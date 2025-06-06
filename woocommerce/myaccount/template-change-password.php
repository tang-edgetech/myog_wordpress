<?php


?>
<div class="woocommerce woocommerce-account">
    <div class="myog-myaccount-wrapper">
        <?php 
            wc_get_template( 'myaccount/navigation.php' ); 
            wc_get_template( 'myaccount/form-change-password.php' ); 
        ?>
        <?php
        if( is_user_logged_in() ) {
        ?>
            <div class="modal fade modal-myog-logout" id="modal-myog-logout" tabindex="-1" aria-labelledby="modalMyogLogout" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h5 class="mb-0">Are you sure you want to sign out?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-logout-action btn-cancel" id="myog-logout-cancel" data-action="cancel" data-dismiss="modal" aria-label="Close"><span>Cancel</span></button>
                            <button type="button" class="btn btn-logout-action btn-proceed" id="myog-logout-proceed" data-action="proceed" onclick="window.location.href='<?php echo wp_logout_url();?>'"><span>Sure</span></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>