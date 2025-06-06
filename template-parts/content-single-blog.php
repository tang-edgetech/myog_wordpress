<?php
$post_title = get_the_title();
$post_id = get_the_ID();
$post_date = get_field('blog_date');
$post_categories = get_the_terms($post_id, 'blog-category');
$author = get_the_author();
$post_type = get_post_type();
$taxonomy = 'blog-category';
$term = get_queried_object()->slug;
if( $term ){
    $back_link = get_term_link($term, $taxonomy);
}
else{
    $back_link = get_post_type_archive_link($post_type);
}
?>
<section class="section section-single-blog px-4 px-md-0" id="single-blog">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="back-page px-3 mb-3">
                    <a href="<?php echo $back_link;?>" class="d-flex align-items-center"><i class="fa fa-long-arrow-left mr-2" aria-hidden="true"></i> Back</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-start">
            <div class="col-12 col-xl-8 single-blog-wrapper px-0 px-md-4">
                <div class="single-blog-content">
                <?php if( has_post_thumbnail() ){ ?>
                    <div class="single-blog-thumbnail mb-2">
                        <img decoding="async" src="<?php echo get_the_post_thumbnail_url();?>" class="img-fluid w-100 h-100">
                    </div>
                <?php } ?>
                    <div class="single-blog-title mb-4">
                        <h2 class="mb-1"><strong><?php echo $post_title;?></strong></h2>
                        <div class="myog-grid-date mb-2"><?php echo $post_date. ' | By ' .$author;?></div>
                    <?php 
                    if( !empty($post_categories) ){
                    echo '<ul class="navbar-nav outline-buttons mx-0">';
                        foreach($post_categories as $cat):
                            
                        $category_permalink = get_term_link($cat, 'blog-category');
                    ?>
                        <li class="nav-item"><a href="<?php echo $category_permalink;?>" target="_blank" type="button" class="nav-link btn btn-outline tiny" data-target="<?php echo $cat->slug;?>"><?php echo $cat->name;?></a></li>
                    <?php
                        endforeach;
                    echo '</ul>';
                    }
                    ?>
                    </div>
                    <div class="single-blog-description mb-3">
                        <?php the_content();?>
                    </div>
                </div>
            </div>
            <?php
            $related_args = array(
                'post_type'     => 'blog',
                'post_status'   => 'publish',
                'posts_per_page' => 5,
                'post__not_in'   => array($post_id),
            );
            $related = new WP_Query($related_args);
            if( $related->have_posts() ){
            ?>
            <div class="col-12 col-xl-4 related-blog-wrapper px-0 px-md-4 mt-5 pt-5">
                <h5 class="text-color-2 mb-2"><strong>Related GeneStory</strong></h5>
                <div class="related-genestory grid-list">
                <?php
                while( $related->have_posts() ){ $related->the_post();
                    $categories = get_the_terms($post_id, 'blog-category');
                ?>
                    <div class="myog-blog-grid-item grid-item">
                        <div class="myog-grid-thumbnail">
                            <a href="<?php echo get_permalink();?>" class="d-block w-100 h-100">
                            <?php if( has_post_thumbnail() ){ ?>
                                <img decoding="async" src="<?php echo get_the_post_thumbnail_url();?>" class="img-fluid w-100 h-100">
                            <?php } ?>
                            <?php
                            if (!empty($categories)) {
                                // Get the first category
                                $first_category = $categories[0]->name;
                            ?>
                                <div class="position-absolute sticky-category">
                                    <span class="btn btn-outline tiny"><?php echo $first_category;?></span>
                                </div>
                            <?php
                            } ?>
                            </a>
                        </div>
                        <div class="myog-grid-content">
                            <div class="myog-grid-title mb-1">
                                <a href="<?php echo get_permalink();?>">
                                    <h5 class="mb-0"><strong>Blog Title 01</strong></h5>
                                </a>
                            </div>
                            <div class="myog-grid-excerpt mb-3">
                                <p class="mb-0"><span class="myog-grid-date"><?php echo $post_date;?> - </span>Science Behind DNA Test Sample CollectionThe journey begins with a saliva sample collection. IsolationScientists isolate your DNA from the sample via specialized techniques to extract the genetic material. Data AnalysisPowerful.</p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>