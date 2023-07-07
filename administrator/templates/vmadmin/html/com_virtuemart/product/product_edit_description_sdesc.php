<?php
/**
 *
 * Set the descriptions for a product
 *
 * @package    VirtueMart
 * @subpackage Product
 * @author RolandD
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: product_edit_description_sdesc.php 10428 2021-01-21 07:46:47Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>
<div class="uk-card   uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: pencil; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_FORM_S_DESC');
			echo $this->origLang ?>
		</div>
	</div>
	<div class="uk-card-body">

				<textarea class="uk-textarea" name="product_s_desc" id="product_s_desc" ><?php echo $this->product->product_s_desc; ?></textarea>
	</div>
</div>



