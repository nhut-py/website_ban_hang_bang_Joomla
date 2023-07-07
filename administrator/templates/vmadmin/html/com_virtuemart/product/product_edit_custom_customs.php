<?php
/**
 *
 * Handle the Product Custom Fields
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD, Patrick khol
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_custom_customs.php 10418 2021-01-13 12:24:24Z alatak $
 *
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$customcfs = $this->customcfs;


?>
<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: customfield; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_CUSTOM_FIELD_TYPE' ); ?>
		</div>
	</div>
	<div class="uk-card-body">

		<!-- BOF CUSTOMFIELDS   -->
		<div   uk-grid>
			<div class="uk-width-1-1">

				<div class="filter-bar search-customfields-boundary">
					<div class="uk-navbar-container uk-margin uk-navbar" uk-navbar="">
						<div class="uk-navbar-left">
							<div class="uk-navbar-item">
								<div class="uk-button-group vmuikit-filter-search ">

									<?php echo $this->customsList; ?>

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>


			<!-- DISPLAY CUSTOMFIELDS-->
			<div id="vmuikit-js-customcf-container"
					class="vmuikit-js-customcf-container uk-width-1-1 uk-grid uk-grid-small uk-child-width-1-1"
					uk-grid>
			</div>
			<!-- EOF DISPLAY CUSTOMFIELDS -->


		</div>

		<!-- EOF CUSTOMFIELDS  -->
	</div>


</div>
<?php
$adminTemplate = VMPATH_ROOT . '/administrator/templates/vmadmin/html/com_virtuemart/';
$adminTemplatePath = '/administrator/templates/vmadmin/html/com_virtuemart/';

$js = "
	var template = jQuery('#vmuikit-js-customcf-template').html()
	var rendered = Mustache.render(template,
			{
				'customcfs': " . json_encode($customcfs) . " ,
			}
	)
	jQuery('#vmuikit-js-customcf-container').html(rendered)
";

vmJsApi::addJScript('customcf.mustache', $js);



