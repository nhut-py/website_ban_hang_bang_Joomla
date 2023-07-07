<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
//JHtml::_('bootstrap.tooltip');

?>

  <button id="j-login-mod-button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#j-login-mod-pop">
   <span class="glyphicon glyphicon-user"></span> <?php echo JText::_('JLOGIN') ?>
  </button>

  <div class="modal fade" id="j-login-mod-pop" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login', true, $params->get('usesecure')); ?>" method="post" id="login-form">
          	<?php if ($params->get('pretext')) : ?>
              <div class="pretext">
              	<p><?php echo $params->get('pretext'); ?></p>
              </div>
              <hr>
          	<?php endif; ?>
          	<div class="userdata">
          		<div id="form-login-username" class="form-group">
          		<?php if (!$params->get('usetext')) : ?>
          			<div class="input-prepend">
          				<span class="add-on">
          					<span class="icon-user hasTooltip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>"></span>
          					<label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME'); ?></label>
          				</span>
          				<input id="modlgn-username" type="text" name="username" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
          			</div>
          		<?php else: ?>
          			<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
          			<input id="modlgn-username" type="text" name="username" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
          		<?php endif; ?>
          		</div>
          		<div id="form-login-password" class="form-group">
          		<?php if (!$params->get('usetext')) : ?>
          			<div class="input-prepend">
          				<span class="add-on">
          					<span class="icon-lock hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>">
          					</span>
          						<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
          					</label>
          				</span>
          				<input id="modlgn-passwd" type="password" name="password" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
          			</div>
          		<?php else: ?>
          			<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
          			<input id="modlgn-passwd" type="password" name="password" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
          		<?php endif; ?>
          		</div>
          		<?php if (count($twofactormethods) > 1): ?>
          		<div id="form-login-secretkey" class="form-group">
          		<?php if (!$params->get('usetext')) : ?>
          			<div class="input-prepend input-append">
          				<span class="add-on">
          					<span class="icon-star hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>">
          					</span>
          						<label for="modlgn-secretkey" class="element-invisible"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?>
          					</label>
          				</span>
          				<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
          				<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
          					<span class="icon-help"></span>
          				</span>
          		    </div>
          		<?php else: ?>
          			<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?></label>
          			<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
          			<span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
          				<span class="icon-help"></span>
          			</span>
          		<?php endif; ?>
          		</div>
          		<?php endif; ?>
          		<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
          		<div id="form-modlgn-remember" class="checkbox">
                <label>
                  <input id="modlgn-remember" type="checkbox" name="remember" value="yes"/><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
                </label>
          		</div>
          		<?php endif; ?>

          		<button type="submit" tabindex="0" name="Submit" class="btn btn-primary btn-block">
                <span class="glyphicon glyphicon-log-in"></span> <?php echo JText::_('JLOGIN') ?>
              </button>
              <hr>
              <?php
        			$usersConfig = JComponentHelper::getParams('com_users'); ?>
        			<ul class="nav nav-pills nav-stacked">
        			<?php if ($usersConfig->get('allowUserRegistration')) : ?>
        				<li>
        					<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute()); ?>">
        					<?php echo JText::_('MOD_LOGIN_REGISTER'); ?> <span class="icon-arrow-right"></span></a>
        				</li>
        			<?php endif; ?>
        				<li>
        					<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind&Itemid=' . UsersHelperRoute::getRemindRoute()); ?>">
        					<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
        				</li>
        				<li>
        					<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>">
        					<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
        				</li>
        			</ul>
          		<input type="hidden" name="return" value="<?php echo $return; ?>" />
          		<?php echo JHtml::_('form.token'); ?>
          	</div>
          	<?php if ($params->get('posttext')) : ?>
              <hr>
              <div class="posttext">
              	<p><?php echo $params->get('posttext'); ?></p>
              </div>
          	<?php endif; ?>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>