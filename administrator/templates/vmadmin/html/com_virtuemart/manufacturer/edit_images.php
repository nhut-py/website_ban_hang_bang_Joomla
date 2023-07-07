<?php
/**
*
*
* @package	VirtueMart
* @subpackage Manufacturer
* @author Patrick Kohl
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit_images.php 10396 2021-01-11 11:35:30Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


echo VmuikitMediaHandler::displayFilesHandler($this->manufacturer->images[0], $this->manufacturer->virtuemart_media_id, 'manufacturer')


?>

