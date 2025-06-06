jQuery(document).ready(function($) {
    $(document).on('submit', '.woocommerce-form-change-password', function(e) {
        e.preventDefault();
        var $this = $(this),
            $dialog_parent = $this.find('.woocommerce-form-section-dialog'),
            $dialog = $this.find('.woocommerce-status-dialog'),
            $dialog_message = $dialog.find('.woocommerce-status-dialog-message'),
            $serialize_data = $this.serialize(),
            $form_data = $serialize_data+'&action=wc_myaccount_change_password&nonce='+myog_change_password.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_change_password.ajaxurl,
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
                    
                    $('.woocommerce-account .myog-myaccount-wrapper').append($response.html);
                    $('#modal-myog-proceed-logout #myog-logout-proceed').attr("onclick", "window.location.href='"+myog_change_password.home_url+"'");
                    setTimeout(function(){
                        $('#modal-myog-proceed-logout').modal('show');
                        var $i = 5;
                        var $countDown = setInterval(function() {
                            $('#modal-myog-proceed-logout #myog-logout-proceed').find('span').text('PROCEED ('+$i+')');
                            $i--;

                            if( $i < 0 ) {
                                clearInterval($countDown);
                                window.location.href = myog_change_password.home_url;
                            }
                        }, 1000);
                    }, 250);
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
                    $dialog_message.append('<p>Something wrong happened unexpectedly! Please try again later.</p>');
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
                $dialog_message.text('<p>Something wrong happened unexpectedly! Please try again later.</p>');
            }
        });
    });
});