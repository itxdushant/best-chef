<?php
$creativa_options = creativa_get_options();
$creativa_image_th = creativa_thumbnail_size();
$content_width = creativa_get_content_width();

$el_class = '';
extract(shortcode_atts(array(
    'categories' => '',
    'tags' => '',
    'authors' => '',

    'exclude_by' => '',
    'excluded_categories' => '',
    'excluded_tags' => '',
    'excluded_authors' => '',

    'posts_number' => 8,
    'posts_offset' => 0,
    'orderby' => 'date',
    'order' => 'DESC',

    'columns' => 3,
    'rp_style' => 'masonry',
    'carousel_arrows_pos' => 'hidden',
    'slides_autoplay' => 0,
    'carousel_transition' => 'move',

    'display_media' => 'display-media',
    'allow_media_styles' => 'show',
    'display_content' => 'display-content',
    'content_settings' => 'content-excerpt',
    'display_categories' => 'display-categories',
	'display_date' => 'display-date',
	'display_comments' => 'display-comments',
	'display_author' => 'display-author',

    'title_color' => '',
    'text_color' => '',
    'title_size' => '',

    'css_animation' => '',
    'css_animation_delay' => '',
    'el_class' => '', 
    'css' => '',
), $atts));

if ($columns == 1) {
	$column_class = 'col-md-12';
}
if ($columns == 2) {
	$column_class = 'col-md-6';
}
elseif ($columns == 3) {
	$column_class = 'col-md-4';
}
elseif ($columns == 4) {
	$column_class = 'col-md-3';
}
elseif ($columns == 5) {
	$column_class = 'col-md-25';
}

if ($rp_style == 'masonry') {
	$rp_style_class = 'loprd-shortcode-posts--masonry ';
	$column_class .= ' masonry-post-wrap';
}
if ($rp_style == 'grid') {
	$rp_style_class = 'loprd-shortcode-posts--grid ';
}
elseif ($rp_style == 'carousel') {
	$arrow_pos_class = 'rsNavOuter ';

	if ($carousel_arrows_pos == 'sides') {
		$arrow_pos_class = 'rsNavOuter ';
	} 
	elseif ($carousel_arrows_pos == 'top' ) {
		$arrow_pos_class = 'rsNavTop ';
	} 
	elseif ($carousel_arrows_pos == 'hidden' ) {
		$arrow_pos_class = 'rsNavHidden ';
	}
	$rp_style_class = 'loprd-shortcode-posts--carousel content-carousel royalSlider rsCreativa '. esc_attr($arrow_pos_class) .' ';
}

// $allow_media_styles = 'show';
if ($allow_media_styles !== 'show') {
	$creativa_image_th[2] = creativa_thumbnail_size(2, false);
} else {
	$creativa_image_th[2] = creativa_thumbnail_size(2, true);
}

$show_thumbnail_class = 'with-thumbnails';
if ( $display_media == 'hide-media' ) {
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


$title_color_style = '';
if (!empty($title_color)) {
	$title_color_style = 'style="color:'. esc_attr($title_color) .'"';
}

$text_color_style = '';
if (!empty($text_color)) {
	$text_color_style = 'style="color:'. esc_attr($text_color) .'"';
	$rp_style_class .= ' posts--custom-colors';
}

?>
<div class="loprd-shortcode-posts blog-grid blog-grid--columns-<?php echo esc_attr($columns) ?> <?php echo esc_attr($rp_style_class) . ' '. esc_attr($show_thumbnail_class) .' '. creativaAnimation($css_animation) .' '. esc_attr($el_class) . vc_shortcode_custom_css_class( $css, ' ' ); ?>" data-carousel-nav="bullets" data-autoplay="<?php echo esc_attr($slides_autoplay) ?>" data-transition="<?php echo esc_attr($carousel_transition) ?>" <?php echo creativaAnimationDelay($css_animation, $css_animation_delay)  ?>>
	<div class="row <?php echo ''.($rp_style == 'masonry' && $columns != 1) ? 'blog-masonry bm-hidden' : '' ?> shortcode-posts--row rsContent">
	<?php   

	$query_args = array(
		'posts_per_page'      => intval($posts_number),
		'no_found_rows'       => true,
		'post_status'         => 'publish',
		// 'cat'		  		  => $categories_output,
		// 'tag_id' 			  => 50,-55,
		// 'tag__not_in' 		=> array(55, 52),
		'offset'			  => intval($posts_offset),
		'ignore_sticky_posts' => false,
		'orderby' 			  => $orderby,
		'order' 			  => $order,
		'ignore_sticky_posts' => 1,
		// 'author' 			  => $authors_output,
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

	$query = new WP_Query( apply_filters( 'loprd_blog_shortcode', $query_args ) );

	$i = 1;

	if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post();
	
		$blog_layout = $creativa_options['opt-blog-style'];

	  	if ($display_media == 'hide-media' || $allow_media_styles == 'hide') {
	  		// $creativa_options['opt-blog-display-media'] = 1;
	  		creativa_get_options('opt-blog-display-media', 1);
	  	}

		$creativa_options = creativa_get_options();
		$standard_media_style = $creativa_options['opt-blog-display-media'];

		$format = get_post_format();

		if ($display_media == 'display-media') {
				
			if ($columns == 1) {
				$creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
				$creativa_image_th[1] = creativa_thumbnail_size(1, 450);

				if ($format == 'gallery' || $format == 'image') {
					$creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
					$creativa_image_th[1] = creativa_thumbnail_size(1, 0);
				}
			} else {
				$creativa_image_th[0] = creativa_thumbnail_size(0, 600);
				$creativa_image_th[1] = creativa_thumbnail_size(1, 0);

				if ($format == 'gallery') {
					$creativa_image_th[0] = creativa_thumbnail_size(0, 600);
					$creativa_image_th[1] = creativa_thumbnail_size(1, 400);
				}
				
				if ($rp_style == 'grid' || $rp_style == 'carousel' ) {
					$creativa_image_th[0] = creativa_thumbnail_size(0, 600);
					$creativa_image_th[1] = creativa_thumbnail_size(1, 400);
				}
			}

			if (has_post_thumbnail() && !post_password_required() && $allow_media_styles == 'show' ) {

			    if ($standard_media_style == 1) {
			      	$blog_media_class = 'blog-media-standard ';
			    }
			    elseif ($standard_media_style == 2 ) {
			    	if ($columns == 1) {
		      			$blog_media_class = 'blog-media-portrait ';
				      	$creativa_image_th[0] = creativa_thumbnail_size(0, 380);
				      	$creativa_image_th[1] = creativa_thumbnail_size(1, 415);
			    	} else {
			      	  	$blog_media_class = 'blog-media-standard ';
			    	}
		
			      	if (has_post_format('quote') || has_post_format('link')) {
			      	  	$blog_media_class = 'blog-media-standard ';
			      	}
			    }
			    elseif ($standard_media_style == 3) {
			      	$blog_media_class = 'blog-media-bg ';
			    }
			} else {
			    $blog_media_class = 'blog-media-standard ';
			}

			$hpth = '';
			if (has_post_thumbnail() && post_password_required()) {
			  	$hpth = 'has-post-thumbnail ';
			}
		} else {
			$hpth = '';
			$blog_media_class = 'blog-media-standard ';
		}

		if ($display_author == 'display-author') { 
		  $blog_media_class .= ' shows-author';
		}

	?>


	  	<div class="<?php echo esc_attr($column_class) ?>">  	

			<!-- Blog Post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class($hpth . $blog_media_class); ?> <?php echo ''.($standard_media_style != 3) ? $title_color_style : '';  ?>>

			  	<?php 	
					
			   	if ($display_media == 'display-media') {
				   	get_template_part( 'includes/post-layout/post-media/media', get_post_format() ); 
			   	}
			      
			  	?>

			  	<div class="post-content-wrap">
			  		<div class="post-content-inner">

					    <div class="blog-header">
					    	<?php if ($display_categories == 'display-categories' || $display_date == 'display-date' || $display_comments == 'display-comments') { ?>
					    	<div class="entry-info" <?php echo ''.($standard_media_style != 3 || $format == 'link' || $format == 'quote') ? $text_color_style : ''; ?>>
					    		<?php if ($display_categories == 'display-categories') { ?>
					    			<span class="single__entry-info--categories"><?php the_category(',&nbsp;'); ?></span>
					    		<?php } //endif display_categories ?>
					    		<?php if ($display_date == 'display-date') { ?>
						    		<a href="<?php the_permalink(); ?>">
						    			<span class="post-date font-secondary"><?php the_time(get_option('date_format')); ?></span>
						    		</a>
					    		<?php } //endif display_date ?>
					    		<?php if ($display_comments == 'display-comments') {
						    		    if (comments_open() && !post_password_required()) { 
	                 						echo ''.($display_date == 'display-date') ? '&middot; ' : '';
							    		    echo '<a class="comments-link font-secondary" href="'. get_comments_link( get_the_ID() ) .'"> Comments: ';
							    		    echo '<span class="comments-number">';
							    		      comments_number('0', '1', '%');
							    		    echo '</span></a>';
						    		    }
					    		    } //endif display_comments
					    		?>
					    	</div>

					    	<?php } //endif entry-info ?>

					    	<h2 class="post-title <?php echo esc_attr($title_size) ?>"><a href="<?php the_permalink(); ?>" <?php echo ''.($standard_media_style != 3) ? $title_color_style : '';  ?>><?php the_title(); ?></a></h2>

					    </div>

					    <div class="blog-content" <?php echo ''.($standard_media_style != 3) ? $text_color_style : ''; ?>>

					        <?php 
					        if ($display_content == 'display-content') {
						        $subtitle_text = $creativa_options['opt-single-subtitle'];
						        $subtitle_text_excerpt = $creativa_options['opt-single-subtitle-display'];

						        if (!post_password_required()) {
							        if (!empty($subtitle_text) && $subtitle_text_excerpt == 1) {
							          	echo wpautop($subtitle_text);
							          	echo '<a href="'. get_permalink() .'" class="more-link btn btn-default btn-sm">'. esc_html__('Continue Reading', 'creativa') .'</a>';
							        } else {
							        	if ($creativa_options['opt-blog-page-style'] != 3) {
								          	if (!post_password_required() && $content_settings == 'content-excerpt' ) {
								          	  the_excerpt();
								          	} else {
								          	  the_content(__('Continue Reading', 'creativa'));
								          	}
							          	}
							        }
						        } else {
						          echo get_the_password_form();
						        }
					        }
					        ?>

					    </div>

					    <?php if ($display_author == 'display-author') { ?>
						    <div class="entry-by">
						      	<span class="entry-avatar"><?php echo get_avatar(  get_the_author_meta('ID'), 25 ); ?></span>
						      	<?php esc_html_e('by ', 'creativa'); ?>
						      	<span class="entry-author"><?php the_author_posts_link(); ?></span>					    </div>
					    <?php } ?>
					    
				    </div>
			  	</div>

			</article><!-- Blog Post End -->

		</div>

	<?php 	
	if ($rp_style != 'masonry') {
		if($i % $columns == 0 && $i !== $query->post_count  ) : ?>
			</div>
			<div class="row shortcode-posts--row rsContent">
		<?php endif; $i++; 
	} 
	?>  
	 
	<?php endwhile;	else : ?>

		<div class="col-md-12">
			<article id="post-<?php the_ID(); ?>" <?php post_class('no-posts'); ?>>
			  	<h2><?php esc_html_e('No posts were found.', 'creativa'); ?></h2>
			</article>
		</div>

	<?php endif; wp_reset_postdata();?>

	</div>
</div>