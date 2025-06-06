jQuery(document).ready(function($) {
    $(document).on('submit', '.woocommerce-form.woocommerce-ResetPassword', function(e) {
        e.preventDefault();
        var $this = $(this),
            $dialog_parent = $this.find('.woocommerce-form-section-dialog'),
            $dialog = $this.find('.woocommerce-status-dialog'),
            $dialog_message = $dialog.find('.woocommerce-status-dialog-message'),
            $serialize = $this.serialize(),
            $form_data = $serialize+'&action=wc_myog_registration&nonce='+myog_lost_password.nonce;
        
        $.ajax({
            type: 'post',
            url: myog_lost_password.ajaxurl,
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
                    
                }
                else if( $response.status == 2000 || $response.status == '2000' ) {
                    $dialog.addClass('error');
                    if( $response.hasOwnProperty('error') && $response.error ) {
                        if( $response.error.hasOwnProperty('user_login') ) {
                            $dialog_message.append('<p>'+$response.error.email+'</p>');
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