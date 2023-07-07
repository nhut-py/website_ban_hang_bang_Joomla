<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.core');
//JHtml::_('formbehavior.chosen', 'select');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
$canEdit = $user->authorise('core.edit', 'com_tags');
$canCreate = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');

$columns = $this->params->get('tag_columns', 1);

// Avoid division by 0 and negative columns.
if ($columns < 1)
{
	$columns = 1;
}

$bsspans = floor(12 / $columns);

if ($bsspans < 1)
{
	$bsspans = 1;
}

$bscolumns = min($columns, floor(12 / $bsspans));
$n = count($this->items);
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
<?php if ($this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
  <hr>
	<fieldset class="filters">
    <div class="row">
  		<?php if ($this->params->get('filter_field')) : ?>
      <div class="col-md-6">
    		<label class="filter-search-lbl sr-only" for="filter-search">
    			<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL') . '&#160;'; ?>
    		</label>
        <div class="input-group">
    			<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" title="<?php echo JText::_('COM_TAGS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>" />
          <span class="input-group-btn">
            <button class="btn btn-primary">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
      </div>
  		<?php endif; ?>
  		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="col-md-6 text-right">
				<label for="limit">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
  		<?php endif; ?>
  		<input type="hidden" name="filter_order" value="" />
  		<input type="hidden" name="filter_order_Dir" value="" />
  		<input type="hidden" name="limitstart" value="" />
  		<input type="hidden" name="task" value="" />
    </div>
  </fieldset>
  <hr>
<?php endif; ?>

<?php if ($this->items == false || $n == 0) : ?>
  <p><?php echo JText::_('COM_TAGS_NO_TAGS'); ?></p>
<?php else : ?>
  <div class="row">
  <?php foreach ($this->items as $i => $item) : ?>

    <?php if ($n == 1 || $i == 0 || $bscolumns == 1 || $i % $bscolumns == 0) : ?>
    <div class="col-md-<?php echo $bsspans; ?>">
      <ul class="list-unstyled">
    <?php endif; ?>

  	  <?php if ((!empty($item->access)) && in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
   		<li class="cat-list-row<?php echo $i % 2; ?>" >
  			<h3>
  				<a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($item->id . '-' . $item->alias)); ?>">
  					<span class="glyphicon glyphicon-tag"></span> <?php echo $this->escape($item->title); ?>
  				</a>
  			</h3>
  	  <?php endif; ?>
  		<?php if ($this->params->get('all_tags_show_tag_image') && !empty($item->images)) : ?>
  			<?php $images  = json_decode($item->images); ?>
  			<div class="tag-body clearfix">
  			<?php if (!empty($images->image_intro)): ?>
  				<?php $imgfloat = (empty($images->float_intro)) ? $this->params->get('float_intro') : $images->float_intro; ?>
  				<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image thumbnail clearfix">
  					<img src="<?php echo $images->image_intro; ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
            <?php if ($images->image_intro_caption) : ?>
            <div class="caption text-center">
              <?php echo htmlspecialchars($images->image_intro_caption); ?>
            </div>
            <?php endif; ?>
          </div>
  		  <?php endif; ?>
  			</div>
  		<?php endif; ?>
  		  <div class="caption">
  			  <?php if ($this->params->get('all_tags_show_tag_description', 1)) : ?>
  					<?php echo JHtml::_('string.truncate', $item->description, $this->params->get('tag_list_item_maximum_characters')); ?>
  			  <?php endif; ?>
  			  <?php if ($this->params->get('all_tags_show_tag_hits')) : ?>
  				<span class="list-hits bold small">
  					<?php echo JText::sprintf('JGLOBAL_HITS_COUNT', $item->hits); ?>
  				</span>
  			  <?php endif; ?>
  		  </div>
        <hr>
  	  </li>

  	<?php if (($i == 0 && $n == 1) || $i == $n - 1 || $bscolumns == 1 || (($i + 1) % $bscolumns == 0)) : ?>
  	  </ul>
    </div>
  	<?php endif; ?>

  <?php endforeach; ?>
  </div>
<?php endif;?>

<?php // Add pagination links ?>
<?php if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
	<div class="margin-top text-center">

		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php endif; ?>

		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>
</form>
<?php endif; ?>
