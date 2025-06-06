<?php
/*
 *
 * Template Name: Change Email
 *
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !is_user_logged_in() ) {
    wp_redirect( home_url() );
}

get_header(); ?>
 
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
 
        <?php
        while( have_posts() ) {
            the_post();
            
            get_template_part('woocommerce/myaccount/template', 'change-email');
        }
        ?>
        </main>
    </div>
<?php
get_footer();
?>