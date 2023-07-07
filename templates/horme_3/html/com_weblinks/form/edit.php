<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_weblinks
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
//JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.modal', 'a.modal_jform_contenthistory');

// Create shortcut to parameters.
$params = $this->state->get('params');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'weblink.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task);
		}
	}
</script>
<div class="edit<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="page-header">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_weblinks&view=form&w_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
		<?php echo $this->form->renderField('title'); ?>
		<?php echo $this->form->renderField('alias'); ?>
		<?php echo $this->form->renderField('catid'); ?>
		<?php echo $this->form->renderField('url'); ?>
		<?php echo $this->form->renderField('tags'); ?>

		<?php if ($params->get('save_history', 0)) : ?>
			<?php echo $this->form->renderField('version_note'); ?>
		<?php endif; ?>

		<?php if ($this->user->authorise('core.edit.state', 'com_weblinks.weblink')) : ?>
			<?php echo $this->form->renderField('state'); ?>
		<?php endif; ?>
		<?php echo $this->form->renderField('language'); ?>
		<?php echo $this->form->renderField('description'); ?>
    <hr>
		<div class="btn-toolbar text-center">
      <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('weblink.save')">
        <span class="glyphicon glyphicon-ok"></span> <?php echo JText::_('JSAVE') ?>
      </button>

      <button type="button" class="btn" onclick="Joomla.submitbutton('weblink.cancel')">
        <span class="glyphicon glyphicon-remove"></span> <?php echo JText::_('JCANCEL') ?>
      </button>
      <?php if ($params->get('save_history', 0)) {
      echo $this->form->getInput('contenthistory');
      }?>
		</div>
    <hr>
		<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
<script>
jQuery('div.editor').addClass('clearfix');
jQuery('i.glyphicon-file-add').addClass('glyphicon-file');
</script>