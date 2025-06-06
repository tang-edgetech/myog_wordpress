jQuery(document).ready(function($) {
    $(document).on('submit', '.woocommerce-form.woocommerce-form-registration', function(e) {
        e.preventDefault();
        var $this = $(this),
            $loading = $this.find('.loading'),
            $dialog_parent = $this.find('.woocommerce-form-section-dialog'),
            $dialog = $this.find('.woocommerce-status-dialog'),
            $dialog_message = $dialog.find('.woocommerce-status-dialog-message'),
            $serialize = $this.serialize(),
            $form_data = $serialize+'&action=wc_myog_registration&nonce='+myog_registration.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_registration.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $dialog_parent.hide();
                $dialog.hide();
                setTimeout(function() {
                    $dialog.removeClass('error success');
                    $dialog_message.html('');
                }, 50);
            },
            beforeSend: function() {
                $this.find('.input-control').removeClass('focus');
                $loading.fadeIn();
                $dialog_parent.hide();
                $dialog.fadeOut();
            },
            success: function($data) {
                $loading.fadeOut();
                var $response = JSON.parse($data);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $dialog.addClass('success');
                    $dialog_message.append('<p>'+$response.message+'</p>');
                    setTimeout(function() {
                        window.location.href = myog_registration.verification_url;
                    }, 150);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $dialog.addClass('error');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        $('html, body').stop().animate({
                            scrollTop: 0
                        });
                        if( $response.error.hasOwnProperty('password') ) {
                            $dialog_message.html('<p>'+$response.error.password+'</p>');
                            if( $this.find('#password')[0] ) {
                                $this.find('#password').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('confirm_password') ) {
                            $dialog_message.html('<p>'+$response.error.confirm_password+'</p>');
                            if( $this.find('#confirm_password')[0] ) {
                                $this.find('#confirm_password').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('fullname') ) {
                            $dialog_message.html('<p>'+$response.error.fullname+'</p>');
                            if( $this.find('#fullname')[0] ) {
                                $this.find('#fullname').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('email') ) {
                            $dialog_message.html('<p>'+$response.error.email+'</p>');
                            if( $this.find('#email')[0] ) {
                                $this.find('#email').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('contact_number') ) {
                            $dialog_message.html('<p>'+$response.error.contact_number+'</p>');
                            if( $this.find('#contact_number')[0] ) {
                                $this.find('#contact_number').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('dob') ) {
                            $dialog_message.html('<p>'+$response.error.dob+'</p>');
                            if( $this.find('#dob')[0] ) {
                                $this.find('#dob').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('gender') ) {
                            $dialog_message.html('<p>'+$response.error.gender+'</p>');
                            if( $this.find('#gender')[0] ) {
                                $this.find('#gender').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('nric_passport') ) {
                            $dialog_message.html('<p>'+$response.error.nric_passport+'</p>');
                            if( $this.find('#nric_passport')[0] ) {
                                $this.find('#nric_passport').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('confirm_nric_passport') ) {
                            $dialog_message.html('<p>'+$response.error.confirm_nric_passport+'</p>');
                            if( $this.find('#confirm_nric_passport')[0] ) {
                                $this.find('#confirm_nric_passport').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('nationality') ) {
                            $dialog_message.html('<p>'+$response.error.nationality+'</p>');
                            if( $this.find('#nationality')[0] ) {
                                $this.find('#nationality').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_name') ) {
                            $dialog_message.html('<p>'+$response.error.billing_name+'</p>');
                            if( $this.find('#billing_name')[0] ) {
                                $this.find('#billing_name').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_contact_number') ) {
                            $dialog_message.html('<p>'+$response.error.billing_contact_number+'</p>');
                            if( $this.find('#billing_phone')[0] ) {
                                $this.find('#billing_phone').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_country') ) {
                            $dialog_message.html('<p>'+$response.error.billing_country+'</p>');
                            if( $this.find('#billing_country')[0] ) {
                                $this.find('#billing_country').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_state') ) {
                            $dialog_message.html('<p>'+$response.error.billing_state+'</p>');
                            if( $this.find('#billing_state')[0] ) {
                                $this.find('#billing_state').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_city') ) {
                            $dialog_message.html('<p>'+$response.error.billing_city+'</p>');
                            if( $this.find('#billing_city')[0] ) {
                                $this.find('#billing_city').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_postcode') ) {
                            $dialog_message.html('<p>'+$response.error.billing_postcode+'</p>');
                            if( $this.find('#billing_postcode')[0] ) {
                                $this.find('#billing_postcode').addClass('focus');
                            }
                        }
                        if( $response.error.hasOwnProperty('billing_address') ) {
                            $dialog_message.html('<p>'+$response.error.billing_address+'</p>');
                            if( $this.find('#mailing_address')[0] ) {
                                $this.find('#mailing_address').addClass('focus');
                            }
                        }
                    }
                }
                else {
                    $dialog.addClass('error');
                    $dialog_message.html('<p>Something wrong happened unexpectedly! Please try again later.</p>');
                }
                setTimeout(function() {
                    $dialog_parent.show();
                    $dialog.fadeIn();
                }, 150);
            },
            error: function(xhr) {
                $loading.fadeOut();
                console.log('Error');
                console.log(xhr);
                $dialog_parent.show();
                $dialog.fadeIn();
                $dialog.addClass('error');
                $dialog_message.text('<p>Something wrong happened unexpectedly! Please try again later.</p>');
            }
        });
    });

});