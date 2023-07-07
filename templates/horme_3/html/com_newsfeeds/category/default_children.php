<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$class = ' class="first"';
if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) :
?>
<ul class="list-unstyled">
<?php foreach ($this->children[$this->category->id] as $id => $child) : ?>
	<?php
	if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) :
	if (!isset($this->children[$this->category->id][$id + 1]))
	{
		$class = ' class="last"';
	}
	?>
	<li <?php echo $class; ?>>
		<?php $class = ''; ?>
			<h5 class="item-title">
        <a href="<?php echo JRoute::_(NewsfeedsHelperRoute::getCategoryRoute($child->id));?>">
  				<?php echo $this->escape($child->title); ?>
        </a>

        <?php if ($this->params->get('show_cat_items') == 1) :?>
  			<span class="newsfeed-count badge hasTooltip" title="<?php echo JText::_('COM_NEWSFEEDS_CAT_NUM'); ?>">
  				<?php echo $child->numitems; ?>
  			</span>
  		  <?php endif; ?>
			</h5>

			<?php if ($this->params->get('show_subcat_desc') == 1) :?>
			<?php if ($child->description) : ?>
				<div class="category-desc">
					<?php echo JHtml::_('content.prepare', $child->description, '', 'com_newsfeeds.category'); ?>
				</div>
			<?php endif; ?>
      <?php endif; ?>

			<?php if (count($child->getChildren()) > 0) :
				$this->children[$child->id] = $child->getChildren();
				$this->category = $child;
				$this->maxLevel--;
				echo $this->loadTemplate('children');
				$this->category = $child->getParent();
				$this->maxLevel++;
			endif; ?>
		</li>
	<?php endif; ?>
	<?php endforeach; ?>
	</ul>
<?php endif;
