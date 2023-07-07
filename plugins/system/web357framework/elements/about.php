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

 
defined('JPATH_BASE') or die;

require_once(JPATH_PLUGINS . DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "web357framework" . DIRECTORY_SEPARATOR . "elements" . DIRECTORY_SEPARATOR . "elements_helper.php");

jimport('joomla.form.formfield');

class JFormFieldabout extends JFormField {
	
	protected $type = 'about';

	function getInput()
	{
		if (version_compare(JVERSION, '4.0', '>='))
		{
			return $this->getInput_J4();
		}
		else
		{
			return $this->getInput_J3();
		}
	}

	function getLabel()
	{
		if (version_compare(JVERSION, '4.0', '>='))
		{
			return $this->getLabel_J4();
		}
		else
		{
			return $this->getLabel_J3();
		}
	}

	protected function getLabel_J3()
	{	
		return $this->Web357AboutHtml();
	}
	
	protected function getInput_J3()
	{
		return ' ';
	}

	protected function getLabel_J4()
	{
		return ' ';
	}

	protected function getInput_J4()
	{
		return $this->Web357AboutHtml();
	}

	protected function Web357AboutHtml()
	{
		$html  = '<div class="web357framework-about-text">';

		$juri_base = str_replace('/administrator', '', JURI::base());

		// About
		$web357_link = '//www.web357.com/?utm_source=CLIENT&utm_medium=CLIENT-AboutUsLink-web357&utm_content=CLIENT-AboutUsLink&utm_campaign=aboutelement';
		
		$html .= '<a href="'.$web357_link.'" target="_blank"><img src="'.$juri_base.'media/plg_system_web357framework/images/web357-logo.jpg" alt="Web357 logo" style="float: left; margin-right: 20px;" /></a>';

		$html .= "<p>We are a young team of professionals and internet lovers who specialise in the development of professional websites and premium extensions for Joomla! CMS. We pride ourselves on providing expertise via our talented and skillful team. We are passionate of our work and that is what makes us stand out in our goal to improve joomla! websites by providing better user interface, increasing performance, efficiency and security.</p><p>Our Web357 team carries years of experience in web design and development especially with Joomla! and WordPress platforms. As a result we decided to put together our expertise and eventually Web357 was born. We are proud to be able to contribute to the Joomla! world by delivering the smartest and most cost efficient solutions for the web.</p><p>Our products focus on extending Joomla's functionality and making repetitive tasks easier, safer and faster. Our source code is completely open (not encoded or encrypted), giving you the maximum flexibility to either modify it yourself or through our consultants.</p><p>We believe in strong long-term relationships with our clients and our working ethic strives for delivering high standard of products and customer support. All our extensions are being regularly updated and improved based on our customers' feedback and new web trends. In addition, Web357 supports personal customisations, as well as we provide assistance and guidance to our clients' individual requirements</p><p>Whether you are thinking of using our expertise for the first time or you are an existing client, we are here to help.</p><p>Web357 Team<br><a href=\"".$web357_link."\" target=\"_blank\">www.web357.com</a></p>";
	
		$html .= '</div>'; // .web357framework-about-text
		
		// BEGIN: Social sharing buttons
		$html .= '<div class="web357framework-about-heading">Stay connected!</div>';
		
		$social_icons_dir_path = $juri_base.'media/plg_system_web357framework/images/social-icons';
		$social_sharing_buttons  = '<div class="web357framework-about-social-icons">'; // https://www.iconfinder.com/icons/252077/tweet_twitter_icon#size=32
				
		// facebook
		$social_sharing_buttons .= '<a href="//www.facebook.com/web357" target="_blank" title="Like us on Facebook"><img src="'.$social_icons_dir_path.'/facebook.png" alt="Facebook" /></a>';

		// twitter
		$social_sharing_buttons .= '<a href="//twitter.com/web357" target="_blank" title="Follow us on Twitter"><img src="'.$social_icons_dir_path.'/twitter.png" alt="Twitter" /></a>';

		// instagram
		$social_sharing_buttons .= '<a href="//www.instagram.com/web357/" target="_blank" title="Follow us on Instagram"><img src="'.$social_icons_dir_path.'/instagram.png" alt="Instagram" /></a>';

		// youtube
		$social_sharing_buttons .= '<a href="//www.youtube.com/channel/UC-yYIuMfdE-NKwZVs19Fmrg" target="_blank" title="Follow us on Youtube"><img src="'.$social_icons_dir_path.'/youtube.png" alt="Youtube" /></a>';
	
		// rss
		$social_sharing_buttons .= '<a href="//feeds.feedburner.com/web357" target="_blank" title="Subscribe to our RSS Feed"><img src="'.$social_icons_dir_path.'/rss.png" alt="RSS Feed" /></a>';
		
		// newsletter
		$social_sharing_buttons .= '<a href="//www.web357.com/newsletter" target="_blank" title="Subscribe to our Newsletter"><img src="'.$social_icons_dir_path.'/newsletter.png" alt="Newsletter" /></a>';

		// jed
		$social_sharing_buttons .= '<a href="https://extensions.joomla.org/profile/profile/details/12368/" target="_blank" title="Find us on Joomla! Extensions Directory"><img src="'.$social_icons_dir_path.'/jed.png" alt="JED" /></a>';
		
		$social_sharing_buttons .= '</div>'; // .web357framework-about-social-icons
		
		$html .= $social_sharing_buttons;
		// END: Social sharing buttons

		return $html;
	}
}