<?php
defined('_JEXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
*Cart Ajax Module
*
* @version $Id: mod_virtuemart_cart.php 10352 2020-11-02 13:19:45Z Milbo $
* @package VirtueMart
* @subpackage modules
*
* @link https://virtuemart.net
*/

if (!class_exists( 'VmConfig' )) require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/config.php');
VmConfig::loadConfig();
vmLanguage::loadJLang('mod_virtuemart_cart', true);
vmLanguage::loadJLang('com_virtuemart', true);
vmJsApi::jQuery();

vmJsApi::addJScript("/modules/mod_virtuemart_cart/assets/js/update_cart.js",false,false);


$viewName = vRequest::getString('view',0);
if($viewName=='cart'){
	$checkAutomaticPS = true;
} else {
	$checkAutomaticPS = false;
}

$currencyDisplay = CurrencyDisplay::getInstance( );
vmJsApi::cssSite();
$moduleclass_sfx 	= $params->get('moduleclass_sfx', '');
$show_price 		= (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
$show_product_list 	= (bool)$params->get( 'show_product_list', 1 ); // Display the Product Price?

$options = array();
$session = JFactory::getSession($options);
$multixcart = VmConfig::get('multixcart',0);

$carts = array();
if($multixcart!='byproduct'){
	$carts[1] = $session->get('vmcart', 0, 'vm');
} else {
	$carts = $session->get('vmcarts', 0, 'vm');
}

$cart = VirtueMartCart::getCart();
$data = $cart->prepareAjaxData();
$vendorId = $cart->vendorId;
//vmdebug('cart module '.$multixcart,$vendorId,$carts);
if(!empty($carts)){
    foreach($carts as $vId=>$cartses) {
        if(!empty($cartses)){
            //This is strange we have the whole thing again in controllers/cart.php public function viewJS()
            $cart = VirtueMartCart::getCart(false, array(), NULL, $vId);
            $data = $cart->prepareAjaxData();
        }
        require JModuleHelper::getLayoutPath('mod_virtuemart_cart', $params->get('layout', 'default'));
    }

    //Reset cart to the selected one
    $cart = VirtueMartCart::getCart(false, array(), NULL, $vendorId);
} else {
    require JModuleHelper::getLayoutPath('mod_virtuemart_cart', $params->get('layout', 'default'));
}

echo vmJsApi::writeJS();
 ?>