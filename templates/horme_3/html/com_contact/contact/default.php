<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams('com_media');

//jimport('joomla.html.html.bootstrap');
?>
<div class="contact <?php echo $this->pageclass_sfx?> row" itemscope itemtype="http://schema.org/Person">
  <div class="col-md-12">
	<?php // Page heading
  if ($this->params->get('show_page_heading')) { ?>
		<h1 class="page-header">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	<?php } ?>

	<?php // Contact name
  if ($this->contact->name && $this->params->get('show_name') && $this->params->get('show_page_heading')) { ?>
  	<h2>
  		<span class="contact-name"><?php echo $this->contact->name; ?></span>
  	</h2>
  <?php } elseif ($this->contact->name && $this->params->get('show_name')) { ?>
  	<h1 class="page-header">
  		<span class="contact-name"><?php echo $this->contact->name; ?></span>
  	</h1>
	<?php } ?>

    <div class="row">
    <?php if ($this->params->get('show_contact_category') == 'show_no_link' || $this->params->get('show_contact_category') == 'show_with_link' ) { ?>
      <div class="col-md-12">
      	<?php // Contact category
        if ($this->params->get('show_contact_category') == 'show_no_link') { ?>
        <h3>
      	  <span class="contact-category"><?php echo $this->contact->category_title; ?></span>
        </h3>
      	<?php } ?>
        <?php echo $this->item->event->afterDisplayTitle; ?>
      	<?php // Contact category as link
        if ($this->params->get('show_contact_category') == 'show_with_link') { ?>
      		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
          <h3>
            <span class="contact-category">
              <a href="<?php echo $contactLink; ?>">
        				<?php echo $this->escape($this->contact->category_title); ?>
              </a>
      			</span>
          </h3>
        <?php } ?>
      </div>
    <?php } ?>
    <?php echo $this->item->event->beforeDisplayContent; ?>
  	<?php // Contact image
    if ($this->contact->image && $this->params->get('show_image')) { ?>
  		<div class="contact-image col-md-4">
  			<?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle', 'itemprop' => 'image', 'class' => 'img-thumbnail')); ?>
  		</div>
  	<?php
      $class = 'col-md-8';
    } else {
      $class = 'col-md-12';
    } ?>

      <div class="<?php echo $class; ?>">
    	<?php // Contact position
      if ($this->contact->con_position && $this->params->get('show_position')) { ?>
    		<div class="contact-position">
    			<h4 itemprop="jobTitle">
    				<?php echo $this->contact->con_position; ?>
    			</h4>
    		</div>
    	<?php } ?>

    	<?php // Address
      echo $this->loadTemplate('address');
      ?>

    	<?php // VCard
      if ($this->params->get('allow_vcard')) { ?>
        <?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
        <a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
        <?php echo JText::_('COM_CONTACT_VCARD');?>
        </a>
    	<?php } ?>

      <?php // Tags
      if ($this->params->get('show_tags', 1) && !empty($this->item->tags)) {
        $this->item->tagLayout = new JLayoutFile('joomla.content.tags');
        echo $this->item->tagLayout->render($this->item->tags->itemTags);
      } ?>

      </div>

    </div>

  	<?php // Email form
    if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) { ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?></h3>
    		<?php  echo $this->loadTemplate('form');  ?>
      </div>
    </div>
  	<?php } ?>

    <?php if ($this->params->get('show_links') || $this->params->get('show_articles')) {
      if ($this->params->get('show_links') && $this->params->get('show_articles')) {
        $class = 'col-md-6';
      } else {
        $class = 'col-md-12';
      }
    ?>
    <div class="row">
    	<?php // Links
      if ($this->params->get('show_links')) { ?>
        <div class="<?php echo $class ?>">
        <?php
        echo '<h3 class="page-header">' . JText::_('COM_CONTACT_LINKS') . '</h3>';
    		echo $this->loadTemplate('links');
        ?>
        </div>
    	<?php } ?>

    	<?php // Articles
      if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) { ?>
        <div class="<?php echo $class ?>">
          <h3 class="page-header"><?php echo JText::_('JGLOBAL_ARTICLES'); ?></h3>
      		<?php echo $this->loadTemplate('articles'); ?>
        </div>
    	<?php } ?>
    </div>
    <?php } ?>

  	<?php // User profile
    if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) { ?>
    <div class="row">
      <div class="col-md-12">
        <h3 class="page-header"><?php echo JText::_('COM_CONTACT_PROFILE'); ?></h3>
    		<?php echo $this->loadTemplate('profile'); ?>
      </div>
    </div>
  	<?php } ?>

  	<?php // Misc information
    if ($this->contact->misc && $this->params->get('show_misc')) { ?>
    <div class="row">
  		<div class="contact-miscinfo col-md-12">
        <h3 class="page-header"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION'); ?></h3>
        <?php echo $this->contact->misc; ?>
  		</div>
    </div>
  	<?php } ?>

  </div>
  <?php echo $this->item->event->afterDisplayContent; ?>
</div>