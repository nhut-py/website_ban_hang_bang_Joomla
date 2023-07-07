<?php // no direct access
defined('_JEXEC') or die('Restricted access');
//JHTML::stylesheet ( 'menucss.css', 'modules/mod_virtuemart_category/css/', false );
$ID = str_replace('.', '_', substr(microtime(true), -8, 8));
?>

<ul class="VMmenu <?php echo $class_sfx ?> nav nav-pills nav-stacked" id="<?php echo "VMmenu".$ID ?>" >

	<?php foreach ($categories as $category) {
		$active_menu = 'class="VmClose"';
		$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id);
		$cattext = $category->category_name;
		if (in_array( $category->virtuemart_category_id, $parentCategories)) {
			$active_menu = 'class="VmOpen active"';
    }
	?>

	<li <?php echo $active_menu; ?>>
    <?php
		echo JHTML::link($caturl, $cattext);

		if ($active_menu == 'class="VmOpen active"') { ?>

		<ul class="vm-current-child-menu nav small">
		<?php
			foreach ($category->childs as $child) {
				$caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$child->virtuemart_category_id);
				$cattext = vmText::_($child->category_name);
				if ($child->virtuemart_category_id == $active_category_id) {
					$active_child_menu = 'class="VmOpen active"';
	      } else {
	        $active_child_menu = '';
	      }
		?>

			<li <?php echo $active_child_menu; ?>><?php echo JHTML::link($caturl, $cattext); ?></li>

		<?php } ?>
		</ul>

		<?php } ?>
	</li>

	<?php } ?>

</ul>