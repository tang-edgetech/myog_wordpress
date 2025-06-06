<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
/** Get floating side menu */
$current_product_id = get_the_ID();
$prod = array(
	'post_type'		 => 'product',
	'posts_per_page' => -1,
	'post_status'	 => 'publish',
);
$products = new WP_Query($prod);
if($products->have_posts()):
	echo '<div class="sp-floating-bar position-fixed"><p class="mb-3">All Package</p><ul class="navbar-nav pt-2 d-flex flex-column justify-content-start sp-floating-menu">';
	while($products->have_posts()):
		$products->the_post();
		$title = get_the_title();
		$id = get_the_ID();
		$permalink = get_permalink();
?>
	<li class="nav-item"><a href="<?php echo $permalink;?>" class="nav-link<?php echo ($current_product_id == $id) ? ' active' : '';?>" data-product-id="<?php echo $id;?>"><?php echo $title;?></a></li>
<?php
	endwhile;
	wp_reset_postdata();
	echo '</ul></div>';
endif;

?>
<section class="section section-single-product" id="single-product">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-8 col-xl-9 col-xxl-11 w-100">
				<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

					<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>

					<div class="col-12 col-md-8 w-100 summary entry-summary">
						
						<?php

						$average_rating = $product->get_average_rating();

						// Output the rating
						// echo 'Average Rating: ' . $average_rating;

						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						do_action( 'woocommerce_single_product_summary' );
						?>
					</div>

					<?php
					/**
					 * Hook: woocommerce_after_single_product_summary.
					 *
					 * @hooked woocommerce_output_product_data_tabs - 10
					 * @hooked woocommerce_upsell_display - 15
					 * @hooked woocommerce_output_related_products - 20
					 */
					do_action( 'woocommerce_after_single_product_summary' );
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('woocommerce/single-product/myog','single-product-additional-information');?>

<?php
$prod_title = get_the_title($current_product_id);
$product_id = $product->get_id();
$product_price = wc_price(wc_get_price_to_display($product));
?>
<div class="myog-instant-add-cart-wrapper position-fixed bg-white p-2">
	<div class="d-flex flex-wrap justify-content-between align-items-center">
		<div class="myog-iac-header d-flex align-items-center justify-content-start">
			<div class="myoc-iac-thumbnail mr-3"><img src="/wp-content/uploads/2024/11/myog-add-to-cart-dollar-sign.png" class="img-fluid w-100"/></div>
			<div class="myoc-iac-title">
				<h5 class="iac-product-title mb-0"><strong><?php echo $prod_title;?></strong></h5>
				<h3 class="iac-product-price mb-0"><strong><?php echo $product_price;?></strong></h5>
			</div>
		</div>
		<div class="myog-iac-cta d-flex align-items-stretch justify-content-end">
			<div class="myog-iac-quantity d-flex align-items-center justify-content-center mr-2">
				<div class="myog-iac-qty-btn btn-decrease disabled">-</div>
				<input type="number" class="myog-iac-qty" min="1" value="1"/>
				<div class="myog-iac-qty-btn btn-increase">+</div>
			</div>
			<div class="myog-iac-buttons">
				<button type="button" class="btn btn-myog elementor-button uppercase px-3 py-2 btn-add-to-cart" id="add-to-cart" data-product-id="<?php echo $current_product_id;?>">Add to Cart</button>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>