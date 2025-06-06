document.addEventListener("DOMContentLoaded", function() {
	$(document).ready(function() {
        $product_unique_id = singleProductData.product_unique_id;
        if( $product_unique_id !== null ) {
            console.log('ID = '+$product_unique_id);
            $.get(singleProductData.api_url+$product_unique_id, function(data) {
                // var $response = JSON.parse(data);
                var $response = data;
                if( $response.code == 1000 ) {
                    console.log($response.message);
                    console.log($response.data);
                }
                else {
                    console.log('Failed');
                    console.log($response.message);
                }
            });
            // $.ajax({
            //     type: 'post',
            //     url: singleProductData.ajax_url,
            //     data: {
            //         action: 'myog_single_product_insight',
            //         product_unique_id: $product_unique_id,
            //         nonce: singleProductData.nonce,
            //     },
            //     dataType: 'json',
            //     beforeSend: function() {

            //     },
            //     success: function(data) {
            //         var $response = JSON.parse(data);
            //         console.log($response.status, $response.message);
            //         if( $response.status == 1000 ) {
            //             console.log($response.html);
            //         }
            //         else if( $response.status == 2000 ) {
            //             console.log('Failed retrieving data!');
            //         }
            //         else {
            //             console.log('Other error!');
            //         }
            //     },
            //     error: function(xhr) {
            //         console.log('Error');
            //         console.log(xhr);
            //     }
            // });
        }

        $(document).on('click', '.myog-iac-quantity .btn-decrease', function(e) {
            e.preventDefault();
            var $this = $(this),
                $qty_field = $this.siblings('.myog-iac-qty'),
                $amount = parseInt($qty_field.val());
            var $new_qty = $amount - 1;
            if($amount>1) {
                $qty_field.val($new_qty);
            }
            if($amount === 1) {
                $this.addClass('disabled');
            }
        });

        $(document).on('click', '.myog-iac-quantity .btn-increase', function(e) {
            e.preventDefault();
            var $this = $(this),
                $qty_field = $this.siblings('.myog-iac-qty'),
                $amount = parseInt($qty_field.val());
            var $new_qty = $amount + 1;
            $qty_field.val($new_qty);
            if($new_qty>1){
                $this.siblings('.btn-decrease').removeClass('disabled');
            }
        });


        $(document).on('input', 'input[type=number].myog-iac-qty', function () {
            let value = parseInt($(this).val());

            if (isNaN(value) || value < 1) {
                $(this).val(1);
            }
        });
    });
});