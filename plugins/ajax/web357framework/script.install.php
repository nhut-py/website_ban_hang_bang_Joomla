<?php
/* ======================================================
 # Web357 Framework for Joomla! - v1.9.1 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS (v3.x)
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2022 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.com
 # Demo: https://demo.web357.com/joomla/
 # Support: support@web357.com
 # Last modified: Thursday 17 February 2022, 03:25:10 AM
 ========================================================= */

 
defined('_JEXEC') or die;

require_once __DIR__ . '/script.install.helper.php';

class PlgAjaxWeb357frameworkInstallerScript extends PlgAjaxWeb357frameworkInstallerScriptHelper
{
	public $name           	= 'Web357 Framework';
	public $alias          	= 'web357framework';
	public $extension_type 	= 'plugin';
	public $plugin_folder   = 'ajax';
}