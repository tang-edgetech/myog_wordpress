<?php
$user_id = get_current_user_id();
$user = get_userdata($user_id);
$user_login = $user->user_login;
$user_email = $user->user_email;
$count_number = strlen($user_login);
$censored_mobile = str_repeat('*', $count_number - 4 ) . substr($user_login, -4);
$reset = get_field('reset_field', 'user_'.$user_id);
$otp_code = $reset['otp_mobile'];
$otp_status = $reset['otp_mobile_status'];
$otp_request_time = $reset['otp_mobile_request_time'];
$current_timestamp = current_time('timestamp');
$time_diff = '';
if( !empty($otp_request_time) ) {
    $time_diff = $current_timestamp - $otp_request_time;
    if( $time_diff > 300 ) {
        update_field('reset_field_otp_mobile', '', 'user_'.$user_id);
        update_field('reset_field_otp_mobile_status', '', 'user_'.$user_id);
        update_field('reset_field_otp_mobile_request_time', '', 'user_'.$user_id);
        update_field('reset_field_otp_mobile_request_count', '0', 'user_'.$user_id);
        update_field('reset_field_temp_mobile', '', 'user_'.$user_id);

        echo '<script type="text/javascript">location.reload();</script>';
    }
}

$temp_mobile = $reset['temp_mobile'];
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
        <form class="woocommerce-form woocommerce-form-change-contact-number" method="post" action="">
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
                    <label for="current_contact_number">Current Contact Number</label>
                    <div class="input-control" disabled><?php echo $user_login;?></div>
                </div>
                <div class="woocommerce-form-row form-row form-row-wide">
                    <label for="new_contact_number">New Contact Number</label>
                    <div class="dial-code-col">
                        <div class="dial-code dial-code-label" data-dial-code="+60">+60</div>
                        <ul class="dial-code-dropdown position-absolute">
                            <li class="code selected" data-dial-code="+60">+60</li>
                            <li class="code" data-dial-code="+65">+65</li>
                        </ul>
                        <input type="hidden" name="dial_code" id="dial_code" value="+60"/>
                        <input type="tel" name="new_contact_number" id="new_contact_number" class="input-control" />
                    </div>
                </div>
            </div>
            <div class="woocommerce-form-section">
                <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                    <button type="submit" class="button woocommerce-button" name="woocommerce_change_contact_number" id="change_contact_number" value="Change Contact Number" data-value="Change Contact Number"><span>Change Contact Number</span></button>
                </div>
            </div>
        </form>
    <?php
    }
    else if( $otp_status == 'Requesting' ) {
    ?>
    <div class="woocommerce-form-otp-mobile">
        <form class="woocommerce-form woocommerce-verify-otp woocommerce-otp-change-mobile" id="woocommerce-otp-change-mobile" action="" method="post">
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
                        <p><strong>Mobile Number OTP</strong></p>
                        <p>The 6-digits verification code has been sent to mobile number <?php echo $censored_mobile;?></p>
                    </div>
                </div>
            </div>
            <div class="woocommerce-form-section">
                <div class="woocommerce-form-row form-row form-row-wide">
                    <div class="otp-fields">
                        <input type="text" name="otp_input_1" id="otp_input_1" class="input-control otp-field otp_input_1" maxlength="1" />
                        <input type="text" name="otp_input_2" id="otp_input_2" class="input-control otp-field otp_input_2" maxlength="1" />
                        <input type="text" name="otp_input_3" id="otp_input_3" class="input-control otp-field otp_input_3" maxlength="1" />
                        <input type="text" name="otp_input_4" id="otp_input_4" class="input-control otp-field otp_input_4" maxlength="1" />
                        <input type="text" name="otp_input_5" id="otp_input_5" class="input-control otp-field otp_input_5" maxlength="1" />
                        <input type="text" name="otp_input_6" id="otp_input_6" class="input-control otp-field otp_input_6" maxlength="1" />
                    </div>
                    <div class="error error-otp"></div>
                </div>
            </div>
            <div class="woocommerce-form-section">
                <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                    <button type="button" class="request-otp p-0 m-0" data-request-type="mobile">Request a new Security Code</button>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                    <input type="hidden" name="method" id="method" value="mobile"/>
                    <button type="submit" class="button woocommerce-button" name="woocommerce_otp_verify" id="request_otp_verify" value="Verify" data-value="Verify"><span>Verify</span></button>
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    ?>
</div>