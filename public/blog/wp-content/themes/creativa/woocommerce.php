<?php 
get_header(); 
$creativa_options = creativa_get_options();

$creativa_woo_products_columns = $creativa_options['opt-woo-shop-items-columns'];

if (isset($_GET['layout']) && $_GET['layout'] == 'full') {
  $creativa_options['opt-woo-shop-layout'] = 1;
} 
elseif (isset($_GET['layout']) && $_GET['layout'] == 'sidebar') {
  $creativa_options['opt-woo-shop-layout'] = 2;
}

$creativa_woo_column_products = 'col-md-12 no-sidebar';
$creativa_woo_sidebar_position = 'woo_fullwidth';
$creativa_woo_column_sidebar = '';

if (!is_product() && isset($creativa_options['opt-woo-shop-layout']) && $creativa_options['opt-woo-shop-layout'] == 2) { 
  if (isset($creativa_options['opt-woo-shop-sidebar-position']) && is_active_sidebar('shop-sidebar') === true) {
    if ($creativa_options['opt-woo-shop-sidebar-position'] == 1 || (isset($_GET['sidebar']) && $_GET['sidebar'] == 'right'))  { //sidebar right
      $creativa_woo_column_products = 'col-md-9 sidebar-content';
      $creativa_woo_column_sidebar = 'col-md-3';
      $creativa_woo_sidebar_position = 'sidebar-right';
    }
    elseif ($creativa_options['opt-woo-shop-sidebar-position'] == 2 || (isset($_GET['sidebar']) && $_GET['sidebar'] == 'left'))  { //sidebar left
      $creativa_woo_column_products = 'col-md-9 col-md-push-3 sidebar-content';
      $creativa_woo_column_sidebar = 'col-md-3 col-md-pull-9';
      $creativa_woo_sidebar_position = 'sidebar-left';
    }
  }

} else {
  $creativa_woo_column_products = 'col-md-12 no-sidebar';
  $creativa_woo_sidebar_position = 'woo_fullwidth';
}



$woo_fullwidth_class = '';
if (!is_singular('product') && ($creativa_options['opt-woo-full-width'] == 1 || (isset($_GET['full']) && $_GET['full'] == 'true'))) {
  $woo_fullwidth_class = 'shop__width-full';
}


?>

      <?php if (!is_singular('product')) { ?>

      <div class="content <?php echo esc_attr($woo_fullwidth_class); ?> creativa_woocommerce <?php echo 'creativa_woo-col-'.esc_attr($creativa_woo_products_columns) ?> <?php echo esc_attr($creativa_woo_sidebar_position) ?> section">
        <div class="container">
          <div class="row">

            <div class="<?php echo esc_attr($creativa_woo_column_products) ?>">

             <?php } ?>

              <?php 

              if ( have_posts() ) {
                woocommerce_content();
              } ?>

            <?php if (!is_singular('product')) { ?>
            
            </div>

            <?php if (!is_product() && $creativa_options['opt-woo-shop-layout'] == 2) { ?>
              <aside class="<?php echo esc_attr($creativa_woo_column_sidebar) ?> sidebar-wrap">

                <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('shop-sidebar') ) : else : ?>   

                <?php endif; ?>  

              </aside>
            <?php } ?>

          </div>
        </div>
      </div>

      <?php } ?>

<?php get_footer(); ?>