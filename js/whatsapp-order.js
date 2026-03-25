jQuery(document).ready(function($){

$('.whatsapp-order-btn').click(function(){

    var phone = $(this).data('phone');
    var productName = $('h3.product_title').text();
    var sku = $('span.sku').text();
    var productUrl = window.location.href;
    var qty = $('input.qty').val() || 1;
    var img = $('img.zoomImg').attr('src');
    var variationData = '';
    var variationSelected = true;

    /* GET SELECTED VARIATIONS */

    $('.variations_form select').each(function(){

        var label = $(this).closest('tr').find('label').text();
        var value = $(this).find('option:selected').text();

        if(!$(this).val()){
            variationSelected = false;
        }

        if(value && $(this).val()){
            variationData += label + ': ' + value + '\n';
        }
    });

    /* PRICE LOGIC */

    var price = '';
    if($('.variations_form').length){   // variable product

        if(!variationSelected){
            alert('Please select product variation');
            return;
        }

        price = $('.single_variation .price').text().trim();

    } else {  // simple product
        price = $('.price').first().text().trim();
    }

    /* BUILD MESSAGE */

    var message = "Hello \n\n";
    message += "I want to order this product.\n\n";
    message += "Product: " + productName + "\n";
    message += "Product SKU : " + sku + "\n";
    message += "Price: " + price + "\n";
    message += "Quantity: " + qty + "\n\n";
    
    message += "Product image : " + img + "\n";

    if(variationData){
        message += variationData + "\n";
    }

    message += "🔗 Product Link:\n" + productUrl;

    var url = "https://wa.me/" + phone + "?text=" + encodeURIComponent(message);

    window.open(url, '_blank');

});
});