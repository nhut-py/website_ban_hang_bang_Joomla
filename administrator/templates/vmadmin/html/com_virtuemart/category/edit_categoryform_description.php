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
 * @version $Id: edit_categoryform_description.php 10392 2021-01-11 11:15:34Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


$mainframe = JFactory::getApplication();
?>


<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: pencil; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_DESCRIPTION'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php echo VmHTML::row('editor', 'COM_VIRTUEMART_DESCRIPTION', 'category_description', $this->category->category_description); ?>

	</div>
</div>


