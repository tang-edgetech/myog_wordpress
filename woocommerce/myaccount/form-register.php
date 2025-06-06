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
    <form class="woocommerce-form woocommerce-form-registration" method="post" action="">
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
                <h5 class="form-heading">Login Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" name="email" id="email" class="input-control"/>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="contact_number">Contact Number <span class="required">*</span></label>
                <div class="dial-code-col">
                    <div class="dial-code dial-code-label" data-dial-code="+60">+60</div>
                    <ul class="dial-code-dropdown position-absolute">
                        <li class="code selected" data-dial-code="+60">+60</li>
                        <li class="code" data-dial-code="+65">+65</li>
                    </ul>
                    <input type="hidden" name="dial_code" id="dial_code" class="dial-code-field" value="+60">
                    <input type="tel" name="contact_number" id="contact_number" class="input-control contact-number-field" placeholder="xxx xxxx">
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="new_password">Password <span class="required">*</span></label>
                <div class="password-wrapper position-relative">
                    <input type="password" name="new_password" id="new_password" class="input-control" autocomplete="off"/>
                    <div class="show-password" id="show-password"><i class="fa fa-eye-slash"></i></div>
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="confirm_new_password">Confirm Password <span class="required">*</span></label>
                <div class="password-wrapper position-relative">
                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="input-control" autocomplete="off"/>
                    <div class="show-password" id="show-password"><i class="fa fa-eye-slash"></i></div>
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <div class="divider"></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <h5 class="form-heading">Personal Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="fullname">Name (as per National ID) <span class="required">*</span></label>
                <input type="text" name="fullname" id="fullname" class="input-control"/>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="nationality">Nationality <span class="required">*</span></label>
                <select name="nationality" id="nationality" class="input-control">
                    <option value="">Select a country</option>
                    <?php echo do_shortcode('[generate_country_options]');?>
                </select>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="nric_passport">National ID No. <span class="required">*</span></label>
                <input type="text" name="nric_passport" id="nric_passport" class="input-control"/>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="confirm_nric_passport">Confirm National ID No. <span class="required">*</span></label>
                <input type="text" name="confirm_nric_passport" id="confirm_nric_passport" class="input-control"/>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="dob">Date of Birth <span class="required">*</span></label>
                <input type="date" name="dob" id="dob" class="input-control"/>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="gender">Gender <span class="required">*</span></label>
                <select name="gender" id="gender" class="input-control">
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <div class="divider"></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <h5 class="form-heading">Billing Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="billing_name">Name <span class="required">*</span></label>
                <input type="text" name="billing_name" id="billing_name" class="input-control"/>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="billing_phone">Mobile No. <span class="required">*</span></label>
                <div class="dial-code-col">
                    <div class="dial-code dial-code-label" data-dial-code="+60">+60</div>
                    <ul class="dial-code-dropdown position-absolute">
                        <li class="code selected" data-dial-code="+60">+60</li>
                        <li class="code" data-dial-code="+65">+65</li>
                    </ul>
                    <input type="hidden" name="billing_dial_code" id="billing_dial_code" class="dial-code-field" value="+60">
                    <input type="tel" name="billing_phone" id="billing_phone" class="input-control contact-number-field" placeholder="xxx xxxx">
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="billing_country">Nationality <span class="required">*</span></label>
                <div class="input-control position-relative disabled">
                    <div>Malaysia</div>
                    <input type="hidden" name="billing_country" id="billing_country" value="MY"/>
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="billing_state">State <span class="required">*</span></label>
                <select name="billing_state" id="billing_state" class="input-control">
                    <option value="">Select State</option>
                    <option value="JHR">Johor</option>
                    <option value="KDH">Kedah</option>
                    <option value="KTN">Kelantan</option>
                    <option value="LBN">Labuan</option>
                    <option value="MLK">Malacca (Melaka)</option>
                    <option value="NSN">Negeri Sembilan</option>
                    <option value="PHG">Pahang</option>
                    <option value="PNG">Penang (Pulau Pinang)</option>
                    <option value="PRK">Perak</option>
                    <option value="PLS">Perlis</option>
                    <option value="SBH">Sabah</option>
                    <option value="SWK">Sarawak</option>
                    <option value="SGR">Selangor</option>
                    <option value="TRG">Terengganu</option>
                    <option value="PJY">Putrajaya</option>
                    <option value="KUL">Kuala Lumpur</option>
                </select>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="billing_city">Town / City <span class="required">*</span></label>
                <input type="text" name="billing_city" id="billing_city" class="input-control" />
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="billing_postcode">Postcode / ZIP <span class="required">*</span></label>
                <input type="text" name="billing_postcode" id="billing_postcode" class="input-control" />
            </div>
            <div class="woocommerce-form-row form-row form-row-wide">
                <label for="mailing_address">Mailing Address <span class="required">*</span></label>
                <textarea rows="5" name="mailing_address" id="mailing_address" class="input-control"></textarea>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
                <button type="submit" class="button woocommerce-button" name="woocommerce_registration" id="registration" value="Registration"><span>Register</span></button>
            </div>
        </div>
    </form>
</div>