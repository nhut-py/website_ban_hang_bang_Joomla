<?php
/**
 * Toolbar
 * @package VirtueMart
 * @subpackage Sublayouts
 * @author Max Milbers
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * @version $Id: toolbar.php 10396 2021-01-11 11:35:30Z alatak $
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

/** @var TYPE_NAME $viewData */
$bar=$viewData['bar'];

?>

<div class="toolbar-box" style="height: 84px;position: relative;"><?php echo $bar->render() ?></div>