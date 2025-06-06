// document.addEventListener('DOMContentLoaded', function() {
    jQuery(document).ready(function($) {
        $('form#woocommerce-myog-edit-account').on('submit', function(e) {
            e.preventDefault();
            var $this = $(this),
                $myaccount_modal = $('#modal-myog-account-update-log'),
                $myaccount_modal_body = $myaccount_modal.find('.modal-body'),
                $serialize = $this.serialize(),
                $formData = $serialize+'&action=myog_myaccount_edit_profile&nonce='+myog_myaccount_edit_profile.nonce;
                
            $.ajax({
                type: 'post',
                url: myog_myaccount_edit_profile.ajaxurl,
                data: $formData,
                dataType: 'json',
                beforeSend: function() {
                    $myaccount_modal_body.html('');
                },
                success: function(data) {
                    var $response = data;
                    console.log($response);
                    if( $response.status == 1000 ) {
                        $myaccount_modal_body.append('<h3 class="mb-3">'+$response.message+'</h3>');
                        if( $response.update.hasOwnProperty('fullname') ) {
                            $myaccount_modal_body.append('<p class="mb-0">'+$response.update.fullname+'</p>');
                        }
                        if( $response.update.hasOwnProperty('nationality') ) {
                            $myaccount_modal_body.append('<p class="mb-0">'+$response.update.nationality+'</p>');
                        }
                        if( $response.update.hasOwnProperty('dob') ) {
                            $myaccount_modal_body.append('<p class="mb-0">'+$response.update.dob+'</p>');
                        }
                        if( $response.update.hasOwnProperty('gender') ) {
                            $myaccount_modal_body.append('<p class="mb-0">'+$response.update.gender+'</p>');
                        }
                    }
                    else if( $response.status == 2000 ) {
                        $update = $response.update;
                        if( $update !== null && $update == false ) {
                            $myaccount_modal_body.append('<h3 class="mb-3">'+$response.message+'</h3>');
                        }
                        else {
                            $myaccount_modal_body.append('<h3 class="mb-3">'+$response.message+'</h3>');
                        }
                    }

                    setTimeout(function() {
                        $myaccount_modal.modal('show');
                    }, 250);
                },
                error: function(xhr) {
                    console.log('Error');
                    console.log(xhr);
                }
            });
        });
    });
// });