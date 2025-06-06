<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
get_header(); 
$blog_url = home_url()."/blog/";
$category_list = array(
    'all' => array(
        'All', $blog_url
    )
);
$taxonomy = 'blog-category';
$cats = array(
    'taxonomy'      => $taxonomy,
    'hide_empty'    => true,
);
$categories = get_terms($cats);
if (!empty($categories)) {
    foreach ($categories as $category) {
        $category_permalink = get_term_link($category, $taxonomy);
        $category_list[$category->slug] = array(
            esc_html($category->name),
            esc_url($category_permalink),
        );
    }
}
$get_post_type = get_post_type();
$get_taxonomy = get_queried_object()->slug;
?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section class="section section-blog-list" id="section-blog-list">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12">
                        <?php
                        ?>
                            <div class="myog-blog-wrapper">
                                <div class="myog-blog-header d-flex justify-content-start align-items-start mb-5">
                                    <div class="d-block d-inline-block mr-0 mr-md-3"><h3 class="mb-0"><strong><?php echo $main_title;?></strong></h3></div>
                                    <div class="myog-blog-navigation">
                                        <ul class="navbar-nav my-0 d-flex flex-row flex-wrap outline-buttons">
                                        <?php
                                        if (!empty($category_list)) {
                                            foreach ($category_list as $slug=>$category) {
                                                $class = '';
                                                if($get_taxonomy==$slug || empty($get_taxonomy) && $slug == 'all'){
                                                    $class = ' active';
                                                }
                                        ?>
                                            <li class="nav-item"><a href="<?php echo $category[1];?>" type="button" class="nav-link btn btn-outline tiny<?php echo $class;?>" data-target="<?php echo $slug;?>" data-toggle="blog"><?php echo $category[0];?></a></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="myog-blog-body position-relative">
                                    <div class="loading"><div class="loader"></div></div>
                                    <div class="myog-blog-grid grid-list" id="myog-blog-grid">
                                <?php
                                // Start the loop.
                                if ( have_posts() ) {
                                    while ( have_posts() ) : the_post();
                            
                                        /*
                                        * Include the post format-specific template for the content. If you want to
                                        * use this in a child theme, then include a file called called content-___.php
                                        * (where ___ is the post format) and that will be used instead.
                                        */
                                        get_template_part( 'template-parts/content', 'blog' );
                            
                                    // End the loop.
                                    endwhile;
                                }
                                else{ ?>
                                    
                                    <div class="myog-blog-grid-item grid-item full text-center p-4 grid-item-error">
                                        <p><strong>Sorry, there was/were no Blog(s) found!</strong></p>
                                    </div>
                                <?php }
                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
 
<?php get_footer(); ?>