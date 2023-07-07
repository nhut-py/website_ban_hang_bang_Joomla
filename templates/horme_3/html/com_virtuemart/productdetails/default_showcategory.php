<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2012 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showcategory.php 8811 2015-03-30 23:11:08Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );

if ($this->category->haschildren) {
  $iCol = 1;
  $iCategory = 1;
  $categories_per_row = VmConfig::get('categories_per_row', 3);
  $category_cellwidth = ' col-md-' . floor ( 12 / $categories_per_row ) . ' col-sm-' . floor ( 12 / $categories_per_row ) . ' span' . floor ( 12 / $categories_per_row );
  $verticalseparator = " vertical-separator";
?>
  <h4 class="page-header"><?php echo vmText::_('COM_VIRTUEMART_SUBCATEGORIES'); ?></h4>
  <div class="sub-category-view row">
    <div class="col-md-12">
		<?php
		// Start the Output
		if (!empty($this->category->children)) {
      foreach ($this->category->children as $category) {

			// Show the horizontal seperator
			if ($iCol == 1 && $iCategory > $categories_per_row) {
    ?>
    	<div class="horizontal-separator"></div>
	    <?php
			}

			// this is an indicator whether a row needs to be opened or not
			if ($iCol == 1) {
	    ?>
    	<div class="row">
  		<?php
	    }

	    // Show the vertical seperator
	    if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
        $show_vertical_separator = ' ';
      } else {
        $show_vertical_separator = $verticalseparator;
      }

	    // Category Link
	    $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id, FALSE);

	    // Show Category
	    ?>
        <div class="category <?php echo $category_cellwidth ?>">
          <div class="thumbnail">
            <a href="<?php echo $caturl ?>">
					    <?php
					    if (!empty($category->images[0])) {
					        echo $category->images[0]->displayMediaThumb("", false);
					    }
					    ?>
              <div class="caption text-center" data-mh="cat-name">
                <hr>
                <h5 class="vm-cat-title">
                  <?php echo vmText::_($category->category_name) ?>
                </h5>
              </div>
            </a>
          </div>
        </div>
	    <?php
	    $iCategory++;

	    // Do we need to close the current row now?
	    if ($iCol == $categories_per_row) {
  		?>
    	</div>
	    <?php
  	    $iCol = 1;
			} else {
  	    $iCol++;
			}
    }
  }
// Do we need a final closing row tag?
if ($iCol != 1) {
?>
    </div>
  </div>
<?php } ?>
</div>
<?php }