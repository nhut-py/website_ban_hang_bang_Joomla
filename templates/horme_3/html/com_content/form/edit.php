<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.tabstate');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidator');
//JHtml::_('formbehavior.chosen', 'select');
//JHtml::_('behavior.modal', 'a.modal_jform_contenthistory');

// Create shortcut to parameters.
$params = $this->state->get('params');
//$images = json_decode($this->item->images);
//$urls = json_decode($this->item->urls);

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);
if (!$editoroptions)
{
	$params->show_urls_images_frontend = '0';
}

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			" . $this->form->getField('articletext')->save() . "
			Joomla.submitform(task);
		}
	}
");

?>

<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
	<?php if ($params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form action="<?php echo JRoute::_('index.php?option=com_content&a_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
		<fieldset>
      <div class="tabpanel">
  			<ul class="nav nav-tabs" role="tablist" id="myTab">
  				<li role="presentation" class="active"><a href="#editor" role="tab"><?php echo JText::_('COM_CONTENT_ARTICLE_CONTENT') ?></a></li>
  				<?php if ($params->get('show_urls_images_frontend') ) : ?>
  				<li role="presentation"><a href="#images" role="tab"><?php echo JText::_('COM_CONTENT_IMAGES_AND_URLS') ?></a></li>
  				<?php endif; ?>
  				<?php foreach ($this->form->getFieldsets('params') as $name => $fieldSet) : ?>
  				<li><a href="#params-<?php echo $name; ?>" data-toggle="tab"><?php echo JText::_($fieldSet->label); ?></a></li>
  				<?php endforeach; ?>
  				<li role="presentation"><a href="#publishing" role="tab"><?php echo JText::_('COM_CONTENT_PUBLISHING') ?></a></li>
  				<li role="presentation"><a href="#language" role="tab" ><?php echo JText::_('JFIELD_LANGUAGE_LABEL') ?></a></li>
  				<li role="presentation"><a href="#metadata" role="tab"><?php echo JText::_('COM_CONTENT_METADATA') ?></a></li>
  			</ul>
  			<div class="tab-content">
  				<div class="tab-pane active" id="editor">
  					<?php echo $this->form->renderField('title'); ?>

  					<?php if (is_null($this->item->id)) : ?>
  						<?php echo $this->form->renderField('alias'); ?>
  					<?php endif; ?>

  					<?php echo $this->form->getInput('articletext'); ?>
  				</div>
  				<?php if ($params->get('show_urls_images_frontend')): ?>
  				<div class="tab-pane" id="images">
  					<?php echo $this->form->renderField('image_intro', 'images'); ?>
  					<?php echo $this->form->renderField('image_intro_alt', 'images'); ?>
  					<?php echo $this->form->renderField('image_intro_caption', 'images'); ?>
  					<?php echo $this->form->renderField('float_intro', 'images'); ?>
  					<?php echo $this->form->renderField('image_fulltext', 'images'); ?>
  					<?php echo $this->form->renderField('image_fulltext_alt', 'images'); ?>
  					<?php echo $this->form->renderField('image_fulltext_caption', 'images'); ?>
  					<?php echo $this->form->renderField('float_fulltext', 'images'); ?>
  					<?php echo $this->form->renderField('urla', 'urls'); ?>
  					<?php echo $this->form->renderField('urlatext', 'urls'); ?>
  					<div class="form-group">
  					  <?php echo $this->form->getInput('targeta', 'urls'); ?>
  					</div>
  					<?php echo $this->form->renderField('urlb', 'urls'); ?>
  					<?php echo $this->form->renderField('urlbtext', 'urls'); ?>
  					<div class="form-group">
  					  <?php echo $this->form->getInput('targetb', 'urls'); ?>
  					</div>
  					<?php echo $this->form->renderField('urlc', 'urls'); ?>
  					<?php echo $this->form->renderField('urlctext', 'urls'); ?>
  					<div class="form-group">
  					  <?php echo $this->form->getInput('targetc', 'urls'); ?>
  					</div>
  				</div>
  				<?php endif; ?>
  				<?php foreach ($this->form->getFieldsets('params') as $name => $fieldSet) : ?>
  					<div class="tab-pane" id="params-<?php echo $name; ?>">
  						<?php foreach ($this->form->getFieldset($name) as $field) : ?>
  							<?php echo $field->renderField(); ?>
  						<?php endforeach; ?>
  					</div>
  				<?php endforeach; ?>
  				<div class="tab-pane" id="publishing">
  					<?php echo $this->form->renderField('catid'); ?>
  					<?php echo $this->form->renderField('tags'); ?>
  					<?php if ($params->get('save_history', 0)) : ?>
  						<?php echo $this->form->renderField('version_note'); ?>
  					<?php endif; ?>
  					<?php echo $this->form->renderField('created_by_alias'); ?>
  					<?php if ($this->item->params->get('access-change')) : ?>
  						<?php echo $this->form->renderField('state'); ?>
  						<?php echo $this->form->renderField('featured'); ?>
  						<?php echo $this->form->renderField('publish_up'); ?>
  						<?php echo $this->form->renderField('publish_down'); ?>
  					<?php endif; ?>
  					<?php echo $this->form->renderField('access'); ?>
  					<?php if (is_null($this->item->id)):?>
  						<div class="form-group">
  						  <?php echo JText::_('COM_CONTENT_ORDERING'); ?>
  						</div>
  					<?php endif; ?>
  				</div>
  				<div class="tab-pane" id="language">
  					<?php echo $this->form->renderField('language'); ?>
  				</div>
  				<div class="tab-pane" id="metadata">
  					<?php echo $this->form->renderField('metadesc'); ?>
  					<?php echo $this->form->renderField('metakey'); ?>

  					<input type="hidden" name="task" value="" />
  					<input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
  					<?php if ($this->params->get('enable_category', 0) == 1) :?>
  					<input type="hidden" name="jform[catid]" value="<?php echo $this->params->get('catid', 1); ?>" />
  					<?php endif; ?>
  				</div>
  			</div>
  			<?php echo JHtml::_('form.token'); ?>
      </div>
		</fieldset>
    <hr>
		<div class="btn-toolbar text-center">
      <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('article.save')">
        <span class="glyphicon glyphicon-ok"></span> <?php echo JText::_('JSAVE') ?>
      </button>

      <button type="button" class="btn" onclick="Joomla.submitbutton('article.cancel')">
        <span class="glyphicon glyphicon-remove"></span> <?php echo JText::_('JCANCEL') ?>
      </button>

      <?php if ($params->get('save_history', 0) && $this->item->id) : ?>
      <?php echo $this->form->getInput('contenthistory'); ?>
      <?php endif; ?>
		</div>
    <hr>
	</form>
</div>
<script>
jQuery('#adminForm').find('.icon-calendar').addClass('glyphicon glyphicon-calendar')
.end()
.find('div.editor').addClass('clearfix')
.end()
.find('div.input-append').addClass('input-group')
.end()
.find('i.glyphicon-file-add').addClass('glyphicon-file')
.end()
.find('i.glyphicon-copy').addClass('glyphicon-minus').removeClass('glyphicon-copy');

jQuery('#jform_publish_down_img, #jform_publish_up_img').wrap('<span class="input-group-btn"></span>');
jQuery('#myTab a').click(function (e) {
  e.preventDefault()
  jQuery(this).tab('show');
});
jQuery('span.icon-remove').addClass('glyphicon glyphicon-remove').parent('a').addClass('btn-default');
jQuery('a.modal').removeClass('modal').addClass('btn-primary');

jQuery(function($) {
	SqueezeBox.initialize({});
	SqueezeBox.assign($('#jform_images_image_intro + a, #jform_images_image_fulltext + a').get(), {
		parse: 'rel'
	});
});
</script>