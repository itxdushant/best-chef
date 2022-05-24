<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>

<?php echo wc_get_product_category_list($product->get_id(), ', ', '<div class="woo__creativa--single-cat heading-color">', '</div>' ); ?>

<h1 itemprop="name" class="product_title single__title entry-title"><?php the_title(); ?></h1>
