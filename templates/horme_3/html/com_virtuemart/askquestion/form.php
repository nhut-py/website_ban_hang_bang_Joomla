<?php
/**
 *TODO Improve the CSS , ADD CATCHA ?
 * Show the form Ask a Question
 *
 * @package	VirtueMart
 * @subpackage
 * @author Kohl Patrick, Maik K�nnemann
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
* @version $Id: default.php 2810 2011-03-02 19:08:24Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );
if(VmConfig::get('usefancy',1)){
	$onclick = 'parent.jQuery.fancybox.close();';
} else {
	$onclick = 'parent.jQuery.facebox.close();';
}
$min = VmConfig::get('asks_minimum_comment_length', 50);
$max = VmConfig::get('asks_maximum_comment_length', 2000) ;
vmJsApi::JvalideForm();
vmJsApi::addJScript('askform','
	jQuery(function($){
			$("#askform").validationEngine("attach");
			$("#comment").keyup( function () {
				var result = $(this).val();
					$("#counter").val( result.length );
			});
	});
');
/* Let's see if we found the product */
if (empty ( $this->product )) {
	echo vmText::_ ( 'COM_VIRTUEMART_PRODUCT_NOT_FOUND' );
	echo '<br /><br />  ' . $this->continue_link_html;
} else {
	$session = JFactory::getSession();
	$sessData = $session->get('askquestion', 0, 'vm');
	if(!empty($this->login)){
		echo $this->login;
	?>
		<button id="close-iframe" class="btn btn-default btn-sm pull-right" type="button"><span class="glyphicon glyphicon-remove"></span> <?php echo vmText::_('COM_VIRTUEMART_CLOSE'); ?></button>
<?php	}
	if(empty($this->login) or VmConfig::get('recommend_unauth',false)){

		if (!empty($this->user->name)) {
			$ask_name = $this->user->name;
		} elseif (!empty($sessData['name'])) {
			$ask_name = $sessData['name'];
		} else {
			$ask_name = '';
		}

		if (!empty($this->user->email)) {
			$ask_email = $this->user->email;
		} elseif (!empty($sessData['email'])) {
			$ask_email = $sessData['email'];
		} else {
			$ask_email = '';
		}

		?>
		<div class="ask-a-question-view">
			<h2><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ASK_QUESTION')  ?> <button id="close-iframe" class="btn btn-default btn-sm pull-right" type="button"><span class="glyphicon glyphicon-remove"></span> <?php echo vmText::_('COM_VIRTUEMART_CLOSE'); ?></button></h2>
			<div class="form-field">

				<form method="post" class="form-validate" action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$this->product->virtuemart_product_id.'&virtuemart_category_id='.$this->product->virtuemart_category_id.'&tmpl=component', FALSE) ; ?>" name="askform" id="askform">

					<div class="askform">
						<div class="form-group">
              <label for="name"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_NAME')  ?> : </label>
              <input type="text" class="validate[required,minSize[3],maxSize[64]] form-control" value="<?php echo $ask_name; ?>" name="name" id="name" size="30"  validation="required name"/>
    				</div>
            <div class="form-group">
              <label for="email"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_EMAIL')  ?> : </label>
              <input type="text" class="validate[required,custom[email]] form-control" value="<?php echo $ask_email; ?>" name="email" id="email" size="30"  validation="required email"/>
            </div>
            <div class="form-group">
              <label for="comment"><?php echo vmText::sprintf('COM_VIRTUEMART_ASK_COMMENT', $min, $max); ?></label>
              <textarea title="<?php echo vmText::sprintf('COM_VIRTUEMART_ASK_COMMENT', $min, $max) ?>" class="validate[required,minSize[<?php echo $min ?>],maxSize[<?php echo $max ?>]] field form-control" id="comment" name="comment" rows="8"><?php if(!empty($sessData['comment'])) echo $sessData['comment'] ?></textarea>
            </div>
  						<?php // captcha addition
              echo $this->captcha;
  						?>
            <div class="form-group row">
              <div class="col-xs-5">
                <input class="highlight-button btn btn-primary margin-top-15" type="submit" name="submit_ask" title="<?php echo vmText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" value="<?php echo vmText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" />
              </div>
              <div class="col-xs-7 text-right">
                <label>
                  <?php echo vmText::_('COM_VIRTUEMART_ASK_COUNT')  ?>
    						  <input type="text" value="0" size="4" class="counter form-control" id="counter" name="counter" maxlength="4" readonly="readonly" />
                </label>
              </div>
            </div>
					</div>

					<input type="hidden" name="virtuemart_product_id" value="<?php echo vRequest::getInt('virtuemart_product_id',0); ?>" />
					<input type="hidden" name="tmpl" value="component" />
					<input type="hidden" name="view" value="productdetails" />
					<input type="hidden" name="option" value="com_virtuemart" />
					<input type="hidden" name="virtuemart_category_id" value="<?php echo vRequest::getInt('virtuemart_category_id'); ?>" />
					<input type="hidden" name="task" value="mailAskquestion" />
					<?php echo JHTML::_( 'form.token' ); ?>
				</form>

			</div>
		</div>
<?php
	}
} ?>
<script>
jQuery(window).load(function(){
	<?php if(VmConfig::get ('ask_captcha')){ ?>
  var height = 680;
	<?php } else { ?>
  var height = 550;
	<?php } ?>
  jQuery('#form-collapse iframe', parent.document).css('min-height', height);
  jQuery('#form-collapse div.vm-preloader', parent.document).addClass('hide');
});
jQuery('#close-iframe').click(function(){
  jQuery('#form-collapse', parent.document).collapse('toggle');
});
// Remove collapse form login, hide the toggle button
jQuery('#vm-login').removeClass('collapse').addClass('iframe-login').find('form').removeClass('form-inline');
jQuery('button.vm-login').hide();
</script>