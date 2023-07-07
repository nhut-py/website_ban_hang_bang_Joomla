<?php
/**
 *
 * @package VirtueMart
 * @subpackage Sublayouts
 * @author Eugen Stranz, Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: buildtabs.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();



/** @var TYPE_NAME $viewData */
$load_template = $viewData['load_template'];
$view = $viewData['view'];
$cookieName = $viewData['cookieName'];
$width = $viewData['width'];
$css = $viewData['css'];
$cookieName = vRequest::getCmd('view', 'virtuemart') . $cookieName;
$tabCookieIndex=isset($_COOKIE[$cookieName])?$_COOKIE[$cookieName]:0;
vmJsApi::addJScript('vm-cookie', '
		var virtuemartcookie="' . $cookieName . '";
		');
$tabIndex=0;
?>
<div id="vmuikit-admin-ui-tabs">
	<div class="">
		<ul class="uk-child-width-expand@m vmuikit-admin-tabs" uk-tab>
			<?php foreach ($load_template as $tab_content => $tab_title) {
				$active='';
				if ($tabCookieIndex==$tabIndex) $active='uk-active';
				$tabIndex++;
				?>
				<li class="<?php echo $active ?>"><a href="#"><?php echo vmText::_($tab_title) ?></a></li>
			<?php } ?>
		</ul>
		<?php
		$tabIndex=0;
		?>

		<ul class="uk-switcher uk-margin">
			<?php foreach ($load_template as $tab_content => $tab_title) {
				$active='';
				if ($tabCookieIndex==$tabIndex) $active='uk-active';
				$tabIndex++;
				?>
				<li class="<?php echo $active ?>">
					<div class="uk-flex uk-flex-center" uk-grid>
						<div class="<?php echo $width ?>">
							<div class=" uk-card-tab-content uk-height-1-1 uk-flex uk-flex-column">
								<div class="uk-card-bodyx  <?php echo $css ?>">
									<?php echo $view->loadTemplate($tab_content) ?>

								</div>
							</div>
						</div>
					</div>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>





