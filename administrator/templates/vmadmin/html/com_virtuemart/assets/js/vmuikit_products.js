/**
 * Created by Milbo on 18.11.2016.
 */

if (typeof Virtuemart === "undefined")
	var Virtuemart = {};



Virtuemart.customfields = jQuery(function($) {

	$(document).ready(function(){
		
		
		$('#vmuikit-js-relatedcategories-container').delegate('.vmuikit-js-remove', 'click', function () {
			$(this).closest('.vmuikit-js-relatedcf').fadeOut('500', function () {
				$(this).remove()
			})
		})
		$('#vmuikit-js-relatedcategories-container').sortable({
			update:function (event, ui) {
				$(this).find('.ordering').each(function (index, element) {
					$(element).val(index)
				})
			}
		})
		
		$('#vmuikit-js-relatedproducts-container').delegate('.vmuikit-js-remove', 'click', function () {
			$(this).closest('.vmuikit-js-relatedcf').fadeOut('500', function () {
				$(this).remove()
			})
		})
		$('#vmuikit-js-relatedproducts-container').sortable({
			update:function (event, ui) {
				$(this).find('.ordering').each(function (index, element) {
					$(element).val(index)
				})
			}
		})
		$('#vmuikit-js-customcf-container').sortable({
			update:function (event, ui) {
				$(this).find('.ordering').each(function (index, element) {
					$(element).val(index)
				})
			}
		})
		$('#vmuikit-js-customcf-container').delegate('.vmuikit-js-remove', 'click', function () {
			$(this).closest('.vmuikit-js-customcf').fadeOut('500', function () {
				$(this).remove()
			})
		})
	});
	

	$('select#customlist').chosen().change(function(e) {
		selected = $(this).find( 'option:selected').val() ;
		$.getJSON(Virtuemart.vmUikitLink+'&type=fields&id='+selected+'&row='+Virtuemart.nextCustom,
				function (data) {
					// TODO Script URL dyn
					 console.log("getJSON customlist", data, Virtuemart.nextCustom);
					var template = $('#vmuikit-js-customcf-template').html()
					var rendered = Mustache.render(template, {"customcfs": data })
				 $('#vmuikit-js-customcf-container').append(rendered)
				}
		)
		Virtuemart.nextCustom++;
	});

	$.each($('.cvard'), function(i,val){
		$(val).chosen().change(function() {
			quantity = $(this).parent().find('input[type=\"hidden\"]');
			quantity.val($(this).val());
		});
	});
	
	$('.vmuikit-js-relatedcf-search').click(function (e) {
		var obj = $(this).closest('.vmuikit-filter-search')
		var term=obj.find("input")
		var relatedcf= $(this).attr('data-relatedcf')

		$.getJSON(Virtuemart.vmUikitLink+'&type='+relatedcf+'&row='+Virtuemart.nextCustom + 'term='+term ,
				function (data) {
					// TODO Script URL dyn
					//	console.log("getJSON vmUikitLink", data);
					$.getScript(Virtuemart.productScript).done(function(script, textStatus) {})
					.fail(function(jqxhr, settings, exception) {
						console.log("could not get " +Virtuemart.productScript +" script.");
					});
					var template = $('#search-relatedcf-template').html()
					var rendered = Mustache.render(template, {"relatedDatas": data ,"relatedcf":relatedcf})
					output="#search-"+relatedcf+"-output"
					dropdown="#search-"+relatedcf+"-result"
					//console.log("getJSON dropdown show", rendered);
					$(output).html (rendered)
					UIkit.dropdown(dropdown).show();
				}
		)
	})
	$('.vmuikit-js-relatedcf-select').click(function (e) {
		var objCard=	$(this).closest('.vmuikit-js-cf-card')
		var objBody=objCard.find('.vmuikit-js-cf-card-body')
		var data= {}
		var datas= []
		data.displayHTML = objBody.html()
		data.hiddenHTML = ''
		datas.push(data)
		// in sublayouts/relatedcf_template.php: template is the same for categories and products
		var template = $('#display-selected-cf-template').html()
		console.log('template',template)
		var relatedcf= $(this).attr('data-relatedcf')
		var rendered = Mustache.render(template, {"relatedDatas": datas ,"relatedcf":relatedcf})
		console.log('rendered',rendered)
		var container='#vmuikit-js-'+relatedcf+'-container'
		console.log('container',container)
		var renderedHTML=$(container).html() + rendered
		$(container).html(renderedHTML)
		dropdown="#search-"+relatedcf+"-result"
		console.log('dropdown',dropdown)
		UIkit.dropdown(dropdown).hide();
	})
	
	
	eventNames = 'click.remove keydown.remove change.remove focus.remove'; // all events you wish to bind to
	
	function removeParent() {$('#customfieldsParent').remove(); }
	
	$('#customfieldsTable').find('input').each(function(i){
		current = $(this);
		current.click(function(){
			$('#customfieldsParent').remove();
		});
	});


});


Virtuemart.edit_status = jQuery (function($) {
	
	$(document).ready(function ($) {
		jQuery('#image').change( function() {
			var $newimage = jQuery(this).val();
			jQuery('#product_availability').val($newimage);
			jQuery('#imagelib').attr({ src:Virtuemart.imagePath+$newimage, alt:$newimage });
		});
		jQuery('.js-change-stock').change( function() {
			
			var in_stock = jQuery('.js-change-stock[name="product_in_stock"]');
			var ordered = jQuery('.js-change-stock[name="product_ordered"]');
			var product_in_stock= parseInt(in_stock.val());
			if ( oldstock == "undefined") var oldstock = product_in_stock ;
			var product_ordered=parseInt(ordered.val());
			if (product_in_stock>product_ordered && product_in_stock!=oldstock )
				jQuery('#notify_users').attr('checked','checked');
			else jQuery('#notify_users').attr('checked',false);
		});
	});
	
	
});

Virtuemart.prdcustomer = jQuery(function($) {
	
	var $customerMailLink = Virtuemart.urlDomain+'/index.php?option=com_virtuemart&view=productdetails&task=sentproductemailtoshoppers&virtuemart_product_id=' +Virtuemart.virtuemart_product_id;
	var $customerMailNotifyLink = 'index.php?option=com_virtuemart&view=product&task=ajax_notifyUsers&virtuemart_product_id=' +Virtuemart.virtuemart_product_id;
	var $customerListLink = 'index.php?option=com_virtuemart&view=product&format=json&type=userlist&virtuemart_product_id=' +Virtuemart.virtuemart_product_id;
	var $customerListNotifyLink = 'index.php?option=com_virtuemart&view=product&task=ajax_waitinglist&virtuemart_product_id=' +Virtuemart.virtuemart_product_id;
	var $customerListtype = 'reserved';
	
	$(document).ready(function ($) {
		
		populate_customer_list(jQuery('select#order_status').val());
		customer_initiliaze_boxes();
		jQuery("input:radio[name=customer_email_type],input:checkbox[name=notification_template]").click(function () {
			customer_initiliaze_boxes();
		});
		jQuery('select#order_status').chosen({enable_select_all:true, select_some_options_text:vm2string.select_some_options_text}).change(function () {
			populate_customer_list(jQuery(this).val());
		});
		jQuery('.mailing .button2-left').click(function () {
			
			email_type = jQuery("input:radio[name=customer_email_type]:checked").val();
			if (email_type == 'notify') {
				
				var $body = '';
				var $subject = '';
				if (jQuery('input:checkbox[name=notification_template]').not(':checked')) {
					$subject = jQuery('#mail-subject').val();
					$body = jQuery('#mail-body').val();
				}
				var $max_number = jQuery('input[name=notify_number]').val();
				
				jQuery.post($customerMailNotifyLink, { subject:$subject, mailbody:$body, max_number:$max_number, token:Virtuemart.token },
						function (data) {
							alert(Virtuemart.msgsent);
							jQuery.getJSON($customerListNotifyLink, {tmpl:'component', no_html:1},
									function (data) {
										//			jQuery("#customers-list").html(data.value);
										$html = '';
										jQuery.each(data, function (key, val) {
											if (val.virtuemart_user_id == 0) {
												$html += '<tr><td></td><td></td><td><a href="mailto:' + val.notify_email + '">' + val.notify_email + '</a></td></tr>';
											}
											else {
												$html += '<tr><td>' + val.name + '</td><td>' + val.username + '</td><td><a href="mailto:' + val.notify_email + '">' + val.notify_email + '</a></td></tr>';
											}
										});
										jQuery("#customers-notify-list").html($html);
									}
							);
						}
				);
				
			}
			else if (email_type == 'customer') {
				var $subject = jQuery('#mail-subject').val();
				var $body = jQuery('#mail-body').val();
				if ($subject == '') {
					alert(Virtuemart.enterSubj);
				}
				else if ($body == '') {
					alert(Virtuemart.enterBody);
				}
				else {
					var $statut = jQuery('select#order_status').val();
					jQuery.post($customerMailLink, { subject:$subject, mailbody:$body, statut:$statut, token:Virtuemart.token },
							function (data) {
								alert(Virtuemart.msgsent);
								//jQuery("#customers-list-msg").html('<strong><?php echo vmText::_ ('COM_VIRTUEMART_PRODUCT_NOTIFY_MESSAGE_SENT')?></strong>');
								//jQuery("#mail-subject").html('');
								jQuery("#mail-body").html('');
							}
					);
				}
				
			}
			
		});
		
	});
	
	/* JS for list changes */
	function populate_customer_list($status) {
		if ($status == "undefined" || $status == null) $status = '';
		if($status !=''){
			jQuery.getJSON($customerListLink, { order_status:$status  },
					function (data) {
						jQuery("#customers-list").html(data.value);
					});
		}
	}
	
	function customer_initiliaze_boxes() {
		email_type = jQuery("input:radio[name=customer_email_type]:checked").val();
		if (email_type == 'notify') {
			jQuery('#notify_particulars').show();
			jQuery('#customer-mail-list').hide();
			jQuery('#customer-mail-notify-list').show();
			jQuery("input:radio[name=customer_email_type]").val();
			if (jQuery('input:checkbox[name=notification_template]').is(':checked')) jQuery('#customer-mail-content').hide();
			else  jQuery('#customer-mail-content').show();
			
		}
		else if (email_type == 'customer') {
			jQuery('#notify_particulars').hide();
			jQuery('#customer-mail-content').show();
			jQuery('#customer-mail-list').show();
			jQuery('#customer-mail-notify-list').hide();
		}
	}
	
});

// based on http://www.seomoves.org/blog/web-design-development/dynotable-a-jquery-plugin-by-bob-tantlinger-2683/
(function ($) {
	
	$.fn.products = function (method) {
		
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Method ' + method + ' does not exist on Vm2 admin jQuery library');
		}
		
	};
	
})(jQuery);

