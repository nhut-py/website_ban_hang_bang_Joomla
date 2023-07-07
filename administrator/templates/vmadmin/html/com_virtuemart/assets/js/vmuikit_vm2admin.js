if (typeof Virtuemart === 'undefined')
	var Virtuemart = {}

jQuery(document).ready(function () {
	jQuery('.changeSendForm')
	.off('change', Virtuemart.sendCurrForm)
	.on('change', Virtuemart.sendCurrForm)
})

Virtuemart.showprices = jQuery(function ($) {
	jQuery(document).ready(function ($) {
		
		if ($('#show_prices').is(':checked')) {
			$('#show_hide_prices').show()
		} else {
			$('#show_hide_prices').hide()
		}
		$('#show_prices').click(function () {
			if ($('#show_prices').is(':checked')) {
				$('#show_hide_prices').show()
			} else {
				$('#show_hide_prices').hide()
			}
		})
	})
})

Virtuemart.sortable = jQuery(function ($) {
	
	$(document).ready(function () {
		$('.adminlist').sortable({
			handle:'.vmicon-16-move',
			items:'tr:not(:first,:last)',
			opacity:0.8,
			update:function () {
				var i = 1
				$(function updatenr () {
					$('input.ordering').each(function (idx) {
						$(this).val(idx)
					})
				})
				
				$(function updaterows () {
					$('.order').each(function (index) {
						var row = $(this).parent('td').parent('tr').prevAll().length
						$(this).val(row)
						i++
					})
					
				})
			}
			
		})
	})
	
});

(function ($) {
	
	Virtuemart.sendCurrForm = function (event) {
		console.log('What the heck', event)
		event.preventDefault()
		if (event.currentTarget.length > 0) {
			$(event.currentTarget[0].form.submit())
		} else {
			var f = jQuery(event.currentTarget).closest('form')
			f.submit()
		}
	}
	
	var methods = {
		
		vmuikitTabs:function (cookie) {
			var tabscount = this.find('.vmuikit-admin-tabs').length
			if ($.cookie(cookie) == null || cookie == 'product0' || tabscount == 1) var idx = 0
			else var idx = $.cookie(cookie)
			var options = {path:'/', expires:2}
			var li = $('#vmuikit-admin-ui-tabs ul.vmuikit-admin-tabs li')
			
			li.click(
					function () {
						var idx = li.index(this)
						if (cookie !== '') $.cookie(cookie, idx, options)
					}
			)
			return this
		},
		
		vmuikitToggleOffcanvas:function (cookie) {
			var options = {path:'/', expires:2}
			var $offcanvasToggle = $('.vmuikit-js-menu-offcanvas-toggle');
			var $offcanvas = $('#vmuikit-menu-offcanvas-wrapper');
			var $menuWrapper = $('#vmuikit-menu-wrapper');
			var $menuOffcanvasWrapper = $('#vmuikit-menu-offcanvas-wrapper');
			$offcanvasToggle.show();
			$offcanvasToggle.click(
					function (e) {
						if ($menuWrapper.hasClass('uk-visible@m')) {
							$menuWrapper.removeClass('uk-visible@m')
							$menuWrapper.addClass('uk-hidden@m')
							$menuOffcanvasWrapper.removeClass('uk-hidden@m')
							$menuOffcanvasWrapper.addClass('uk-visible@m')
							$.cookie('vmmenu', 'hidden', options);
						} else {
							$menuWrapper.removeClass('uk-hidden@m')
							$menuWrapper.addClass('uk-visible@m')
							$menuOffcanvasWrapper.removeClass('uk-visible@m')
							$menuOffcanvasWrapper.addClass('uk-hidden@m')
							$.cookie('vmmenu', 'visible', options);
						}
					}
			);
			
		},
		
	};
	
	$.fn.vmuikitadmin = function (method) {
		
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1))
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments)
		} else {
			$.error('Method ' + method + ' does not exist on Vm2 admin jQuery library')
		}
		
	}
})(jQuery)

// load defaut scripts
jQuery.noConflict()
