<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$categoryModel->addImages($categories);
$categories_per_row = vmConfig::get('categories_per_row');
$col_width = floor ( 12 / $categories_per_row);
?>

<ul class="<?php echo $class_sfx ?> row" style="margin-left:-15px">
  <?php foreach ($categories as $category) : ?>
  <?php
  $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id);
  $catname = $category->category_name ;
  ?>
  <li class="vm-categories-wall-catwrapper col-md-<?php echo $col_width; ?>">
  	<div class="thumbnail text-center">
      <a href="<?php echo $caturl; ?>">
        <div data-mh="image-wrapper"><?php echo $category->images[0]->displayMediaThumb('class="vm-categories-wall-img"',false) ?></div>
    		<div class="caption text-center">
          <hr>
          <h5 class="cat-title"><?php echo $catname; ?></h5>
        </div>
      </a>
  	</div>
  </li>
  <?php endforeach; ?>
</ul>