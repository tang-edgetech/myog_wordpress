jQuery(document).ready(function($) {
    $(document).on('submit', '.woocommerce-form-change-email', function(e) {
        e.preventDefault();
        var $this = $(this),
            $serialize_data = $this.serialize(),
            $timestamp = Math.floor(new Date().getTime() / 1000),
            $error_log = $this.find('.error-otp'),
            $form_data = $serialize_data+'&action=wc_myaccount_change_email&nonce='+myog_change_email.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_change_email.ajaxurl,
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
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $error_log.addClass('failed');
                    // $error_log.html($response.message);
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        $error_log.addClass('failed');
                        $('html, body').stop().animate({
                            scrollTop: 0
                        });
                        if( $response.error.hasOwnProperty('user_id') ) {
                            $error_log.html($response.error.user_id);
                        }
                        if( $response.error.hasOwnProperty('email') ) {
                            $error_log.html($response.error.email);
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

    $(document).on('submit', '.woocommerce-form.woocommerce-account-change-email', function(e) {
        e.preventDefault();
        var $this = $(this),
            $error_log = $this.find('.error-otp'),
            $serialize_data = $this.serialize(),
            $form_data = $serialize_data+'&action=wc_myaccount_change_email_verify_otp&nonce='+myog_change_email.nonce;
        $.ajax({
            type: 'post',
            url: myog_change_email.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $error_log.hide();
                $error_log.removeClass('success failed');
                $error_log.html('');
            },
            success: function($response) {
                $response = $.parseJSON($response);
                console.log($response);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $error_log.addClass('success');
                    $error_log.html($response.message);
                    $error_log.fadeIn();
                    // var $logout = decodeURIComponent($response.logout_url)
                    // $logout = $logout.replace(/&amp;/g, '&');
                    // setTimeout(function() {
                    //     window.location.href = $logout;
                    // }, 1000);
                    var $popup = $response.html;
                    $popup = $popup.replace(/&amp;/g, '&');;
                    $('.woocommerce-account .myog-myaccount-wrapper').append($popup);
                    $('#modal-myog-proceed-logout').modal('show');
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $error_log.addClass('failed');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        if( $response.error.hasOwnProperty('security_code') ) {
                            $error_log.html($response.error.security_code);
                        }
                        if( $response.error.hasOwnProperty('email') ) {
                            $error_log.html($response.error.email);
                        }
                    }
                    $error_log.fadeIn();
                }
                else {
                    $error_log.addClass('failed');
                    $error_log.html('Something went wrong! Please try again later.');
                    $error_log.fadeIn();
                }
            },
            error: function(xhr) {
                console.log(xhr);
                $error_log.addClass('failed');
                $error_log.html('Something went wrong! Please try again later.');
                $error_log.fadeIn();
            }
        });
    });

    $(document).on('click', '.woocommerce-account-change-email button.request-otp', function(e) {
        e.preventDefault();
        var $this = $(this),
            $user_id = $this.siblings('#user_id').val(),
            $method = $this.siblings('#method').val(),
            $error_log = $this.parents('.woocommerce-account-change-email').find('.error-otp'),
            $security_code = $this.parents('.woocommerce-form').find('#security_code').val(),
            $form_data = 'user_id='+$user_id+'&method='+$method+'&action=wc_myaccount_change_email_request_otp&nonce='+myog_change_email.nonce;
        $.ajax({
            type: 'post',
            url: myog_change_email.ajaxurl,
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