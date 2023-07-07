jQuery(document).ready(function(){
	
	var opt=jQuery('#jform_params_pages_select').val();
	showhide(opt);
});
function onwc_select_change(){
	var opt=jQuery('#jform_params_pages_select').val();
	showhide(opt);
	
}
function showhide(opt){
	if(opt==2){
		jQuery('#jform_params_showonpages').parent().parent().show();
		jQuery('#jform_params_showonpages').attr('required','required');
		jQuery('#jform_params_hideonpages').parent().parent().hide();
		jQuery('#jform_params_hideonpages').removeAttr('required');
	}else if(opt==3){
		jQuery('#jform_params_hideonpages').parent().parent().show();
		jQuery('#jform_params_hideonpages').attr('required','required');
		jQuery('#jform_params_showonpages').parent().parent().hide();
		jQuery('#jform_params_showonpages').removeAttr('required');
	}else{
		jQuery('#jform_params_showonpages').parent().parent().hide();
		jQuery('#jform_params_hideonpages').parent().parent().hide();
		jQuery('#jform_params_showonpages').removeAttr('required');
		jQuery('#jform_params_hideonpages').removeAttr('required');
	}
	
}