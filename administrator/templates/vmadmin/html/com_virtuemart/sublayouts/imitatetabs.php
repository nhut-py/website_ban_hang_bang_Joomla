<?php
/**
 * Administrator imitates_tabs sublayout
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
 * @version $Id: imitatetabs.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();


/** @var TYPE_NAME $viewData */
$return = $viewData['return'];
$language = $viewData['language'];
$width = $viewData['width'];
$css = $viewData['css'];
if ($return == 'start') {

	vmJsApi::addJScript('vm-cookietab', '
			var virtuemartcookie="vm-tab";
			');
	?>
	<ul class="uk-child-width-expand uk-tab" data-uk-tab="">
		<li class="uk-active"><a href="#"><?php echo vmText::_($language) ?></a></li>
	</ul>
	<ul class="uk-switcher uk-margin">
		<li class="uk-active">
			<div class="uk-flex uk-flex-center" uk-grid>
	<div class="<?php echo $width ?>">
					<div class="uk-card-tab-content uk-height-1-1 uk-flex uk-flex-column">
						<div class="<?php echo $css ?>">
	<?php
}
?>
<?php
if ($return == 'end') { ?>
						</div>
					</div>
				</div>
			</div>
		</li>
	</ul>

	<?php
}
?>

