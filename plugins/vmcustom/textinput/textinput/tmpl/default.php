<?php
	defined('_JEXEC') or die();
	$class='no-vm-bind vmcustom-textinput';
$product = $viewData[0];
$params = $viewData[1];
$nameJs = 'customProductData['.$product->virtuemart_product_id.']['.$params->virtuemart_custom_id.']';
$name = 'customProductData['.$product->virtuemart_product_id.']['.$params->virtuemart_custom_id.']['.$params->virtuemart_customfield_id .'][comment]';

$recalculate = '';
if(!empty($params->customfield_price)){

	$recalculate = 'Virtuemart.setproducttype(formProduct,virtuemart_product_id);';
}

?>

	<input class="<?php echo $class ?>"
		   type="text" value=""
		   size="<?php echo $params->custom_size ?>"
		   name="<?php echo $name?>"
		><br />
<?php

$checkMin = '';
$ButtonTexts = '';
if(!empty($params->required_letters)){
    $ButtonTexts = 'Virtuemart.BtncartAddToo = "'.vmText::_( 'COM_VIRTUEMART_CART_ADD_TO' ).'";
                    Virtuemart.BtncartEnterText = "'.vmText::_( 'VMCUSTOM_TEXTINPUT_ENTER_TEXT' ).'";';
    $checkMin = 'Virtuemart.checkCharCount($(this), event);';
    vmJsApi::addJScript('toggleCartButton');
}
	//javascript to update price
	$j = 'var test = function($) {
'.$ButtonTexts.'
	$(".vmcustom-textinput").keyup(function(event) {
			formProduct = $(this).parents("form.product");
			virtuemart_product_id = formProduct.find(\'input[name="virtuemart_product_id[]"]\').val();
		'.$recalculate.'
		'.$checkMin.'
		});
		Virtuemart.checkCharCount = function(obj, event){
		    var charCount; 
		    
		    var addToCart = true;
		    console.log("New try ");
		    $("[name*=\''.$nameJs.'\']").each(function (){
		        charCount = $(this).val().length;
		        console.log("My charcount ",charCount,this);
		        if(charCount<'.$params->required_letters.'){
		            addToCart = false;
		            $(this).css("border-color", "red");
		            $(this).removeClass("valid");
		            $(this).addClass("required invalid");
		        } else {
		            $(this).removeClass("required invalid");
		            $(this).addClass("valid");
		            $(this).css("border-color", "green");
		            console.log("Set Green ",this);
		        }
		    });
		    var button;
		    if(addToCart){
		        
		        button = iStraxx.toggleButton(true, event);
		        if(typeof button[0] !== "undefined"){
		            button[0].innerHTML=Virtuemart.BtncartAddToo;
		            console.log("My Button",button);
		        }
		        
		        
		        //Extra
		        event.data.cartform = $(".addtocart_inner").find(".js-recalculate");
		        button = iStraxx.toggleButton(true, event);
		        if(typeof button[0] !== "undefined"){
		            button[0].innerHTML=Virtuemart.BtncartAddToo;
		        }
		        
		    } else {
		        obj.css("border-color", "red");
		        button = iStraxx.toggleButton(false, event);
		        if(typeof button[0] !== "undefined"){
		            button[0].innerHTML=Virtuemart.BtncartEnterText;
		        }
		        
		        
		        //Extra
		        event.data.cartform = $(".addtocart_inner").find(".js-recalculate");
		        button = iStraxx.toggleButton(false, event);
		        if(typeof button[0] !== "undefined"){
		            button[0].innerHTML=Virtuemart.BtncartEnterText;
		        } else {
		            button.innerHTML=Virtuemart.BtncartEnterText;
		        }
		        
		    }
		    //console.log("lets se what we have here",obj);
		    //obj.border = "red";
		};
};
jQuery("body").on("updateVirtueMartProductDetail", test);
jQuery(document).ready(test);';
	vmJsApi::addJScript('textinput',$j);

?>