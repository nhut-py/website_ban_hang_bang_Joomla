<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_shop.php 10440 2021-01-22 16:25:59Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');?>


<div class="uk-child-width-1-2@l uk-grid-match uk-grid-small" uk-grid>
	<div>
		<?php echo $this->loadTemplate('shop_settings') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shop_languages') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('shop_advanced') ?>
	</div>
</div>










