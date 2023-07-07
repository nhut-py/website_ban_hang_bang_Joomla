<?php

/**
 *
 * Modify user form view, User info
 *
 * @package	VirtueMart
 * @subpackage User
 * @author Oscar van Eijk, Eugen Stranz
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_address_userfields.php 9222 2016-05-23 11:41:31Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$user = JFactory::getUser();

// Status Of Delimiter
$closeDelimiter = false;
$openTable = true;
$hiddenFields = '';
?>
<fieldset class="col-xs-12">
<?php
// Output: Userfields
foreach($this->userFields['fields'] as $field) {

  if($field['type'] == 'delimiter') {
  ?>

<?php if ($closeDelimiter) : ?>
  </table>
</fieldset>
<fieldset class="col-xs-12">
<?php endif; ?>

  <legend class="userfields_info"><?php echo $field['title'] ?></legend>
  <?php
    $openTable = true;
  } elseif ($field['hidden'] == true) {

    // We collect all hidden fields
    // and output them at the end
    $hiddenFields .= $field['formcode'] . "\n";

  } else {

    if ($openTable) { ?>
    <table class="adminForm user-details">
    <?php
      $openTable = false;
    }

    $descr = empty($field['description'])? $field['title']:$field['description'];
    // Output: Userfields
    ?>
    <tr title="<?php echo strip_tags($descr) ?>">
      <td class="key"  >
        <label class="<?php echo $field['name'] ?>" for="<?php echo $field['name'] ?>_field">
          <?php echo $field['title'] . ($field['required'] ? ' <span class="asterisk">*</span>' : '') ?>
        </label>
      </td>
      <td>
        <?php echo $field['formcode'] ?>
      </td>
    </tr>
  <?php
  }
  $closeDelimiter = true;
} //End foreach

// At the end we have to close the current
// table and delimiter ?>

  </table>
</fieldset>

<?php // Output: Hidden Fields
echo $hiddenFields
?>
<?php if ($user->guest) : ?>
<script>
// Split layput
var fieldsets = jQuery('div.userfields-wrap').find('fieldset');
if (fieldsets.length == 2) {
  fieldsets.addClass('col-sm-6');
}
</script>
<?php endif; ?>