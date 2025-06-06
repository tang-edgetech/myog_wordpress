<?php
global $countries;
$user_id = get_current_user_id();
$user = get_userdata($user_id);
$current_endpoint = wc_get_account_endpoint_url( 'edit-account' );
$is_edit_account = ( is_wc_endpoint_url( 'edit-account' ) );
$username = $user->user_login;
$pass_length = 12;
$hash_password = str_repeat('*', $pass_length );
$user_additional_info = get_field('user_additional_information', 'user_' . $user_id);

// Standard WooCommerce fields
$first_name = esc_html($user->first_name);
$last_name = esc_html($user->last_name);
$nickname = esc_html($user->nickname);
$email_address = esc_html($user->user_email);

// ACF fields
$gender = ucfirst( isset($user_additional_info['gender']) ? esc_html($user_additional_info['gender']) : '' );
$date_of_birth = isset($user_additional_info['date_of_birth']) ? esc_html($user_additional_info['date_of_birth']) : '';
if( strlen($date_of_birth) > 0 ) {
    $date = DateTime::createFromFormat('d/m/Y', $date_of_birth);
    $default_dob = $date->format('Y-m-d');
}
else {
    $default_dob = '';
}
$dial_code = isset($user_additional_info['dial_code']) ? esc_html($user_additional_info['dial_code']) : '';
$contact_number = isset($user_additional_info['contact_number']) ? esc_html($user_additional_info['contact_number']) : '';
$nric_passport = isset($user_additional_info['nric_passport']) ? esc_html($user_additional_info['nric_passport']) : '';
$nationality = isset($user_additional_info['nationality']) ? esc_html($user_additional_info['nationality']) : '';
$countryName = '';
foreach($countries as $country) {
    if( $country['code'] == $nationality ) {
        $countryName = $country['country'];
        break;
    }
}

$ethnicity = isset($user_additional_info['ethnicity']) ? esc_html($user_additional_info['ethnicity']) : '';
$family_tree = isset($user_additional_info['family_tree']) ? esc_html($user_additional_info['family_tree']) : '(None)';

?>
<form class="woocommerce-form woocommerce-myog-edit-account" id="woocommerce-myog-edit-account" method="post" acction="" data-id="<?php echo $user_id;?>">
    <?php if ( $is_edit_account ) { ?>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide">
                <h5 class="form-heading">Login Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="email">Email Address</label>
                <div class="input-control" disabled><?php echo esc_html( $email_address ); ?></div>
            </div>
            
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="contact_number">Contact Number</label>
                <div class="dial-code-col">
                    <div class="dial-code"><?php echo esc_html( $dial_code );?></div>
                    <div class="input-control" disabled><?php echo esc_html( substr( $contact_number, 2 ) ); ?></div>
                </div>
            </div>

            <div class="woocommerce-form-row form-row form-row-first">
                <label for="password">Password</label>
                <div class="input-control" disabled><?php echo esc_html( $hash_password ); ?></div>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide">
                <h5 class="form-heading">Personal Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="first_name">Full Name</label>
                <input type="text" name="first_name" id="first_name" class="input-control" value="<?php echo esc_html( $first_name ); ?>" />
                <i class="fa fa-pencil position-absolute wp-field-edit-icon" aria-hidden="true"></i>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="nationality">Nationality</label>
                <select name="nationality" id="nationality" class="input-control">
                    <option value="">Select a Country</option>
                    <?php foreach( $countries as $country ) {
                        $selected = ($country['code'] === $nationality) ? 'selected' : '';
                        echo '<option value="'.$country['code'].'"'.$selected.'>'.$country['country'].'</option>';
                    } ?>
                </select>
                <i class="fa fa-pencil position-absolute wp-field-edit-icon" aria-hidden="true"></i>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="nric_passport">NRIC/Passport</label>
                <div name="nric_passport" id="nric_passport" class="input-control"><?php echo esc_html( $nric_passport ); ?></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="input-control" value="<?php echo esc_html( $default_dob ); ?>" />
                <i class="fa fa-pencil position-absolute wp-field-edit-icon" aria-hidden="true"></i>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="input-control">
                    <option value="" <?php if( empty($gender) ) { echo 'selected disabled'; }?>>--Choose--</option>
                    <option value="male" <?php selected( $gender, 'Male' ); ?>>Male</option>
                    <option value="female" <?php selected( $gender, 'Female' ); ?>>Female</option>
                </select>
                <i class="fa fa-pencil position-absolute wp-field-edit-icon" aria-hidden="true"></i>
            </div>
        </div>
    <?php } else { ?>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide">
                <h5 class="form-heading">Login Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label>Email Address</label>
                <div class="input-control" disabled><?php echo esc_html( $email_address ); ?></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label for="contact_number">Contact Number</label>
                <div class="dial-code-col">
                    <div class="dial-code"><?php echo esc_html( $dial_code );?></div>
                    <div class="input-control"><?php echo esc_html( substr( $contact_number, 2 ) ); ?></div>
                </div>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label>Password</label>
                <div class="input-control"><?php echo esc_html( $hash_password ); ?></div>
            </div>
        </div>
        <div class="woocommerce-form-section">
            <div class="woocommerce-form-row form-row form-row-wide">
                <h5 class="form-heading">Personal Details</h5>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label>Full Name</label>
                <div class="input-control"><?php echo esc_html( $first_name ); ?></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label>Nationality</label>
                <div class="input-control"><?php echo esc_html( $countryName );?></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label>NRIC/Passport</label>
                <div class="input-control"><?php echo esc_html( $nric_passport ); ?></div>
           </div>
            <div class="woocommerce-form-row form-row form-row-last">
                <label>Date of Birth</label>
                <div class="input-control"><?php echo esc_html( $date_of_birth ); ?></div>
            </div>
            <div class="woocommerce-form-row form-row form-row-first">
                <label>Gender</label>
                <div class="input-control"><?php echo esc_html( $gender ); ?></div>
            </div>
        </div>
    <?php } ?>

    <?php if ( $is_edit_account ) : ?>
    <div class="woocommerce-form-section">
        <div class="woocommerce-form-row form-row form-row-wide woocommerce-form-submission">
            <input type="hidden" name="user_id" value="<?php echo $user_id;?>"/>
            <button type="submit" class="woocommerce-button button" name="save_account_details" value="<?php esc_html_e( 'Save changes', 'woocommerce' ); ?>"><span><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></span></button>
        </div>
    </div>
    <?php endif; ?>
</form>
