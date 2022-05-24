<?php
$creativa_options = creativa_get_options();


$el_class = '';
extract(shortcode_atts(array(
    'el_class' => '', 
    'css' => '',

    'portfolio_ovr_settings' => 'global',
    'portfolio_layout' => 3,
    'portfolio_masonry_size' => 2,
    'portfolio_gap' => 30,
    'portfolio_ppage' => -1,
    'projects_offset' => 0,
    'orderby' => 'date',
    'order' => 'DESC',
    'portfolio_paginate' => 0,

    'portfolio_item_style' => 1,
    'portfolio_item_categories' => 1,
    'portfolio_item_quickview' => 1,
    'portfolio_item_like' => 1,

    'portfolio_filtering' => 0,
    'portfolio_filtering_sorting' => 1,
    'portfolio_filtering_position' => 1,

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

    'filtering_color' => '',
    'filtering_color_active' => '',
    'sorting_color' => '',
), $atts));

?>

<?php 


if ($portfolio_ovr_settings == 'custom') {
  $creativa_options['opt-portfolio-layout'] = intval($portfolio_layout);
  $creativa_options['opt-portfolio-items-gap'] = $portfolio_gap;
  $creativa_options['opt-portfolio-style'] = intval($portfolio_item_style);
  $creativa_options['opt-portfolio-pagination'] = 1;
  $creativa_options['opt-portfolio-pper-page'] = intval($portfolio_ppage);
} 

$portfolio_gap_output = $creativa_options['opt-portfolio-items-gap'];
$loprd_portfolio_custom = '';

$custom_css = '';
if ($portfolio_gap_output != 30 || $title_color || $hover_bg || $bottom_title_bg || $filtering_color) {
  $custom_id = rand(0,9999);
  $loprd_portfolio_custom = 'loprd-ps-custom-' .$custom_id. ' ';

  $custom_css .= '<style type="text/css" scoped>';

  if ($portfolio_gap_output != 30) {
    $custom_css .= '
        .'. $loprd_portfolio_custom. ' .portfolio-items--container .row {
          margin-right: '. - intval($portfolio_gap_output) / 2 .'px;
          margin-left: '. - intval($portfolio_gap_output) / 2 .'px;
        }

        .'. $loprd_portfolio_custom. ' .portfolio-items--container .row [class*="col-"] {
          padding-left: '. intval($portfolio_gap_output) / 2 .'px;
          padding-right: '. intval($portfolio_gap_output) / 2 .'px;
          margin-bottom: '. intval($portfolio_gap_output) / 2 .'px;
          margin-top: '. intval($portfolio_gap_output) / 2 .'px;
        }

        .'. $loprd_portfolio_custom. ' .project-filtering-wrap.project-filtering--standard + .portfolio {
          margin-top: -'. intval($portfolio_gap_output) / 2 .'px;
        }
    ';
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


  // filtering 
  if ($filtering_color) {
    $custom_css .= '
      .'. $loprd_portfolio_custom. ' .filters > .project--filters > a {
        color: '. esc_attr($filtering_color) .';
      }
    ';
  }
  if ($filtering_color_active) {
    $custom_css .= '
      .'. $loprd_portfolio_custom. ' .filters > .project--filters .active {
        color: '. esc_attr($filtering_color_active) .';
      }
    ';
  }

  $custom_css .= '</style>';

  echo ''.$custom_css; // var escaped
}


$portfolio_filtered_class = '';
if ($portfolio_filtering == 1) {
  $portfolio_filtered_class = 'portfolio--filtered';
}

$filtering_cats_style = '';
$filtering_sort_style = '';

if ($sorting_color) {
  $filtering_sort_style = 'style="color:'. esc_attr($sorting_color) .'"';
}

?>


<div class="loprd-portfolio-shortcode <?php echo esc_attr($loprd_portfolio_custom) . esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>">

<?php 
if ( class_exists('Portfolio_Post_Type') ) {
  //plugin is activated

  $content_width = 1200;

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
  elseif ($creativa_options['opt-portfolio-layout'] == 5) { // masonry
    $item_thumbnail_layout = 'portfolio--masonry pm-hidden';
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
  $filtering_class = 'project-filtering--standard';


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
  // $filter_custom_select = $creativa_options['opt-portfolio-sel-categories'];


  if ($creativa_options['opt-portfolio-pagination'] == 1 ) {
   $projects_per_page = $creativa_options['opt-portfolio-pper-page'];
  } else {
   $projects_per_page = -1;
  }

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
  
  $portfolio = array(
    'posts_per_page' => $projects_per_page,
    'post_type'   => 'portfolio',
    // 'author'      => $authors_output,
    'tax_query'   => $tax_query,
  );

  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
  $portfolio['paged'] = $paged;

  if (!empty($authors)) {
    $portfolio['author__in'] = $authors_output;
  }
  if (!empty($excluded_authors)) {
    $portfolio['author__not_in'] = $authors_ex_output;
  }

  if ($portfolio_ovr_settings == 'custom') {
    $potfolio_settings = array(
      'offset'      => intval($projects_offset),
      'orderby'     => $orderby,
      'order'       => $order,
    );

    $portfolio = array_merge($portfolio, $potfolio_settings);
  }

  $wp_query = new WP_Query($portfolio);

?>

<?php if ($portfolio_filtering == 1) { ?>

<div class="project-filtering-wrap clearfix <?php echo esc_attr($filtering_class) ?>">

        <?php 
          $filtering_position = $portfolio_filtering_position;
          $filtering_position_class = '';

          if ($filtering_position == 1) {
            $filtering_position_class = 'project--filtering--left';
          }
          elseif ($filtering_position == 2) {
            $filtering_position_class = 'project--filtering--center';
          }
          elseif ($filtering_position == 3) {
            $filtering_position_class = 'project--filtering--right';
          }

        ?>

        <div class="project--filtering <?php echo esc_attr($filtering_position_class) ?>">
        <?php 

        echo '<ul class="filters">';
        //echo '<li><small class="filter-title">'. esc_html__('Filter Projects', 'creativa') .'</small></li>';
        echo '<li class="project--filters"><a class="filter--a active heading" data-filter="*">'. esc_html__("All", 'creativa') .' <sup>'. intval($wp_query->found_posts) .'</sup></a></li>';

        if (!empty($categories_arr)) {
          foreach ($categories_arr as $selected_category) {
            $filter_category = get_term_by('slug',$selected_category,'portfolio_category');
            if (isset($filter_category->slug)) {
              echo '<li class="project--filters"><a class="filter--a heading" data-filter=".'. esc_attr($filter_category->slug) .'">'. esc_html(ucfirst($filter_category->name)) . ' <sup>'. intval($filter_category->count) .'</sup></a></li>';
            } else {
              echo '<li class="project--filters">'. esc_html__('Typed category not exist', 'creativa') .'</li>';
            }
          }
        } else {
          foreach ($filter_categories as $filter_category) {
            echo '<li class="project--filters"><a class="filter--a heading" data-filter=".'. esc_attr($filter_category->slug) .'">'. esc_html(ucfirst($filter_category->name)) . ' <sup>'. intval($filter_category->count) .'</sup></a></li>';
          }
        } ?>

        <?php if ($portfolio_filtering_sorting == 1) { ?>
        <li class="project--sorting"><a class="font-secondary" href="#" title="<?php esc_html_e('Sort by', 'creativa') ?>" <?php echo ''.$filtering_sort_style // var escaped ?>><?php esc_html_e('Sort by', 'creativa') ?><i class="arrow_carrot-down"></i></a>
          <ul>
            <li><a class="sorter--a active" data-sort-value=""  href="#"><?php esc_html_e('Most Recent', 'creativa') ?></a></li>
            <li><a class="sorter--a" data-sort-value="likes" href="#"><?php esc_html_e('Most Liked', 'creativa') ?></a></li>
            <li><a class="sorter--a" data-sort-value="views" href="#"><?php esc_html_e('Most Viewed', 'creativa') ?></a></li>
          </ul>
        </li>
        <?php } // endif sorting ?>  

        <?php echo '</ul>';
        ?>
        </div>

</div>

<?php } ?>     

<div class="portfolio-wrapper <?php echo esc_attr($portfolio_class) ?>">



    <!-- Portfolio items container -->
    <div class="portfolio-items--container <?php echo esc_attr($portfolio_item_style) .' '. esc_attr($portfolio_filtered_class ) ?> <?php echo esc_attr($item_thumbnail_layout) ?>">

      <div class="row">

        <?php

        if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();

          if ($portfolio_ovr_settings == 'custom') {
            // $creativa_options['opt-portfolio-layout'] = intval($portfolio_layout);
            creativa_get_options('opt-portfolio-layout', intval($portfolio_layout));
            if ($portfolio_layout == 5) {
              // $creativa_options['opt-masonry-size'] = intval($portfolio_masonry_size);
              creativa_get_options('opt-masonry-size', intval($portfolio_masonry_size));
            }
            // $creativa_options['opt-portfolio-style'] = intval($portfolio_item_style);
            creativa_get_options('opt-portfolio-style', intval($portfolio_item_style));
            // $creativa_options['opt-porfolio-item-categories'] = intval($portfolio_item_categories);
            creativa_get_options('opt-porfolio-item-categories', intval($portfolio_item_categories));
            // $creativa_options['opt-quick-view'] = intval($portfolio_item_quickview);
            creativa_get_options('opt-quick-view', intval($portfolio_item_quickview));
            // $creativa_options['opt-like-button'] = intval($portfolio_item_like);
            creativa_get_options('opt-like-button', intval($portfolio_item_like));

          } 

          get_template_part( 'includes/portfolio/portfolio-display' );  ?>
            
         <?php endwhile; 
         else : ?>

        <h3><?php esc_html_e('No projects were found.', 'creativa'); ?></h3>

        <?php endif; wp_reset_postdata(); ?>

      </div>


      <?php
      if ($portfolio_ovr_settings == 'custom' && $portfolio_paginate == 1 && $projects_offset == 0) {
        if ( function_exists('creativa_pagination') ) {
          creativa_pagination($wp_query);
        }
      }
      ?>

    </div><!-- Portfolio items container END-->


</div>

<?php

} // if plug activated 
else { ?>

  <h3>Portfolio plugin not installed/activated</h3>

<?php } ?>

</div>