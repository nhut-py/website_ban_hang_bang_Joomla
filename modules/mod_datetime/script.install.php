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

require_once __DIR__ . '/script.install.helper.php';

class Mod_DatetimeInstallerScript extends Mod_DatetimeInstallerScriptHelper
{
	public $name           	= 'Date Time';
	public $alias          	= 'datetime';
	public $extension_type 	= 'module';
	public $module_position = 'web357';
}