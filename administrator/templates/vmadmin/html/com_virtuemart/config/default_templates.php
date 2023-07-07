<?php
/**
 *
 * Description
 *
 * @package    VirtueMart
 * @subpackage Config
 * @author Max Milbers
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_templates.php 10451 2021-01-27 08:16:53Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$params = VmConfig::loadConfig();

?>
<?php
$type = 'checkbox';

?>
<div class="uk-child-width-1-2@l uk-grid-match uk-grid-small" uk-grid>
	<!-- template_params -->
	<div >
		<?php echo $this->loadTemplate('templates_params') ?>
	</div>

	<div>
		<?php echo $this->loadTemplate('templates_media') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('templates_layout') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('templates_pagination') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('templates_front') ?>
	</div>
	<div>
		<?php echo $this->loadTemplate('templates_shopfront') ?>
	</div>

</div>

