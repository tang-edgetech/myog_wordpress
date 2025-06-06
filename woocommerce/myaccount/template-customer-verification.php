<?php
$user_id = get_current_user_id();
$user = get_userdata($user_id);
$uai = get_field('user_additional_information', 'user_'.$user_id);
$verify = get_field('verification', 'user_'.$user_id);
$email = $user->user_email;
$censored_email = $email;
$contact_number = $uai['contact_number'];
$count_number = strlen($contact_number);
$censored_mobile = str_repeat('*', $count_number - 4 ) . substr($contact_number, -4);
$verification_status = $verify['verification_status'];
$verification_method = $verify['verification_method'];
$otp_status = $verify['otp_status'];
?>
<div class="woocommerce woocommerce-account woocommerce-account-verification">
    <div class="myog-myaccount-wrapper d-flex justify-content-center">
        <div class="woocommerce-MyAccount-content">
            <div class="myog-page-title mb-4">
                <h2 class="mb-4"><?php echo get_the_title();?></h2>
                <div class="divider my-0"></div>
            </div>
            <div class="woocommerce-otp-forms">
                <?php if( $otp_status == 'Pending' || $otp_status == '' ) { ?>
                <div class="woocommerce-verification-methods">
                    <form class="woocommerce-form woocommerce-verification-method" id="woocommerce-verification-method">
                        <div class="woocommerce-form-section">
                            <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                                <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
                                <input type="hidden" name="method" value="mobile"/>
                                <button type="submit" class="button woocommerce-button">
                                    <span>Verify via Mobile Number</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <form class="woocommerce-form woocommerce-verification-method" id="woocommerce-verification-method">
                        <div class="woocommerce-form-section">
                            <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                                <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
                                <input type="hidden" name="method" value="email"/>
                                <button type="submit" class="button woocommerce-button">
                                    <span>Verify via Email Address</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="error error-otp error-otp-verification"></div>
                </div>
                <?php } elseif( $otp_status == 'Requesting' ) { ?>
                    <?php if( strtolower($verification_method) == 'mobile' ): ?>
                    <div class="woocommerce-form-otp-mobile">
                        <form class="woocommerce-form woocommerce-verify-otp woocommerce-otp-mobile-verification" id="woocommerce-otp-mobile-verification" action="" method="post">
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
                                    <button type="button" class="request-otp p-0 m-0" data-request-type="email">Request a new Security Code</button>
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                                    <input type="hidden" name="method" id="method" value="mobile"/>
                                    <button type="submit" class="button woocommerce-button" name="woocommerce_otp_verify" id="request_otp_verify" value="Verify" data-value="Verify"><span>Verify</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php elseif( strtolower($verification_method) == 'email' ): ?>
                    <div class="woocommerce-form-otp-email">
                        <form class="woocommerce-form woocommerce-verify-otp woocommerce-otp-email-verification" id="woocommerce-otp-email-verification" action="" method="post">
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
                                        <p>The security code has been sent to <?php echo $censored_email;?></p>
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
                                    <button type="submit" class="button woocommerce-button" name="woocommerce_otp_verify" id="request_otp_verify" value="Verify" data-value="Verify"><span>Verify</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                    <div class="woocommerce-form-verification-method-reset">
                        <form class="woocommerce-form woocommerce-reset-verification-method" id="woocommerce-reset-verification-method">
                            <div class="woocommerce-form-section">
                                <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>"/>
                                    <p class="text-center">Click <button type="submit" class="button-text d-inline-block w-auto p-0 m-0" name="woocommerce_reset_verification_method" id="woocommerce_reset_verification_method" value="Reset" data-value="Reset"><span>here</span></button> to change different verification method.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>