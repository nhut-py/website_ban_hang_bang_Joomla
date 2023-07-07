<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="registration <?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	  <h1 class="page-header"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
		<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
			<?php $fields = $this->form->getFieldset($fieldset->name);?>
			<?php if (count($fields)):?>
				<fieldset>
				<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
					<legend>
            <?php echo JText::_($fieldset->label);?>
          </legend>
				<?php endif;?>
				<?php foreach ($fields as $field) :// Iterate through the fields in the set and display them.?>
					<?php if ($field->hidden):// If the field is hidden, just display the input.?>
						<?php echo $field->input;?>
					<?php else:?>
						<div class="form-group">
							<?php echo $field->label; ?>
							<?php if (!$field->required && $field->type != 'Spacer') : ?>
								<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
							<?php endif; ?>
							<?php echo $field->input;?>
						</div>
					<?php endif;?>
				<?php endforeach;?>
				</fieldset>
			<?php endif;?>
		<?php endforeach;?>
    <hr>
		<div class="form-group text-center">
  		<button type="submit" class="btn btn-primary validate">
        <span class="glyphicon glyphicon-edit"></span>
        <?php echo JText::_('JREGISTER');?>
      </button>
  		<a class="btn btn-default" href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>">
        <span class="glyphicon glyphicon-remove"></span>
        <?php echo JText::_('JCANCEL');?>
      </a>
  		<input type="hidden" name="option" value="com_users" />
  		<input type="hidden" name="task" value="registration.register" />
		</div>
		<?php echo JHtml::_('form.token');?>
	</form>
</div>
<script>
jQuery('span.text').addClass('alert alert-info center-block');
</script>