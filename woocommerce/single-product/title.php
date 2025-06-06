<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://woo.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$features_title = get_field('features_title');
if(!empty($features_title)) {
    echo '<h5 class="myog-features-title mb-1">'.$features_title.'</h5>';
}
the_title( '<div class="title-gradient theme-1"><h1 class="product_title entry-title mb-0"><strong>', '</strong></h1></div>' );


$product_id = get_the_ID();
$product = wc_get_product($product_id);
$average_rating = $product->get_average_rating();
$review_count = $product->get_review_count();
$rating = ceil($average_rating);
?>
<div class="myog-product-rating-wrapper my-4 d-flex flex-row align-items-center gap-15">
    <ul class="navbar-nav flex-row align-items-center">
    <?php for($s=0;$s<=4;$s++){
        if($s<$rating){$star = 'fa-star';}
        else{ $star = 'fa-star-o'; }
        echo '<li><i class="fa '.$star.'"></i></li>';
    } ?>
    </ul>
    <p class="overall-review-count mb-0"><?php echo $review_count;?></p>
</div>
<?php
?>

