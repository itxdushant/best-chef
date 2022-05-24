<?php 
/* ------------------------------------------------------------ */
/* WooCommerce Custom */
/* ------------------------------------------------------------ */

// WooCommerce Items Per Page
function creativa_woo_items() {
	global $creativa_options;
	$woo_items = $creativa_options['opt-woo-shop-items'];

	if ($woo_items != 0) {
		return intval($woo_items);
	} else {
		return -1;
	}
}
add_filter( 'loop_shop_per_page', 'creativa_woo_items', 20 );

if (!function_exists('loop_columns')) {
  function creativa_woo_loop_columns() {
    global $creativa_options;
    $creativa_woo_products_columns = $creativa_options['opt-woo-shop-items-columns'];
    
    return $creativa_woo_products_columns; // products per row
  }
}

add_filter('loop_shop_columns', 'creativa_woo_loop_columns');


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
 
/**
 * WooCommerce Loop Product Thumbs
 **/
 
 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
 
	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail();
	} 
 }
 
 
/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce, $product;
 
		$placeholder_sizes = wc_get_image_size( 'shop_catalog' );
		
		$output = '';

		if ( has_post_thumbnail() ) {

			$creativa_product_gallery = $product->get_gallery_image_ids();

			//$output .= get_the_post_thumbnail( $post->ID, $size ); 

			$image_url_thumb_id = get_post_thumbnail_id();
			$image_url_thumb = wp_get_attachment_url( $image_url_thumb_id, 'full' );
			$image_thumb = aq_resize( $image_url_thumb, $placeholder_sizes['width'], $placeholder_sizes['height'], $placeholder_sizes['crop'], false, true );
			$output .= '<img class="creativa_gallery_image_thumb '. creativa_retina_check($image_thumb[0], false) .'" src="'. $image_thumb[0] .'" width="'. $image_thumb[1] .'" height="'. $image_thumb[2] .'"  alt="'. esc_attr__('Product Image', 'creativa') .'" />';

			if ( $creativa_product_gallery ) {
				$image_url = wp_get_attachment_url($creativa_product_gallery[0], 'full');
				$image = aq_resize( $image_url, $placeholder_sizes['width'], $placeholder_sizes['height'], $placeholder_sizes['crop'], false, true );
				$output .= '<img class="creativa_gallery_image_thumb_overlay '. creativa_retina_check($image[0], false) .'" src="'. $image[0] .'" width="'. $image[1] .'" height="'. $image[2] .'"  alt="'. esc_attr__('Product Image', 'creativa') .'" />';
			}
			
		} else {

			$creativa_product_gallery = $product->get_gallery_image_ids();

			if ( $creativa_product_gallery ) {
				$image_url = wp_get_attachment_url($creativa_product_gallery[0], 'full');
				$image = aq_resize( $image_url, $placeholder_sizes['width'], $placeholder_sizes['height'], $placeholder_sizes['crop'], false, true );
				$output .= '<img class="creativa_gallery_image_thumb '. creativa_retina_check($image[0], false) .'" src="'. $image[0] .'" width="'. $image[1] .'" height="'. $image[2] .'"  alt="'. esc_attr__('Product Image', 'creativa') .'" />';
			} else {
				$output .= apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
			}
		}
			
		return $output;
	}
 }

 
/**
 * WooCommerce Category Name - Catalog
 **/

function wc_category_title_archive_products(){
    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats );
        echo '<div class="product-category-title">' .$single_cat->name .'</div>';
	}
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
// add_action( 'woocommerce_after_shop_loop_item_title', 'wc_category_title_archive_products', 10 );
// add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );

function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}

function woocommerce_single_variation() {
	echo '<div class="woocommerce-variation single_variation creativa_woo_sp_pricing"></div>';
}

add_filter( 'woocommerce_output_related_products_args', 'creativa_related_products_args' );
  function creativa_related_products_args( $args ) {
 
	$args['posts_per_page'] = 4; // 4 related products
	$args['columns'] = 4; // arranged in 2 columns
	return $args;
}

add_filter('woocommerce_add_to_cart_fragments', 'creativa_woo_header_add_to_cart_fragment');
 
function creativa_woo_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce, $creativa_options;

	$icons_style = $creativa_options['opt-nav-icons-style'];

	if ($icons_style == 1) {

		$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
		
		ob_start();
		
		?>
		<span class="nav__cart-subtotal"><?php echo ''.$cart_subtotal; ?></span>
		<?php
		
		$fragments['span.nav__cart-subtotal'] = ob_get_clean();
		
		return $fragments;
		
	}

	elseif ($icons_style == 2 || $icons_style == 3) {

		$cart_items = $woocommerce->cart->cart_contents_count;
		
		ob_start();
		
		?>
		<span class="nav__cart-items"><?php echo ''.$cart_items; ?></span>
		<?php
		
		$fragments['span.nav__cart-items'] = ob_get_clean();
		
		return $fragments;
		
	}
}