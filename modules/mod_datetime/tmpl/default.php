<?php
/* ======================================================
 # Display Date and Time for Joomla! - v2.3.7 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS (v3.x)
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2022 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.com
 # Demo: https://demo.web357.com/joomla/date-time
 # Support: support@web357.com
 # Last modified: Thursday 17 February 2022, 03:25:10 AM
 ========================================================= */
 
defined( '_JEXEC' ) or die( 'Restricted access' ); 

// CSS Style
$document->addStyleSheet($host.'modules/mod_datetime/tmpl/default.css'); ?>

<?php if ($datetime_in_two_rows): ?>
    <span class="mod_datetime">
        <?php echo $front_text; ?>

            <?php if (!empty($time)): ?>
                <span class="mod_datetime_date">
                    <time datetime="<?php echo $full_datetime; ?>"><?php echo $date; ?></time>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($between_text)): ?>
                <?php echo $between_text; ?>
            <?php endif; ?>
            
            <?php if (!empty($time)): ?>
                <span class="mod_datetime_time">
                    <time datetime="<?php echo $full_datetime; ?>"><?php echo $time; ?></time>
                </span>
            <?php endif; ?>

        <?php echo $end_text; ?>
    </span>
<?php else: ?>
    <span class="mod_datetime"><?php echo $front_text; ?><time datetime="<?php echo $full_datetime; ?>"><?php echo $date.''.$between_text.''.$time; ?></time><?php echo $end_text; ?></span>
<?php endif; ?>