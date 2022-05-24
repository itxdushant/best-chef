<?php 
  $creativa_options = creativa_get_options();
  // wp_reset_postdata();
?>

<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
      <meta charset="<?php bloginfo('charset'); ?>">
      <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Pingbacks -->
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
      
      <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>
    <?php 
    if (function_exists('wp_body_open')) {
      wp_body_open();
    }
    ?>
      
    <?php 
    if ($creativa_options['opt-nav-layout'] == 1 && $creativa_options['opt-show-header'] == 1 && $creativa_options['opt-show-sticky-header'] == 1) {
      get_template_part('includes/headers/addons/sticky-header', creativa_header_style());
    }
    ?>

    <?php 

    if ($creativa_options['opt-nav-layout'] == 2 && $creativa_options['opt-show-header'] == 1) {
      get_template_part('includes/nav-layouts/nav-layout', 'side' ); ?>

      <div class="side-nav--content-wrapper">
    <?php } ?>

    <div class="layout-wrapper">

      <?php 
      if ( class_exists('RevSliderFunctions') && $creativa_options['opt-nav-layout'] == 1) {
        $header_slider  = $creativa_options['opt-slider-header'];

        if ($header_slider != 'none') {
          echo '<div class="header--slider">';
            putRevSlider(esc_attr($header_slider));
          echo '</div><!-- header--slider end -->';
        }
      }


      ?>

    <?php if ($creativa_options['opt-show-header'] == 1) { ?>


    <?php 

    if ($creativa_options['opt-nav-layout'] == 1) {
      get_template_part('includes/headers/header', creativa_header_style() ); 
    }

    ?>

    <?php } // blank template endif ?>

    <div class="content-wrapper clear">

    <?php if ($creativa_options['opt-show-header'] == 1) { ?>
    
      <?php 
        if (function_exists('creativa_page_share')) {
          creativa_page_share(); 
        }
      ?>
    
    <?php 

    if (function_exists('creativa_page_title')) {
      creativa_page_title(); 
    }

    ?>

    <?php } // blank template endif ?>