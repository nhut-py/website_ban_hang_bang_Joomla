<?php
/**
 *
 * Description
 *
 * @packageVirtueMart
 * @subpackage Config
 * @author RickG
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - Copyright (C) 2004 - 2021 Virtuemart Team. All rights reserved. VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_shopfront_review.php 10424 2021-01-14 09:24:33Z alatak $
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>


<div class="uk-card uk-card-small uk-card-vm">
	<div class="uk-card-header">
		<div class="uk-card-title">
						<span class="md-color-cyan-600 uk-margin-small-right"
								uk-icon="icon: commenting; ratio: 1.2"></span>
			<?php echo vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_TITLE'); ?>
		</div>
	</div>
	<div class="uk-card-body">
		<?php
		echo VmuikitHtml::row('booleanlist', 'COM_VIRTUEMART_REVIEWS_AUTOPUBLISH', 'reviews_autopublish', VmConfig::get('reviews_autopublish', 0));
		echo VmuikitHtml::row('booleanlist', 'COM_VM_REVIEWS_LANGUAGESELECT', 'reviews_languagefilter', VmConfig::get('reviews_languagefilter', 0));
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_REVIEW_MINIMUM_COMMENT_LENGTH', 'reviews_minimum_comment_length', VmConfig::get('reviews_minimum_comment_length', 0), 'class="uk-form-width-xsmall"');
		echo VmuikitHtml::row('input', 'COM_VIRTUEMART_ADMIN_CFG_REVIEW_MAXIMUM_COMMENT_LENGTH', 'reviews_maximum_comment_length', VmConfig::get('reviews_maximum_comment_length', 0), 'class="uk-form-width-xsmall"');
		echo VmuikitHtml::row('input', 'COM_VM_ADMIN_CFG_NUM_RATINGS', 'vm_num_ratings_show', VmConfig::get('vm_num_ratings_show', 3), 'class="uk-form-width-xsmall"');
		$showReviewFor = array('none' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_NONE'),
			'registered' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_REGISTERED'),
			'all' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW_ALL')
		); //showReviewFor
		echo VmuikitHtml::row('radioList', 'COM_VIRTUEMART_ADMIN_CFG_REVIEW_SHOW', 'showReviewFor', VmConfig::get('showReviewFor', 'all'), $showReviewFor);

		$reviewMode = array('none' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_NONE'),
			'bought' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_BOUGHT_PRODUCT'),
			'registered' => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_REGISTERED')
			//	3 => vmText::_('COM_VIRTUEMART_ADMIN_CFG_REVIEW_MODE_ALL')
		);
		echo VmuikitHtml::row('radioList', 'COM_VIRTUEMART_ADMIN_CFG_REVIEW', 'reviewMode', VmConfig::get('reviewMode', 'bought'), $reviewMode);

		echo VmuikitHtml::row('radioList', 'COM_VIRTUEMART_ADMIN_CFG_RATING_SHOW', 'showRatingFor', VmConfig::get('showRatingFor', 'all'), $showReviewFor);
		echo VmuikitHtml::row('radioList', 'COM_VIRTUEMART_ADMIN_CFG_RATING', 'ratingMode', VmConfig::get('ratingMode', 'bought'), $reviewMode);

		$attrlist = 'class="inputbox" multiple="multiple" ';
		echo VmuikitHtml::row('genericlist', 'COM_VIRTUEMART_REVIEWS_OS', $this->os_Options, 'rr_os[]', $attrlist, 'order_status_code', 'order_status_name', VmConfig::get('rr_os', array('C')), 'rr_os', true);
		?>
	</div>
</div>

