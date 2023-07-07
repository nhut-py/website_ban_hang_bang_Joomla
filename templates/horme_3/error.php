<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if (!isset($this->error)) {
   $this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
   $this->debug = false;
}

//get language and direction
$app = JFactory::getApplication('site');
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
$tpath = $this->baseurl.'/templates/'.$this->template;
$template = $app->getTemplate(true);
$params = JFactory::getApplication()->getTemplate(true)->params;
$style = $params->get('style');
$hfonts = $params->get('hfonts');
$bfonts = $params->get('bfonts');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
		<?php if ($style == 0) { ?>
    <link rel="stylesheet" href="<?php echo $tpath ;?>/css/bootstrap.min.css" type="text/css" />
    <?php } else { ?>
    <link rel="stylesheet" href="<?php echo $tpath ;?>/css/horme.bootstrap.min.css" type="text/css" />
		<?php } ?>
		<link rel="stylesheet" href="<?php echo $tpath ;?>/css/template.css" type="text/css" />
		<?php if ($style == 1) { ?>
		<link rel="stylesheet" href="<?php echo $tpath ;?>/css/style.css" type="text/css" />
		<?php } ?>
  	<link rel="stylesheet" href="<?php echo $tpath ;?>/css/error.css" type="text/css" />
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

      <?php if ($params->get('customcss')) { ?>
      <link rel="stylesheet" href="<?php echo $tpath; ?>/css/custom.css" type="text/css" />
      <?php } ?>

  </head>
  <body>
    <div class="error container text-center">
      <div class="row-fluid">
        <div class="col-sm-12 span12">
          <h1 class="page-header"><?php echo $app->getCfg('sitename'); ?></h1>
          <div class="hero-unit">
          	<h2><?php echo $this->error->getCode(); ?></h2>
            <p><?php echo $this->error->getMessage(); ?></p>
          </div>
          <div id="errorboxbody" class="well">
        	  <p class="lead"><?php echo JText::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></p>
            <a class="btn btn-primary btn-lg" href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>">
							<span class="glyphicon glyphicon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?>
						</a>
        	  <p class="csm">
						<?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?>
						<br>
						<a href="mailto:<?php echo $app->getCfg('mailfrom'); ?>"><span class="glyphicon glyphicon-envelope"></span> <?php echo $app->getCfg('mailfrom'); ?></a></p>
              <div id="techinfo">
          	  <blockquote><?php echo $this->error->getMessage(); ?></blockquote>
          	  <p>
          		<?php if ($this->debug) {
          			echo $this->renderBacktrace();
          		} ?>
          	  </p>
            </div>
         </div>
        </div>
      </div>
    </div>
  </body>
</html>