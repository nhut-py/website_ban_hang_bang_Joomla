<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
$n = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->items)) : ?>
<p class="alert alert-info"><?php echo JText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?></p>
<?php else : ?>
<hr>
<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
	<?php if ((($this->params->get('filter_field') != 'hide') || ($this->params->get('filter_field') != '0')) || $this->params->get('show_pagination_limit')) :?>
	<fieldset class="filters">
    <div class="row">
		<?php if (($this->params->get('filter_field') != 'hide') || ($this->params->get('filter_field') != '0')) :?>
			<div class="col-md-6">
        <label class="filter-search-lbl sr-only" for="filter-search"><?php echo JText::_('COM_NEWSFEEDS_FILTER_LABEL') . '&#160;'; ?></label>
        <div class="input-group">
  				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="form-control" title="<?php echo JText::_('COM_NEWSFEEDS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_NEWSFEEDS_FILTER_SEARCH_DESC'); ?>" />
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
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
    </div>
	</fieldset>
	<?php endif; ?>

  <table class="table table-striped">
	<?php foreach ($this->items as $i => $item) : ?>
    <tr>
	    <td class="cat-list-row" >
        <div class="list-title clearfix">
  				<a href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($item->slug, $item->catid)); ?>">
  				<?php echo $item->name; ?>
          </a>
  				<?php if ($this->items[$i]->published == 0) : ?>
  				<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
  				<?php endif; ?>
  			</div>
      </td>
      <td>
  		<?php if ($this->params->get('show_link')) : ?>
  			<?php $link = JStringPunycode::urlToUTF8($item->link); ?>
  			<span class="list">
  			  <a href="<?php echo $item->link; ?>"><?php echo $link; ?></a>
  			</span>
  		<?php endif; ?>
		  </td>
      <td class="text-right">
		  <?php  if ($this->params->get('show_articles')) : ?>
  			<span class="list-hits badge">
  				<?php echo JText::sprintf('COM_NEWSFEEDS_NUM_ARTICLES_COUNT', $item->numarticles); ?>
  			</span>
  		<?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>

<?php // Add pagination links
  if (!empty($this->items)) : ?>
	<?php if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
		<div class="margin-top">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
  		<p class="counter text-center">
  		<?php echo $this->pagination->getPagesCounter(); ?>
  		</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
<?php  endif; ?>
</form>
<?php endif; ?>
