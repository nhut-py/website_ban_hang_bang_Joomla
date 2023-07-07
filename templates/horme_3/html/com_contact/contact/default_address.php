<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<div class="row">
  <div class="col-md-6">
    <ul class="contact-address list-unstyled" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
    <?php if (($this->params->get('address_check') > 0) &&  ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
    	<?php if ($this->params->get('address_check') > 0) : ?>
    	<li>
    		<span class="<?php echo $this->params->get('marker_class'); ?>" >
    			<?php echo $this->params->get('marker_address'); ?>
    		</span>
    	</li>
    	<li>
        <address>
        <?php endif; ?>
        <?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
        <span class="contact-street">
        	<?php echo nl2br($this->contact->address); ?>
        </span><br>
        <?php endif; ?>
        <?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
        <span class="contact-suburb">
        	<?php echo $this->contact->suburb; ?>
        </span><br>
        <?php endif; ?>
        <?php if ($this->contact->state && $this->params->get('show_state')) : ?>
        <span class="contact-state">
        	<?php echo $this->contact->state; ?>
        </span><br>
        <?php endif; ?>
        <?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
        <span class="contact-postcode">
        	<?php echo $this->contact->postcode; ?>
        </span><br>
        <?php endif; ?>
        <?php if ($this->contact->country && $this->params->get('show_country')) : ?>
        <span class="contact-country">
        	<?php echo $this->contact->country; ?>
        </span>
        <?php endif; ?>
        <?php endif; ?>
        <?php if ($this->params->get('address_check') > 0) : ?>
        </address>
    	</li>
    <?php endif; ?>
    </ul>
  </div>
  <div class="col-md-6">
    <ul class="contact-address list-unstyled">
    <?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
    	<li>
    		<span class="<?php echo $this->params->get('marker_class'); ?>" >
    			<?php echo $this->params->get('marker_email'); ?>
    		</span>
    		<span class="contact-emailto">
    			<?php echo $this->contact->email_to; ?>
    		</span>
    	</li>
    <?php endif; ?>

    <?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
    	<li>
    		<span class="<?php echo $this->params->get('marker_class'); ?>" >
    			<?php echo $this->params->get('marker_telephone'); ?>
    		</span>

    		<span class="contact-telephone">
    			<?php echo nl2br($this->contact->telephone); ?>
    		</span>
    	</li>
    <?php endif; ?>
    <?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
    	<li>
    		<span class="<?php echo $this->params->get('marker_class'); ?>" >
    			<?php echo $this->params->get('marker_fax'); ?>
    		</span>
    		<span class="contact-fax">
    		<?php echo nl2br($this->contact->fax); ?>
    		</span>
    	</li>
    <?php endif; ?>
    <?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
    	<li>
    		<span class="<?php echo $this->params->get('marker_class'); ?>" >
    			<?php echo $this->params->get('marker_mobile'); ?>
    		</span>
    		<span class="contact-mobile">
    			<?php echo nl2br($this->contact->mobile); ?>
    		</span>
    	</li>
    <?php endif; ?>
    <?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
    	<li>
    		<span class="<?php echo $this->params->get('marker_class'); ?>" >
    		</span>
    		<span class="contact-webpage">
    			<a href="<?php echo $this->contact->webpage; ?>" target="_blank">
    			<?php echo $this->contact->webpage; ?></a>
    		</span>
    	</li>
    <?php endif; ?>
    </ul>
  </div>
</div>