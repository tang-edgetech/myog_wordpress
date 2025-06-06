jQuery(document).ready(function($){
    // $(document).on('click', '.btn-tkp-add-cart', function(e){
    //     e.preventDefault();
    //     var $this = $(this),
    //         $product_id = $this.data('product-id'),
    //         $loading = $this.find('.loading');
    //     if($product_id!=''){
    //         $loading.fadeIn();
    //         $.ajax({
    //             type: 'POST',
    //             url: myog_add_cart.ajaxurl,
    //             data: {
    //                 action: 'add_to_cart_ajax_handler',
    //                 nonce: myog_add_cart.nonce,
    //                 product_id: $product_id,
    //             },
    //             success: function(response){
    //                 $loading.fadeOut();
    //                 console.log('Success');
    //                 console.log(response);
    //                 if(response.status == 'success'){
    //                     myog_add_cart_popup(response.status, response.message, myog_add_cart.cart_page);
    //                     $('#cart-counter').text(response.cart);
    //                 }
    //                 else{
    //                     myog_add_cart_popup(response.status, response.message, '');
    //                 }
    //             },
    //             error: function(xhr){
    //                 $loading.fadeOut();
    //                 console.log('Error');
    //                 console.log(xhr);
    //                 myog_add_cart_popup(response.status, response.message, '');
    //             }
    //         });
    //     }
    // });
    // $(document).on('click', '.myog-add-cart-popup .close', function(e){
    //     $('#addCartModal').fadeOut();
    //     setTimeout(function(){
    //         $('#addCartModal').removeClass('show');
    //     }, 250);
    // });
    // function myog_add_cart_popup($status,$message,$link){
    //     var $ajaxResponse = $('.ajax-response');
    //     $ajaxResponse.addClass($status);
    //     $ajaxResponse.html('<p class="d-block w-100 mb-3">'+$message+'</p>');
    //     if($.trim($link) !== ''){
    //         $ajaxResponse.append('<div class="add-cart-cta"><a href='+$link+'" target="_blank" class="btn elementor-button uppercase px-4 py-2">View Cart</a></div>');
    //     }
    //     $('#addCartModal').fadeIn();
    //     setTimeout(function(){
    //         $('#addCartModal').addClass('show');
    //     }, 250);
    // }
});