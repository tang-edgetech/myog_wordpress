document.addEventListener("DOMContentLoaded", function() {
	$(document).ready(function() {
        $product_unique_id = singleProductData.product_unique_id;
        if( $product_unique_id !== null || $product_unique_id !== '' ) {
            $.ajax({
                type: 'post',
                url: singleProductData.ajax_url,
                data: {
                    action: 'myog_single_product_insight',
                    product_unique_id: $product_unique_id
                },
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    var $response = JSON.parse(data);
                    console.log($response.status, $response.message);
                    if( $response.status == 1000 ) {
                        console.log($response.html);
                    }
                    else if( $response.status == 2000 ) {
                        console.log('Failed retrieving data!');
                    }
                    else {
                        console.log('Other error!');
                    }
                },
                error: function(xhr) {
                    console.log('Error');
                    console.log(xhr);
                }
            });
        }
    });
});