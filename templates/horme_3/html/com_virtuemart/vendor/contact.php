<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage vendor
* @author Kohl Patrick, Eugen Stranz
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2701 2011-02-11 15:16:49Z impleri $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

?>

<div class="vendor-details-view">

	<h1 class="page-header">
    <?php echo $this->vendor->vendor_store_name; ?>
  </h1>

  <div class="row">
    <div class="col-md-6">
      <address>
      <?php

      	echo shopFunctionsF::renderVendorAddress($this->vendor->virtuemart_vendor_id);

      	$min = VmConfig::get('asks_minimum_comment_length', 50);
      	$max = VmConfig::get('asks_maximum_comment_length', 2000) ;
      	vmJsApi::JvalideForm();
      	vmJsApi::addJScript('askform', '
      		jQuery(function($){
      				$("#askform").validationEngine("attach");
      				$("#comment").keyup( function () {
      					var result = $(this).val();
      						$("#counter").val( result.length );
      				});
      		});
      	');
      ?>
      </address>
    </div>
    <div class="col-md-6">
      <?php
      if (!empty($this->vendor->images[0])) { ?>
      <div class="vendor-image">
      <?php echo $this->vendor->images[0]->displayMediaThumb('',false); ?>
      </div>
      <?php
      }
      ?>
      <ul class="list-unstyled margin-top-15">
      	<li><?php echo $this->linkdetails ?></li>
      	<li><?php echo $this->linktos ?></li>
      </ul>
    </div>
  </div>

  <hr>

	<p class="lead margin-top"><?php echo vmText::_('COM_VIRTUEMART_VENDOR_ASK_QUESTION')  ?></p>

  <div class="form-field">

  	<form method="post" class="form-validate" action="<?php echo JRoute::_('index.php') ; ?>" name="askform" id="askform">

      <div class="form-group">
    		<label for="name"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_NAME')  ?></label>
        <input type="text" class="validate[required,minSize[4],maxSize[64]]" value="<?php echo $this->user->name ?>" name="name" id="name" size="30"  validation="required name"/>
      </div>

      <div class="form-group">
    		<label for="email"><?php echo vmText::_('COM_VIRTUEMART_USER_FORM_EMAIL')  ?></label>
        <input type="text" class="validate[required,custom[email]]" value="<?php echo $this->user->email ?>" name="email" id="email" size="30"  validation="required email"/>
      </div>

      <div class="form-group">
    		<label for="comment">
    			<?php
    			$ask_comment = vmText::sprintf('COM_VIRTUEMART_ASK_COMMENT', $min, $max);
    			echo $ask_comment;
    			?>
    		</label>
        <textarea title="<?php echo $ask_comment ?>" class="validate[required,minSize[<?php echo $min ?>],maxSize[<?php echo $max ?>]] field" id="comment" name="comment" cols="30" rows="10"></textarea>
      </div>
      <div class="row form-group">
        <div class="col-md-12">
          <?php // captcha addition
          echo $this->captcha;
          // end of captcha addition
          ?>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6 col-sm-6">
  			  <input class="btn btn-primary" type="submit" name="submit_ask" title="<?php echo vmText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" value="<?php echo vmText::_('COM_VIRTUEMART_ASK_SUBMIT')  ?>" />
        </div>
        <div class="col-md-6 col-sm-6 text-right form-inline">
          <label for="counter">
            <?php echo vmText::_('COM_VIRTUEMART_ASK_COUNT')  ?>
          </label>
  				<input type="text" value="0" size="4" class="counter inline" id="counter" name="counter" maxlength="4" readonly="readonly" />
        </div>
      </div>

  		<input type="hidden" name="view" value="vendor" />
  		<input type="hidden" name="virtuemart_vendor_id" value="<?php echo $this->vendor->virtuemart_vendor_id ?>" />
  		<input type="hidden" name="option" value="com_virtuemart" />
  		<input type="hidden" name="task" value="mailAskquestion" />
  		<?php echo JHtml::_( 'form.token' ); ?>

  	</form>

  </div>

</div>