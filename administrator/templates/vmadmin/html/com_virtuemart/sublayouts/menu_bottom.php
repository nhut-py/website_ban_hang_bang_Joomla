<?php
/**
 * Administrator menu bottom
 *
 * @package VirtueMart
 * @subpackage Sublayouts  build tabs end
 * @author Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: menu_bottom.php 10470 2021-01-29 08:34:09Z alatak $
 *
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die ();


// $vmView todo
if (!isset(VmConfig::$installed)) {
	VmConfig::$installed = false;
}
if (!VmConfig::$installed) {
	return false;
}


?>
<div class="vmuikit-menu-bottom  uk-child-width-1-1 uk-grid-small" uk-grid>
	<div>
			<div class="uk-card uk-card-small uk-card-body uk-text-center">VirtueMart <?php echo vmVersion::$RELEASE . ' ' . vmVersion::$REVISION ?></div>
	</div>
	<div>
			<div class="uk-card uk-card-small uk-card-body ">
				<ul class="uk-subnav uk-flex uk-flex-center uk-child-width-1-5" data-uk-grid>
					<li>
						<a href="https://virtuemart.net" target="_blank" class="uk-icon-link" uk-icon="icon: home" uk-tooltip="VirtueMart.net"></a>
					</li>
					<li>
						<a href="https://extensions.virtuemart.net" target="_blank" class="uk-icon-link" uk-icon="icon: nut" uk-tooltip="Extensions"></a>
					</li>
                    <li>
						<a href="https://docs.virtuemart.net/" target="_blank" class="uk-icon-link" uk-icon="icon: copy" uk-tooltip="User guides"></a>
					</li>
					<li>
						<a href="https://forum.virtuemart.net/index.php" class="uk-icon-link" uk-tooltip="Forum" uk-icon="icon: comments"></a>
					</li>
					<li>
						<a href="https://www.facebook.com/virtuemart" target="_blank" class="uk-icon-link" uk-icon="icon: facebook" uk-tooltip="Facebook"></a>
					</li>
				</ul>
			</div>
	</div>
	<div>
		<div class="uk-card uk-card-small uk-card-membership uk-card-body">
			<div class="uk-text-center">
				<div class="uk-margin-small uk-text-bold">Like VirtueMart?</div>
				<div>Become a Supporter</div>
				<div>Reliable Security and Advanced Development thanks to our members</div>

				<div class="uk-margin-small">
					<a href="http://extensions.virtuemart.net/support-updates/virtuemart-membership" target="_blank" >
						<button class="uk-button uk-button-small uk-button-membership">Buy now</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
