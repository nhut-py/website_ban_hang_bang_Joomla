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

jimport('joomla.form.formfield');

class JFormFieldapikey extends JFormField {
	
	protected $type = 'apikey';

	protected function getLabel()
	{
		return '<label id="jform_params_apikey-lbl" for="jform_params_apikey" class="hasTooltip" title="&lt;strong&gt;'.JText::_('W357FRM_APIKEY').'&lt;/strong&gt;&lt;br /&gt;'.JText::_('W357FRM_APIKEY_DESCRIPTION').'">'.JText::_('W357FRM_APIKEY').'</label>';	
	}

	protected function getInput()
	{
		$html = '';

		// load js
		JFactory::getDocument()->addScript(JURI::root(true).'/media/plg_system_web357framework/js/admin.min.js?v=ASSETS_VERSION_DATETIME');

		// Translate placeholder text
		$hint = $this->translateHint ? JText::_($this->hint) : $this->hint;

		// Initialize some field attributes.
		$class        = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$disabled     = $this->disabled ? ' disabled' : '';
		$readonly     = $this->readonly ? ' readonly' : '';
		$columns      = $this->columns ? ' cols="' . $this->columns . '"' : '';
		$rows         = $this->rows ? ' rows="' . $this->rows . '"' : '';
		$required     = $this->required ? ' required aria-required="true"' : '';
		$hint         = $hint ? ' placeholder="' . $hint . '"' : '';
		$autocomplete = !$this->autocomplete ? ' autocomplete="off"' : ' autocomplete="' . $this->autocomplete . '"';
		$autocomplete = $autocomplete == ' autocomplete="on"' ? '' : $autocomplete;
		$autofocus    = $this->autofocus ? ' autofocus' : '';
		$spellcheck   = $this->spellcheck ? '' : ' spellcheck="false"';

		// Initialize JavaScript field attributes.
		$onchange = $this->onchange ? ' onchange="' . $this->onchange . '"' : '';
		$onclick = $this->onclick ? ' onclick="' . $this->onclick . '"' : '';
		
		// Default value
		$value = (!empty($this->value) && $this->value != '') ? $this->value : '';
		$value = htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
		
		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		$html .= '<textarea name="' . $this->name . '" id="' . $this->id . '"' . $columns . $rows . $class
			. $hint . $disabled . $readonly . $onchange . $onclick . $required . $autocomplete . $autofocus . $spellcheck . '>'
			. $value . '</textarea>';

		// get domain
		$domain = $_SERVER['HTTP_HOST'];
		$html .= '<input type="hidden" name="jform[params][domain]" id="jform_params_domain" value="'.$domain.'" />';

		// loading icon
		$html .= '<div id="apikey-container">';
		$html .= '<div class="web357-loading-gif text-center" style="display:none"></div>';

		if (!empty($value))
		{
			// Get
			$url = 'https://www.web357.com/wp-json/web357-api-key/v1/status/'.$value;
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $url ); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
			$resp = curl_exec($ch); 

			if (curl_errno($ch)) 
			{ 
				$curl_error_message = curl_error($ch); 
			} 

			curl_close($ch);

			$show_active_key_button = true;
			if ($resp === FALSE) 
			{
				$html .= '<div style="margin: 20px 0;" id="w357-activated-successfully-msg" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_('Call with web357.com has been failed with the error message "'. $curl_error_message .'". Please, try again later or contact us at support@web357.com.').'</div>';
			} 
			else 
			{
				$resp = json_decode($resp);
				if (isset($resp->status) && ($resp->status == 1 || $resp->status == 'old_api_key'))
				{
					$html .= '<div style="margin: 20px 0;" id="w357-activated-successfully-msg" class="alert alert-success"><span class="icon-save"></span> '.JText::_('Your API Key <strong>' . $value . '</strong> is active and validated.').'</div>';
					$show_active_key_button = false;
				}
				elseif (isset($resp->status) && $resp->status == 0)
				{
					$html .= '<div style="margin: 20px 0;" id="w357-activated-successfully-msg" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_('Your API Key <strong>' . $value . '</strong> is valid, but is not activated yet.<br>Click the button below to activate it.').'</div>';
				}
				
				elseif (isset($resp->code) && ($resp->code == 'error' && !empty($resp->message)))
				{
					$show_active_key_button = false;
					$html .= '<div style="margin: 20px 0;" id="w357-activated-successfully-msg" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_($resp->message).'</div>';
				}
				else
				{
					$html .= '<div style="margin: 20px 0;" id="w357-activated-successfully-msg" class="alert alert-danger"><span class="icon-cancel"></span> '.JText::_('Call with Web357\'s License Manager has been failed. <br>Please, try again later or contact us at support@web357.com.').'</div>';
				}
			}

			// show the button only if is not activated
			if ($show_active_key_button)
			{
				$html .= '<p class="web357_apikey_activation_html"></p>';
				$html .= '<p><a class="btn btn-success web357-activate-api-key-btn"><strong>'.JText::_('Activate Api Key').'</strong></a></p>';
			}
			
		}

		$html .= '</div>'; // #apikey-container

		return $html;		
	}
}