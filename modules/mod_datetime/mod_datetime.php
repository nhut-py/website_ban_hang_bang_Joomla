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
 
defined('_JEXEC') or die;

// get helper
require_once(dirname(__FILE__).'/helper.php');
$modWeb357DateTimeHelper = new modWeb357DateTimeHelper();

// Default Vars
jimport('joomla.environment.uri' );
$host = JURI::root();
$document = JFactory::getDocument();

// Get Absolute path of Joomla
$absolute_path = getcwd();
$months = array( JText::_( 'MOD_DATETIME_JANUARY' ), JText::_( 'MOD_DATETIME_FEBRUARY' ), JText::_( 'MOD_DATETIME_MARCH' ), JText::_( 'MOD_DATETIME_APRIL' ), JText::_( 'MOD_DATETIME_MAY' ), JText::_( 'MOD_DATETIME_JUNE' ), JText::_( 'MOD_DATETIME_JULY' ), JText::_( 'MOD_DATETIME_AUGUST' ), JText::_( 'MOD_DATETIME_SEPTEMBER' ), JText::_( 'MOD_DATETIME_OCTOBER' ), JText::_( 'MOD_DATETIME_NOVEMBER' ), JText::_( 'MOD_DATETIME_DECEMBER' )); 
$days = array( JText::_( 'MOD_DATETIME_SUNDAY' ), JText::_( 'MOD_DATETIME_MONDAY' ), JText::_( 'MOD_DATETIME_TUESDAY' ), JText::_( 'MOD_DATETIME_WEDNESDAY' ), JText::_( 'MOD_DATETIME_THURSDAY' ), JText::_( 'MOD_DATETIME_FRIDAY' ), JText::_( 'MOD_DATETIME_SATURDAY' )); 
$server_now = time();

// Parameters
$layout = $params->get('layout', 'default');
$front_text = $params->get('front_text', '');
$end_text = $params->get('end_text', '');
$display_gmt = (int)$params->get('display_gmt', '1');
$display_minutes = (int)$params->get('display_minutes', '0');
$between_text_param = (string)$params->get('between_text', '');

// dateformat
$dateformat = $params->get('dateformat', '');
$custom_date_format = $params->get('custom_date_format', '');
$dateformat = (!empty($custom_date_format)) ? $custom_date_format : $dateformat;

$dateformat_separator = $params->get('dateformat_separator', '-');
$timeformat = $params->get('timeformat', '3');
$hour_system = (int)$params->get('hour_system', '12');
$show_leading_zero_for_hours = (bool) $params->get('show_leading_zero_for_hours', '1');
$show_leading_zeros_for_minutes = (bool) $params->get('show_leading_zeros_for_minutes', '1');
$display_pm_am = (int)$params->get('display_pm_am', '1');
$between_text = (!empty($between_text_param) && !empty($dateformat) && $timeformat != 4) ? $between_text_param.' ' : ''; // the text between date and time

// Display Date/Time in two rows
$datetime_in_two_rows = $params->get('datetime_in_two_rows', '0');

// CSS Styling
$custom_css = $params->get('custom_css');
if(!empty($custom_css) && JFactory::getApplication()->input->get('option') !== 'com_gridbox')
{
	$document->addStyleDeclaration($custom_css, 'text/css');
}

// Offset
$offset_param = $params->get('offset', '');
$config = JFactory::getConfig();
if (!empty($offset_param) && $offset_param != 'gconfig_timezone'):
	$offset = $offset_param;
elseif ($offset_param == 'gconfig_timezone'):
	if(version_compare(JVERSION,'1.6.0') < 0):
		$offset = $config->getValue('config.offset'); //j16+
	else:
		$offset = $config->get('offset'); //j30+
	endif;
else:
	$offset = '';
endif;

if (!empty($offset)): // custom time

	// BEGIN: Calculate Our Timezone time
	date_default_timezone_set($offset);
	$week = date("W"); // week (e.g. 27)
	$day_of_the_week = date("w"); // day (Monday)
	$day = date("j");  // day (7)
	$month_full = date("F"); // month (March)
	$full_month = JText::_(strtoupper($month_full)); // month (Mar) from .ini
	$short_month = JText::_(strtoupper($month_full).'_SHORT'); // month (Mar) from .ini
	$month = date("n"); // month (3)
	$year = date("Y"); // year (2014)
	$d = date("d"); // day (07)
	$l = date("l"); // day (Monday)
	$m = date("m"); // month (03)
	$Y = date("Y"); // year (2015)
	$h = ($hour_system == '12') ? date("h") : date("H"); /* (h: 07)( H: 19)*/
	$i = date("i"); // minute (38)
	$s = date("s"); // second (06)
	$a = date("A"); // PM/AM
	$z = date("z"); // z (0 to 365)
	
	$time_type = "custom_time";
	// END: Calculate Our Timezone time
	
else: // visitor's time
	
	// BEGIN: Calculate Visitor's time
	$week = date("W"); // week (e.g. 27)
	$day_of_the_week = date("w"); // day (Monday)
	$day = date("j");  // day (7)
	$month_full = date("F"); // month (March)
	$full_month = JText::_(strtoupper($month_full)); // month (Mar) from .ini
	$short_month = JText::_(strtoupper($month_full).'_SHORT'); // month (Mar) from .ini
	$month = date("n"); // month (3)
	$year = date("Y"); // year (2014)
	$d = date("d"); // day (07)
	$m = date("m"); // month (03)
	$Y = date("Y"); // year (2015)
	$h = ($hour_system == '12') ? date("h") : date("H"); /* (h: 07)( H: 19)*/
	$i = date("i"); // minute (38)
	$s = date("s"); // second (06)
	$a = date("A"); // PM/AM
	$z = date("z"); // z (0 to 365)
	
	$time_type = "visitors_time";
	// END: Calculate Visitor's time
endif;	

// BEGIN: Get Date and Time
$full_datetime = date('c');
$date = (!empty($dateformat)) ? $modWeb357DateTimeHelper->getDate($Y, $m, $d, $dateformat, $days, $day_of_the_week, $day, $months, $month, $short_month, $full_month, $year, $dateformat_separator, $offset, $z, $params) : '';
$time = ($timeformat != 4) ? $modWeb357DateTimeHelper->getTime($timeformat, $display_pm_am, $hour_system, $offset, $h, $i, $a, $module, $show_leading_zero_for_hours, $show_leading_zeros_for_minutes, $time_type) : '';
// END: Get Date and Time

// Print Layout
require(JModuleHelper::getLayoutPath('mod_datetime', $layout));