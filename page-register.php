<?php
/*
 *
 * Template Name: Register
 *
*/
if( is_user_logged_in()  ) {
    wp_redirect( home_url().'/my-account' );
}

get_header(); ?>
 
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
 
        <?php
        while( have_posts() ) {
            the_post();
            
            get_template_part('woocommerce/myaccount/template', 'register');
        }
        ?>
        </main>
    </div>
<?php
get_footer();
?>