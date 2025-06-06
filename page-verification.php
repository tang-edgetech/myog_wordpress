<?php
/*
 *
 * Template Name: Verification
 *
*/

if( !is_user_logged_in() ) {
    wp_redirect( home_url() );
}
else {
    $user_id = get_current_user_id();
    $verify = get_field('verification', 'user_'.$user_id);
    $verification_status = $verify['verification_status'];
    if( $verification_status == 'Verified' ) {
        wp_redirect( home_url().'/my-account' );
    }
    else {
        $otp_status = $verify['otp_status'];
        if( $otp_status == 'Verified' ) {
            update_field('verification', array( 'verification_status' => 'Verified' ), 'user_'.$user_id);
            wp_redirect( home_url().'/my-account' );
        }
    }
}

get_header(); ?>
 
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
 
        <?php
        while( have_posts() ) {
            the_post();
            
            get_template_part('woocommerce/myaccount/template', 'customer-verification');
        }
        ?>
        </main>
    </div>
<?php
get_footer();
?>