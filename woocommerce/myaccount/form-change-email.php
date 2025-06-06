<?php
$user_id = get_current_user_id();
$user = get_userdata($user_id);
$user_email = $user->user_email;
$reset = get_field('reset_field', 'user_'.$user_id);
$otp_status = $reset['otp_email_status'];
$otp_request_time = $reset['otp_email_request_time'];
$current_timestamp = current_time('timestamp');
$time_diff = '';
if( !empty($otp_request_time) ) {
    $time_diff = $current_timestamp - $otp_request_time;
    if( $time_diff > 300 ) {
        update_field('reset_field_otp_email', '', 'user_'.$user_id);
        update_field('reset_field_otp_email_status', '', 'user_'.$user_id);
        update_field('reset_field_otp_email_request_time', '', 'user_'.$user_id);
        update_field('reset_field_otp_email_request_count', '0', 'user_'.$user_id);
        update_field('reset_field_temp_email', '', 'user_'.$user_id);

        echo '<script type="text/javascript">location.reload();</script>';
    }
}

$temp_email = $reset['temp_email'];
?>
<div class="woocommerce-MyAccount-content" data-timestamp="<?php echo $current_timestamp;?>" data-time-diff="<?php echo $time_diff;?>">
    <div class="myog-page-title"><h2><?php echo get_the_title();?></h2></div>
    <?php
    if( is_user_logged_in() ) {
    ?>
        <button type="button" class="btn myog-logout-button" data-toggle="modal" data-target="#modal-myog-logout">
            <img src="/wp-content/uploads/2024/09/icon-myog-logout.svg"/>
        </button>
    <?php
    }

    if( empty($otp_status) || $otp_status == 'Completed' ) {
    ?>
        <form class="woocommerce-form woocommerce-form-change-email" method="post" action="">
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
                    <label>Current Email Address</label>
                    <div class="input-control" disabled><?php echo $user_email;?></div>
                </div>
                <div class="woocommerce-form-row form-row form-row-wide">
                    <label for="new_email">New Email Address</label>
                    <input type="email" name="new_email" id="new_email" class="input-control" autocomplete="off">
                    <div class="error error-otp text-left"></div>
                </div>
            </div>
            <div class="woocommerce-form-section">
                <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                    <button type="submit" class="button woocommerce-button" name="woocommerce_change_email" id="change_email" value="Change Email" data-value="Change Email"><span>Change Email</span></button>
                </div>
            </div>
        </form>
    <?php
    }
    else if( $otp_status == 'Requesting' ) {
    ?>
    <form class="woocommerce-form woocommerce-account-change-email" id="woocommerce-account-change-email" action="" method="post">
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
                <div class="woocommerce-form-dialog text-center">
                    <p><strong>Email OTP</strong></p>
                    <p>The security code has been sent to <?php echo $temp_email;?></p>
                </div>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide">
                <input type="text" name="security_code" id="security_code" class="input-control"/>
                <div class="error error-otp"></div>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                <button type="button" class="request-otp p-0 m-0" data-request-type="email">Request a new Security Code</button>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                <input type="hidden" name="method" id="method" value="email"/>
                <button type="submit" class="button woocommerce-button" name="change_account_email" id="change_account_email" value="Change Email" data-value="Change Email"><span>Change</span></button>
            </div>
        </div>
    </form>
    <?php
    }
    ?>
</div>