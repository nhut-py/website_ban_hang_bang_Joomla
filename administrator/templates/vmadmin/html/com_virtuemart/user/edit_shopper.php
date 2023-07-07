<?php
/**
 *
 * Modify user form view, User info
 *
 * @package    VirtueMart
 * @subpackage User
 * @author Oscar van Eijk
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_shopper.php 10438 2021-01-22 07:18:16Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>
<div class="uk-grid-match uk-grid-small uk-child-width-1-1 uk-child-width-1-2@l" uk-grid>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: user; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_SHOPPER_FORM_LBL'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php
				if ($this->showVendors()) {
					echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_USER_FORM_ISVENDOR', 'user_is_vendor', $this->userDetails->user_is_vendor);
				}
				echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_VENDOR', $this->lists['vendors']);
				if (!empty($this->lists['vendor'])) {
					echo VmuikitHtml::row('raw', 'COM_VM_VENDOR_USER', $this->lists['vendors']);
				}
				echo VmuikitHtml::row('input', 'COM_VIRTUEMART_USER_FORM_CUSTOMER_NUMBER', 'customer_number', $this->lists['custnumber']);
				echo VmuikitHtml::row('raw', 'COM_VIRTUEMART_SHOPPER_FORM_GROUP', $this->lists['shoppergroups']);
				?>
			</div>
		</div>
	</div>
	<?php if ($this->userDetails->JUser->get('id')) { ?>
		<div>
			<div class="uk-card uk-card-small uk-card-vm">
				<div class="uk-card-header">
					<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: location; ratio: 1.2"></span>
						<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL'); ?>
					</div>
				</div>
				<div class="uk-card-body">
					<?php
					// <a
					// href="/administrator/index.php?option=com_virtuemart&view=user&task=addST&new=1&addrtype=ST&virtuemart_user_id[]=134&37079fa6c004f852b97fa1bca43b89ef=1">
					//<span class="vmicon vmicon-16-editadd"></span> Add Address </a><ul></ul>
					$this->lists['shipTo'] = str_replace('<span class="vmicon vmicon-16-editadd"></span>', '<span uk-icon="plus-circle"></span>', $this->lists['shipTo']);

					echo $this->lists['shipTo'];
					?>
				</div>
			</div>
		</div>
	<?php } ?>

	<div>
		<div class="uk-card uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: user; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_LEGEND_USERDETAILS'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php
				$_k = 0;
				$_set = false;
				$_table = false;
				$_hiddenFields = '';

				if (count($this->userFieldsBT['functions']) > 0) {
					echo '<script language="javascript">' . "\n";
					echo join("\n", $this->userFieldsBT['functions']);
					echo '</script>' . "\n";
				}

				foreach ($this->userFieldsBT['fields'] as $field) {
					if ($field ['hidden'] == true) {
						echo $field['formcode'];
						continue;
					}
					if ($field ['type'] == 'delimiter') {
						?>
						<h3>
							<?php echo $field['title'] ?>
						</h3>
						<?php
						continue;
					}

					?>
					<div class="uk-margin">
						<label class="uk-form-label" for="<?php echo $field['name'] . '_field' ?>">
							<?php echo $field['title'] ?>
						</label>
						<div class="uk-form-controls <?php echo $field['required'] ? 'required' : '' ?>">
							<?php echo $field['formcode'] ?>
						</div>
					</div>
					<?php

				}
				?>
				<input type="hidden" name="virtuemart_userinfo_id" value="<?php echo $this->userInfoID; ?>"/>
				<input type="hidden" name="address_type" value="BT"/>

			</div>
		</div>
	</div>
</div>


<script language="javascript" type="text/javascript">
	function gotocontact (id) {
		var form = document.adminForm
		form.target = '_parent'
		form.contact_id.value = id
		form.option.value = 'com_users'
		submitform('contact')
	}
</script>

<div class="uk-margin-top uk-grid-match uk-grid-small uk-child-width-1-3@m" uk-grid>
	<div>
		<div class="uk-card uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: user; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_LEGEND_USERDETAILS'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php if ($this->lists['canBlock']) { ?>
					<div class="uk-margin">
						<label class="uk-form-label">
							<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_BLOCKUSER'); ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->lists['block']; ?>
						</div>
					</div>
				<?php } ?>
				<?php if ($this->lists['canSetMailopt']) { ?>
					<div class="uk-margin">
						<label class="uk-form-label">
							<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_RECEIVESYSTEMEMAILS'); ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->lists['sendEmail']; ?>
						</div>
					</div>
				<?php } else {
					?>
					<input type="hidden" name="sendEmail" value="0"/>
					<?php
				} ?>

				<?php if ($this->userDetails->JUser) { ?>
					<div class="uk-margin">
						<label class="uk-form-label">
							<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_REGISTERDATE'); ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->userDetails->JUser->get('registerDate'); ?>

						</div>
					</div>
					<div class="uk-margin">
						<label class="uk-form-label">
							<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_LASTVISITDATE'); ?>
						</label>
						<div class="uk-form-controls">
							<?php echo $this->userDetails->JUser->get('lastvisitDate'); ?>

						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: cog; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_LEGEND_PARAMETERS'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php
				if (is_callable(array($this->lists['params'], 'render'))) {
					echo $this->lists['params']->render('params');
				}
				?>

			</div>
		</div>
	</div>
	<div>
		<div class="uk-card   uk-card-small uk-card-vm">
			<div class="uk-card-header">
				<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: info; ratio: 1.2"></span>
					<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_LEGEND_CONTACTINFO'); ?>
				</div>
			</div>
			<div class="uk-card-body">
				<?php if (!$this->contactDetails) { ?>
					<table class="admintable" cellspacing="1">
						<tr>
							<td>
								<br/>
								<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_NOCONTACTDETAILS_1'); ?>
								<br/>
								<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_NOCONTACTDETAILS_2'); ?>
								<br/><br/>
							</td>
						</tr>
					</table>
				<?php } else { ?>
					<table class="admintable" cellspacing="1">
						<tr>
							<td width="15%">
								<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_CONTACTDETAILS_NAME'); ?>:
							</td>
							<td>
								<strong><?php echo $this->contactDetails->name; ?></strong>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_CONTACTDETAILS_POSITION'); ?>:
							</td>
							<td>
								<strong><?php echo $this->contactDetails->con_position; ?></strong>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_CONTACTDETAILS_TELEPHONE'); ?>:
							</td>
							<td>
								<strong><?php echo $this->contactDetails->telephone; ?></strong>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo vmText::_('COM_VIRTUEMART_SHOPPER_FORM_FAX'); ?>:
							</td>
							<td>
								<strong><?php echo $this->contactDetails->fax; ?></strong>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<strong><?php echo $this->contactDetails->misc; ?></strong>
							</td>
						</tr>
						<?php if ($this->contactDetails->image) { ?>
							<tr>
								<td></td>
								<td valign="top">
									<img src="/images/stories/<?php echo $this->contactDetails->image; ?>"
											align="middle"
											alt="Contact"/>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="2">
								<br/>
								<input class="button" type="button"
										value="<?php echo vmText::_('COM_VIRTUEMART_USER_FORM_CONTACTDETAILS_CHANGEBUTTON'); ?>"
										onclick="javascript: gotocontact( '<?php echo $this->contactDetails->id; ?>' )">
							</td>
						</tr>
					</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="virtuemart_user_id" value="<?php echo $this->userDetails->JUser->get('id'); ?>"/>
<input type="hidden" name="virtuemart_user_id[]" value="<?php echo $this->userDetails->JUser->get('id'); ?>"/>
<input type="hidden" name="contact_id" value=""/>



