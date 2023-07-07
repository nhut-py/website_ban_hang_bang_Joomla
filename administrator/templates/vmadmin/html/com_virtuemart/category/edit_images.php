<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author RickG, jseros, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_images.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


?>

<div class="selectimage">
	<?php
	//echo $this->category->images[0]->displayFilesHandler($this->category->virtuemart_media_id);
	if (empty($this->category->images[0]->virtuemart_media_id)) {
		?>
		<!-- MEDIA Hidden -->
		<input type="hidden"  name="file_is_category_image" value="1" />
	<?php


	}
	if ($this->category->virtuemart_media_id) {
		echo VmuikitMediaHandler::displayFilesHandler($this->category->images[0], $this->category->virtuemart_media_id, 'category');

	} else {
		echo VmuikitMediaHandler::displayFilesHandler($this->category->images[0], null, 'category');
	}
	?>
</div>
