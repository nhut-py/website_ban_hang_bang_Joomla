<?php
/**
 * Administrator metaedit
 *
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
 * @version $Id: metaedit.php 10428 2021-01-21 07:46:47Z alatak $
 *
 */
// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ();


/** @var TYPE_NAME $viewData */
$obj = $viewData['obj'];
$options = array(
	'' => vmText::_('COM_VIRTUEMART_DRDOWN_NONE'),
	'index, follow' => vmText::_('JGLOBAL_INDEX_FOLLOW'),
	'noindex, follow' => vmText::_('JGLOBAL_NOINDEX_FOLLOW'),
	'index, nofollow' => vmText::_('JGLOBAL_INDEX_NOFOLLOW'),
	'noindex, nofollow' => vmText::_('JGLOBAL_NOINDEX_NOFOLLOW'),
	'noodp, noydir' => vmText::_('COM_VIRTUEMART_NOODP_NOYDIR'),
	'noodp, noydir, nofollow' => vmText::_('COM_VIRTUEMART_NOODP_NOYDIR_NOFOLLOW'),
);
?>
<div class="uk-card   uk-card-small uk-card-vm ">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: code; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_METAINFO') ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php


		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_CUSTOM_PAGE_TITLE', 'customtitle', $obj->customtitle);
		echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_METAKEY', 'metakey', $obj->metakey, 'class="uk-textarea  uk-margin-small-bottom"', 80);
		echo VmuikitHtml::row('textarea', 'COM_VIRTUEMART_METADESC', 'metadesc', $obj->metadesc, 'class="uk-textarea  uk-margin-small-bottom"', 80);
		echo VmuikitHtml::row('selectList', 'COM_VIRTUEMART_METAROBOTS', 'metarobot', $obj->metarobot, $options);
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_METAAUTHOR', 'metaauthor', $obj->metaauthor);
		?>
	</div>

</div>
