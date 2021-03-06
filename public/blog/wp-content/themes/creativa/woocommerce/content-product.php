<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="creativa_woo_item--wrapper">

		<div class="creativa_woo_imagewrapper">
			<a href="<?php the_permalink(); ?>">

				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			</a>
			<div class="woo_creativa_thumb-overlay">
				<div class="creativa_woo_add-to-cart">
					<?php wc_get_template( 'loop/add-to-cart.php' ); ?>
				</div>
			</div>

		</div>

		<div class="creativa_woo_title--wrapper">

			<a href="<?php the_permalink(); ?>">

				<?php 
					if (function_exists('wc_category_title_archive_products')) {
						wc_category_title_archive_products();
					}
				?>

				<div class="creativa_woo_title"><h4><?php the_title(); ?></h4>

				<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
				</div>

			</a>

		</div>

	</div>

	<?php // do_action( 'woocommerce_after_shop_loop_item' ); ?>
</li>
