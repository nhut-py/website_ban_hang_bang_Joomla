// Javascript Document  Feidias

jQuery(document).ready(function($) {

    // Back-top
    $(window).scroll(function () {
    	if ($(this).scrollTop() > 100) {
    		$('#totop-scroller').fadeIn('slow');
    	} else {
    		$('#totop-scroller').fadeOut('slow');
    	}
    });

    $('#totop-scroller').click(function(e){
        $('html, body').animate({scrollTop:0}, 'slow');
        e.preventDefault();
    });

    // Joomla core
    if ($('table').length) {
      $('table').addClass('table');
    }

    if ($('#system-message-container').html().trim()){
      $('dd.info, dd.notice').addClass('alert alert-info');
      $('dd.error').addClass('alert alert-danger');
      $('dd.warning').addClass('alert alert-warning');
      $('dd.message').addClass('alert alert-success');
    }

    // Joomla list modules styling
    $('ul.archive-module, ul.mostread, ul.latestnews, .tagssimilar ul').addClass('nav nav-pills nav-stacked');

   // Carousel & Tooltip  Mootools fix
   if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined' ) {

    // both present , kill jquery slide for carousel class
    (function($) {
      $('.carousel').each(function(index, element) {
        $(this)[index].slide = null;
      });
      $('[data-toggle="tooltip"], .hasTooltip, #myTab a, div.btn-group, [data-toggle="tab"], .hasPopover, .hasTooltip').each(function(){this.show = null; this.hide = null});
    })(jQuery);

   }

    // Joomla tos link fix
    $('#jform_profile_tos-lbl').find('a').removeClass('modal');

    // Modal for print , ask question, recommend, manufacturer, call for price
    $('a[href="#vt-modal"]').click(function(event){

        var modalurl = $(this).attr('data-url');
        $('#vt-modal-iframe').attr('src', modalurl);
        event.preventDefault();

        // Show , Hide the preloader
        $('#vt-modal-iframe').ready(function(){
            $('#preloader').css('display', 'block');
        }).load(function(){
            $('#preloader').css('display', 'none');
        });

    });

    $('a.close-modal, button.close').click(function(){
        // reset the iframe src
        $('#vt-modal-iframe').attr('src' , '');

    });

    $(window).load(function(){
      if (!$('div.bklink').length) {
        $('body').append('<div class="bklink" style="text-align: center;font-size: 13px;padding: 5px 0;background-color:#333;color:#fff;border-top: 1px solid#555;"><a href="https://www.olympianthemes.com/virtuemart-templates.html">VirtueMart template</a> by olympianthemes.com</div>');
      }
    });

});
