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
 * @version $Id: default_shop_languages.php 10422 2021-01-14 08:42:44Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: world; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_SHOP_LANGUAGES'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_ADMIN_CFG_ENABLE_ENGLISH', 'enableEnglish', VmConfig::get('enableEnglish', 1)); ?>
		<div class="uk-clearfix">
			<div class="uk-form-label">
						<span  uk-tooltip="<?php echo vmText::_('COM_VM_CFG_SHOPLANG_TIP'); ?>">
							<?php echo vmText::sprintf('COM_VM_CFG_SHOPLANG', VmConfig::$jDefLang); ?>
						</span>
			</div>
			<div class="uk-form-controls">
				<?php echo $this->activeShopLanguage; ?>
			</div>
		</div>
		<div class="uk-clearfix">
			<div class="uk-form-label">
						<span
								uk-tooltip="<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_MULTILANGUE_TIP'); ?>">
							<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_MULTILANGUE'); ?>
						</span>
			</div>
			<div class="uk-form-controls">
				<?php echo $this->activeLanguages; ?>
				<div class="uk-text-meta">
					<?php echo vmText::sprintf('COM_VIRTUEMART_MORE_LANGUAGES', '<a href="https://virtuemart.net/community/translations" target="_blank" >Translations</a>'); ?>
				</div>
			</div>
		</div>
		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_NO_FALLBACK', 'prodOnlyWLang', VmConfig::get('prodOnlyWLang', 0));

		//echo VmuikitHtml::row('checkbox','COM_VM_CFG_DUAL_FALLBACK','dualFallback',VmConfig::get('dualFallback',1));
		echo VmuikitHtml::row('input', 'COM_VM_CFG_CUSTOM_FALLBACK', 'vm_lfbs', VmConfig::get('vm_lfbs', ''));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_CFG_REINJECTJLANGUAGE', 'ReInjectJLanguage', VmConfig::get('ReInjectJLanguage', 0));
		?>
	</div>
</div>










