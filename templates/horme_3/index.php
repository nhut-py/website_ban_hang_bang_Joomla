<?php
/**
 * @package		Feidias master template
 * @author Spyros Petrakis
 * @copyright	Copyright (C) 2015 Olympiansoft PC IKE. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */
defined('_JEXEC') or die;
JHtml::_('jquery.framework'); // Load jQuery
JHtml::_('bootstrap.framework'); // Load bootstrap js
require_once JPATH_THEMES.'/'.$this->template.'/logic.php'; // load logic.php
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <jdoc:include type="head" />

    <?php if ($this->params->get('bgcolor')) { ?>
    <!-- Body Background color -->
    <style>
    body {
        background-color: <?php echo $this->params->get('bgcolor');
        ?>
    }
    </style>
    <?php } ?>

    <?php if ($this->params->get('boxcolor')) { ?>
    <!-- Content Backgroumd color -->
    <style>
    .<?php echo $container;

    ?> {
        background-color: <?php echo $this->params->get('boxcolor');
        ?>
    }
    </style>
    <?php } ?>

    <?php if ($hfonts != 'default') { ?>
    <!-- Headings Fonts -->
    <style type="text/css">
    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3,
    h4,
    h5,
    h6,
    .site-title,
    .product-price,
    .PricesalesPrice,
    legend,
    .navbar-nav a,
    .navbar-nav span {
        font-family: '<?php echo $hfonts; ?>', san-serif;
    }
    </style>
    <?php } ?>

    <?php if ($bfonts != 'default') { ?>
    <!-- Body Fonts -->
    <style type="text/css">
    body {
        font-family: '<?php echo $bfonts; ?>', san-serif;
    }
    </style>
    <?php } ?>

    <?php if ($this->params->get('customcss')) { ?>
    <!-- Load Custom css -->
    <link rel="stylesheet" href="<?php echo $tpath; ?>/css/custom.css" type="text/css" />
    <?php } ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php // Google Analytics
      if ($this->params->get('analytics')) {
        echo $this->params->get('analytics');
      }
    ?>
</head>

<body id="body" class="<?php echo $pageclass . ' ' . $bodyclass; ?>"
    <?php if ($background) {echo $bg;} // Background image ?>>

    <!--[if lte IE 8]>
        <h1 class="ie7"><?php echo $app->getCfg('sitename');?></h1>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser.<br> Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <style type="text/css">
          .<?php echo $container; ?>, .<?php echo $container; ?>-fluid {display: none;}
        </style>
      <![endif]-->

    <!-- Toolbar Section -->
    <?php if ($mobilehide && $this->params->get('toolbar')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('toolbar-l') || $this->countModules('toolbar-r')) { ?>
    <div id="fds-toolbar">
        <div class="<?php echo $container; ?>">
            <div class="<?php echo $bsrow; ?> toolbar">
                <div class="<?php echo $bscol; ?>6 col-sm-6 toolbar-l">
                    <jdoc:include type="modules" name="toolbar-l" style="none" />
                </div>
                <div class="<?php echo $bscol; ?>6 col-sm-6 toolbar-r text-right">
                    <jdoc:include type="modules" name="toolbar-r" style="none" />
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <?php if ($logo || $this->countModules('search') || $this->countModules('cart')) { ?>
    <!-- Header Section -->
    <header id="fds-header">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?>">

                <div class="col-sm-4 fds-logo" data-mh="header">
                    <a href="<?php echo JURI::base(); ?>">
                        <?php echo $logo; ?>
                    </a>
                </div>

                <div class="col-sm-4 search" data-mh="header">
                    <?php if ($this->countModules('search')) { ?>
                    <jdoc:include type="modules" name="search" style="none" />
                    <?php } ?>
                </div>

                <?php if ($this->countModules('cart')) { ?>
                <div class="col-sm-4 cart text-right" data-mh="header">
                    <jdoc:include type="modules" name="cart" style="none" />
                </div>
                <?php } ?>

            </div>
        </div>
    </header>
    <?php } ?>

    <!-- Main menu -->
    <?php if ($this->countModules('menu')) { ?>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header pull-right">
                <button type="button" class="navbar-toggle" id="offcanvas-toggle"
                    title="<?php echo JText::_('TPL_VM_MENU'); ?>">
                    <b><?php echo JText::_('TPL_VM_MENU'); ?></b>
                    <span class="sr-only">Toggle navigation</span>
                    <span class="glyphicon glyphicon-menu-hamburger"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="visible-md visible-lg" id="fds-navbar">
                <jdoc:include type="modules" name="menu" style="none" />
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <?php } ?>

    <?php if ($mobilehide && $this->params->get('breadcrumbs')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('breadcrumbs')) { ?>
    <div class="<?php echo $container; ?>">
        <div class="<?php echo $bsrow; ?>">
            <div class="<?php echo $bscol; ?>12">
                <jdoc:include type="modules" name="breadcrumbs" style="none" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <?php // Fds-Slider Section
      if ($mobilehide && $this->params->get('fds-slider')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($slidecount > 0 && $home == 'home') {
          include JPATH_THEMES.'/'.$this->template.'/fds_slider.php'; // include the Fds Slider
        } ?>
    <?php } // Mobile Detect ?>

    <!-- Slider Section -->
    <?php if ($mobilehide && $this->params->get('slider')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('slider')) { ?>
    <div id="fds-slider">
        <div class="<?php echo $container; ?>">
            <div class="<?php echo $bsrow; ?>">
                <div class="<?php echo $bscol; ?>12">
                    <jdoc:include type="modules" name="slider" style="none" />
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <!-- Top-a Section -->
    <?php if ($mobilehide && $this->params->get('top-a')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('top-a')) { ?>
    <div id="fds-top-a" class="margin-top">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?> top-a">
                <jdoc:include type="modules" name="top-a" style="custom" width="<?php echo $tawidth ?>" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <!-- Top-b Section -->
    <?php if ($mobilehide && $this->params->get('top-b')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('top-b')) { ?>
    <div id="fds-top-b" class="margin-top">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?> top-b">
                <jdoc:include type="modules" name="top-b" style="custom" width="<?php echo $tbwidth ?>" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <?php // Top-c Section
      if ($mobilehide && $this->params->get('top-c')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('top-c')) { ?>
    <div id="fds-top-b" class="margin-top">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?> top-c">
                <jdoc:include type="modules" name="top-c" style="custom" width="<?php echo $tcwidth ?>" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <!-- Component & Sidebars Section -->
    <div id="fds-main" class="margin-top">
        <div class="<?php echo $container; ?>">
            <div class="<?php echo $bsrow; ?>">

                <div class="main-wrapper
						<?php if ($this->countModules('sidebar-a') && $this->countModules('sidebar-b')) {
								echo "col-md-6 col-md-push-3";
							} elseif ($this->countModules('sidebar-a') && !$this->countModules('sidebar-b')) {
								echo "col-md-9 col-md-push-3";
							} elseif ($this->countModules('sidebar-b') && !$this->countModules('sidebar-a')) {
								echo "col-md-9";
							} else {
								echo "col-md-12";
							} ?>">

                    <?php if ($mobilehide && $this->params->get('innertop')) { // Mobile Detect ?>
                    <?php } else { ?>
                    <?php if ($this->countModules('innertop')) { ?>
                    <div class="<?php echo $bsrow; ?> innertop">
                        <div class="<?php echo $bscol; ?>12">
                            <jdoc:include type="modules" name="innertop" style="html" />
                        </div>
                    </div>
                    <?php } ?>
                    <?php } // Mobile Detect ?>

                    <main class="<?php echo $bsrow; ?>">
                        <div class="<?php echo $bscol; ?>12">
                            <jdoc:include type="message" />
                            <jdoc:include type="component" />
                        </div>
                    </main>

                    <?php if ($mobilehide && $this->params->get('innerbottom')) { // Mobile Detect ?>
                    <?php } else { ?>
                    <?php if ($this->countModules('innerbottom')) { ?>
                    <div class="<?php echo $bsrow; ?> innerbottom">
                        <div class="<?php echo $bscol; ?>12">
                            <jdoc:include type="modules" name="innerbottom" style="html" />
                        </div>
                    </div>
                    <?php } ?>
                    <?php } // Mobile Detect ?>

                </div> <!-- Main wrapper end -->

                <?php if ($mobilehide && $this->params->get('sidebar-a')) { // Mobile Detect ?>
                <?php  } else { ?>
                <?php if ($this->countModules('sidebar-a')) { ?>
                <aside class="<?php echo $bscol; ?>3 sidebar-a
						<?php if (!$this->countModules('sidebar-b')) {
							echo 'col-md-pull-9';
						} else {
							echo 'col-md-pull-6';
						} ?>">
                    <jdoc:include type="modules" name="sidebar-a" style="html" />
                </aside>
                <?php } ?>
                <?php } // Mobile Detect ?>

                <?php if ($mobilehide && $this->params->get('bottom-a')) { // Mobile Detect ?>
                <?php } else { ?>
                <?php if ($this->countModules('sidebar-b')) { ?>
                <aside class="<?php echo $bscol; ?>3 sidebar-b">
                    <jdoc:include type="modules" name="sidebar-b" style="html" />
                </aside>
                <?php } ?>
                <?php } // Mobile Detect ?>

            </div> <!-- Row end -->
        </div> <!-- Container end -->
    </div> <!-- Component & Sidebars Section End -->

    <!-- Bootom-a Section -->
    <?php if ($mobilehide && $this->params->get('bottom-a')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('bottom-a')) { ?>
    <div id="fds-bottom-a" class="margin-top">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?> bottom-a">
                <jdoc:include type="modules" name="bottom-a" style="custom" width="<?php echo $bawidth ?>" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <!-- Bootom-b Section -->
    <?php if ($mobilehide && $this->params->get('bottom-b')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('bottom-b')) { ?>
    <div id="fds-bottom-b" class="margin-top">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?> bottom-b">
                <jdoc:include type="modules" name="bottom-b" style="custom" width="<?php echo $bbwidth ?>" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <?php // Bootom-c Section
      if ($mobilehide && $this->params->get('bottom-c')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('bottom-c')) { ?>
    <div id="fds-bottom-c" class="margin-top">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?> bottom-c">
                <jdoc:include type="modules" name="bottom-c" style="custom" width="<?php echo $bcwidth ?>" />
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <!-- Footer Section -->
    <?php if ($mobilehide && $this->params->get('footer')) { // Mobile Detect ?>
    <?php } else { ?>
    <?php if ($this->countModules('footer')) { ?>
    <footer id="fds-footer">
        <div class="<?php echo $container; ?> ">
            <div class="<?php echo $bsrow; ?>">
                <jdoc:include type="modules" name="footer" style="custom" width="<?php echo $fwidth ?>" />
            </div>
        </div>
    </footer>
    <?php } ?>
    <?php } // Mobile Detect ?>

    <?php if ($this->countModules('absolute')) { ?>
    <div id="fds-absolute">
        <jdoc:include type="modules" name="absolute" style="none" />
    </div>
    <?php } ?>

    <?php if ($this->params->get('cookie') && $this->countModules('cookie')) { ?>
    <!-- EU cookie law -->
    <?php if (!$this->params->get('combinedjs')) { ?>
    <script src="<?php echo $tpath; ?>/js/jquery.cookie.js" defer="defer"></script>
    <?php } ?>
    <script>
    jQuery(window).load(function() {
        var $cookie = jQuery.cookie('law');
        if (typeof $cookie === 'undefined') {
            jQuery('#cookie-law').fadeIn('slow');
            jQuery('#cookie-x').click(function(e) {
                jQuery('#cookie-law').fadeOut('slow');
                jQuery.cookie('law', '1', {
                    expires: 7,
                    path: '/'
                });
                e.preventDefault();
            });
        }
    });
    </script>
    <div id="cookie-law" class="text-center container-fluid">
        <div class="<?php echo $bsrow; ?>">
            <div class="<?php echo $bscol; ?>1 text-center" data-mh="cookie">
                <a id="cookie-x" href="#">
                    <span class="glyphicon glyphicon-remove"></span> <?php echo JText::_('JLIB_HTML_BEHAVIOR_CLOSE'); ?>
                </a>
            </div>
            <div class="<?php echo $bscol; ?>11" data-mh="cookie">
                <jdoc:include type="modules" name="cookie" style="none" />
            </div>
        </div>
    </div>
    <?php } ?>

    <jdoc:include type="modules" name="debug" />

    <!-- To Top Anchor -->
    <a id="totop-scroller" class="btn btn-default" href="#page">
        <span class="glyphicon glyphicon-arrow-up"></span>
    </a>

    <!-- Offcanvas -->
    <div id="offcanvas" class="navbar-inverse hidden-lg">
        <span class="glyphicon glyphicon-remove"></span>
        <div class="off-canvas-wrapper">
            <jdoc:include type="modules" name="menu" style="none" />
        </div>
    </div>
    <script>
    jQuery('nav #offcanvas-toggle').click(function() {
        jQuery('body').addClass('noscroll').animate({
            right: '-280px'
        }, 400, "linear");
        jQuery('#offcanvas').fadeIn()
            .find('span.glyphicon-remove').show('slow')
            .end()
            .find('div.off-canvas-wrapper').animate({
                left: '0'
            }, 400, "linear");
    });

    jQuery('#offcanvas').click(function() {
        jQuery('#offcanvas > span').hide();
        jQuery('div.off-canvas-wrapper').animate({
            left: '-280px'
        }, 400, "linear");
        jQuery('body').removeClass('noscroll').animate({
            right: '0'
        }, 400, "linear");
        jQuery(this).fadeOut(600);
    });

    jQuery('#offcanvas ul.navbar-nav').click(function(e) {
        e.stopPropagation();
    });
    </script>

    <!-- Javascript -->

    <script>
    jQuery('button, a.button, input.button, input.details-button, input.highlight-button').addClass('btn');
    </script>
    <script src="<?php echo $tpath; ?>/js/jquery.matchHeight-min.js" defer="defer"></script>
    <script src="<?php echo $tpath; ?>/js/template.js" defer="defer"></script>
    <div class="bklink"
        style="text-align: center;font-size: 18px;padding: 15px 0;background-color:#333;color:#fff;border-top: 1px solid#555;">
        <a href="http://localhost/Lavender/" style="font-weight:bold; color:skyblue;">Lavender</a> by <a style="font-weight:bold; color:skyblue" href="sites.google.com/view/110119038/">nhutnhut.pip</a>
    </div>
</body>

</html>