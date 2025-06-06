<?php
    $post_id = get_the_id();
    $post_title = get_the_title();
    $permalink = get_permalink();
    $post_date = get_field('blog_date');
    $post_description = get_post_field('post_content', get_the_ID());
    $categories = get_the_terms($post_id, 'blog-category');
    $first_category = $categories[0]->slug;
?>
<div class="myog-blog-grid-item grid-item" id="blog-id-<?php echo $post_id;?>">
    <div class="myog-grid-thumbnail">
    <?php if ( has_post_thumbnail() ){ ?>
        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full');?>" class="img-fluid w-100 h-100"/>
    <?php } ?>
    <?php if( !empty($categories) ){ ?>
        <div class="position-absolute sticky-category"><span class="btn btn-outline tiny"><?php echo $first_category;?></span></div>
    <?php } ?>
    </div>
    <div class="myog-grid-content">
        <div class="myog-grid-title mb-1">
            <h4 class="mb-0"><strong><?php echo $post_title;?></strong></h4>
        </div>
        <div class="myog-grid-date mb-3">
            <p class="mb-0"><?php echo $post_date;?></p>
        </div>
        <div class="myog-grid-excerpt mb-3">
        <?php if( has_excerpt() ) { $excerpt = get_the_excerpt(); }
        else{
            if( !empty($post_description) ){ $excerpt = $post_description; }
            else{  $excerpt = ''; }
        }
            ?>
            <p class="mb-0"><?php echo $excerpt;?></p>
        </div>
        <div class="myog-grid-cta">
            <a href="<?php echo $permalink;?>" class="btn btn-outline">READ MORE</a>
        </div>
    </div>
</div>