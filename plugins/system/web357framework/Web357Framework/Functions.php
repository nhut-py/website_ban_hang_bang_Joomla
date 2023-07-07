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

 
namespace Web357Framework;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

class Functions
{
    // Load Web357Framework's language 
    public static function loadWeb357FrameworkLanguage()
    {
         $jlang = \JFactory::getLanguage();
         $jlang->load('plg_system_web357framework', JPATH_ADMINISTRATOR, 'en-GB', true);
         $jlang->load('plg_system_web357framework', JPATH_ADMINISTRATOR, null, true);
    }
   
    // check if url exists
	public static function url_exists($url) 
	{
		if (self::_isCurl())
		{
			// cUrl method
			$ch = curl_init();

			$options = array(
				CURLOPT_URL            => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING       => "",
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_AUTOREFERER    => true,
				CURLOPT_CONNECTTIMEOUT => 120,
				CURLOPT_TIMEOUT        => 120,
				CURLOPT_MAXREDIRS      => 10,
			);
			curl_setopt_array( $ch, $options );
			$response = curl_exec($ch); 
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // $retcode >= 400 -> not found, $retcode = 200, found.

			if ($httpCode != 200)
			{
				// The URL does not exist
				return false;

			} else {
				return true;
			}

			curl_close($ch);
		}
		else
		{			
			// default method
			$file_headers = @get_headers($url);
			if($file_headers[0] == 'HTTP/1.1 404 Not Found')
			{
				return false;
			}
			else
			{
				return true;
			}
		}
    }

    /**
	 * Check if the PHP function curl is enabled
	 */
	public static function _isCurl()
	{
		return function_exists('curl_version');
	}
	
	/**
	 * Check if the PHP function allow_url_fopen is enabled
	 */
	protected static function _allowUrlFopen()
	{
		return ini_get('allow_url_fopen');
	}

    /**
     * 
     * Fetch the Web357 API Key from the plugin settings
     *
     * @return string
     */
    public static function getWeb357ApiKey()
    {
		$db = \JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select($db->quoteName('params'));
		$query->from($db->quoteName('#__extensions'));
		$query->where($db->quoteName('element') . ' = ' . $db->quote('web357framework'));
		$query->where($db->quoteName('folder') . ' = ' . $db->quote('system'));
		$db->setQuery($query);

		try
		{
			$plugin = $db->loadObject();
			$plugin_params = new \JRegistry();
			$plugin_params->loadString($plugin->params);
			return $plugin_params->get('apikey', '');
		}
		catch (RuntimeException $e)
		{
			JError::raiseError(500, $e->getMessage());
		}
    }

	public static function web357ApiKeyCheckerHTMLbox($extension_real_name)
	{
        if (empty($extension_real_name))
        {
			\JFactory::getApplication()->enqueueMessage("Error getting Extension Details. Please, contact us at support@web357.com!", "error");
			return false;
        }

        if (empty(self::getWeb357ApiKey()))
        { ?>
        <div class="alert alert-danger">
            <h3><?php echo \JText::_("W357FRM_DOWNLOAD_KEY_MISSING") ?></h3>
                <p>
                <span class="icon-key" aria-hidden="true"></span> 
                <?php echo sprintf(\JText::_("W357FRM_DOWNLOAD_KEY_MISSING_DESC"), "<b>".\JText::_($extension_real_name)."</b>"); ?>
                <?php echo \JText::_("W357FRM_DOWNLOAD_KEY_MISSING_FIND_APIKEY_AT_WEB357COM") ?>
                </p>

                <p><a class="btn btn-small btn-success" href="<?php echo \JURI::base() ?>index.php?option=com_plugins&view=plugins&filter[search]=System%20-%20Web357%20Framework">
                
                <?php echo \JText::_("W357FRM_DOWNLOAD_KEY_UPDATE_BTN")?>
            </a>
            </p>
        </div>
        <?php 
        }
    }

    /**
     *  Get the HTML Product Information Table for Control Panel at the Backend
     *
     *  @param  string  $extension (e.g. plg_system_web357framework, com_test)
     *  @param  string  $extension_real_name  (e.g. Fix 404 Error Links)
     *
     *  @return  string
     */
    public static function controlPanelProductInfoHTMLTable($extension, $extension_real_name)
    {
        if (empty($extension) || empty($extension_real_name))
        {
			\JFactory::getApplication()->enqueueMessage("Error getting Product Details. Please, contact us at support@web357.com!", "error");
			return false;
        }

        // Clean extension name
        $extension_name = preg_replace('/(plg_system_|plg_user_|plg_authentication_|plg_ajax_|plg_k2_|com_|mod_)/', '', $extension); // e.g. fix404errorlinks, or monthlyarchive

        /**
         *  Get extension details from the json file
         */
        $json_file = 'http://cdn.web357.com/extension-info/'.$extension_name.'-info.json';
        $json_data = file_get_contents($json_file);
        $data = json_decode($json_data);

        if (!isset($data->$extension_name))
        {
            \JFactory::getApplication()->enqueueMessage("Error getting Product Details. Please, contact us at support@web357.com!", "error");
			return false;
        }

        // get extension details from json file
        $item = $data->$extension_name;
        $extension_type = str_replace('_', ' ', $item->extension_type);
        $product_image = (str_replace('/administrator', '', \JURI::base())).'media/plg_system_web357framework/images/joomla-extensions/'.$extension_name.'.png';

        ?>
        <div class="container-fluid">
            <div class="row row-fluid">
                <span class="w357-col-span span3 col-3">
                    <div>
                        <?php if (!empty($item->more_info_url)): ?>
                            <a href="<?php echo $item->more_info_url; ?>" target="_blank" alt="<?php echo $extension_real_name; ?>">
                        <?php endif; ?>

                            <img src="<?php echo $product_image; ?>">

                        <?php if (!empty($item->more_info_url)): ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </span>
                <span class="w357-col-span span9 col-9">
                    <p style="margin: 30px 0 20px 0;"><?php echo $item->description; ?></p>
                    <div class="w357-product-info-buttons w357">

                        <?php if (!empty($item->live_demo_url)): ?>
                            <a href="<?php echo $item->live_demo_url; ?>" class="btn btn-primary" target="_blank">View Demo</a>
                        <?php endif; ?>

                        <?php if (!empty($item->more_info_url)): ?>
                            <a href="<?php echo $item->more_info_url; ?>" class="btn btn-success" target="_blank">More Details</a>
                        <?php endif; ?>

                        <?php if (!empty($item->documentation_url)): ?>
                            <a href="<?php echo $item->documentation_url; ?>" class="btn btn-warning" target="_blank">Documentation</a>
                        <?php endif; ?>

                        <?php if (!empty($item->changelog_url)): ?>
                            <a href="<?php echo $item->changelog_url; ?>" class="btn btn-info" target="_blank">Changelog</a>
                        <?php endif; ?>

                        <?php if (!empty($item->support_url)): ?>
                            <a href="<?php echo $item->support_url; ?>" class="btn btn-danger" target="_blank">Support</a>
                        <?php endif; ?>

                    </div>
                </span>
            </div>
        </div>
        <?php
    }
    
    /**
     *  Get the extension details (version)
     *
     *  @param  string  $extension (e.g. plg_system_web357framework, com_test)
     *
     *  @return  object (current_version, current_creationDate, latest_version, latest_creationDate)
     */
    public static function getExtensionDetails($extension)
    {
        $extension_clean_name = preg_replace('/(plg_system_|plg_user_|plg_authentication_|plg_ajax_|plg_k2_|com_|mod_)/', '', $extension);

        if (strpos($extension, 'plg_system_') !== false) 
        {
            $extension_type = 'plugin';
            $plugin_type = 'system';
        }
        elseif (strpos($extension, 'plg_authentication_') !== false) 
        {
            $extension_type = 'plugin';
            $plugin_type = 'authentication';
        }
        elseif (strpos($extension, 'plg_user_') !== false) 
        {
            $extension_type = 'plugin';
            $plugin_type = 'user';
        }
        elseif (strpos($extension, 'plg_content_') !== false) 
        {
            $extension_type = 'plugin';
            $plugin_type = 'content';
        }
        elseif (strpos($extension, 'mod_') !== false) 
        {
            $extension_type = 'module';
            $plugin_type = '';
        }
        elseif (strpos($extension, 'com_') !== false) 
        {
            $extension_type = 'component';
            $plugin_type = '';
        }

        if (empty($extension) || empty($extension_type))
        {
			\JFactory::getApplication()->enqueueMessage("Error getting Extension Details. Please, contact us at support@web357.com!", "error");
			return false;
        }
   
        // Retrieving request data using JInput
		$jinput = \JFactory::getApplication()->input;

		// get current extension's version & creationDate from database
		$db = \JFactory::getDBO();
		$query = "SELECT manifest_cache "
		."FROM #__extensions "
		."WHERE element = '".$extension."' and type = '".$extension_type."' "
		;
		$db->setQuery($query);
		$db->execute();
		$manifest = json_decode( $db->loadResult(), true );
		$current_version = (!empty($manifest['version'])) ? $manifest['version'] : '1.0.0';
        $current_creationDate = (!empty($manifest['creationDate'])) ? $manifest['creationDate'] : '10 Oct 1985';
        
        if (empty($current_version) || empty($current_creationDate))
        {
			\JFactory::getApplication()->enqueueMessage("Error retrieving extension details from database. Please, contact us at support@web357.com!", "error");
			return false;
        }

        // Get web357 releases json content
        $web357_releases_json_url = 'http://cdn.web357.com/extension-info/'.urlencode($extension_clean_name).'-info.json';
		
		$web357_releases_json = '';
		if (self::url_exists($web357_releases_json_url))
		{
			if (self::_isCurl()) // check if extension=php_curl.dll is enabled from php.ini
			{
				// cUrl method
				$ch = curl_init();

				$options = array(
					CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification
					CURLOPT_RETURNTRANSFER => true, // // Will return the response, if false it print the response
					CURLOPT_URL            => $web357_releases_json_url, // Set the url
					CURLOPT_CONNECTTIMEOUT => 120,
					CURLOPT_TIMEOUT        => 120,
					CURLOPT_MAXREDIRS      => 10,
				);

				curl_setopt_array( $ch, $options ); // Add options to array
				
				$web357_releases_json = curl_exec($ch); // Execute

				curl_close($ch); // Closing

				// get data in a json
				$web357_releases_json = json_decode($web357_releases_json);

			}
			elseif (self::_allowUrlFopen())
			{
				$web357_releases_json = file_get_contents($web357_releases_json_url);
				$web357_releases_json = json_decode($web357_releases_json);
			}
		}

		// Get the latest version of extension, from Web357.com
		$latest_version = $current_version;
		$latest_creationDate = $current_creationDate;

		if (!empty($web357_releases_json))
		{
			if ($web357_releases_json->$extension_clean_name->extension == $extension_clean_name)
			{
				$latest_version = $web357_releases_json->$extension_clean_name->version;
				$latest_creationDate = date("d-M-Y", strtotime($web357_releases_json->$extension_clean_name->date));
			}
        }

        $extension_details = new \stdClass();
        $extension_details->current_version = $current_version;
        $extension_details->current_creationDate = $current_creationDate;
        $extension_details->latest_version = $latest_version;
        $extension_details->latest_creationDate = $latest_creationDate;
        $extension_details->extension_type = $extension_type;
        $extension_details->plugin_type = $plugin_type;
        
        return $extension_details;
    }

    /**
     *  Show Footer
     *
     *  @param  string  $extension (e.g. plg_system_web357framework, com_test)
     *  @param  string  $extension_real_name  (e.g. Fix 404 Error Links)
     *
     *  @return  array
     */
    public static function showFooter($extension, $extension_real_name)
    {
        if (empty($extension) || empty($extension_real_name))
        {
			\JFactory::getApplication()->enqueueMessage("Error getting Extension Details. Please, contact us at support@web357.com!", "error");
			return false;
        }

        $extension_details = self::getExtensionDetails($extension);
        $extension_clean_name = preg_replace('/(plg_system_|plg_user_|plg_authentication_|plg_ajax_|plg_k2_|com_|mod_)/', '', $extension);
        
        // Show Footer
        $show_copyright = true;
        if ($extension_details->extension_type == 'component')
        {
            $comParams = \JComponentHelper::getParams($extension);
            if ($comParams)
            {
                $show_copyright = $comParams->get('show_copyright', 1);
            }
        }

        $juri_base = str_replace('/administrator', '', \JURI::base());

        // Get the product id
		$product_id = self::getProductId($extension);
        $product_id_url_var = (is_numeric($product_id) && $product_id > 0 && !empty($product_id)) ? 'product_id='.$product_id.'&' : '';

        $product_id_url_var = (is_numeric($product_id) && $product_id > 0 && !empty($product_id)) ? 'product_id='.$product_id.'&' : '';
        
        $pro_link = '//www.web357.com/joomla-pricing?'.$product_id_url_var.'utm_source=CLIENT&utm_medium=CLIENT-ProLink-Backend-Footer-'.$extension_clean_name.'-Web357&utm_content=CLIENT-ProLink-Backend-Footer-'.$extension_clean_name.'&utm_campaign=prolinkbackendfooter-'.strtoupper($extension_clean_name);
        ?>
        <div class="center" style="margin-top: 50px; text-align:center;">
            
            <div class="alert alert-default w357-free-version-alert">
                This is the <strong>FREE</strong> version of <strong><?php echo $extension_real_name; ?></strong>.<br>For more functionality you can purchase the PRO version.<br><br>
                <a href="<?php echo $pro_link; ?>" target="_blank" class="btn btn-small btn-danger"> <span class="icon-thumbs-up"></span> Upgrade to Pro!</a>
            </div>
            
            <div class="w357-footer">

                <div class="w357-footer-extension">
                    <?php
                    $product_link = '//www.web357.com/?extension='.$extension_clean_name.'&utm_source=CLIENT&utm_medium=CLIENT-ProLink-Backend-Footer-Product-link-'.$extension_clean_name.'-Web357&utm_content=CLIENT-ProLink-Backend-Footer-Product-link-'.$extension_clean_name.'&utm_campaign=prolinkbackendfooterproductlink-'.strtoupper($extension_clean_name);
                    ?>
                    <img src="<?php echo $juri_base; ?>media/plg_system_web357framework/images/<?php echo $extension_clean_name; ?>.png" width="24" height="24" alt="<?php echo $extension_real_name; ?>">
                    <a href="<?php echo $product_link; ?>" target="_blank"><?php echo $extension_real_name; ?></a> (Free version) v<?php echo $extension_details->current_version; ?> (<?php echo $extension_details->current_creationDate; ?>)
                </div>
            
                <?php if ($show_copyright): 
                    $logo_link = '//www.web357.com/?utm_source=CLIENT&utm_medium=CLIENT-ProLink-Backend-Footer-Web357-logo-'.$extension_clean_name.'-Web357&utm_content=CLIENT-ProLink-Backend-Footer-Web357-logo-'.$extension_clean_name.'&utm_campaign=prolinkbackendfooterweb357logo-'.strtoupper($extension_clean_name);
                    ?>
                    <div class="w357-footer-logo">
                        Developed by <a href="<?php echo $logo_link; ?>" target="_blank">
                        <img src="<?php echo $juri_base; ?>media/plg_system_web357framework/images/web357-logo.png" width="97" height="25" alt="Web357">
                        </a>
                    </div>
                    
                    <div class="w357-footer-copyright">Copyright &copy; <?php echo date('Y'); ?> Web357 - All Rights Reserved.</div>
                <?php endif; ?>

            </div>
        </div>
        <?php
    }

    /**
     *  Update Checker
     *
     *  @param  string  $extension (e.g. plg_system_web357framework, com_test)
     *  @param  string  $extension_real_name  (e.g. Fix 404 Error Links)
     *
     *  @return  array
     */
    public static function updateChecker($extension, $extension_real_name)
    {
        if (empty($extension) || empty($extension_real_name))
        {
			\JFactory::getApplication()->enqueueMessage("Error getting Extension Details. Please, contact us at support@web357.com!", "error");
			return false;
        }
        
        $extension_details = self::getExtensionDetails($extension);
        $current_version = preg_replace('/[A-Za-z-]/', '', $extension_details->current_version);
        $latest_version = preg_replace('/[A-Za-z-]/', '', $extension_details->latest_version);

		if (version_compare($current_version, $latest_version, 'lt') && strpos($extension_details->latest_version, 'beta') == false) // show the notification only for stable versions
        {
            // latest's release URL
		    $real_ext_name_with_dashes = \JText::_($extension_real_name);
            $real_ext_name_with_dashes = str_replace(" (Pro version)", "", $real_ext_name_with_dashes);
            $real_ext_name_with_dashes = str_replace(" (Pro version)", "", $real_ext_name_with_dashes);
            $real_ext_name_with_dashes = str_replace(" (Free version)", "", $real_ext_name_with_dashes);
            $real_ext_name_with_dashes = str_replace(" PRO", "", $real_ext_name_with_dashes);
            $real_ext_name_with_dashes = str_replace(" FREE", "", $real_ext_name_with_dashes);
            $real_ext_name_with_dashes = str_replace("System - ", "", $real_ext_name_with_dashes);
            $real_ext_name_with_dashes = str_replace("Authentication - ", "", $real_ext_name_with_dashes);
            if ($real_ext_name_with_dashes != 'Web357 Framework')
            {
                $real_ext_name_with_dashes = str_replace("Web357 ", "", $real_ext_name_with_dashes);
            }
            $real_ext_name_with_dashes = strtolower(str_replace(" ", "-", $real_ext_name_with_dashes));
            $latest_version_with_dashes = strtolower(str_replace(".", "-", $extension_details->latest_version));
            $latest_release_url = '//www.web357.com/blog/releases/'.$real_ext_name_with_dashes.'-v'.$latest_version_with_dashes.'-released';
            ?>

            <div class="alert alert-danger">
                <h3><?php echo \JText::_("New version available!") ?></h3>
                <p>
                    <span class="icon-notification"></span> An updated version of <strong><?php echo $extension_real_name; ?> (v<?php echo $extension_details->latest_version; ?>)</strong> is available for installation.
                <br><br>
                <a href="index.php?option=com_installer&view=update" class="btn btn-default btn-success"> <span class="icon-thumbs-up"></span> Update to v<?php echo $extension_details->latest_version; ?></a> 
                <a href="<?php echo $latest_release_url; ?>" target="_blank" class="btn btn-default btn-default"> <span class="icon-info"></span> More Info</a>
                </p>
            </div>
            <?php
        }
    }

    /**
     *  Get Changelog's URL
     *
     *  @param  string  $extension (e.g. plg_system_web357framework, com_test)
     *  @param  string  $extension_real_name  (e.g. Fix 404 Error Links)
     *
     *  @return  string
     */
    public static function getChangelogURL($extension_real_name)
    {
        if (empty($extension_real_name))
        {
			\JFactory::getApplication()->enqueueMessage("Error getting Extension Details. Please, contact us at support@web357.com!", "error");
			return false;
        }
        
        $real_ext_name_with_dashes = \JText::_($extension_real_name);
        $real_ext_name_with_dashes = str_replace(" (Pro version)", "", $real_ext_name_with_dashes);
        $real_ext_name_with_dashes = str_replace(" (Pro version)", "", $real_ext_name_with_dashes);
        $real_ext_name_with_dashes = str_replace(" (Free version)", "", $real_ext_name_with_dashes);
        $real_ext_name_with_dashes = str_replace(" PRO", "", $real_ext_name_with_dashes);
        $real_ext_name_with_dashes = str_replace(" FREE", "", $real_ext_name_with_dashes);
        $real_ext_name_with_dashes = str_replace("System - ", "", $real_ext_name_with_dashes);
        $real_ext_name_with_dashes = str_replace("Authentication - ", "", $real_ext_name_with_dashes);
        if ($real_ext_name_with_dashes != 'Web357 Framework')
        {
            $real_ext_name_with_dashes = str_replace("Web357 ", "", $real_ext_name_with_dashes);
        }
        $real_ext_name_with_dashes = strtolower(str_replace(" ", "-", $real_ext_name_with_dashes));
		$changelog_url = '//www.web357.com/product/'.$real_ext_name_with_dashes.'#changelog';  // e.g. support-hours
        
        return $changelog_url;
    }

    /**
     *  Shortener URL
     *  It gets only the first 10 characters and the last 10 characters of URL that has over 20 characters
     *
     *  @param  string  $url
     *  @param  int  $max_char
     *
     *  @return  string
     */
    public static function shortenURL($url, $max_char = 60)
    {
        if (strlen($url) > $max_char)
        {
            $short_url = substr($url, 0, ($max_char/2)) . '...' .substr($url, strlen($url)-($max_char/2));
            return $short_url;
        }

        return $url;
    }

     /**
     * Get the product_id from web357.com
     *
     * @param string $extension
     * @return void
     */
    public static function getProductId($extension = '')
    {
        if (empty($extension))
        {
			return 0;
        }

        $extension_clean_name = preg_replace('/(plg_system_|plg_user_|plg_authentication_|plg_ajax_|plg_k2_|com_|mod_)/', '', $extension);

        // Get product id
        switch ($extension_clean_name) {
            case 'monthlyarchive':
                $product_id = 3581;
                break;
            case 'loginasuser':
                $product_id = 1934;
                break;
            case 'cookiespolicynotificationbar':
                $product_id = 3489;
                break;
            case 'fix404errorlinks':
                $product_id = 3546;
                break;
            case 'failedloginattempts':
                $product_id = 3533;
                break;
            case 'vmsales':
                $product_id = 3621;
                break;
            case 'supporthours':
                $product_id = 3601;
                break;
            case 'contactinfo':
                $product_id = 3469;
                break;    
            case 'k2multiplecategories':
                $product_id = 3566;
                break; 
            case 'multiplecategoriesfork2':
                $product_id = 3566;
                break; 
            case 'limitactivelogins':
                $product_id = 197435;
                break; 
            case 'manageunusedimages':
                $product_id = 197435;
                break; 
            default:
                $product_id = 0;
                break;
        }

        return $product_id;
    }
}