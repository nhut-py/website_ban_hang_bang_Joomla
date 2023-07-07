<?php
/**
 *
 * @package VirtueMart
 * @subpackage Sublayouts  filter
 * @author Eugen Stranz, Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: filterbar.php 10432 2021-01-21 18:53:33Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();


/** @var TYPE_NAME $viewData */

$search = isset($viewData['search']) ? $viewData['search'] : '';
$searches = isset($viewData['searches']) ? $viewData['searches'] : array();
$tools = isset($viewData['tools']) ? $viewData['tools'] : array();
$extras = isset($viewData['extras']) ? $viewData['extras'] : array();
$resultsCounter = isset($viewData['resultsCounter']) ? $viewData['resultsCounter'] : false;;
$limitBox = isset($viewData['limitBox']) ? $viewData['limitBox'] : false;
if ($search) {
	$label = $search['label'];
	$name = $search['name'];
	$value = $search['value'];
	$placeholder = vmText::_('COM_VIRTUEMART_FILTER') . ' ' . vmText::_($label);
}


?>

<div class="toggle-filterbar uk-navbar-container uk-margin " uk-navbar>
	<div class="uk-navbar-left">
		<?php
		if ($search) {
			?>
			<div class="uk-navbar-item">
				<div class="uk-button-group vmuikit-filter-search">
					<input type="text" value="<?php echo $value; ?>"
							placeholder="<?php echo $placeholder ?>"
							class="vmuikit-filter-search-input"
							name="<?php echo $name ?>" id="<?php echo $name ?>"/>

					<button class="uk-button uk-button-small uk-button-default"
							onclick="this.form.submit();">
						<span uk-icon="search"></span>
					</button>
					<button class="uk-button uk-button-small uk-button-default"
							onclick="document.getElementById('<?php echo $name ?>').value='';this.form.submit();"
					>
						<span uk-icon="close"></span>
					</button>

				</div>
			</div>
			<?php
		}
		?>
		<?php
		if ($searches) {
			?>
			<div class="uk-navbar-item">
						<span class="uk-margin-small-right">
							<?php
							echo vmText::_('COM_VIRTUEMART_FILTER');
							?>
						</span>
			</div>
			<?php

			$reset = '';
			foreach ($searches as $input) {
				$label = $input['label'];
				$name = $input['name'];
				$placeholder = $label;
				$value = $input['value'];
				$type = $input['type'];
				$class = '';
				if (isset($input['class'])) {
					$class = $input['class'];
				}
				$reset .= "document.getElementById('" . $name . "').value='';";
				?>
				<div class="uk-navbar-item">
					<?php
					if ($type == 'text') {
						?>
						<input type="text" value="<?php echo $value; ?>"
								placeholder="<?php echo $placeholder ?>"
								class="vmuikit-filter-search-input uk-margin-small-right@m <?php echo $class ?>"
								name="<?php echo $name ?>" id="<?php echo $name ?>"/>
						<?php
					}

					?>

				</div>
				<?php
			}
			?>
			<div class="uk-navbar-item">
				<div class="uk-button-group vmuikit-filter-search">
					<button class="uk-button uk-button-small uk-button-default uk-margin-small-right"
							onclick="this.form.submit();">
						<span uk-icon="search"></span>
					</button>

					<button class="uk-button uk-button-small uk-button-default uk-margin-small-right"
							onclick="<?php echo $reset ?>;this.form.submit();"
					>
						<span uk-icon="close"></span>
					</button>
				</div>
			</div>
			<?php
		}
		?>
		<?php
		foreach ($extras as $extra) {
			?>
			<div class="uk-navbar-item">
				<?php echo $extra ?>
			</div>
			<?php
		}
		?>
		<?php
		if ($tools) {
			foreach ($tools as $tool) {
				$button = isset($tool['button']) ? $tool['button'] : 'uk-button-default';
				?>
				<div class="uk-margin-medium-left uk-navbar-item">
					<button class="uk-button uk-button-small <?php echo $button ?>" type="button">
						<?php
						echo $tool['title'];
						?>
						<span class="uk-margin-small-left" uk-icon="icon:  triangle-down"></span>
					</button>
					<div class="uk-form-horizontal"
							uk-dropdown="mode: click;animation: uk-animation-slide-bottom-small; duration: 1000">

						<?php
						if (isset($tool['subtitle']) && $tool['subtitle']) {
							?>
							<div class="">
								<?php
								echo $tool['subtitle'];
								?>
							</div>
							<hr/>
							<?php
						}
						?>

						<?php
						if ($tool['fields']) {
							foreach ($tool['fields'] as $field) {
								?>
								<div class="uk-navbar-item">
									<?php
									echo $field;
									?>
								</div>
								<?php
							}
							?>
							<hr/>
							<?php
						}
						?>
						<?php
						if ($tool['footer']) {
							?>

							<div class="uk-text-center">
								<?php
								echo $tool['footer'];
								?>
							</div>
							<?php
						}
						?>
					</div>
				</div>

				<?php
			}
		}
		?>
	</div><!-- uk-navbar-left -->
	<?php
	if ($limitBox or $resultsCounter) {
		?>
		<div class="uk-navbar-right uk-visible@m">
			<?php
			if ($limitBox) {
				?>
				<div class="uk-navbar-item">
					<?php echo $limitBox ?>
				</div>
				<?php
			}
			?>
			<?php
			if ($resultsCounter) {
				?>
				<div class="uk-navbar-item">
					<?php echo $resultsCounter ?>
				</div>
				<?php
			}
			?>

		</div>
		<?php
	}
	?>
</div>

