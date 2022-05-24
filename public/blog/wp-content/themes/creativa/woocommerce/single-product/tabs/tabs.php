<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

<div class="woo__creativa--tabs-wrapper">
	<div class="container">
  		<div class="row">
    		<div class="col-md-12">


				<div class="woocommerce-tabs">
					<ul class="nav nav-tabs">
						<?php 
							$isFirst = true;
							foreach ( $product_tabs as $key => $product_tab ) : ?>

							<li class="<?php echo ''.$key ?>_tab <?php echo ''.$isFirst ? ' active' : '' ?>">
								<a data-toggle="tab" href="#tab-<?php echo ''.$key ?>" class="ui-tabs-anchor"><?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?></a>
							</li>

						<?php $isFirst = false; endforeach; ?>
					</ul>
				</div>



			</div>
		</div>
	</div>
</div>

<?php 

	$section_class = 'section';

	if (is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'vc_row')) {
		$section_class = '';
	}
?>

<div class="content-separated woo__creativa--description__content <?php echo esc_attr($section_class) ?>">
	
	<?php if (is_a( $post, 'WP_Post' ) && !has_shortcode( $post->post_content, 'vc_row')) { ?>
	<div class="container">
  		<div class="row">
    		<div class="col-md-12">

    <?php } ?>

				<div class="tab-content">

				<?php 
					$isFirst = true;
					foreach ( $product_tabs as $key => $product_tab ) : ?>

					<div class="tab-pane fade in <?php echo ''.$isFirst ? ' active' : '' ?>" id="tab-<?php echo ''.$key ?>">
						<?php if ( isset( $product_tab['callback'] ) ) {
							call_user_func( $product_tab['callback'], $key, $product_tab );
						} ?>
					</div>

				<?php $isFirst = false; endforeach; ?>
				</div>


	<?php if (is_a( $post, 'WP_Post' ) && !has_shortcode( $post->post_content, 'vc_row')) { ?>
			</div>
		</div>
	</div>

    <?php } ?>
</div>

<?php do_action( 'woocommerce_product_after_tabs' ); ?>

<?php endif; ?>