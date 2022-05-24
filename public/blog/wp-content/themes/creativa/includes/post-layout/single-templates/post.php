<?php 

$creativa_options = creativa_get_options();
$creativa_image_th = creativa_thumbnail_size();
$content_width = creativa_get_content_width();

// Sidebar position
if ($creativa_options['opt-blog-page-style'] == 1) {
  $section_class = 'col-md-9 sidebar-content';
  $sidebar_class = 'col-md-3';
  $content_class = 'sidebar-right';
}
elseif ($creativa_options['opt-blog-page-style'] == 2) {
  $section_class = 'col-md-9 col-md-push-3 sidebar-content';
  $sidebar_class = 'col-md-3 col-md-pull-9';
  $content_class = 'sidebar-left';
}

$standard_media_style = $creativa_options['opt-blog-display-media'];
$allow_media_styles = $creativa_options['opt-allow-media-styles'];

$blog_media_class = 'single-blog-media-standard ';
if (has_post_thumbnail() && !post_password_required()) {
  if ($standard_media_style == 1) {
    $blog_media_class = 'single-blog-media-standard ';
  }
  if ($standard_media_style == 2 ) {
    $blog_media_class = 'single-blog-media-portrait ';

    if (has_post_format('quote') || has_post_format('link')) {
      $blog_media_class = 'single-blog-media-standard ';
    }
  }
  if ($standard_media_style == 3) {
    $blog_media_class = 'single-blog-media-bg ';
  }
}

//thumbnail sizes 
$standard_media_style = $creativa_options['opt-blog-display-media'];  
$post_format = get_post_format();
if ( $standard_media_style == 1 || $standard_media_style == 3 ) { // blog-media-standard OR blog-media-bg
    $creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
    $creativa_image_th[1] = creativa_thumbnail_size(1, 450);

    if ($post_format == 'gallery' || $post_format == 'image') {
      $creativa_image_th[1] = creativa_thumbnail_size(1, 0);;
    }
} 
elseif ( $standard_media_style == 2 ) { // blog-media-portrait
    $creativa_image_th[0] = ($post_format == 'gallery') ? creativa_thumbnail_size(0, $content_width) : creativa_thumbnail_size(0, 380);
    $creativa_image_th[1] = ($post_format == 'gallery') ? creativa_thumbnail_size(1, 0) : creativa_thumbnail_size(1, 415);
}

if ($allow_media_styles == 0) {
  $creativa_image_th[2] = false;
}

?>

<div class="content single--section section <?php if (isset($content_class)) echo esc_attr($content_class); ?> <?php echo esc_attr($blog_media_class); ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="post-content <?php echo esc_attr($section_class); ?>">
		<div class="row">			<div class="col-md-12">				<div class="single__title--wrap">				  <div class="entry-info">					
		 <span class="post-date font-secondary">
		<?php the_time(get_option('date_format')); ?></span>
		
		
										  </div>				  <?php 				  if ($creativa_options['opt-single-display-media'] == 1 && $standard_media_style != 2) {					get_template_part( 'includes/post-layout/post-media/media', get_post_format() ); 				  }				  ?>				  <?php					$subtitle_content = $creativa_options['opt-single-subtitle'];					if (!empty($subtitle_content)) {				  ?>				  <div class="single__post-subtitle">					<hr/>					<?php echo wpautop($subtitle_content); ?>				  </div>				  <?php } // endif subtitle content ?>				</div>			</div>		</div>
        <?php 
        if ($creativa_options['opt-single-display-media'] == 1 && $standard_media_style == 2) {
          get_template_part( 'includes/post-layout/post-media/media', get_post_format() ); 
        }
        ?>

        <?php
          $subtitle_content = $creativa_options['opt-single-subtitle'];

          if (!empty($subtitle_content)) {
        ?>

        <div class="single__post-subtitle for-readers">
          <?php echo wpautop($subtitle_content); ?>
          <hr/>
        </div>

        <?php } // endif subtitle content ?>

        <?php if (!post_password_required() ) { 
           
           the_content();
    
           $args = array(
            'before'           => '<ul class="wp_link_pages"><li><span>',
            'after'            => '</span></li></ul>',
            'link_before'      => '',
            'link_after'       => '',
            'next_or_number'   => 'number',
            'separator'        => '</span></li><li><span>',
            'pagelink'         => '%',
            'echo'             => 1
             );

             wp_link_pages( $args ); ?>


        <?php } ?>

      </div>

      <div class="single-post-info <?php echo esc_attr($sidebar_class);  ?>">

        <?php if ($creativa_options['opt-share-buttons'] == 1) { ?>
        <div class="post-info">
          <div class="single-posts-shares">
            <div class="shares-count">
              <h6><?php esc_html_e('Shares', 'creativa') ?></h6>
            </div>
            <ul class="shares-list">
              <li><?php echo getPostLikeLink( get_the_ID() ); ?></li>
              <li class="get-share"><a class="share-facebook" data-service="facebook" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li class="get-share"><a class="share-twitter" data-service="twitter" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li class="get-share"><a class="share-google-plus" data-service="google" title="Google+" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li class="get-share"><a class="share-linkedin" data-service="linkedin" title="LinkedIn" href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
        <?php } ?>  


   
        <?php if ($creativa_options['opt-tags'] == 1) {
         if (has_tag()) : ?>        

         <div class="post-info">
          <div class="post-tags">
            <?php the_tags("", ""); ?>
          </div>
        </div>    
          
        <?php endif;
        } ?>

        <?php if (is_active_sidebar( 'single-post-sidebar' )) { ?>
          <div class="single-post__widgets">
            <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('single-post-sidebar') ) : ?>   
            <?php endif; ?> 
          </div>
        <?php } ?>

      </div>

    </div>
  </div>
</div>
