<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$col= 1 ;
if (!empty($manufacturers_per_row)) {
	$col_sm = 12 / $manufacturers_per_row;
} else {
  $col_sm = '4';
}
?>

<div class="vmgroup <?php echo $params->get( 'moduleclass_sfx' ) ?>">

	<?php if ($headerText) { ?>
	<div class="vmheader well well-sm text-left"><?php echo $headerText ?></div>
	<?php }

	if ($display_style =="div") {
	?>

	<div class="vmmanufacturer row text-center">

		<?php foreach ($manufacturers as $manufacturer) {
			$link = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id);
		?>
		<div class="col-sm-<?php echo $col_sm; ?>">
			<div class="thumbnail">
				<a href="<?php echo $link; ?>">
				<?php

				if ($manufacturer->images && ($show == 'image' or $show == 'all' )) {
					echo $manufacturer->images[0]->displayMediaThumb('',false);
				}

				if ($show == 'text' or $show == 'all' ) { ?>
				<div class="caption">
					<?php if ($show == 'all') { ?>
	        <hr>
					<?php } ?>
					<?php echo $manufacturer->mf_name; ?>
				</div>
				<?php
				}
				?>
				</a>
			</div>
		</div>
		<?php	} ?>

	</div>

	<?php
	} else {
	?>

	<ul class="vmmanufacturer <?php echo $params->get('moduleclass_sfx'); ?> text-center <?php if ($show != 'image' or $show != 'all') {echo 'nav';} ?>">
	<?php
	if ($show == 'image' or $show == 'all') {
	  $liclass = 'class="thumbnail"';
	} else {
	  $liclass = 'class="text-left"';
	}

	foreach ($manufacturers as $manufacturer) {
		$link = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id);
	?>
		<li <?php echo $liclass; ?>>
			<a href="<?php echo $link; ?>">
			<?php
			if ($manufacturer->images && ($show == 'image' or $show == 'all')) {
				echo $manufacturer->images[0]->displayMediaThumb('',false);
			}

			if ($show == 'text' or $show == 'all' ) { ?>
			 <div class="caption">
			 	<?php if ($show == 'all') { ?>
			 	<hr>
	      <?php } ?>
				<?php echo $manufacturer->mf_name; ?>
			 </div>
			<?php
			}
			?>
			</a>
		</li>
	<?php
	}
	?>
	</ul>

	<?php } // End else

	if ($footerText) { ?>
	<div class="vmfooter well well-sm text-left <?php if ($display_style == "list" && ($show != 'image' or $show != 'all') ) {echo 'margin-top-15';} ?>">
		<?php echo $footerText ?>
	</div>
	<?php } ?>

</div>