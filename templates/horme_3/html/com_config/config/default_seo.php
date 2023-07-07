<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<fieldset class="panel panel-default">
  <div class="panel-heading">
  	<legend><?php echo JText::_('COM_CONFIG_SEO_SETTINGS'); ?></legend>
  </div>
  <div class="panel-body">
	<?php
	foreach ($this->form->getFieldset('seo') as $field):
	?>
		<div class="form-group">
			<?php echo $field->label; ?>
			<?php echo $field->input; ?>
		</div>
	<?php
	endforeach;
	?>
  </div>
</fieldset>
