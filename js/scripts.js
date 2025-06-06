jQuery(document).ready(function($){
    if( $('button.btn-add-to-cart.disabled')[0] ) {
        setTimeout(function() {
            $('button.btn-add-to-cart.disabled').removeClass('disabled');
        }, 300);
    }

    $(document).on('click', '#btn-account', function() {
        var $this = $(this),
            $parent = $this.parent(),
            $siblings = $this.siblings('.myaccount-submenu');
        if( $parent.hasClass('submenu-opened') ) {
            $parent.removeClass('submenu-opened');
            $siblings.slideUp();
        }
        else {
            $parent.addClass('submenu-opened');
            $siblings.slideDown();
        }
    });

    $(document).on('click', '#show-password', function(e) {
        e.preventDefault();
        var $this = $(this),
            $parents = $this.parent(),
            $input = $this.siblings('input'),
            $icon = $this.find('i');

        if( $parents.hasClass('showed') ) {
            $parents.removeClass('showed');
            setTimeout(function() {
                $input.attr('type', 'password');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }, 50);
        }
        else {
            $parents.addClass('showed');
            setTimeout(function() {
                $input.attr('type', 'text');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }, 50);
        }
    });

    $('.myog-dropdown').each(function() {
        var $dropdown = $(this), 
            $label = $dropdown.find('.myog-dropdown-label'),
            $item = $dropdown.find('.myog-dropdown-item'),
            $dropdown_list = $dropdown.find('.myog-dropdown-list'),
            $genderField = $dropdown.find('#gender');
        if( $dropdown.hasClass('dropdown-gender') ){
            $label.on('click', function() {
                var $this = $(this);
                if( $dropdown.hasClass('dropdown-opened') ) {
                    $dropdown.removeClass('dropdown-opened');
                    $dropdown_list.slideUp();
                }
                else {
                    $dropdown.addClass('dropdown-opened');
                    $dropdown_list.slideDown();
                }
            });

            $item.on('click', function() {
                var $this = $(this),
                    $gender = $this.attr('data-gender'),
                    $genderField = $('.woocommerce-form #gender');
                if( $dropdown.hasClass('dropdown-opened') ) {
                    $dropdown.removeClass('dropdown-opened');
                    $dropdown_list.slideUp();
                }
                
                $('.myog-dropdown.dropdown-gender .myog-dropdown-item').removeClass('active');
                $label.attr('data-gender', $gender);
                $label.text($gender);
                $this.addClass('active');
                $genderField.val($gender);
            });
        }
    });

    $(document).on('click', '#add-to-cart-popup .modal-close', function(e) {
        e.preventDefault();
        $('#add-to-cart-popup').modal('hide');
        setTimeout(function() {
            $('#add-to-cart-popup').remove();
        }, 300);
    });

    $(document).on('click', 'button#add-to-cart', function(e) {
        e.preventDefault();
        var $this = $(this),
            $prod_id = $this.attr('data-product-id'),
            $prod_amount = 1;
        if( $('.myog-iac-quantity .myog-iac-qty')[0] ) {
            $prod_amount = $('.myog-iac-quantity .myog-iac-qty').val();
        }

        $.ajax({
            type: 'POST',
            url: myog.ajaxurl,
            data: {
                action: 'myog_add_to_cart',
                nonce: myog.add_to_cart,
                prod_id: $prod_id,
                prod_amount: $prod_amount,
            },
            beforeSend: function() {
                $this.addClass('disabled');
            },
            success: function(data) {
                var $response = JSON.parse(data);
                $this.removeClass('disabled');
                if( $response.status == 1000 || $response.status == 2000 ) {
                    $('body').append($response.popup);
                    $('#masthead #cart-counter').html($response.cart_quantity);
                }
                else {
                    $('body').append(myog.popup_error);
                }

                $('#add-to-cart-popup').modal({
                    backdrop: 'static',
                    keyboard: false,
                });
                setTimeout(function() {
                    $('#add-to-cart-popup').modal('show');
                }, 150);
            },
            error: function(xhr) {
                $this.removeClass('disabled');
                console.log('Error');
                console.log(xhr);
            },
        });
    });

    $(document).on('click', '.woocommerce-form-row input + i', function(e) {
        var $this = $(this),
            $input_date = $this.siblings('input');
        $input_date.focus();
    });

    $(document).on('click', '.woocommerce-form-row select + i', function(e) {
        var $this = $(this);
        const selectElement = $this.prev('select')[0];
        console.log('Clicked select');
        if (selectElement) {
            console.log('Ada');
            selectElement.style.borderColor = 'green';
            selectElement.dispatchEvent(new MouseEvent('mousedown', {
                bubbles: true,
                cancelable: true,
                view: window
            }));
            selectElement.focus();
            selectElement.dispatchEvent(new KeyboardEvent('keydown', { key: 'ArrowDown' }));
            selectElement.dispatchEvent(new KeyboardEvent('keydown', { key: 'ArrowDown' }));
        }
    });
});