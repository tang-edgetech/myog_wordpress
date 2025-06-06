document.addEventListener('DOMContentLoaded', function() {
    jQuery(document).ready(function($) {
        var currentPath = window.location.pathname;
        var getPath = currentPath.split('/');
        if( getPath[2].length > 0 && getPath[2] == 'change-password' ) {
            $('.woocommerce-MyAccount-navigation ul .woocommerce-MyAccount-navigation-link--'+getPath[2]).addClass('active');
        }
        
        $(document).on('click', '.dial-code-label', function() {
            var $this = $(this),
                $parent = $this.parent(),
                $siblings = $this.siblings('.dial-code-dropdown');
            if( $parent.hasClass('dropdown-opened') ) {
                $parent.removeClass('dropdown-opened');
                $siblings.slideUp();
            }
            else {
                $parent.addClass('dropdown-opened');
                $siblings.slideDown();
            }
        });
        
        $(document).on('click', '.dial-code-dropdown li', function() {
            var $this = $(this),
                $target = $this.attr('data-dial-code'),
                $parent = $this.parent(),
                $tel_field = $parent.siblings('.contact-number-field'),
                $dial_code_field = $parent.siblings('.dial-code-field'),
                $ancestor = $this.parents('.dial-code-col'),
                $siblings = $parent.siblings('.dial-code-label');
            
            $siblings.text($target);
            $siblings.attr('data-dial-code', $target);
            $siblings.data('dial-code', $target);
            $('.dial-code-dropdown li').removeClass('selected');
            $this.addClass('selected');
            $dial_code_field.val($target);
            if( $target == '+65' ) {
                $tel_field.attr('placeholder', 'xxxx xxxx');
            }
            else {
                $tel_field.attr('placeholder', 'xxx xxxx');
            }
            setTimeout(function() {
                $ancestor.removeClass('dropdown-opened');
                $parent.slideUp();
            }, 150);
        });


        $(document).on('click', '.woocommerce-status-dialog-close', function(e) {
            e.preventDefault();
            var $this = $(this),
                $dialog_parent = $this.parents('.woocommerce-form-section-dialog'),
                $parents = $this.parents('.woocommerce-status-dialog');
            $dialog_parent.hide();
            $parents.hide();
            $parents.removeClass('error success');
        });
    });
});