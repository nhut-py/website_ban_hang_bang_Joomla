<?php // no direct access
defined('_JEXEC') or die('Restricted access');
//JHTML::stylesheet ( 'menucss.css', 'modules/mod_virtuemart_category/css/', false );
?>

<ul class="menu <?php echo $class_sfx ?> nav nav-pills nav-stacked">

	<?php foreach ($categories as $category) {
		$active_menu = '';
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id);
		$cattext = $category->category_name;
		if (in_array( $category->virtuemart_category_id, $parentCategories)) {
			$active_menu = 'class="active"';
     }
	?>

	<li <?php echo $active_menu ?>>
	<?php echo JHTML::link($caturl, $cattext); ?>
		<?php if ($category->childs ) {	?>
		<ul class="vm-all-child-menu nav small">
			<?php
				foreach ($category->childs as $child) {
				$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$child->virtuemart_category_id);
				$cattext = vmText::_($child->category_name);
				if ($child->virtuemart_category_id == $active_category_id) {
					$active_child_menu = 'class="active"';
        } else {
          $active_child_menu = '';
        }
			?>
			<li <?php echo $active_child_menu; ?>><?php echo JHTML::link($caturl, $cattext); ?></li>
			<?php } ?>
		</ul>
		<?php } ?>
	</li>

	<?php	} ?>

</ul>