<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if ($displayData->params->get('show_page_heading')) { ?>
  <h1 class="page-header">
  <?php echo $displayData->escape($displayData->params->get('page_heading')); ?>
  </h1>
<?php } ?>

<?php //If there is a description in the menu parameters use that;
if ($displayData->params->get('show_base_description')) { ?>

  <?php if($displayData->params->get('categories_description')) { ?>
    <div class="category-desc base-desc">
     <p><?php echo JHtml::_('content.prepare', $displayData->params->get('categories_description'), '',  $displayData->get('extension') . '.categories'); ?></p>
    </div>
  <?php } else { ?>
    <?php //Otherwise get one from the database if it exists.
    if ($displayData->parent->description) { ?>
    <div class="category-desc base-desc">
    	<p><?php echo JHtml::_('content.prepare', $displayData->parent->description, '', $displayData->parent->extension . '.categories'); ?></p>
    </div>
    <?php } ?>
  <?php } ?>

<?php } ?>
