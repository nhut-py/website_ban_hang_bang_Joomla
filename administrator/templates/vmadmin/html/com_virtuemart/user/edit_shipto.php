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
 * @version $Id: edit_shipto.php 10396 2021-01-11 11:35:30Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>

<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: location; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_SHOPPER_FORM_SHIPTO_LBL'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		$_k = 0;
		$_set = false;
		$_table = false;
		$_hiddenFields = '';

		if (count($this->shipToFields['functions']) > 0) {
			echo '<script language="javascript">' . "\n";
			echo join("\n", $this->shipToFields['functions']);
			echo '</script>' . "\n";
		}
		foreach ($this->shipToFields['fields'] as $field) {
			if ($field ['hidden'] == true) {
				echo $field['formcode'];
				continue;
			}
			if ($field ['type'] == 'delimiter') {
				?>
				<h4>
					<?php echo $field['title'] ?>
				</h4>
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


		if (!empty($this->virtuemart_userinfo_id)) {
			?>
			<input type="hidden" name="shipto_virtuemart_userinfo_id" value="<?php echo $this->shipToId ?>"/>
			<?php
		}
		?>
	</div>
</div>

