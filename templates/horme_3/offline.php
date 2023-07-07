<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */

defined('_JEXEC') or die;
include_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<jdoc:include type="head" />
    <!--<link rel="stylesheet" href="<?php echo $tpath; ?>/css/offline.css" type="text/css" />-->

    <?php if ($hfonts != 'default') { ?>
    <style type="text/css">
      h1, .h1, h2, .h2, h3, .h3, h4, h5, h6, .product-price, .PricesalesPrice, legend, .navbar-nav a, .navbar-nav span{
        font-family: '<?php echo $hfonts; ?>', san-serif;
      }
    </style>
    <?php } ?>

    <?php if ($bfonts != 'default') { ?>
    <style type="text/css">
      body{
        font-family: '<?php echo $bfonts; ?>', san-serif;
      }
    </style>
    <?php } ?>

    <?php if ($this->params->get('customcss')) { ?>
    <link rel="stylesheet" href="<?php echo $tpath; ?>/css/custom.css" type="text/css" />
    <?php } ?>

  </head>
  <body <?php if ($background) {echo $bg;} ?>>
    <div class="<?php echo $container; ?>">
    	<div id="frame" class="row">
	      <div class="col-sm-12">
	      	<jdoc:include type="message" />
	    		<?php if ($app->getCfg('offline_image')) { ?>
					<div class="text-center">
	    			<img src="<?php echo $app->getCfg('offline_image'); ?>" alt="<?php echo htmlspecialchars($app->getCfg('sitename')); ?>" />
					</div>
	    		<?php } ?>
	    		<h1 class="page-header text-center">
	    			<?php echo htmlspecialchars($app->getCfg('sitename')); ?>
	    		</h1>
	    	  <?php if ($app->getCfg('display_offline_message', 1) == 1 && str_replace(' ', '', $app->getCfg('offline_message')) != '') { ?>
	    		<p class="lead text-center">
	    		<?php echo $app->getCfg('offline_message'); ?>
	    		</p>
	    	  <?php } elseif ($app->getCfg('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != '') { ?>
	    		<p class="lead text-center">
	    		<?php echo JText::_('JOFFLINE_MESSAGE'); ?>
	    		</p>
	    	  <?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
        <div class="col-sm-6">
	       	<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login" class="well">

	       		<div class="form-group" id="form-login-username">
	       			<label for="username"><?php echo JText::_('JGLOBAL_USERNAME') ?></label>
	       			<input name="username" id="username" type="text" class="inputbox form-control" title="<?php echo JText::_('JGLOBAL_USERNAME') ?>" size="18" />
	       		</div>
	       		<div class="form-group" id="form-login-password">
	       			<label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
	       			<input type="password" name="password" class="inputbox form-control" size="18" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" id="passwd" />
	       		</div>
	       		<div class="checkbox" id="form-login-remember">
						  <label for="remember">
	       				<input type="checkbox" name="remember" class="inputbox checkbox" value="yes" title="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" id="remember" />
	             	<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>
							</label>
	       		</div>
						<hr>
						<div class="form-group">
	       			<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGIN') ?>" />
						</div>
	       		<input type="hidden" name="option" value="com_users" />
	       		<input type="hidden" name="task" value="user.login" />
	       		<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
	       		<?php echo JHtml::_('form.token'); ?>

	       	</form>
				</div>
				<div class="col-sm-3"></div>
    	</div>
    </div>
  </body>
</html>