<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Category
 * @author RickG, jseros, Max Milbers, Valérie Isaksen
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_categoryform.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


$mainframe = JFactory::getApplication();
?>


<div class="uk-grid-match uk-grid-small uk-child-width-1-2@m uk-child-width-1-3@l" uk-grid>
	<div>
		<?php echo $this->loadTemplate('categoryform_general') ?>

	</div>
	<div>
		<?php echo $this->loadTemplate('categoryform_meta') ?>
	</div>

	<div>

		<?php echo $this->loadTemplate('categoryform_details') ?>
	</div>
</div>

<div class="uk-grid-match uk-grid-small uk-child-width-1-1" uk-grid>
	<div>
		<?php echo $this->loadTemplate('categoryform_description') ?>

	</div>
</div>


