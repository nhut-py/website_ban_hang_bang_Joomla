<?php
defined('_JEXEC') or die;

if (!$this->params->get('timer')) {

  $timer = 4000;

} else {

  $timer = $this->params->get('timer');

}
?>
<div id="fds-fsslider" class="margin-top-15">
  <div class="<?php echo $container; ?>">
    <div class="<?php echo $bsrow; ?>">
      <div class="<?php echo $bscol; ?>12">
        <div class="slide carousel" id="carousel" data-ride="carousel" style="max-height:<?php echo $this->params->get('slideheight'); ?>px; overflow: hidden;">
          <?php if ($slidecount > 1) : ?>
          <!-- Indicators -->
          <ol class="carousel-indicators">
           <?php
              for ($i = 0; $i <= ( $slidecount ) -1;  $i ++) {
               if ($i == 0) {
                 $class = ' class="active"';
               } else {
                 $class = '';
               }
               echo '<li data-target="#carousel" data-slide-to="'.$i.'"'.$class.'></li>';
            } ?>
          </ol>
          <?php endif; ?>
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php
            $imgcounter = 1;
            foreach ($fsdslides as $image) { ?>
              <?php if (!empty($image)) { ?>
              <div class="item <?php if ($imgcounter == 1) { echo 'active';} ?>">
                <?php if ($this->params->get('slide' . $imgcounter . 'link')) : ?>
                <a href="<?php echo $this->params->get('slide' . $imgcounter . 'link'); ?>"><img src="<?php echo $image; ?>" alt=""></a>
                <?php else : ?>
                <img src="<?php echo $image; ?>" alt="">
                <?php endif; ?>
              </div>
              <?php
              $imgcounter++;
              } ?>
            <?php } ?>
          </div>
          <?php if ($slidecount > 1) : ?>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  //jQuery(window).load(function(){
    jQuery('#carousel').carousel({
      interval: <?php echo $timer; ?>,
      pause: "hover"
    });
  //});
</script>