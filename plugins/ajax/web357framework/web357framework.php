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
use Joomla\Filter\InputFilter;

// Import library dependencies
jimport('joomla.plugin.plugin');

class plgAjaxWeb357Framework extends JPlugin
{
    function onAjaxWeb357framework()
    {
		$app = JFactory::getApplication();
		$method = $app->input->get('method', '', 'STRING');

		// Method to activate the Web357 Api Key
		if ($method == 'web357ApikeyValidation')
		{
			return $this->web357ApikeyValidation();
		}

		return '';
    }

	/**
	 * Method to activate the Web357 Api Key
	 */
	private function web357ApikeyValidation()
	{
		$app = JFactory::getApplication();
		if ($app->isClient('administrator'))
		{		
			$data  = $app->input->post->get('jform', array(), 'array');
			$get_api_key = isset($data['params']['apikey']) ? $data['params']['apikey'] : null;
			$get_domain = isset($data['params']['domain']) ? $data['params']['domain'] : null;

			if (empty($get_api_key))
			{
				return '<div style="margin: 20px 0; display:none;" id="w357-activated-successfully-msg-ajax" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_('The Api Key cannot be empty.').'</div>';
			}

			// Create the request Array.
			$paramArr = array(
				'domain'    => $get_domain,
			);

			// Create an Http Query.
			$paramArr = http_build_query($paramArr);
			
			// Post
			$url = 'https://www.web357.com/wp-json/web357-api-key/v1/status/'.$get_api_key;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $paramArr);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);			

			$resp = curl_exec($ch);
			curl_close($ch);

			if ($resp === FALSE || empty($resp) || $resp == '') 
			{
				return '<div style="margin: 20px 0;display:none;" id="w357-activated-successfully-msg-ajax" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_('Call with web357.com has been failed.<br>Please, try again later or contact us at support@web357.com.').'</div>';
			} 
			else 
			{
				$resp = json_decode($resp);
				
				if (isset($resp->req->data->status) && ($resp->req->data->status == 'ok' || $resp->req->data->status == 'ok_old_api_key'))
				{
					return '<div style="margin: 20px 0;display:none;" id="w357-activated-successfully-msg-ajax" class="alert alert-success"><span class="icon-save"></span> '.JText::_('Your API Key ('. $get_api_key . ') has been successfully activated.').'</div>';
				}
				elseif ($resp->code == 'error' && !empty($resp->message))
				{
					return '<div style="margin: 20px 0;display:none;" id="w357-activated-successfully-msg-ajax" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_($resp->message).'</div>';
				}
				else
				{
					return '<div style="margin: 20px 0; display:none;" id="w357-activated-successfully-msg-ajax" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_('Call with Web357\'s License Manager has been failed. <br>Please, try again later or contact us at support@web357.com.').'</div>';
				}
			}
		}
		else
		{
			JError::raiseError(403, '');
			return;
		}
	}
}