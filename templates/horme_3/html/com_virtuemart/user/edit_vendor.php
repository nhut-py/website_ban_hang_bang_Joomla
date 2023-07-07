<?php
/**
*
* Modify user form view, User info
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit_vendor.php 8539 2014-10-30 15:52:48Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
if(!vmAccess::manager('user.editshop')){
?>
<div><?php echo vmText::_('COM_VM_PERM_MISSING_VENDOR');?></div>
<?php
}
?>
<div class="row">
  <div class="col-md-6">
		<fieldset>
			<legend>
				<?php echo vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL') ?>
			</legend>
      <div class="form-group">
				<label for="vendor_store_name"><?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_STORE_NAME'); ?>:</label>
        <input class="inputbox" type="text" name="vendor_store_name" id="vendor_store_name" size="50" value="<?php echo $this->vendor->vendor_store_name; ?>" />
      </div>
      <div class="form-group">
        <label for="vendor_name"><?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_COMPANY_NAME'); ?>:</label>
        <input class="inputbox" type="text" name="vendor_name" id="vendor_name" size="50" value="<?php echo $this->vendor->vendor_name; ?>" />
      </div>
      <div class="form-group">
				<label for="vendor_url"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_URL'); ?>:</label>
				<input class="inputbox" type="text" name="vendor_url" id="vendor_url" size="50" value="<?php echo $this->vendor->vendor_url; ?>" />
      </div>
      <div class="form-group">
				<label for="vendor_min_pov"><?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_MPOV'); ?>:</label>
				<input class="inputbox" type="text" name="vendor_min_pov" id="vendor_min_pov" size="10" value="<?php echo $this->vendor->vendor_min_pov; ?>" />
      </div>
    </fieldset>
  </div>
  <div class="col-md-6">
		<fieldset>
			<legend>
				<?php echo vmText::_('COM_VIRTUEMART_STORE_CURRENCY_DISPLAY') ?>
			</legend>
      <div class="form-group">
				<label><?php echo vmText::_('COM_VIRTUEMART_CURRENCY'); ?>:</label>
        <?php
        if (VmConfig::get ('jchosen')) {

          echo '<div>';
				  echo JHtml::_('Select.genericlist', $this->currencies, 'vendor_currency', 'class="vm-chzn-select"', 'virtuemart_currency_id', 'currency_name', $this->vendor->vendor_currency);
          echo '</div>';

        } else {

          echo JHtml::_('Select.genericlist', $this->currencies, 'vendor_currency', 'class="vm-chzn-select"', 'virtuemart_currency_id', 'currency_name', $this->vendor->vendor_currency);

        } ?>
      </div>
      <div class="form-group">
				<label><?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_ACCEPTED_CURRENCIES'); ?>:</label>
				<?php
        if (VmConfig::get ('jchosen')) {

          echo '<div>';
          echo JHtml::_('Select.genericlist', $this->currencies, 'vendor_accepted_currencies[]', 'size=10 multiple="multiple" class="vm-chzn-select"', 'virtuemart_currency_id', 'currency_name', $this->vendor->vendor_accepted_currencies);
          echo '</div>';

        } else {

          echo JHtml::_('Select.genericlist', $this->currencies, 'vendor_accepted_currencies[]', 'size=10 multiple="multiple" class="vm-chzn-select"', 'virtuemart_currency_id', 'currency_name', $this->vendor->vendor_accepted_currencies);

        } ?>
      </div>
		</fieldset>
  </div>
</div>
<fieldset>
  <div class="form-group">
	<?php
		echo $this->vendor->images[0]->displayFilesHandler($this->vendor->virtuemart_media_id,'vendor');
	?>
  </div>
</fieldset>
<fieldset>
	<legend>
		<?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_DESCRIPTION');?>
	</legend>
  <div class="form-group">
  	<?php echo $this->editor->display('vendor_store_desc', $this->vendor->vendor_store_desc, '100%', 450, 70, 15)?>
  </div>
</fieldset>
<fieldset>
	<legend>
		<?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_TOS');?>
	</legend>
  <div class="form-group">
	  <?php echo $this->editor->display('vendor_terms_of_service', $this->vendor->vendor_terms_of_service, '100%', 450, 70, 15)?>
  </div>
</fieldset>
<fieldset>
	<legend>
		<?php echo vmText::_('COM_VIRTUEMART_STORE_FORM_LEGAL');?>
	</legend>
  <div class="form-group">
	  <?php echo $this->editor->display('vendor_legal_info', $this->vendor->vendor_legal_info, '100%', 400, 70, 15)?>
  </div>
</fieldset>
<input type="hidden" name="user_is_vendor" value="1" />
<input type="hidden" name="virtuemart_vendor_id" value="<?php echo $this->vendor->virtuemart_vendor_id; ?>" />
<input type="hidden" name="last_task" value="<?php echo vRequest::getCmd('task'); ?>" />