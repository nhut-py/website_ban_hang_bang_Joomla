<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author RickG, jseros, Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_categoryform_general.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


$mainframe = JFactory::getApplication();
?>

<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: info; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_FORM_GENERAL'); ?>
		</div>
	</div>
	<div class="uk-card-body">

		<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_CATEGORY_NAME', VmHtml::input('category_name', $this->category->category_name, 'class="required inputbox"') . $this->origLang); ?>
		<?php echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_SLUG', VmHtml::input('slug', $this->category->slug) . $this->origLang); ?>
		<?php //echo VmHTML::row('input','COM_VIRTUEMART_SLUG','slug',$this->category->slug); ?><?php //echo $this->origLang ?>
		<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_PUBLISHED', 'published', $this->category->published); ?>
		<?php if ($this->showVendors()) {
			echo VmuikitHtml::row('checkbox', 'COM_VIRTUEMART_SHARED', 'shared', $this->category->shared);
			echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->vendorList);
		} ?>


	</div>

</div>


