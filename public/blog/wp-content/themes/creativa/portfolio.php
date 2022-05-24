<?php
/*
Template Name: Portfolio
*/
?>

<?php 
get_header(); 
$creativa_options = creativa_get_options();

?>

<?php 
// check for plugin using plugin name
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
  elseif ($creativa_options['opt-portfolio-layout'] == 5) { // masonry
    $item_thumbnail_layout = 'portfolio--masonry pm-hidden';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 10) { // 1col block
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
  $filtering_class = 'project-filtering--standard';
  if ($creativa_options['opt-portfolio-fullwidth'] == true) {
    $portfolio_class = 'portfolio-fullwidth';
    $filtering_class = 'project-filtering--fullwidth';
  }

  $filter_categories = get_terms('portfolio_category'); 
  // $filter_custom_select = $creativa_options['opt-portfolio-categories'];

  $categories = $creativa_options['opt-portfolio-sel-categories'];
  $tags = $creativa_options['opt-portfolio-sel-tags'];
  $authors = $creativa_options['opt-portfolio-sel-authors'];

  $exclude_by = $creativa_options['opt-portfolio-exc'];
  $excluded_categories = $creativa_options['opt-portfolio-exc-categories'];
  $excluded_tags = $creativa_options['opt-portfolio-exc-tags'];
  $excluded_authors = $creativa_options['opt-portfolio-exc-authors'];

  $authors_output = '';
  

  if ($authors || ($exclude_by == true && $excluded_authors)) {
    $authors_arr = array();
    $excluded_authors_arr = array();

    if ($authors) {
      $authors_arr = $authors;
    }
    if ($excluded_authors) {
      $excluded_authors_arr = $excluded_authors;
    }

    foreach ($excluded_authors_arr as &$value) {
      $value *= (-1);
    }

    $authors_arr = array_filter($authors_arr);
    $excluded_authors_arr = array_filter($excluded_authors_arr);

    $merged_authors = array_merge($authors_arr, $excluded_authors_arr);
    $authors_output = implode(',', $merged_authors);
  }

  $portfolio_filtered_class = '';
  if ($creativa_options['opt-portfolio-filtering'] == 1) {
    $portfolio_filtered_class = 'portfolio--filtered';
  }


  if ($creativa_options['opt-portfolio-pagination'] == 1 ) {
   $projects_per_page = $creativa_options['opt-portfolio-pper-page'];
  } else {
   $projects_per_page = -1;
  }

  $tax_query = array( 'relation' => 'AND' );

  if( $categories ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_category',
      'field'    => 'term_id',
      'terms'    => $categories,
    );
  }
  if($exclude_by == true && $excluded_categories ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_category',
      'field'    => 'term_id',
      'terms'    => $excluded_categories,
      'operator' => 'NOT IN'
    );
  }

  if( $tags ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_tag',
      'field'    => 'term_id',
      'terms'    => $tags,
    );
  }
  if($exclude_by == true && $excluded_tags ){
    $tax_query[] = array(
      'taxonomy' => 'portfolio_tag',
      'field'    => 'term_id',
      'terms'    => $excluded_tags,
      'operator' => 'NOT IN'
    );
  }

  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
  $portfolio = array(
    'posts_per_page' => intval($projects_per_page),
    'post_type' => 'portfolio',
    'paged'=> $paged,
    'author'      => $authors_output,
    'tax_query'   => $tax_query,
  );

  $wp_query = new WP_Query($portfolio);

?>

<div class="content">

  <?php if ($creativa_options['opt-portfolio-filtering'] == 1) { ?>

  <div class="project-filtering-wrap section <?php echo esc_attr($filtering_class) ?>">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <?php 
            $filtering_position = $creativa_options['opt-portfolio-filtering-pos'];
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

          if (!empty($categories)) {
            foreach ($categories as $selected_category) {
              $filter_category = get_term_by('term_id',$selected_category,'portfolio_category');
              echo '<li class="project--filters"><a class="filter--a heading" data-filter=".'. esc_attr($filter_category->slug) .'">'. esc_html(ucfirst($filter_category->name)) . ' <sup>'. intval($filter_category->count) .'</sup></a></li>';
            }
          } else {
            foreach ($filter_categories as $filter_category) {
              echo '<li class="project--filters"><a class="filter--a heading" data-filter=".'. esc_attr($filter_category->slug) .'">'. esc_html(ucfirst($filter_category->name)) . ' <sup>'. intval($filter_category->count) .'</sup></a></li>';
            }
          } ?>

          <?php if ($creativa_options['opt-portfolio-sorting'] == 1) { ?>
          <li class="project--sorting"><a class="font-secondary" href="#" title="<?php esc_html_e('Sort by', 'creativa') ?>"><?php esc_html_e('Sort by', 'creativa') ?><i class="arrow_carrot-down"></i></a>
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
      </div>
    </div>
  </div>

  <?php } ?>     

  <div class="portfolio-wrapper <?php echo esc_attr($portfolio_class) ?> section">
    <div class="container">


      <!-- Portfolio items container -->
      <div class="portfolio-items--container <?php echo esc_attr($portfolio_item_style) .' '. esc_attr($portfolio_filtered_class)  ?> <?php echo esc_attr($item_thumbnail_layout) ?>">

        <div class="row">

          <?php

          if(have_posts()) : while(have_posts()) : the_post();

            get_template_part( 'includes/portfolio/portfolio-display' );  ?>
              
           <?php endwhile; 
            wp_reset_postdata();
           else : ?>

            <div class="container">
              <div class="row">
                <div class="col-md-12">
                 <h3><?php esc_html_e('No projects were found.', 'creativa'); ?></h3>
                </div>
              </div>
            </div>

          <?php endif; ?>

          
        </div>

        <?php
          if ( function_exists('creativa_pagination') ) {
            creativa_pagination();
          }
        ?>

      </div><!-- Portfolio items container END-->

    </div>
  </div>
</div>

<?php

} // if plug activated 
else { ?>

<div class="content section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <h3>Portfolio plugin not installed/activated</h3>
      </div>
    </div>
  </div>
</div>

<?php }

get_footer(); ?>