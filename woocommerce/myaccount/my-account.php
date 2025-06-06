<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

global $wp;
$user_id = get_current_user_id();
$uai = get_field('verification', 'user_'.$user_id);
// $status = $uai['verification_status'];
if( !is_user_logged_in()  && !is_wc_endpoint_url('lost-password') ) {
    wp_redirect( home_url() );
}

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
if( !is_wc_endpoint_url('lost-password') || !is_page('verification') ) {
    do_action( 'woocommerce_account_navigation' ); 
} ?>

<div class="woocommerce-MyAccount-content">
    <?php
    $page_title = get_the_title();
    $address_type = isset($wp->query_vars['edit-address']) ? $wp->query_vars['edit-address'] : '';
    if( is_wc_endpoint_url('edit-address') ) {
        $page_title_class = ' page-edit-address';
        $address_type = isset($wp->query_vars['edit-address']) ? $wp->query_vars['edit-address'] : '';

        if ($address_type === 'billing' || $address_type === 'shipping') {
            $return_html = '<a href="' . esc_url(wc_get_endpoint_url('edit-address')) . '" class="d-flex align-items-center return-button text-decoration-none mb-0"><i class="fa fa-chevron-left mr-2" aria-hidden="true"></i>Return</a>';
        }
    }
    echo '<div class="myog-page-title'.$page_title_class.'"><h2>';
    if( is_account_page() ) {
        if ( is_wc_endpoint_url( 'my-account' ) || is_wc_endpoint_url( 'dashboard' ) || is_wc_endpoint_url( 'edit-account' ) ) {
            echo 'My Profile';
        }
        else {
            echo $page_title;
        }
    }
    else {
        echo $page_title;
    }
    echo '</h2>'.$return_html.'</div>';
    
    if( is_user_logged_in() ) {
        if ( !is_page('verification') ) {
    ?>
        <button type="button" class="btn myog-logout-button" data-toggle="modal" data-target="#modal-myog-logout">
            <img src="/wp-content/uploads/2024/09/icon-myog-logout.svg"/>
        </button>
    <?php
        }
    }
    ?>
	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
// 		    do_action( 'woocommerce_account_content' );


    if( is_wc_endpoint_url( 'edit-account') && !is_wc_endpoint_url('lost-password') ) {
        get_template_part('woocommerce/myaccount/form', 'user-profile');
    }
    else if( is_wc_endpoint_url('lost-password') ) {
        get_template_part('woocommerce/myaccount/form', 'lost-password');
    }
    else {
        do_action( 'woocommerce_account_content' );
    }
	?>
</div>
