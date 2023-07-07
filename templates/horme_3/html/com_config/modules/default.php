<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

JHtml::_('behavior.combobox');
//JHtml::_('formbehavior.chosen', 'select');

$hasContent = empty($this->item['module']) || $this->item['module'] == 'custom' || $this->item['module'] == 'mod_custom';

// If multi-language site, make language read-only
if (JLanguageMultilang::isEnabled())
{
	$this->form->setFieldAttribute('language', 'readonly', 'true');
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel.modules' || document.formvalidator.isValid(document.getElementById('modules-form')))
		{
			Joomla.submitform(task, document.getElementById('modules-form'));
		}
	}
");
?>
<h1 class="page-header"><?php echo JText::_('COM_CONFIG_MODULES_SETTINGS_TITLE'); ?></h1>

<form
	action="<?php echo JRoute::_('index.php?option=com_config'); ?>"
	method="post" name="adminForm" id="modules-form"
	class="form-validate well">

	<div class="row">
		<!-- Begin Content -->
		<div class="col-md-12">

			<div class="text-center lead">
				<?php echo JText::_('COM_CONFIG_MODULES_MODULE_NAME') ?>
				<span class="label label-default"><?php echo $this->item['title'] ?></span>
				&nbsp;&nbsp;
				<?php echo JText::_('COM_CONFIG_MODULES_MODULE_TYPE') ?>
				<span class="label label-default"><?php echo $this->item['module'] ?></span>
			</div>
      <hr>
			<div class="row">
				<div class="col-md-12">
					<fieldset>
						<div class="form-group">
							<?php echo $this->form->getLabel('title'); ?>
							<?php echo $this->form->getInput('title'); ?>
						</div>
						<div class="form-group">
							<?php echo $this->form->getLabel('showtitle'); ?>
							<?php echo $this->form->getInput('showtitle'); ?>
						</div>
						<div class="form-group">
							<?php echo $this->form->getLabel('position'); ?>
							<?php echo $this->loadTemplate('positions'); ?>
						</div>

						<hr>

						<?php
						if (JFactory::getUser()->authorise('core.edit.state', 'com_modules.module.' . $this->item['id'])): ?>
						<div class="form-group">
							<?php echo $this->form->getLabel('published'); ?>
							<?php echo $this->form->getInput('published'); ?>
						</div>
						<?php endif ?>

						<div class="form-group">
								<?php echo $this->form->getLabel('publish_up'); ?>
								<?php echo $this->form->getInput('publish_up'); ?>
						</div>
						<div class="form-group">
								<?php echo $this->form->getLabel('publish_down'); ?>
								<?php echo $this->form->getInput('publish_down'); ?>
						</div>
						<div class="form-group">
								<?php echo $this->form->getLabel('access'); ?>
								<?php echo $this->form->getInput('access'); ?>
						</div>
						<div class="form-group">
								<?php echo $this->form->getLabel('ordering'); ?>
								<?php echo $this->form->getInput('ordering'); ?>
						</div>

						<div class="form-group">
								<?php echo $this->form->getLabel('language'); ?>
								<?php echo $this->form->getInput('language'); ?>
						</div>
						<div class="form-group">
								<?php echo $this->form->getLabel('note'); ?>
								<?php echo $this->form->getInput('note'); ?>
						</div>
						<div id="options">
							<?php echo $this->loadTemplate('options'); ?>
						</div>

						<?php if ($hasContent): ?>
							<div class="tab-pane" id="custom">
								<?php echo $this->form->getInput('content'); ?>
							</div>
						<?php endif; ?>
					</fieldset>
				</div>

				<input type="hidden" name="id" value="<?php echo $this->item['id'];?>" />
				<input type="hidden" name="return" value="<?php echo JFactory::getApplication()->input->get('return', null, 'base64');?>" />
				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>

			</div>
			<hr>
			<div class="text-center">
				<button type="button" class="btn btn-default btn-primary"
					onclick="Joomla.submitbutton('config.save.modules.apply')">
					<span class="glyphicon glyphicon-ok"></span>
					<?php echo JText::_('JAPPLY') ?>
				</button>
				<button type="button" class="btn btn-default"
					onclick="Joomla.submitbutton('config.save.modules.save')">
					<span class="glyphicon glyphicon-floppy-saved"></span>
					<?php echo JText::_('JSAVE') ?>
				</button>
				<button type="button" class="btn"
					onclick="Joomla.submitbutton('config.cancel.modules')">
					<span class="glyphicon glyphicon-remove"></span>
					<?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
			<hr>
		</div>
		<!-- End Content -->
	</div>

</form>
<script>
  jQuery('fieldset').removeClass('radio btn-group');
	jQuery('#modules-form').find('i.icon-calendar').addClass('glyphicon glyphicon-calendar')
	.end()
	.find('div.input-append').addClass('input-group');
	jQuery('#jform_publish_down_img, #jform_publish_up_img').wrap('<span class="input-group-btn"></span>');
</script>