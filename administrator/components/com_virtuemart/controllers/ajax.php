<?php
/**
 *
 * Media controller
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: ajax.php 10405 2021-01-11 18:06:36Z alatak $
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controllerform library
jimport('joomla.application.component.controller');


use Joomla\CMS\Response\JsonResponse;


class VirtueMartControllerAjax extends JControllerLegacy {
	public function __construct() {
		parent::__construct();

		// load the tasks 
		$this->registerTask('getMedias', 'getMedias');
		$this->registerTask('getProductData', 'getProductData');

	}

	public function getProductData() {
		$filter = trim(vRequest::getVar('q', vRequest::getVar('term', '')));

		$db = JFactory::getDBO();
		$virtuemart_product_id = vRequest::getInt('virtuemart_product_id', array());
		if (is_array($virtuemart_product_id) && count($virtuemart_product_id) > 0) {
			$product_id = (int)$virtuemart_product_id[0];
		} else {
			$product_id = (int)$virtuemart_product_id;
		}
		$useFb = vmLanguage::getUseLangFallback();
		$useFb2 = vmLanguage::getUseLangFallbackSecondary();
		$type = vRequest::getCmd('type', '');
		switch ($type) {
			case 'relatedcategories':
				{


					$query = "SELECT c.virtuemart_category_id AS id, ";

					$langField = 'category_name';
					if ($useFb) {
						$f2 = 'ld.' . $langField;
						if ($useFb2) {
							$f2 = 'IFNULL(ld.' . $langField . ', ljd.' . $langField . ')';
						}
						$field = 'IFNULL(l.' . $langField . ',' . $f2 . ')';
					} else {
						$field = 'l.' . $langField;
					}

					$query .= ' CONCAT(' . $field . ', "::", c.virtuemart_category_id) AS value';
					$query .= ' FROM `#__virtuemart_categories` AS c ';

					$joinedTables = VmModel::joinLangTables('#__virtuemart_categories', 'c', 'virtuemart_category_id');
					$query .= " \n" . implode(" \n", $joinedTables);
					if (!empty($filter)) {
						
						$filter = '"%' . $db->escape($filter, true) . '%"';
						$fields = VmModel::joinLangLikeFields(array('category_name'), $filter);
						$query .= ' WHERE ' . implode(' OR ', $fields);
					}

					$json = self::getRelated($product_id, $query, 'Z');
				}
				break;
			case 'relatedproducts':
				{

					$query = "SELECT p.virtuemart_product_id AS id, ";

					$langField = 'product_name';
					if($useFb){
						$f2 = 'ld.'.$langField;
						if($useFb2){
							$f2 = 'IFNULL(ld.'.$langField.', ljd.'.$langField.')';
						}
						$field = 'IFNULL(l.'.$langField.','.$f2.')';
					} else {
						$field = 'l.'.$langField;
					}

					$query .= ' CONCAT('.$field.', "::", p.product_sku) AS value';
					$query .= ' FROM `#__virtuemart_products` AS p ';

					$joinedTables = VmModel::joinLangTables('#__virtuemart_products','p','virtuemart_product_id');
					$query .= " \n".implode(" \n",$joinedTables);
					if (!empty($filter)){
						$filter = '"%'.$db->escape( $filter, true ).'%"';
						$fields = VmModel::joinLangLikeFields(array('product_name'),$filter);
						$query .=  ' WHERE '.implode (' OR ', $fields) ;
						$query .= ' OR p.product_sku LIKE '.$filter;
					}

					$json = self::getRelated($product_id,$query,'R');
				}
				break;
			case 'fields':
				{
					$thisRow  = vRequest::getInt('row', false);
					$id = vRequest::getInt('id', false);
						$fieldTypes = VirtueMartModelCustom::getCustomTypes();
						$model = VmModel::getModel('custom');
						$q = 'SELECT `virtuemart_custom_id` FROM `#__virtuemart_customs`WHERE (`custom_parent_id`=' . $id . ') ';
						$q .= 'order by `ordering` asc';
						$db->setQuery($q);
						$ids = $db->loadColumn();
						if ($ids) {
							array_unshift($ids, $id);
						} else {
							$ids = array($id);
						}

						foreach ($ids as $k => $i) {
							$p = $model->getCustom($i);
							if ($p) {
								$p->value = $p->custom_value;
								$rows[] = $p;
							}
						}
					$modelCustomfields = VmModel::getModel('Customfields');
						$html = array();
						foreach ($rows as $field) {
							$customcf= new stdClass();
							if ($field->field_type == 'deprecatedwasC') {
								$childcf= new stdClass();
								$json['table'] = 'childs';
								$q = 'SELECT `virtuemart_product_id` FROM `#__virtuemart_products` WHERE `published`=1 AND `product_parent_id`= ' . vRequest::getInt('virtuemart_product_id');
								//$this->db->setQuery(' SELECT virtuemart_product_id, product_name FROM `#__virtuemart_products` WHERE `product_parent_id` ='.(int)$product_id);
								$db->setQuery($q);
								if ($childIds = $db->loadColumn()) {
									// Get childs
									foreach ($childIds as $childId) {
										$field->custom_value = $childId;
										$display = $modelCustomfields->displayProductCustomfieldBE($field, $childId, $thisRow );
										if ($field->is_cart_attribute) {
											$cartIcone = 'default';
										} else {
											$cartIcone = 'default-off';
										}
										$html[] = '<div class="removable">
								<td>' . $field->custom_title . '</td>
								 <td>' . $display . $field->custom_tip . '</td>
								 <td>' . vmText::_($fieldTypes[$field->field_type]) . '
								' . $modelCustomfields->setEditCustomHidden($field, $thisRow ) . '
								 </td>
								 <td><span class="vmicon vmicon-16-' . $cartIcone . '"></span></td>
								 <td></td>
								</div>';
										$customcf->canMove=true;
										$customcf->canRemove=true;
										$customcf->type=vmText::_($fieldTypes[$field->field_type]) ;
										$customcf->title=$field->custom_tip;
										$customcf->is_cart_attribute=$field->is_cart_attribute;
										$customcf->hiddenHTML=$modelCustomfields->setEditCustomHidden($field, $thisRow );
										$customcf->displayHTML= $modelCustomfields->displayProductCustomfieldBE($field, $childId, $thisRow );
										$customcfs[]=$customcf;
										$thisRow ++;
									}
								}
							} else { //if ($field->field_type =='E') {
								$json['table'] = 'customPlugins';
								$colspan = '';
								if ($field->field_type == 'E') {
									$modelCustomfields->bindCustomEmbeddedFieldParams($field, 'E');
								} else {
									if ($field->field_type == 'C') {
										$colspan = 'colspan="2" ';
									}
								}

								$display = $modelCustomfields->displayProductCustomfieldBE($field, $product_id, $thisRow );
								if ($field->is_cart_attribute) {
									$cartIcone = 'default';
								} else {
									$cartIcone = 'default-off';
								}
								$field->virtuemart_product_id = $product_id;
								$html[] = '
					<tr class="removable">
						<td>
							<b>' . vmText::_($fieldTypes[$field->field_type]) . '</b> ' . vmText::_($field->custom_title) . '</span><br/>

								<span class="vmicon vmicon-16-' . $cartIcone . '"></span>
								<span class="vmicon vmicon-16-move"></span>
								<span class="vmicon vmicon-16-remove 4remove"></span>

						' . $modelCustomfields->setEditCustomHidden($field, $thisRow ) . '
					 	</td>
							<td ' . $colspan . '>' . $display . '</td>
						 </tr>
					</tr>';
								$customcf->canMove=true;
								$customcf->canRemove=true;
								$customcf->type=vmText::_($fieldTypes[$field->field_type]) ;
								$customcf->title=vmText::_($field->custom_title);
								$customcf->is_cart_attribute=$field->is_cart_attribute;
								$customcf->hiddenHTML=$modelCustomfields->setEditCustomHidden($field, $thisRow );
								$customcf->displayHTML= $display;
								$customcfs[]=$customcf;


								$thisRow ++;

							}
						}

					$json = $customcfs;

				}
				break;

		}



		echo vmJsApi::safe_json_encode($json);
		jexit();
	}

	function getRelated($product_id, $query, $fieldType) {
		$row = vRequest::getInt('row', false);
		$model = VmModel::getModel('Customfields');
		$db = JFactory::getDBO();
		$db->setQuery($query . ' limit 0,50');
		$json = $db->loadObjectList();
		if (!($json)) {
			echo('setRelatedHtml ' . $query);
			return;
		}
		$query = 'SELECT * FROM `#__virtuemart_customs` WHERE field_type ="' . $fieldType . '" ';
		$db->setQuery($query);
		$custom = $db->loadObject();
		if (!$custom) {
			vmdebug('setRelatedHtml could not find $custom for field type ' . $fieldType);
			return false;
		}
		$custom->virtuemart_product_id = $product_id;
		/*$m = count($json);
		vmdebug('setRelatedHtml '.str_replace('#__',$db->getPrefix(),$db->getQuery()),$m);*/
		foreach ($json as $k => $related) {

			$custom->customfield_value = $related->id;

			$json[$k]->displayHTML = $model->displayProductCustomfieldBE($custom, $related->id, $row);

			$json[$k]->hiddenHTML = $model->setEditCustomHidden($custom, $row);

		}
		return $json;
	}

	public function getMedias() {
		if (!JSession::checkToken()) {
			//echo new JsonResponse(null, JText::_('JINVALID_TOKEN'), true);
			//exit;
		}
		$start = vRequest::getInt('start', 0);
		$max = vRequest::getInt('max', 16);
		$type = vRequest::getCmd('mediatype', '');

		$list = VmMediaHandler::getImagesList($type, $start, $max);
		$images = array();
		foreach ($list['images'] as $key => $vmImage) {
			$image = new stdClass();
			$image->virtuemart_media_id = $vmImage->virtuemart_media_id;
			$image->file_title = $vmImage->file_title;
			$image->file_meta = $vmImage->file_meta;
			$image->file_description = $vmImage->file_description;
			$image->file_url = $vmImage->file_url;
			$image->ordering = $key;

			$vmImage->displayMediaThumb($imageArgs = '', $lightbox = false, $effect = "", $return = false);
			$file_url_thumb = $vmImage->getFileUrlThumb();
			$image->file_url_thumb = JURI::root(false) . '/' . str_replace('/', DS, $file_url_thumb);

			$image->file_url = JURI::root(true) . '/' . $image->file_url;
			$image->file_url_thumb_img = '<img src="'.$image->file_url_thumb.'" alt="'.$image->file_title.'"/>';
			$image->file_url_img = '<img src="'.$image->file_url.'" alt="'.$image->file_title.'"/>';


			$images[] = $image;
		}

		echo vmJsApi::safe_json_encode($images);
		jexit();
	}


}
