<?php 
  $creativa_options = creativa_get_options();
  $creativa_image_th = creativa_thumbnail_size();

  $video_link = $creativa_options['opt-format-video-url'];
  $video_embeed = $creativa_options['opt-format-video-embed'];
  $standard_media_style = $creativa_options['opt-blog-display-media'];

// blog media
if ((has_post_thumbnail() || !empty($video_link) || !empty($video_embeed)) && !post_password_required()) {
 
  $image_w = (isset($creativa_image_th[0]) && !empty($creativa_image_th[0])) ? $creativa_image_th[0] : '1200';
  $image_h = (isset($creativa_image_th[1]) && !empty($creativa_image_th[1])) ? $creativa_image_th[1] : '';
  $allow_media_styles = (!isset($creativa_image_th[2]) || $creativa_image_th[2] != false) ? true : false;

  // get thumb
  $thumb = get_post_thumbnail_id();
  $img_url = wp_get_attachment_url( $thumb, 'full' ); //get full URL to image (use "large" or "medium" if the images too big)
  if (function_exists('aq_resize')) {
    $image = aq_resize( $img_url, $image_w, $image_h, true, false, true ); //resize & crop the image
  } else {
    $image = wp_get_attachment_image_src($thumb, 'creativa-large');
  }

?>

<div class="post-media">
  <?php 

  if (!is_single()) { // blog-media gallery output

    if (!empty($video_link) || !empty($video_embeed)) {
      if (has_post_thumbnail() && $standard_media_style == 3 && $allow_media_styles == true) {
        $image = wp_get_attachment_image_src($thumb, 'full');
        echo '<div class="post-media-bg-icon"><a href="'. get_permalink() .'" title="'. esc_html__('Click to see Video', 'creativa') .'"><i class="icon_film"></i></a></div>';
        echo '<div class="blog-media-bg_wrapper" style="background-image: url('.esc_url($image[0]).');"></div>';
        echo '<a href="'. get_permalink() .'" class="blog-media-anchor"></a>';
      } else {

        echo '<div class="fit-vid">';
        if ($creativa_options['opt-format-video-type'] == 1 && !empty($video_link)) {
          echo creativa_convert_videos(esc_url($video_link));
        } 
        elseif ($creativa_options['opt-format-video-type'] == 2 && !empty($video_embeed)) {          
          $allowed_tags = array(
            'iframe' => array(
                'align' => array(),
                'width' => array(),
                'height' => array(),
                'frameborder' => array(),
                'name' => array(),
                'src' => array(),
                'id' => array(),
                'class' => array(),
                'style' => array(),
                'scrolling' => array(),
                'marginwidth' => array(),
                'marginheight' => array(),
            ),
          );

          echo wp_kses($video_embeed, $allowed_tags);
        } 
        echo '</div>';
      }
    } else {

      if ($standard_media_style == 3 && $allow_media_styles == true) { 
        $image = wp_get_attachment_image_src($thumb, 'full');
        echo '<div class="blog-media-bg_wrapper" style="background-image: url('.esc_url($image[0]).');"></div>';
        // echo '<div class="blog-media-bg_wrapper"></div>';
        echo '<a href="'. get_permalink() .'" class="blog-media-anchor"></a>';
      } else {
        if($image) {
          echo '<a href="'. get_permalink() .'">';
          echo '<img src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Post Image', 'creativa') .'" />';
          echo '</a>'; 
        }
      }
    }

  } else { // single-post gallery output
    if (!empty($video_link) || !empty($video_embeed)) {

      echo '<div class="fit-vid">';
      
      if ($creativa_options['opt-format-video-type'] == 1 && !empty($video_link)) {

        echo creativa_convert_videos(esc_url($video_link));

      } 
      elseif ($creativa_options['opt-format-video-type'] == 2 && !empty($video_embeed)) {          
        $allowed_tags = array(
          'iframe' => array(
              'align' => array(),
              'width' => array(),
              'height' => array(),
              'frameborder' => array(),
              'name' => array(),
              'src' => array(),
              'id' => array(),
              'class' => array(),
              'style' => array(),
              'scrolling' => array(),
              'marginwidth' => array(),
              'marginheight' => array(),
          ),
        );

        echo wp_kses($video_embeed, $allowed_tags);
      } 

      echo '</div>';

    } else {
      if($image) {
        echo '<img src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Post Image', 'creativa') .'" />';
      }
    }
  }  

  ?>
</div><!-- Blog Media End -->

<?php } ?>




