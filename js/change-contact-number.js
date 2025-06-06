jQuery(document).ready(function($) {
    $('.otp-fields .otp-field').on('keyup', function(e) {
        let $input = $(this);
        let inputVal = e.key;

        if (/^[a-zA-Z0-9]$/.test(inputVal)) {
            $input.val(inputVal);
            $input.next('.otp-field').focus();
        }
        else if (e.key === "Backspace") {
            $input.val('');
            $input.prev('.otp-field').focus();
        }
    });
    $(document).on('submit', '.woocommerce-form-change-contact-number', function(e) {
        e.preventDefault();
        var $this = $(this),
            $dialog_parent = $this.find('.woocommerce-form-section-dialog'),
            $dialog = $this.find('.woocommerce-status-dialog'),
            $dialog_message = $dialog.find('.woocommerce-status-dialog-message'),
            $serialize_data = $this.serialize(),
            $form_data = $serialize_data+'&action=wc_myaccount_change_account_mobile&nonce='+myog_change_contact_number.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_change_contact_number.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $dialog_parent.hide();
                $dialog.hide();
                setTimeout(function() {
                    $dialog.removeClass('error success');
                    $dialog_message.html('');
                }, 50);
            },
            success: function($data) {
                var $response = JSON.parse($data);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $dialog.addClass('success');
                    $dialog_message.append('<p>'+$response.message+'</p>');
                    
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $dialog.addClass('error');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        $('html, body').stop().animate({
                            scrollTop: 0
                        });
                        if( $response.error.hasOwnProperty('current_password') ) {
                            $dialog_message.append('<p>'+$response.error.current_password+'</p>');
                        }
                        if( $response.error.hasOwnProperty('new_password') ) {
                            $dialog_message.append('<p>'+$response.error.new_password+'</p>');
                        }
                        if( $response.error.hasOwnProperty('confirm_password') ) {
                            $dialog_message.append('<p>'+$response.error.confirm_password+'</p>');
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
                console.log('Error');
                console.log(xhr);
                $dialog_parent.show();
                $dialog.fadeIn();
                $dialog.addClass('error');
                $dialog_message.html('<p>Something wrong happened unexpectedly! Please try again later.</p>');
            }
        });
    });

    $(document).on('submit', '.woocommerce-otp-change-mobile', function(e) {
        e.preventDefault();
        var $this = $(this),
            $dialog_parent = $this.find('.woocommerce-form-section-dialog'),
            $dialog = $this.find('.woocommerce-status-dialog'),
            $dialog_message = $dialog.find('.woocommerce-status-dialog-message'),
            $serialize_data = $this.serialize(),
            $form_data = $serialize_data+'&action=wc_myaccount_change_account_mobile_otp_verify&nonce='+myog_change_contact_number.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_change_contact_number.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $dialog_parent.hide();
                $dialog.hide();
                setTimeout(function() {
                    $dialog.removeClass('error success');
                    $dialog_message.html('');
                }, 50);
            },
            success: function($data) {
                var $response = JSON.parse($data);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $dialog.addClass('success');
                    $dialog_message.append('<p>'+$response.message+'</p>');
                    
                    var $popup = $response.html;
                    $popup = $popup.replace(/&amp;/g, '&');;
                    $('.woocommerce-account .myog-myaccount-wrapper').append($popup);
                    $('#modal-myog-proceed-logout').modal('show');
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $dialog.addClass('error');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        $('html, body').stop().animate({
                            scrollTop: 0
                        });
                        if( $response.error.hasOwnProperty('current_password') ) {
                            $dialog_message.append('<p>'+$response.error.current_password+'</p>');
                        }
                        if( $response.error.hasOwnProperty('new_password') ) {
                            $dialog_message.append('<p>'+$response.error.new_password+'</p>');
                        }
                        if( $response.error.hasOwnProperty('confirm_password') ) {
                            $dialog_message.append('<p>'+$response.error.confirm_password+'</p>');
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
                console.log('Error');
                console.log(xhr);
                $dialog_parent.show();
                $dialog.fadeIn();
                $dialog.addClass('error');
                $dialog_message.html('<p>Something wrong happened unexpectedly! Please try again later.</p>');
            }
        });
    });
    
    $(document).on('click', '.woocommerce-otp-change-mobile button.request-otp', function(e) {
        e.preventDefault();
        var $this = $(this),
            $user_id = $this.siblings('#user_id').val(),
            $method = $this.siblings('#method').val(),
            $error_log = $this.parents('.woocommerce-otp-change-mobile').find('.error-otp'),
            $security_code = $this.parents('.woocommerce-form').find('#security_code').val(),
            $form_data = 'user_id='+$user_id+'&method='+$method+'&action=wc_myaccount_change_mobile_request_otp&nonce='+myog_change_contact_number.nonce;
        $.ajax({
            type: 'post',
            url: myog_change_contact_number.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $error_log.hide();
                $error_log.removeClass('success failed');
                $error_log.html('');
            },
            success: function($response) {
                $response = $.parseJSON($response);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $error_log.addClass('success');
                    $error_log.html($response.message);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $error_log.addClass('failed');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        $error_log.addClass('failed');
                        $('html, body').stop().animate({
                            scrollTop: 0
                        });
                        if( $response.error.hasOwnProperty('user_id') ) {
                            $error_log.html($response.error.user_id);
                        }
                        if( $response.error.hasOwnProperty('security_code') ) {
                            $error_log.html($response.error.security_code);
                        }
                    }
                }
                $error_log.fadeIn();
            },
            error: function(xhr) {
                console.log(xhr);
                $error_log.addClass('failed');
                $error_log.html('Something went wrong! Please try again later.');
                $error_log.fadeIn();
            }
        });
    });
});