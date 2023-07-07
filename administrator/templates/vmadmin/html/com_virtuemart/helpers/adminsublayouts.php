<?php
/**
 *
 * sublayouts for the admin template
 *
 * @package	VirtueMart
 * @subpackage Helpers
 * @author Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: adminsublayouts.php 10395 2021-01-11 11:32:44Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined( '_JEXEC' ) or die('Restricted access');


class adminSublayouts {



	/**
	 * Renders sublayouts
	 *
	 * @param $name
	 * @param int $viewData viewdata for the rendered sublayout, do not remove
	 * @return string
	 */
	static public function renderAdminVmSubLayout($name,$viewData=0){

		$lPath = self::getAdminVmSubLayoutPath ($name);

		if($lPath){
			ob_start ();
			include ($lPath);
			return ob_get_clean();
		} else {
			vmdebug('renderVmSubLayout layout not found '.$name);
		}

	}

	static public function getAdminVmSubLayoutPath($name){

		static $layouts = array();

		if(isset($layouts[$name])){
			return $layouts[$name];
		} else {

			// get the template and default paths for the layout if the site template has a layout override, use it
			$tP = VMPATH_ROOT .'/administrator/templates/vmadmin/html/com_virtuemart/sublayouts/'. $name .'.php';

			$layouts[$name] = $tP;

			return $layouts[$name];
		}


	}
}
