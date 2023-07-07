/**
 * @subpackage Plugins - istraxx toggle Button script
 * @author Max Milbers
 * @copyright Copyright (C) 2012-2020 iStraxx - All rights reserved.
 * @license MIT Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

if (typeof iStraxx === "undefined")
    iStraxx = {};

(function($) {

    iStraxx.getCartArea = function(inp){
        var runs= 0, maxruns = 20;
        while(!inp.hasClass('js-recalculate') && runs<=maxruns){
            inp = inp.parent();
            runs++;
        }
        if(runs>maxruns){
            console.log('istraxx download: Could not find parent container ');
            return false;
        }
        return inp;
    }

    iStraxx.getButton = function(inp){
        if(inp!=false){
            return inp.find('[name="addtocart"]');
        } else return false;
    }

    iStraxx.toggleCartButton = function(add, event){

        if(event.data === null){
            var cart = iStraxx.getCartArea($(event.currentTarget));
        } else {
            var cart = event.data.cartform;
        }

        var buttons = iStraxx.getButton(cart);
        if(buttons==false) return;

        var button = $(buttons[0]);

        if(add){
            if(button[0]!="undefined" && button[0].tagName=='A'){
                button.off("click submit",Virtuemart.disabledLink);
            } else {
                button.removeProp('disabled');
                button.removeAttr('disabled');
            }

            button.on("click submit",null,{cart:cart},Virtuemart.addtocart);
            button.toggleClass("addtocart-button-disabled",false);
            button.toggleClass("addtocart-button",true);

        } else {
            if(button[0]!="undefined" && button[0].tagName=='A'){
                button.on("click submit",null,{button:button},Virtuemart.disabledLink);
            } else {
                button.attr('disabled','disabled');
            }

            button.off("click submit",Virtuemart.addtocart);
            button.toggleClass("addtocart-button-disabled",true);
            button.toggleClass("addtocart-button",false);

        }
        return button;
    }
})(jQuery)