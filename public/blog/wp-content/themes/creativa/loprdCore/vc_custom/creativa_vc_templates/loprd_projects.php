<?php
$creativa_options = creativa_get_options();

$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'projects_number' => 6,
    'projects_offset' => 0,
    'orderby' => 'date',
    'order' => 'DESC',

    'portfolio_layout' => 3,
    'rp_style' => 'grid',
    'carousel_arrows_pos' => 'none',
    'navigation' => 'bullets',
    'slides_autoplay' => 0,
    'carousel_transition' => 'move',

    'portfolio_gap' => 30,

    'portfolio_item_style' => 1,
    'portfolio_item_categories' => 1,
    'portfolio_item_quickview' => 1,
    'portfolio_item_like' => 1,

    'categories' => '',
    'tags' => '',
    'authors' => '',

    'exclude_by' => '',
    'excluded_categories' => '',
    'excluded_tags' => '',
    'excluded_authors' => '',

    'title_color' => '',
    'hover_bg' => '',
    'bottom_title_bg' => '', 
    
    'css' => '',

    'css_animation' => '',
    'css_animation_delay' => '',

), $atts));

?>

<?php 

$creativa_options['opt-portfolio-layout'] = intval($portfolio_layout);
$creativa_options['opt-portfolio-items-gap'] = $portfolio_gap;
$creativa_options['opt-portfolio-style'] = intval($portfolio_item_style);

if ($rp_style == 'grid') {
  $rp_style_class = 'loprd-shortcode-projects--grid ';
}
elseif ($rp_style == 'carousel') {
  if ($carousel_arrows_pos == 'sides') {
    $arrow_pos_class = 'rsNavOuter ';
  } 
  elseif ($carousel_arrows_pos == 'top' ) {
    $arrow_pos_class = 'rsNavTop ';
  } 
  elseif ($carousel_arrows_pos == 'hidden' ) {
    $arrow_pos_class = 'rsNavHidden ';
  }
  $rp_style_class = 'loprd-shortcode-projects--carousel content-carousel royalSlider rsCreativa '. esc_attr($arrow_pos_class) .' ';
}


$portfolio_gap_output = $creativa_options['opt-portfolio-items-gap'];
$loprd_portfolio_custom = '';

$custom_css = '';
if ($portfolio_gap_output != 30 || $title_color || $hover_bg || $bottom_title_bg) {
  $custom_id = rand(0,9999);
  $loprd_portfolio_custom = 'loprd-ps-custom-' .$custom_id. ' ';

  $custom_css .= '<style type="text/css" scoped>';

  if ($portfolio_gap_output != 30) {
    $custom_css .= '
        .'. $loprd_portfolio_custom. ' .portfolio-items--container .row {
          margin-right: '. - intval($portfolio_gap_output) / 2 .'px !important;
          margin-left: '. - intval($portfolio_gap_output) / 2 .'px !important;
        }

        .'. $loprd_portfolio_custom. ' .portfolio-items--container .row [class*="col-"] {
          padding-left: '. intval($portfolio_gap_output) / 2 .'px !important;
          padding-right: '. intval($portfolio_gap_output) / 2 .'px !important;
        }
    ';

    if ($rp_style == 'grid') {
      $custom_css .= '
          .'. $loprd_portfolio_custom. ' .portfolio-items--container .row [class*="col-"] {
            margin-bottom: '. intval($portfolio_gap_output) / 2 .'px !important;
            margin-top: '. intval($portfolio_gap_output) / 2 .'px !important;
          }
      ';
    } 
  }

  if ($title_color) {
    $custom_css .= '
      .'. $loprd_portfolio_custom. ' .portfolio-item a .portfolio_hover--meta {
        color: '. esc_attr($title_color) .';
      }
    ';
  }
  if ($hover_bg) {
    $custom_css .= '
      .'. $loprd_portfolio_custom. ' .portfolio-item a .portfolio_hover {
        background-color: '. esc_attr($hover_bg) .';
      }
    ';
  }
  if ($bottom_title_bg) {
    $custom_css .= '
      .'. $loprd_portfolio_custom. ' .portfolio__style--bottom .portfolio-item a .portfolio_hover--meta {
        background-color: '. esc_attr($bottom_title_bg) .';
      }
    ';
  }

  $custom_css .= '</style>';

  echo ''.$custom_css; // var escaped
}


?>


<div class="loprd-projects-shortcode <?php echo esc_attr($loprd_portfolio_custom) .' '. esc_attr($el_class) .' '. creativaAnimation($css_animation) .' '. vc_shortcode_custom_css_class( $css, ' ' ); ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>

<?php 
if ( class_exists('Portfolio_Post_Type') ) {
  //plugin is activated



  if ($creativa_options['opt-portfolio-layout'] == 1) { // 1 column
    $item_thumbnail_layout = 'portfolio--1col';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 2) { // 2 columns
    $item_thumbnail_layout = 'portfolio--2col';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 3) { // 3 columns
    $item_thumbnail_layout = 'portfolio--3col';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 4) { // 4 columns
    $item_thumbnail_layout = 'portfolio--4col';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 5) { // 5 columns
    $item_thumbnail_layout = 'portfolio--5col';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 10) { // 1 col block
    $item_thumbnail_layout = 'portfolio--1col--block';
  }

  if ($creativa_options['opt-portfolio-style'] == 1) {
    $portfolio_item_style = 'portfolio__style--onhover';
  }
  elseif ($creativa_options['opt-portfolio-style'] == 2) {
    $portfolio_item_style = 'portfolio__style--overlay';
  }
  elseif ($creativa_options['opt-portfolio-style'] == 3) {
    $portfolio_item_style = 'portfolio__style--bottom';
  }

  $portfolio_class = 'portfolio';

  $categories_arr = '';
  $excluded_categories_arr = '';
  $tags_arr = '';
  $excluded_tags_arr = '';

  // select/exclude categories
  if (!empty($categories)) {
    $categories_arr = explode(',', $categories);
    $categories_arr = array_filter($categories_arr);
  }
  if ($exclude_by == 'exclude' && !empty($excluded_categories)) {
    $excluded_categories_arr = explode(',', $excluded_categories);
    $excluded_categories_arr = array_filter($excluded_categories_arr);
  }
  
  if (!empty($tags)) {
    $tags_arr = explode(',', $tags);
    $tags_arr = array_filter($tags_arr);
  }
  if ($exclude_by == 'exclude' && !empty($excluded_tags)) {
    $excluded_tags_arr = explode(',', $excluded_tags);
    $excluded_tags_arr = array_filter($excluded_tags_arr);
  }

  // select/exclude authors

  $authors_output = '';
  $authors_ex_output = '';


  if (!empty($authors)) {
    $authors_output = explode(',', $authors);
  }
  if ($exclude_by == 'exclude' && !empty($excluded_authors)) {
    $authors_ex_output = explode(',', $excluded_authors);
  }


  // Portfolio filtering
  $filter_categories = get_terms('portfolio_category'); 

  $projects_per_page = intval($projects_number);

  $tax_query = array( 'relation' => 'AND' );

  if( $categories_arr ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_category',
      'field'    => 'slug',
      'terms'    => $categories_arr,
    );
  }
  if($exclude_by == 'exclude' && $excluded_categories_arr ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_category',
      'field'    => 'slug',
      'terms'    => $excluded_categories_arr,
      'operator' => 'NOT IN'
    );
  }

  if( $tags_arr ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_tag',
      'field'    => 'slug',
      'terms'    => $tags_arr,
    );
  }
  if($exclude_by == 'exclude' && $excluded_tags_arr ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_tag',
      'field'    => 'slug',
      'terms'    => $excluded_tags_arr,
      'operator' => 'NOT IN'
    );
  }

  // $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
  $portfolio = array(
    'posts_per_page'  => $projects_per_page,
    'offset'          => intval($projects_offset),
    'post_type'       => 'portfolio',
    // 'paged'           => $paged,
    'tax_query'       => $tax_query,
    'orderby'         => $orderby,
    'order'           => $order,
  );

  if (!empty($authors)) {
    $portfolio['author__in'] = $authors_output;
  }
  if (!empty($excluded_authors)) {
    $portfolio['author__not_in'] = $authors_ex_output;
  }

  $wp_query = new WP_Query($portfolio);

  $i = 1;

?>

<div class="portfolio-wrapper <?php echo esc_attr($portfolio_class) ?>">

    <!-- Portfolio items container -->
    <div class="portfolio-items--container <?php echo esc_attr($rp_style_class) .' '. esc_attr($portfolio_item_style); ?> <?php echo esc_attr($item_thumbnail_layout) ?>" data-carousel-nav="<?php echo esc_attr($navigation) ?>" data-autoplay="<?php echo esc_attr($slides_autoplay) ?>" data-transition="<?php echo esc_attr($carousel_transition) ?>" data-gap="<?php echo esc_attr($portfolio_gap_output) ?>">

      <div class="row shortcode-projects--row rsContent">

        <?php

        if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();

            creativa_get_options('opt-portfolio-layout', intval($portfolio_layout));
            creativa_get_options('opt-portfolio-style', intval($portfolio_item_style));
            creativa_get_options('opt-porfolio-item-categories', intval($portfolio_item_categories));
            creativa_get_options('opt-quick-view', intval($portfolio_item_quickview));
            creativa_get_options('opt-like-button', intval($portfolio_item_like));

            if ($portfolio_layout == 5) {
              creativa_get_options('opt-portfolio-layout', 4);
            }
          

          get_template_part( 'includes/portfolio/portfolio-display' );  ?>


          <?php   
          if ($rp_style == 'carousel') {
            if($i % $portfolio_layout == 0 && $i !== $wp_query->post_count  ) : ?>
              </div>
              <div class="row shortcode-projects--row rsContent">
            <?php endif; $i++; 
          } 
          ?>  
            
         <?php endwhile; 
         else : ?>

        <h3><?php esc_html_e('No projects were found.', 'creativa'); ?></h3>

        <?php endif; wp_reset_postdata(); ?>

      </div>


    </div><!-- Portfolio items container END-->


</div>

<?php

} // if plug activated 
else { ?>

  <h3>Portfolio plugin not installed/activated</h3>

<?php } ?>

</div>