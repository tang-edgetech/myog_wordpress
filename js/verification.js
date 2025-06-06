jQuery(document).ready(function($) {
    var $now = new Date();

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

    $(document).on('submit', '.woocommerce-form.woocommerce-request-otp', function(e) {
        e.preventDefault();
        var $this = $(this),
            $serialize = $this.serialize(),
            $timestamp = Math.floor(new Date().getTime() / 1000),
            $method = $this.siblings('#method'),
            $method_text = 'otp',
            $error_log = $this.find('.error-otp'),
            $submit_button = $this.find('button[type="submit"]'),
            $form_data = $serialize+'&timestamp='+$timestamp+'&action=wc_myog_verification_request_otp&nonce='+myog_verification.nonce;
        if( $method == 'email' ) { $method_text == 'securrity'; }

        $.ajax({
            type: 'post',
            url: myog_verification.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $error_log.removeClass('failed success');
                $error_log.html('');
                $this.addClass('disabled');
                $submit_button.prop('disabled', true);
            },
            success: function($data) {
                var $response = JSON.parse($data);
                console.log($response);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $error_log.html('Request a new '+$method_text+' code in (<span id="counter">5</span>s).');
                    var counter = 5;
                    var $cooldown = setInterval(function() {
                        counter--;
                        $this.find('#counter').text(counter);
                        if( counter == 0 ) {
                            clearInterval($cooldown);
                        }
                    }, 1000);
                    setTimeout(function() {
                        $this.removeClass('disabled');
                    }, 6000);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    // $dialog.addClass('error');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        if( $response.error.hasOwnProperty('otp') ) {
                            $error_log.addClass('failed');
                            $error_log.html($response.error.otp);
                        }
                    }
                    $this.removeClass('disabled');
                    $submit_button.prop('disabled', false);
                }
            },
            error: function(xhr) {
                console.log('Error, unable to proceed ajax submission');
                console.log(xhr);
                $submit_button.prop('disabled', false);
            }
        });
    });

    $(document).on('submit', '.woocommerce-form.woocommerce-verify-otp', function(e) {
        e.preventDefault();
        var $this = $(this),
            $serialize = $this.serialize(),
            $timestamp = Math.floor(new Date().getTime() / 1000),
            $error_log = $this.find('.error-otp'),
            $submit_button = $this.find('button[type="submit"]'),
            $form_data = $serialize+'&timestamp='+$timestamp+'&action=wc_myog_user_account_verification&nonce='+myog_verification.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_verification.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $error_log.hide();
                $error_log.removeClass('success failed');
                $submit_button.prop('disabled', true);
            },
            success: function($data) {
                var $response = JSON.parse($data);
                console.log($response);
                $error_log.html($response.message);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $error_log.addClass('success');
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $error_log.addClass('failed');
                    $submit_button.prop('disabled', false);
                }
                else {
                    $error_log.addClass('failed');
                    $submit_button.prop('disabled', false);
                }
                $error_log.fadeIn();
            },
            error: function(xhr) {
                $error_log.addClass('failed');
                $error_log.html('Something wrong happened! Please try again later.');
                $error_log.fadeIn();
            }
        });
    });

    $(document).on('submit', '.woocommerce-form.woocommerce-verification-method', function(e) {
        e.preventDefault();
        var $this = $(this),
            $serialize = $this.serialize(),
            $error_log = $this.siblings('.error-otp'),
            $submit_button = $this.find('button[type="submit"]'),
            $timestamp = Math.floor(new Date().getTime() / 1000),
            $form_data = $serialize+'&timestamp='+$timestamp+'&action=wc_myog_select_verification_method&nonce='+myog_verification.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_verification.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $error_log.removeClass('failed success');
                $error_log.hide();
                $submit_button.prop('disabled', true);
            },
            success: function($data) {
                var $response = JSON.parse($data);
                console.log($data);
                console.log($response);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    $error_log.addClass('success');
                    $error_log.html($response.message);
                    $error_log.fadeIn();
                    setTimeout(function() { 
                        location.reload();
                    }, 1000);
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        if( $response.error.hasOwnProperty('method') ) {
                            $error_log.addClass('failed');
                            $error_log.html($response.error.method);
                            $error_log.fadeIn();
                        }
                    }
                    $submit_button.prop('disabled', false);
                }
            },
            error: function(xhr) {
                $error_log.addClass('failed');
                $error_log.html('Something went wrong unexpectedly! Please try again later.');
                $error_log.fadeIn();
                $submit_button.prop('disabled', false);
            }
        });
    });

    $(document).on('submit', '.woocommerce-form.woocommerce-reset-verification-method', function(e) {
        e.preventDefault();
        var $this = $(this),
            $serialize = $this.serialize(),
            $form_data = $serialize+'&action=wc_myog_reset_verification_method&nonce='+myog_verification.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_verification.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                console.log('Form Data ->', $form_data);
            },
            success: function($data) {
                var $response = JSON.parse($data);
                console.log($response);
                if( $response.status == 1000 || $response.status == '1000' ) {
                    location.reload();
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        if( $response.error.hasOwnProperty('reset') ) {
                            console.log($response.error.reset);
                        }
                    }
                }
            },
            error: function(xhr) {
                console.log('Error, unable to proceed ajax submission');
                console.log(xhr);
            }
        });
    });

    $(document).on('click', '.woocommerce-form.woocommerce-verify-otp button.request-otp', function(e) {
        var $this = $(this),
            $user_id = $this.siblings('#user_id').val(),
            $timestamp = Math.floor(new Date().getTime() / 1000),
            $method = $this.siblings('#method').val(),
            $method_text = 'otp',
            $error_log = $this.parents('.woocommerce-form.woocommerce-verify-otp').find('.error-otp'),
            $form_data = 'user_id='+$user_id+'&timestamp='+$timestamp+'&method='+$method+'&action=wc_myog_verification_request_otp&nonce='+myog_verification.nonce;
        if( $method == 'email' ) { $method_text = 'security'; }
        $.ajax({
            type: 'post',
            url: myog_verification.ajaxurl,
            data: $form_data,
            beforeSend: function() {
                $error_log.removeClass('failed success');
                $error_log.html('');
                $this.addClass('disabled');
            },
            success: function($data) {
                var $response = JSON.parse($data);
                $this.html('Request a new '+$method_text+' code in (<span id="counter">60</span>s).');
                var counter = 60;
                var countdown = setInterval(function() {
                    counter--;
                    $this.find('#counter').text(counter);
            
                    if (counter <= 0) {
                        clearInterval(countdown);
                    }
                }, 1000);
                setTimeout(function() {
                    $this.html('Request a new '+$method_text+' code.');
                    $this.removeClass('disabled');
                }, 61000);

                if( $response.status == 1000 || $response.status == '1000' ) {
                    $error_log.hide();
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        if( $response.error.hasOwnProperty('otp') ) {
                            $error_log.addClass('failed');
                            $error_log.html($response.error.otp);
                        }
                    }
                }
                $error_log.fadeIn();
            },
            error: function(xhr) {
                console.log('Error, unable to proceed ajax submission');
                console.log(xhr);
            }
        });
    });
});