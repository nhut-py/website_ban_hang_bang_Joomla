<?php
/**
 * @package		onWebChat.com Integration for Joomla!
 * @type		Plugin (System)
 * @filename	onwebchat.php
 * @folder		<root>/plugins/system/onwebchat
 * @version     2.2.0
 * @modified	2 August 2018
 * @author		onwebchat.com / onWebChat
 * @website		http://www.onwebchat.com
 * @license		GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @copyright (C) 2015 onwebchat.com
 *
 * This program can be used under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the License.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
**/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );
if(!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
class  plgSystemOnWebchat extends JPlugin
{

	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}
	  function onBeforeCompileHead()
   {

	   $doc = JFactory::getDocument();
       $app = JFactory::getApplication();
	    try {
			if (method_exists($app, 'isClient')) { // fix bug on Joomla 3.4
				if ($app->isClient('administrator')) {
					// add all yr js and css for the backend, eg.
					$doc->addScript( DS.'plugins'.DS.'system'.DS.'onwebchat'.DS.'onechat.js',array('version' => 'auto', 'relative' => true));
				}
			}
	     } catch (Exception $e) {}

   }
	//Backward Compatibility with 1.5
	public function getParams(){
		if(version_compare(JVERSION,'2.5.0','ge')) return $this->params;
		$plugin = JPluginHelper::getPlugin('system', 'onwebchat');
		$params=class_exists('JParameter')? new JParameter($plugin->params) : new JRegistry($plugin->params);
		return $params;
	}

	public function onAfterRender() {
		$app =JFactory::getApplication();
		$doc =JFactory::getDocument();
		$showSelect=true;
		if($app->isAdmin() || $doc->getType()!='html') return;

		$user = JFactory::getUser();
		$params=$this->getParams();
		//echo "<pre>";
		//print_r($params);


		$buffer = JResponse::getBody();
		$chatid=JString::trim($params->get('chatid',''));
		$pagesselect=($params->get('pages-select','')!='')?$params->get('pages-select',''):1;

		$showonpages=(JString::trim($params->get('showonpages',''))!='')?explode(',',JString::trim($params->get('showonpages',''))):array();
		$hideonpages=(JString::trim($params->get('hideonpages',''))!='')?explode(',',JString::trim($params->get('hideonpages',''))):array();

		//print_r($showonpages);
		//print_r($hideonpages);
		$currentPage=JUri::getInstance();
		//echo "</pre>";
		//die();
		if(empty($chatid)) return;

		$scripts=array();
		$scripts[]="<script type='text/javascript'>var onWebChat={ar:[], set: function(a,b){if (typeof onWebChat_==='undefined'){this.ar.push([a,b]);}else{onWebChat_.set(a,b);}},get:function(a){return(onWebChat_.get(a));},w:(function(){ var ga=document.createElement('script'); ga.type = 'text/javascript';ga.async=1;ga.src='//www.onwebchat.com/clientchat/".$chatid."';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})()}</script>";
		if(!$user->guest){
			$scripts[]='<script type="text/javascript">onWebChat.set("name","'.$user->name.'");onWebChat.set("email","'.$user->email.'");</script>';
				$buffer = str_replace("</body>",implode("\n",$scripts)."</body>",$buffer);
					JResponse::setBody($buffer);
		}else{
			$app = JFactory::getApplication();
			//print_r($app);
			switch ($pagesselect) {
					case 2:
								$showSelect=false;
							foreach ($showonpages as $page){
							if ($page=='home' && @$app->getMenu()->getActive()->home) {
										$showSelect = true;
								}
							else if (strpos($currentPage, $page) !== false) {

									$showSelect = true;
								}
							}
							break;
							case 3:
							$showSelect=true;
								foreach ($hideonpages as $page){
									if ($page=='home' && @$app->getMenu()->getActive()->home) {
										$showSelect = false;
								}
							else if (strpos($currentPage, $page) !== false) {
										$showSelect = false;
									}
								}
							break;
								default:
			}
			if($showSelect){

					$buffer = str_replace("</body>",implode("\n",$scripts)."</body>",$buffer);
					JResponse::setBody($buffer);

			}
		}


    }
}
