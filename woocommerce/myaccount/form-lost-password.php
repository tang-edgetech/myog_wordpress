<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="woocommerce-form woocommerce-ResetPassword lost_reset_password">
	<div class="loading"><span class="loader"></span></div>

	<div class="woocommerce-form-section">
		<div class="woocommerce-form-row form-row form-row-wide">
			<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
		</div>
	</div>

	<div class="woocommerce-form-section woocommerce-form-section-dialog">
		<div class="woocommerce-form-row form-row form-row-wide">
			<div class="woocommerce-status-dialog">
				<div class="woocommerce-status-dialog-close"><i class="fa fa-times"></i></div>
				<div class="woocommerce-status-dialog-message" id="woocommerce-status-dialog-message"></div>
			</div>
		</div>
	</div>

	<div class="woocommerce-form-section">
		<div class="woocommerce-form-row form-row form-row-first">
			<label for="user_login"><?php esc_html_e( 'Email address', 'woocommerce' ); ?></label>
			<input class="woocommerce-Input woocommerce-Input--text input-text input-control" type="text" name="user_login" id="user_login" autocomplete="username" />

			<?php do_action( 'woocommerce_lostpassword_form' ); ?>

			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="button woocommerce-button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><span><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></span></button>

			<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
		</div>
	</div>
</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );
