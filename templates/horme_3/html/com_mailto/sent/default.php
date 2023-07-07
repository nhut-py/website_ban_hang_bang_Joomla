<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_mailto
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div id="mailto-window" class="alert alert-success clearfix">
	<div class="pull-left">
		<?php echo JText::_('COM_MAILTO_EMAIL_SENT'); ?>
	</div>
	<div class="mailto-close pull-right">
		<a href="javascript: void window.close()" title="<?php echo JText::_('COM_MAILTO_CLOSE_WINDOW'); ?>">
			<span class="glyphicon glyphicon-remove"></span>
    </a>
	</div>
</div>
