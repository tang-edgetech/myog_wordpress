<?php
$user_id = get_current_user_id();
?>
<div class="woocommerce-MyAccount-content">
    <div class="myog-page-title"><h2><?php echo get_the_title();?></h2></div>
    <?php
    if( is_user_logged_in() ) {
    ?>
        <button type="button" class="btn myog-logout-button" data-toggle="modal" data-target="#modal-myog-logout">
            <img src="/wp-content/uploads/2024/09/icon-myog-logout.svg"/>
        </button>
    <?php
    }
    ?>
    <form class="woocommerce-form woocommerce-form-change-password" method="post" action="">
        <div class="loading"><span class="loader"></span></div>
        <div class="woocommerce-form-section woocommerce-form-section-dialog">
            <div class="woocommerce-form-row form-row form-row-wide">
                <div class="woocommerce-status-dialog">
                    <div class="woocommerce-status-dialog-close"><i class="fa fa-times"></i></div>
                    <div class="woocommerce-status-dialog-message" id="woocommerce-status-dialog-message"></div>
                </div>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide">
                <label for="current_password">Current Password</label>
                <div class="password-wrapper position-relative">
                    <input type="password" name="current_password" id="current_password" class="input-control" autocomplete="off">
                    <span class="show-password" id="show-password"><i class="fa fa-eye-slash"></i></span>
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <label for="new_password">New Password</label>
                <div class="password-wrapper position-relative">
                    <input type="password" name="new_password" id="new_password" class="input-control" autocomplete="off">
                    <span class="show-password" id="show-password"><i class="fa fa-eye-slash"></i></span>
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <label for="confirm_password">Confirm Password</label>
                <div class="password-wrapper position-relative">
                    <input type="password" name="confirm_password" id="confirm_password" class="input-control" autocomplete="off">
                    <span class="show-password" id="show-password"><i class="fa fa-eye-slash"></i></span>
                </div>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                <button type="submit" class="button woocommerce-button" name="woocommerce_change_password" id="change_password" value="Change Password" data-value="Change Password"><span>Change Password</span></button>
            </div>
        </div>
    </form>
</div>