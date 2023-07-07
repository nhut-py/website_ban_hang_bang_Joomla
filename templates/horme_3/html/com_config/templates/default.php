<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
$user = JFactory::getUser();

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'config.cancel' || document.formvalidator.isValid(document.getElementById('templates-form')))
		{
			Joomla.submitform(task, document.getElementById('templates-form'));
		}
	}
");
?>

<form action="<?php echo JRoute::_('index.php?option=com_config'); ?>" method="post" name="adminForm" id="templates-form" class="form-validate">

	<div class="row">
		<!-- Begin Content -->

		<div id="page-site" class="col-md-12">
				<?php // Get the menu parameters that are automatically set but may be modified.
				echo $this->loadTemplate('options'); ?>
		</div>
    <hr>
		<div class="col-md-12 text-center">
				<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('config.save.templates.apply')">
					<span class="glyphicon glyphicon-ok"></span> <?php echo JText::_('JSAVE') ?>
				</button>

				<button type="button" class="btn" onclick="Joomla.submitbutton('config.cancel')">
					<span class="glyphicon glyphicon-remove"></span> <?php echo JText::_('JCANCEL') ?>
				</button>
		</div>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>

		<!-- End Content -->
	</div>

</form>
<script>
jQuery('div.media-preview').addClass('input-group-addon');
jQuery('#params_background').nextAll().wrapAll('<div class="input-group-btn"></div>');
jQuery('div.input-prepend').addClass('input-group').find('a').addClass('btn-default');
jQuery('i.icon-remove').addClass('glyphicon glyphicon-remove');
jQuery('i.icon-eye').addClass('glyphicon glyphicon-eye-open');
</script>