<?php
/**
*
* Layout for the login
*
* @package	VirtueMart
* @subpackage User
* @author Max Milbers, George Kostopoulos
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 4431 2011-10-17 grtrustme $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

//set variables, usually set by shopfunctionsf::getLoginForm in case this layout is differently used
if (!isset( $this->show )) $this->show = TRUE;
if (!isset( $this->from_cart )) $this->from_cart = FALSE;
if (!isset( $this->order )) $this->order = FALSE ;


if (empty($this->url)){
  $url = vmURI::getCurrentUrlBy('request');
} else{
  $url = $this->url;
}
vmdebug('My Url in loginform',$url);
$user = JFactory::getUser();

if ($this->show and $user->id == 0) {
vmJsApi::vmValidator();

  //Extra login stuff, systems like openId and plugins HERE
    if (JPluginHelper::isEnabled('authentication', 'openid')) {
        $lang = vmLanguage::getLanguage();
        $lang->load('plg_authentication_openid', JPATH_ADMINISTRATOR);
        $langScript = '
//<![CDATA[
'.'var JLanguage = {};' .
                ' JLanguage.WHAT_IS_OPENID = \'' . vmText::_('WHAT_IS_OPENID') . '\';' .
                ' JLanguage.LOGIN_WITH_OPENID = \'' . vmText::_('LOGIN_WITH_OPENID') . '\';' .
                ' JLanguage.NORMAL_LOGIN = \'' . vmText::_('NORMAL_LOGIN') . '\';' .
                ' var comlogin = 1;
//]]>
                ';
    vmJsApi::addJScript('login_openid',$langScript);
        JHtml::_('script', 'openid.js');
    }

    $html = '';
    VmConfig::importVMPlugins('vmpayment');
    $dispatcher = JDispatcher::getInstance();
    $returnValues = $dispatcher->trigger('plgVmDisplayLogin', array($this, &$html, $this->from_cart));

    if (is_array($html)) {
      foreach ($html as $login) {
          echo $login.'<br />';
      }
    }
    else {
    echo $html;
    }

    //end plugins section

//anonymous order section
if ($this->order) {
?>

<div class="order-view">
  <p class="lead"><?php echo vmText::_('COM_VIRTUEMART_ORDER_ANONYMOUS') ?></p>

  <form class="form-validate" action="<?php echo JRoute::_( 'index.php', 1, $this->useSSL); ?>" method="post" name="com-login">

    <div class="form-group">
    	<label for="order_number"><?php echo vmText::_('COM_VIRTUEMART_ORDER_NUMBER') ?></label>
    	<input type="text" id="order_number" name="order_number" class="inputbox form-control required" size="18" />
    </div>
    <div class="form-group">
    	<label for="order_pass"><?php echo vmText::_('COM_VIRTUEMART_ORDER_PASS') ?></label>
    	<input type="text" id="order_pass" name="order_pass" class="inputbox form-control required" size="18" value="" />
    </div>
    <div class="form-group">
    	<input type="submit" name="Submitbuton" class="button btn btn-default" value="<?php echo vmText::_('COM_VIRTUEMART_ORDER_BUTTON_VIEW') ?>" />
    </div>
    <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="orders" />
    <input type="hidden" name="layout" value="details" />
    <input type="hidden" name="return" value="" />

  </form>
</div>
<hr>

<?php   }

// XXX style CSS id com-form-login ?>
<div class="well collapse" id="vm-login">
  <form id="com-form-login" class="form-inline form-validate" action="<?php echo JUri::root(true).'/'.$url; ?>" method="post" name="com-login" >
    <fieldset class="userdata">

      <p><?php echo vmText::_('COM_VIRTUEMART_ORDER_CONNECT_FORM'); ?></p>

      <div class="form-group">
        <input type="text" name="username" class="inputbox form-control required" size="18" placeholder="<?php echo vmText::_('COM_VIRTUEMART_USERNAME'); ?>"/>
      </div>
      <div class="form-group">
        <input type="password" name="password" class="inputbox form-control required" size="18" placeholder="<?php echo vmText::_('COM_VIRTUEMART_PASSWORD'); ?>"/>
      </div>
      <?php if (JPluginHelper::isEnabled('system', 'remember')) { ?>
      <div class="form-group checkbox">
        <label for="remember">
          <input class="checkbox" type="checkbox" id="remember" name="remember" value="yes" />
          <?php echo $remember_me = vmText::_('JGLOBAL_REMEMBER_ME') ?>
        </label>
      </div>
      <?php } ?>
      <div class="form-group">
        <input class="btn btn-primary btn-block" type="submit" name="Submit" value="<?php echo vmText::_('COM_VIRTUEMART_LOGIN') ?>" />
      </div>
    </fieldset>
    <input type="hidden" name="task" value="user.login" />
    <input type="hidden" name="option" value="com_users" />
    <input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
    <?php echo JHtml::_('form.token'); ?>
  </form>
  <ul class="list-inline small">
    <li>
      <a href="<?php echo JRoute::_('index.php?option=com_users&amp;view=remind'); ?>" rel="nofollow">
      <?php echo vmText::_('COM_VIRTUEMART_ORDER_FORGOT_YOUR_USERNAME'); ?>
      </a>
    </li>
    <li>
      <a href="<?php echo JRoute::_('index.php?option=com_users&amp;view=reset'); ?>" rel="nofollow">
      <?php echo vmText::_('COM_VIRTUEMART_ORDER_FORGOT_YOUR_PASSWORD'); ?>
      </a>
    </li>
  </ul>
</div>
<button class="btn btn-primary btn-block vm-login" type="button" data-toggle="collapse" data-target="#vm-login">
  <span class="glyphicon glyphicon-log-in"></span>
  <span class="glyphicon glyphicon glyphicon-remove hide"></span>
  <span class="vm-login-text"><?php echo vmText::_('COM_VIRTUEMART_LOGIN') ?></span>
</button>

<script>
jQuery('button.vm-login').click(function(){
  jQuery(this).children('span').toggleClass('hide');
});
</script>

<?php  } else if ( $user->id ) { ?>

<form class="well" action="<?php echo JUri::root(true).'/'.$url; ?>" method="post" name="login" id="form-login">
  <?php echo vmText::sprintf( 'COM_VIRTUEMART_HINAME', $user->name ); ?>
  <input type="submit" name="Submit" class="btn btn-primary" value="<?php echo vmText::_( 'COM_VIRTUEMART_BUTTON_LOGOUT'); ?>" />
  <input type="hidden" name="option" value="com_users" />
  <input type="hidden" name="task" value="user.logout" />
  <?php echo JHtml::_('form.token'); ?>
  <input type="hidden" name="return" value="<?php echo base64_encode($url) ?>" />
</form>
<hr>

<?php } ?>