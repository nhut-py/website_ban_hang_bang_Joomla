<?php
/**
 * Administrator menu sublayout
 *
 * @package VirtueMart
 * @subpackage Sublayouts  build tabs end
 * @author Eugen Stranz, Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: menu.php 10440 2021-01-22 16:25:59Z alatak $
 *
 */
// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();



// $vmView todo
if (!isset(VmConfig::$installed)) {
	VmConfig::$installed = false;
}
if (!VmConfig::$installed) {
	return false;
}
/** @var TYPE_NAME $viewData */
$vmView = $viewData['vmView'];
$currentView = vRequest::getVar('view');
$task = vRequest::getVar('task');
$moduleId = vRequest::getInt('module_id', 0);
$menuItems = vmuikitAdminUIHelper::_getAdminMenu($moduleId);

$app = JFactory::getApplication();
$isSite = $app->isSite();
$collapse = false;


?>

<div class="vmuikit-menu uk-padding-xsmall">
	<ul class="uk-nav uk-nav-default uk-nav-parent-icon" uk-nav>
		<?php
		foreach ($menuItems as $item) {
			foreach ($item ['items'] as $i => $link) {
				$externalLink = false;
				if (strncmp($link ['link'], 'http', 4) === 0) {
					$externalLink = true;
				}

				if (!($vmView->manager($link ['view'])
					|| $externalLink || $link ['view'] == 'about' || $link ['view'] == 'virtuemart')) {
					unset($item ['items'][$i]);
					continue;
				}

				$activeParent = "";
				if ($link['view'] == "user") {
					$stop = true;
				}
				if ($link['view'] == $currentView) {
					$activeParent = "uk-active uk-open";
					break;
				}

			}
			if (count($item ['items']) == 0) {
				continue;
			}
			$parentClass = '';
			if (!$collapse) {
				$parentClass = 'uk-parent';
			}
			?>
			<li class="<?php echo $parentClass ?> <?php echo $activeParent ?>">
				<a href="#" class="uk-nav-header">
					<?php
					if ($collapse) {
						?>
						<span class="uk-margin-small-right uk-nav-sub-icon"
								uk-icon="<?php echo $item ['items'][0]['uikit_icon'] ?>"></span>
						<?php
					}
					?>
					<?php
					if (!$collapse) {
						?>
						<span class="uk-nav-title "><?php echo vmText::_($item ['title']) ?></span>
						<?php
					}
					?>
				</a>
				<?php
				$ulClass = 'uk-nav-sub uk-list';
				if ($collapse){
				$ulClass = 'uk-nav uk-dropdown-nav'
				?>
				<div class="uk-background-secondary" uk-dropdown="pos: right-top">
					<?php
					}
					?>

					<ul class="<?php echo $ulClass ?>">
						<?php
						foreach ($item ['items'] as $link) {
							$target = '';
							if ($link ['name'] != '-') {
								if (strncmp($link ['link'], 'http', 4) === 0) {
									$url = $link ['link'];
									$target = 'target="_blank"';
								} else {
									$url = ($link ['link'] === '') ? 'index.php?option=com_virtuemart' : $link ['link'];
									$url .= $link ['view'] ? "&view=" . $link ['view'] : '';
									$url .= $link ['task'] ? "&task=" . $link ['task'] : '';
									$url .= $isSite ? '&tmpl=component&manage=1' : '';
									// $url .= $link['extra'] ? $link['extra'] : '';
									$url = vRequest::vmSpecialChars($url);
								}
								$activeclass = "";


								if ($link['view'] == $currentView) {
									$activeclass = "uk-active";
								}
								?>
								<li class="<?php echo $activeclass ?>">
									<a href="<?php echo $url ?>" <?php echo $target ?> >
										<div class="">
											<span class="uk-margin-small-right uk-nav-sub-icon"
													uk-icon="<?php echo $link ['uikit_icon'] ?>"></span>
											<span class="uk-nav-sub-name vmuikit-menu-toggle"><?php echo vmText::_($link ['name']) ?></span>
										</div>

									</a>
								</li>
								<?php
							}
						}
						?>
					</ul>
					<?php
					if ($collapse){
					?>
				</div>
			<?php
			}
			?>
			</li>
			<?php
		}
		?>

	</ul>


</div>