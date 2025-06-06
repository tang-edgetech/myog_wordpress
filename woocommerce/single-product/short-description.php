<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
// Replace Short Description / Excerpt to Normal Description and custom field

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<div class="woocommerce-product-description-wrapper">
		<?php the_content(); ?>
	</div>
	<?php if( have_rows('features') ){ ?>
	<div class="woocommerce-product-features p-0">
	<h4 class="fw-bold mb-3">Insights</h4>
	<ul class="p-4 mb-0">
		<?php while( have_rows('features') ){ the_row(); 
			$title = get_sub_field('title'); ?>
			<li class="d-flex"><span class="d-block mb-0"><?php echo $title;?><span></li>
		<?php } ?>
		</ul>
	</div>
	<?php }	?>
</div>