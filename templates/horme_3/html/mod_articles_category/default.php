<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<ul class="category-module<?php echo $moduleclass_sfx; ?>">
	<?php if ($grouped) : ?>
		<?php foreach ($list as $group_name => $group) : ?>
		<li>
		  <div class="mod-articles-category-group"><?php echo $group_name;?></div>
			<ul>
				<?php foreach ($group as $item) : ?>
					<li>
						<?php if ($params->get('link_titles') == 1) : ?>
    					<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
                <h4>
    						  <?php echo $item->title; ?>
                </h4>
    					</a>
						<?php else : ?>
              <h4>
  							<?php echo $item->title; ?>
              </h4>
						<?php endif; ?>
	
						<?php if ($item->displayHits) : ?>
							<div class="mod-articles-category-hits small">
								<span class="glyphicon glyphicon-signal"></span> <?php echo $item->displayHits; ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('show_author')) : ?>
							<div class="mod-articles-category-writtenby small">
								<span class="glyphicon glyphicon-user"></span> <?php echo $item->displayAuthorName; ?>
							</div>
						<?php endif;?>

						<?php if ($item->displayCategoryTitle) : ?>
							<div class="mod-articles-category-category small">
								<span class="glyphicon glyphicon-folder-open"></span> <?php echo $item->displayCategoryTitle; ?>
							</div>
						<?php endif; ?>

						<?php if ($item->displayDate) : ?>
							<div class="mod-articles-category-date small">
                <span class="glyphicon glyphicon-calendar"></span> <?php echo $item->displayDate; ?>
              </div>
						<?php endif; ?>

						<?php if ($params->get('show_introtext')) : ?>
							<p class="mod-articles-category-introtext">
								<?php echo $item->displayIntrotext; ?>
							</p>
						<?php endif; ?>
	
						<?php if ($params->get('show_readmore')) : ?>
							<p class="mod-articles-category-readmore">
								<a class="mod-articles-category-title <?php echo $item->active; ?> btn btn-default btn-sm" href="<?php echo $item->link; ?>">
									<?php if ($item->params->get('access-view') == false) : ?>
										<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
									<?php elseif ($readmore = $item->alternative_readmore) : ?>
										<?php echo $readmore; ?>
										<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
											<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
												<?php echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit')); ?>
											<?php endif; ?>
									<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
										<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
									<?php else : ?>
										<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
										<?php echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit')); ?>
									<?php endif; ?>
								</a>
							</p>
						<?php endif; ?>
            <hr>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<?php endforeach; ?>
	<?php else : ?>
		<?php foreach ($list as $item) : ?>
    <li>
    <?php if ($params->get('link_titles') == 1) : ?>
    	<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
        <h4>
        	<?php echo $item->title; ?>
        </h4>
    	</a>
    <?php else : ?>
      <h4>
    	  <?php echo $item->title; ?>
      </h4>
    <?php endif; ?>

    <?php if ($item->displayHits) : ?>
    	<div class="mod-articles-category-hits small">
    		<span class="glyphicon glyphicon-signal"></span> <?php echo $item->displayHits; ?>
    	</div>
    <?php endif; ?>

    <?php if ($params->get('show_author')) : ?>
    	<div class="mod-articles-category-writtenby small">
    		<span class="glyphicon glyphicon-user"></span> <?php echo $item->displayAuthorName; ?>
    	</div>
    <?php endif;?>

    <?php if ($item->displayCategoryTitle) : ?>
    	<div class="mod-articles-category-category small">
    		<span class="glyphicon glyphicon-folder-open"></span> <?php echo $item->displayCategoryTitle; ?>
    	</div>
    <?php endif; ?>

    <?php if ($item->displayDate) : ?>
    	<div class="mod-articles-category-date small">
              <span class="glyphicon glyphicon-calendar"></span> <?php echo $item->displayDate; ?>
            </div>
    <?php endif; ?>
    <?php
      $infos = array($item->displayHits,$params->get('show_author'),$item->displayCategoryTitle,$item->displayDate);
      if (in_array(true, $infos)){
        $class = 'margin-top-15';
      } else {
        $class = '';
      }
    ?>
    <?php if ($params->get('show_introtext')) : ?>
    	<p class="mod-articles-category-introtext <?php echo $class; ?>">
    		<?php echo $item->displayIntrotext; ?>
    	</p>
    <?php endif; ?>

    <?php if ($params->get('show_readmore')) : ?>
    	<p class="mod-articles-category-readmore">
    		<a class="mod-articles-category-title <?php echo $item->active; ?> btn btn-default btn-sm" href="<?php echo $item->link; ?>">
    			<?php if ($item->params->get('access-view') == false) : ?>
    				<?php echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE'); ?>
    			<?php elseif ($readmore = $item->alternative_readmore) : ?>
    				<?php echo $readmore; ?>
    				<?php echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit')); ?>
    					<?php if ($params->get('show_readmore_title', 0) != 0) : ?>
    						<?php echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit')); ?>
    					<?php endif; ?>
    			<?php elseif ($params->get('show_readmore_title', 0) == 0) : ?>
    				<?php echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE'); ?>
    			<?php else : ?>
    				<?php echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE'); ?>
    				<?php echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit')); ?>
    			<?php endif; ?>
    		</a>
    	</p>
    <?php endif; ?>
      <hr>
    </li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
