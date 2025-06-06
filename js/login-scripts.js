( function($) {
    $(document).ready(function() {
        $(document).on('click', '#btn-login', function(){
            $('.myog-login-popup').addClass('active');
            setTimeout(function(){
                $('.myog-login-popup').addClass('show');
                $('html').addClass('modal-open');
            }, 250);
        });

        $(document).on('click', '.myog-login-popup .close', function(){
            $('.myog-login-popup').removeClass('show');
            setTimeout(function(){
                $('.myog-login-popup').addClass('active');
                $('html').removeClass('modal-open');
            }, 250);
        });

        $(document).on('click', '.show-password', function(){
            var $this = $(this),
                $parents = $this.parents('.password-wrapper');
            if( $parents.find('input').attr('type') == 'password' ){
                $this.find('i').toggleClass('fa-eye-slash fa-eye');
                $parents.find('input').attr('type', 'text')
            }
            else if( $parents.find('input').attr('type') == 'text' ){
                $this.find('i').toggleClass('fa-eye fa-eye-slash');
                $parents.find('input').attr('type', 'password')
            }
        });

        $('#myog-login-form').on('submit', function(e){
            e.preventDefault();
            console.log('Submitting...');
            var $this = $(this),
                $loading = $('.myog-login-popup .loading'),
                $username = $this.find('#login-username'),
                $password = $this.find('#login-password'),
                $serialize = $this.serialize();

            $loading.fadeIn();
            // data: 'action=myog_login_validation&nonce='+myog_login.nonce+'&username='+$username+'&password='+$password+'&remember_me='+$remember_me,
            console.log( $this.serialize() );
            $.ajax({
                type: "POST",
                url: myog_login.ajaxurl,
                data: $serialize+'&action=myog_login_validation&nonce='+myog_login.nonce,
                dataType: "json",
                beforeSend: function(){
                    console.log('Sending');
                    $this.find('.form-input').css('border-color','#358C9A');
                    $this.find('.error').fadeOut();
                },
                success: function(response){
                    console.log(response);
                    $loading.fadeOut();
                    if(response.status == 'success'){
                        $this.find('.form-input').css('border-color','#44E076');
                        $('.myog-login-form .form-row.form-fields .form-group').append('<span class="success-tick position-absolute" id="success-tick"><i class="fa fa-check-cricle"></i></span>');
                        $this.addClass('blocking');
                        $('.myog-login-popup .modal-footer').addClass('blocking');
                        $('#error-globe-message').addClass('success');
                        $('#error-globe-message').text('Login successfully! Redirecting...');
                        $('#error-globe-message').fadeIn();
                        setTimeout(function(){
                            window.location.href = myog_login.myaccount_url;
                        }, 500);
                    }
                    else{ // Failed
                        $('#error-globe-message').removeClass('success');
                        if(response.hasOwnProperty('error')){
                            if( response.error.hasOwnProperty('username') ){
                                $('#login-username').css('border-color', '#ff0000');
                                $('#error-login-username').text(response.error.username);
                                $('#error-login-username').fadeIn();
                            }
                            if( response.error.hasOwnProperty('password') ){
                                $('#login-password').css('border-color', '#ff0000');
                                $('#error-login-password').text(response.error.password);
                                $('#error-login-password').fadeIn();
                            }
                        }
                        else{
                            $('#error-globe-message').text(response.message);
                        }
                    }
                },
                error: function(xhr){
                    $loading.fadeOut();
                    console.log('Error');
                    console.log(xhr);
                    $('#error-globe-message').removeClass('success');
                    $('#error-globe-message').text('Something went wrong! Please try again later.');
                    $('#error-globe-message').fadeIn();
                }
            });
        });
    });
})(jQuery);