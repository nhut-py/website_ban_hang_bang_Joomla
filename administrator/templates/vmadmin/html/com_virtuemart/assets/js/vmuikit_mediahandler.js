/**
 * mediahandler.js: for VirtueMart Mediahandler
 *
 * @package    VirtueMart
 * @subpackage Javascript Library
 * @authors    Patrick Kohl, Max Milbers
 * @copyright  Copyright (c) 2011-2016 VirtueMart Team. All rights reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

jQuery(document).ready(function ($) {
	
	var media = $('#vmuikit-js-search-media').data()
	var searchMedia = $('input#vmuikit-js-search-media')
	searchMedia.click(function () {
		if (media.start > 0) media.start = 0
	})

	$('.vmuikit-js-pages').click(function (e) {
		e.preventDefault()
		if (searchMedia.val() == '') {
			searchMedia.val(' ')
			media.start = 0
		} else if ($(this).hasClass('vmuikit-js-next')) media.start = media.start + 16
		else if (media.start > 0) media.start = media.start - 16
 
		$.getJSON(Virtuemart.medialink + '&start=' + media.start,
				function (data) {
			// TODO Script URL dyn
					$.getScript(Virtuemart.mediaScript).done(function(script, textStatus) {})
					.fail(function(jqxhr, settings, exception) {
						console.log("could not get '+Virtuemart.mediaScript+' script.");
					});
					var template = $('#search-media-template').html()
					var rendered = Mustache.render(template, {"images": data ,})
					console.log("getJSON dropdown show", rendered);
					$('#search-media-output').html(rendered)
					UIkit.dropdown('#search-media-result').show();
					
				}
		)
	})
	$('.vmuikit-js-select-media').click(function (e) {
		console.log('vmuikit-js-select-media click')
		var obj=$(this)
		var image= {}
		var images= []
		image.virtuemart_media_id = parseInt(obj.attr('data-virtuemart-media-id'))
		image.file_url_thumb = obj.attr('data-file-url-thumb')
		image.file_title = obj.attr('data-file-title')
		image.file_description = obj.attr('data-file-description')
		image.file_meta = obj.attr('data-file-meta')
		image.file_url = obj.attr('data-file-url')
		image.ordering = obj.attr('data-ordering')
 
		image.file_url_thumb_img='<img src="'+image.file_url_thumb+'" alt="'+image.file_title+'" />'
		
		images.push(image)
		var template = $('#display-selected-media-template').html()
		var rendered = Mustache.render(template, {"images": images ,})
		var container=$('#vmuikit-js-images-container')
		var renderedHTML=$(container).html() + rendered
		$(container).html(renderedHTML)
		UIkit.dropdown('#search-media-result').hide();
	})
	
	function imgPreviewCard (readerResult, filename) {
		$('#vmuikit-image-preview').removeClass('uk-hidden')
		$('#image-preview-card-title').text(filename)
		
		const img = document.createElement('img')
		img.setAttribute('id', 'img-preview-responsive')
		img.setAttribute('src', readerResult)
		img.setAttribute('data-name', filename)
		img.setAttribute('alt', filename)
		$('#image-preview-card-image').html(img)
		return
	}
	
	
	$('[name="upload"]').on('change', function (e) {
		e.preventDefault()
		const file = e.target.files[0]
		
		/* TODO
		const fileInput = uploadContainer.querySelector('.uk-form-custom>input')
		const preview = uploadContainer.querySelector('#image-preview')
		const alert = uploadContainer.parentElement.querySelector('.uk-upload-box>#vmuikit-error-alert-file-upload')
		const alertMessage = uploadContainer.parentElement.querySelector('.uk-upload-box>#vmuikit-error-alert-file-upload>div')
		*/
		let filename = file['name']
		
		/* TODO Can do some checkings on client side
		* 	 acceptedDocMimes = ['application/pdf', 'image/png', 'image/jpeg']
				 size = file['size']
				 fileType = file['type']
				 * add errors in alert box
		* */
		const reader = new FileReader()
		reader.onload = () => {
			imgPreviewCard(reader.result, filename)
		}
		reader.readAsDataURL(file)
		
		var media_action = $('#vmuikit-js-upload').find('[name=\'media[media_action]\']:checked')
		if (typeof $(media_action[0]).val() != 'undefined' && $(media_action[0]).val() == 0) {
			var mediaActionDefaultChecked = $('#vmuikit-js-upload').find('[id=\'media[media_action]upload\']')
			if(mediaActionDefaultChecked.length == 0) {
				mediaActionDefaultChecked =$('#vmuikit-js-upload').find('[id=\'media[media_action]replace\']')
			}
			mediaActionDefaultChecked.attr('checked', true)
		}
		
	})
	$('.vmuikit-media-action').on('change', function () {
		var media_action = $('#vmuikit-js-upload').find('[name=\'media[media_action]\']:checked')
		if (typeof $(media_action[0]).val() != 'undefined' && $(media_action[0]).val() == 0) {
			$('#vmuikit-image-preview').addClass('uk-hidden')
			$('#image-preview-card-title').text('')
			$('#image-preview-card-image').text('')
		}
	})
 
	
	$('#vmuikit-js-images-container').sortable({
		update:function (event, ui) {
			$(this).find('.ordering').each(function (index, element) {
				$(element).val(index)
			})
		}
	})
	
	
	$('.vmuikit-js-edit-image').click(function (e) {
		//var virtuemart_media_id = $(this).parent().find("input").val();
		//console.log('edit-image', virtuemart_media_id)
		var closest = $(this).closest('.vmuikit-js-thumb-image')
		var virtuemart_media_id = closest.find('input[name=\'virtuemart_media_id[]\']').val()
		console.log('edit-image', virtuemart_media_id)
		$.getJSON('index.php?option=com_virtuemart&view=media&format=json&virtuemart_media_id=' + virtuemart_media_id,
				function (datas, textStatus) {
					if (datas.msg == 'OK') {
						$('#vmuikit-js-display-image').attr('src', datas.file_root + datas.file_url)
						$('#vmuikit-js-display-image').attr('alt', datas.file_title)
						$('#file_title').html(datas.file_title)
						if (datas.published == 1) $('#adminForm [name=\'media[media_published]\']').attr('checked', true)
						else $('#adminForm [name=media_published]').attr('checked', false)
						if (datas.file_is_downloadable == 0) {
							$('#media_rolesfile_is_displayable').attr('checked', true)
							//$("#adminForm [name=media_roles]").filter("value='file_is_downloadable'").attr('checked', false);
						} else {
							//$("#adminForm [name=media_roles]").filter("value='file_is_displayable'").attr('checked', false);
							$('#media_rolesfile_is_downloadable').attr('checked', true)
						}
						$('#adminForm [name=\'media[file_title]\']').val(datas.file_title)
						$('#adminForm [name=\'media[file_description]\']').val(datas.file_description)
						$('#adminForm [name=\'media[file_meta]\']').val(datas.file_meta)
						$('#adminForm [name=\'media[file_class]\']').val(datas.file_class)
						$('#adminForm [name=\'media[file_url]\']').val(datas.file_url)
						$('#adminForm [name=\'media[file_url_thumb]\']').val(datas.file_url_thumb)
						var lang = datas.file_lang.split(',')
						$('#adminForm [name=\'media[active_languages][]\']').val(lang).trigger('liszt:updated')
						$('[name=\'media[active_media_id]\']').val(datas.virtuemart_media_id)
						if (typeof datas.file_url_thumb !== 'undefined') {
							$('.vmuikit-js-info-image').attr('src', datas.file_root + datas.file_url_thumb_dyn)
						} else {
							$('.vmuikit-js-info-image').attr('src', '')
						}
					} else $('#file_title').html(datas.msg)
				})
	})
	
	
});

(function ($) {
	
	var methods = {
		media:function (mediatype, total) {
			var page = 0,
					max = 24,
					container = $(this)
			var pagetotal = Math.ceil(total / max)
			var cache = new Array()
			
			var formatTitle = function (title, currentArray, currentIndex, currentOpts) {
				var pagination = '', pagetotal = total / max
				if (pagetotal > 0) {
					pagination = '<span><<</span><span><</span>'
					for (i = 0; i < pagetotal; i++) {
						pagination += '<span>' + (i + 1) + '</span>'
					}
					pagination += '<span>></span><span>>></span>'
				}
				return '<div class="media-pagination">' + (title && title.length ? '<b>' + title + '</b>' : '') + ' ' + pagination + '</div>'
			}
 


			$('#media-dialog').delegate('.vmuikit-js-thumb-image', 'click', function (event) {
				event.preventDefault()
				var id = $(this).find('input').val(), ok = 0
				var inputArray = new Array()
				$('#vmuikit-js-images-container input:hidden').each(
						function () {
							inputArray.push($(this).val())
						}
				)
 
				
			})
			
			$('#vmuikit-admin-ui-tabs').delegate('.vmuikit-js-remove', 'click', function () {
				$(this).closest('.vmuikit-js-thumb-image').fadeOut('500', function () {
					$(this).remove()
				})
			})
 
		 
		}
	}
	$.fn.vmuikitmedia = function (method) {
		
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1))
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments)
		} else {
			$.error('Method ' + method + ' does not exist on Vm2 admin jQuery library')
		}
		
	}
})(jQuery)
//$('#ImagesContainer').media()

