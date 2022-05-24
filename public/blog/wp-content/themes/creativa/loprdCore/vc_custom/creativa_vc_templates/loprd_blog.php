<?php
$creativa_options = creativa_get_options();
$creativa_image_th = creativa_thumbnail_size();

$el_class = '';
extract(shortcode_atts(array(
    'posts_number' => 0,
    'orderby' => 'date',
    'order' => 'DESC',

    'blog_ovr_settings' => 'global',
    'blog_ovr_style' => 1,

	'display_ovr_media' => 1,
	'allow_ovr_media_styles' => 1,
	'content_ovr_settings' => 1,
	'display_ovr_categories' => 1,
	'display_ovr_date' => 1,
	'display_ovr_comments' => 1,
	'display_ovr_author' => 1,
    
    'categories' => '',
    'tags' => '',
    'authors' => '',

    'exclude_by' => '',
    'excluded_categories' => '',
    'excluded_tags' => '',
    'excluded_authors' => '',

    'el_class' => '', 
    'css' => '',
), $atts));

$blog_sh_layout = ($blog_ovr_settings == 'global') ? $creativa_options['opt-blog-style'] : $blog_ovr_style;

if ($blog_sh_layout == 1) {
  $style_class = 'blog-large';
  $blog_style = '';
}
elseif ($blog_sh_layout == 2) {
  $style_class = 'blog-masonry blog-grid row bm-hidden';
  $blog_style = 'masonry';
}

$show_thumbnail_class = 'with-thumbnails';
if ($blog_ovr_settings == 'custom' && $display_ovr_media == 0 ) {
	$show_thumbnail_class = 'no-thumbnails';
}

$categories_output = '';
$tags_output = '';
$authors_output = '';

$categories_ex_output = '';
$tags_ex_output = '';
$authors_ex_output = '';

if (!empty($categories)) {
	$categories_output = explode(',', $categories);
}
if ($exclude_by == 'exclude' && !empty($excluded_categories)) {
	$categories_ex_output = explode(',', $excluded_categories);
}

if (!empty($tags)) {
	$tags_output = explode(',', $tags);
}
if ($exclude_by == 'exclude' && !empty($excluded_tags)) {
	$tags_ex_output = explode(',', $excluded_tags);
}

if (!empty($authors)) {
	$authors_output = explode(',', $authors);
}
if ($exclude_by == 'exclude' && !empty($excluded_authors)) {
	$authors_ex_output = explode(',', $excluded_authors);
}


?>
<div class="loprd-shortcode-blog <?php echo esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>">
	<div class="<?php echo esc_attr($style_class . ' ' . $show_thumbnail_class) ?>">
	  	<?php

		$creativa_image_th[2] = creativa_thumbnail_size(2, true);

		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

	  	$query_args = array(
			'post_status'         => 'publish',
		  	'paged'				  => $paged,
			// 'cat'		  		  => $categories_output,
			// 'tag_id' 			  => $tags_output,
			// 'author' 			  => $authors_output,
			'posts_per_page'   	  => intval($posts_number),
			'orderby' 		      => $orderby,
			'order' 			  => $order,
		);
		
		if (!empty($categories)) {
			$query_args['category__and'] = $categories_output;
		}
		if (!empty($excluded_categories)) {
			$query_args['category__not_in'] = $categories_ex_output;
		}

		if (!empty($tags)) {
			$query_args['tags__and'] = $tags_output;
		}
		if (!empty($excluded_tags)) {
			$query_args['tag__not_in'] = $tags_ex_output;
		}

		if (!empty($authors)) {
			$query_args['author__in'] = $authors_output;
		}
		if (!empty($excluded_authors)) {
			$query_args['author__not_in'] = $authors_ex_output;
		}

		$query = new WP_Query( $query_args );

	  	if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();
	  	
		  	if ($blog_ovr_settings == 'custom') {
	  			creativa_get_options('opt-blog-style', $blog_ovr_style);
	  			creativa_get_options('opt-show-thumbnail', $display_ovr_media);
	  			creativa_get_options('opt-allow-media-styles', $allow_ovr_media_styles);
	  			creativa_get_options('opt-excerpts', $content_ovr_settings);
	  			creativa_get_options('opt-display-categories', $display_ovr_categories);
	  			creativa_get_options('opt-display-date', $display_ovr_date);
	  			creativa_get_options('opt-display-comments', $display_ovr_comments);
	  			creativa_get_options('opt-display-author', $display_ovr_author);
	  		}

	  	  	get_template_part( 'includes/post-layout/display', $blog_style );  ?>
		
	  	<?php endwhile;	else : ?>
		
	  	<article id="post-<?php the_ID(); ?>" <?php post_class('no-posts'); ?>>
		
	  	  <h2><?php esc_html_e('No posts were found.', 'creativa'); ?></h2>
	  	
	  	</article>
		
		<?php endif; wp_reset_postdata(); ?>
  	</div>
		
  	<?php
  	if ( function_exists('creativa_pagination') ) {
  	  creativa_pagination($query);
  	}
  	?>
</div>


