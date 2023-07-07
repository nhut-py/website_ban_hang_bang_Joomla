<?php
/**
 *
 * Description
 *
 * @packageVirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_shopfront_coupon.php 10422 2021-01-14 08:42:44Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: gift-box; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_COUPONS_ENABLE'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_COUPONS_ENABLE', 'coupons_enable', VmConfig::get('coupons_enable', 0));


		$_defaultExpTime = array(
			'1,D' => '1 ' . vmText::_('COM_VIRTUEMART_DAY')
		, '1,W' => '1 ' . vmText::_('COM_VIRTUEMART_WEEK')
		, '2,W' => '2 ' . vmText::_('COM_VIRTUEMART_WEEK_S')
		, '1,M' => '1 ' . vmText::_('COM_VIRTUEMART_MONTH')
		, '3,M' => '3 ' . vmText::_('COM_VIRTUEMART_MONTH_S')
		, '6,M' => '6 ' . vmText::_('COM_VIRTUEMART_MONTH_S')
		, '1,Y' => '1 ' . vmText::_('COM_VIRTUEMART_YEAR')
		);
		echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_COUPONS_EXPIRE', VmuikitHtml::selectList('coupons_default_expire', VmConfig::get('coupons_default_expire'), $_defaultExpTime));
		$attrlist = 'class="inputbox" multiple="multiple" ';
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_COUPONS_REMOVE', $this->os_Options, 'cp_rm[]', $attrlist, 'order_status_code', 'order_status_name', VmConfig::get('cp_rm', array('C')), 'cp_rm', true);
		?>
	</div>
</div>
