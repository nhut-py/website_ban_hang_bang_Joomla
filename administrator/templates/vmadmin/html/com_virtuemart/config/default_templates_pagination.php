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
 * @version $Id: default_templates_pagination.php 10393 2021-01-11 11:23:39Z alatak $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$params = VmConfig::loadConfig();

?>
<?php
$type = 'checkbox';

?>

<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: more; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_PAGINATION_SEQUENCE'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_LIST_MEDIA', 'mediaLimit', VmConfig::get('mediaLimit', 20), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_LLIMIT_INIT_BE', 'llimit_init_BE', VmConfig::get('llimit_init_BE', 30), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_PAGSEQ_BE', 'pagseq', VmConfig::get('pagseq'), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_LLIMIT_INIT_FE', 'llimit_init_FE', VmConfig::get('llimit_init_FE', 24), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_PAGSEQ_1', 'pagseq_1', VmConfig::get('pagseq_1'), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_PAGSEQ_2', 'pagseq_2', VmConfig::get('pagseq_2'), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_PAGSEQ_3', 'pagseq_3', VmConfig::get('pagseq_3'), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_PAGSEQ_4', 'pagseq_4', VmConfig::get('pagseq_4'), 'class="input-mini"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CFG_PAGSEQ_5', 'pagseq_5', VmConfig::get('pagseq_5'), 'class="input-mini"');
		?>
	</div>
</div>

