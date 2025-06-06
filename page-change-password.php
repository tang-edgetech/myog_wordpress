<?php
/*
 *
 * Template Name: Change Password
 *
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>
 
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
 
        <?php
        while( have_posts() ) {
            the_post();
            
            get_template_part('woocommerce/myaccount/template', 'change-password');
        }
        ?>
        </main>
    </div>
<?php
get_footer();
?>