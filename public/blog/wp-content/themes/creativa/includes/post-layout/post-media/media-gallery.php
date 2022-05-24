<?php 
  $creativa_options = creativa_get_options();
  $creativa_image_th = creativa_thumbnail_size();

  $post_gallery = $creativa_options['opt-meta-post-gallery'];
  $standard_media_style = $creativa_options['opt-blog-display-media'];

// blog media
if ((has_post_thumbnail() || !empty($post_gallery) ) && !post_password_required()) {

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

    if (!empty($post_gallery)) {
      if (has_post_thumbnail() && $standard_media_style == 3 && $allow_media_styles == true) {
        $post_gallery_attachments = explode(',', $post_gallery);
        $images_number = count($post_gallery_attachments);
        $image = wp_get_attachment_image_src($thumb, 'full');
        echo '<div class="post-media-bg-icon"><a href="'. get_permalink() .'" title="'. esc_html__('Click to see Gallery', 'creativa') .'"><i class="icon_images"></i> '. esc_html($images_number) .'</a></div>';
        echo '<div class="blog-media-bg_wrapper" style="background-image: url('.esc_url($image[0]).');"></div>';
        // echo '<div class="blog-media-bg_wrapper"></div>';
        echo '<a href="'. get_permalink() .'" class="blog-media-anchor"></a>';
      } else {

        $post_gallery_attachments = explode(',', $post_gallery);
        if ($post_gallery_attachments) {
          echo '<div class="image-slider royalSlider rsCreativa rsNavInner rsArrowHover" data-autoplay="0" data-transiton="move">';
          foreach ($post_gallery_attachments as $post_gallery_attachment) {
            echo '<div class="rsContent">'; 
            $image_src = wp_get_attachment_image_src($post_gallery_attachment, 'full');
            if (function_exists('aq_resize') && (($image_src[1] >= $image_w && $image_src[2] >= $image_h) || $creativa_options['opt-blog-style'] == 2)) {
              $image = aq_resize( $image_src[0], $image_w, $image_h, true, false );
            } else {
              $image = $image_src;
            }
            if($image) {
              echo '<img src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Post Image', 'creativa') .'" />';
            }
            echo wp_get_attachment_image( $post_gallery_attachment, 'thumbnail', '', array('class' => 'attachment-thumbnail rsTmb'));
            echo '</div>';
          }
          echo '</div>';
        }
      }
    } else {

      if ($standard_media_style == 3 && $allow_media_styles == true) { 
        $image = wp_get_attachment_image_src($thumb, 'full');
        echo '<div class="blog-media-bg_wrapper" style="background-image: url('.esc_url($image[0]).');"></div>';
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

    if (!empty($post_gallery)) {
      $post_gallery_attachments = explode(',', $post_gallery);
      if ($post_gallery_attachments) {
        echo '<div class="image-slider royalSlider rsCreativa rsNavInner rsArrowHover" data-autoplay="0" data-transiton="move">';
        foreach ($post_gallery_attachments as $post_gallery_attachment) {
          echo '<div class="rsContent">'; 
          $image_src = wp_get_attachment_image_src($post_gallery_attachment, 'full');
          if (function_exists('aq_resize') && $image_src[1] >= $image_w && $image_src[2] >= $image_h) {
            $image = aq_resize( $image_src[0], $image_w, $image_h, true, false );
          } else {
            $image = $image_src;
          }
          if($image) {
            echo '<img src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Post Image', 'creativa') .'" />';
          }
          echo wp_get_attachment_image( $post_gallery_attachment, 'thumbnail', '', array('class' => 'attachment-thumbnail rsTmb'));
          echo '</div>';
        }
        echo '</div>';
      }
    } else {
      if($image) {
        echo '<img src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Post Image', 'creativa') .'" />';
      }
    }
    
  }

 ?>

</div><!-- Blog Media End -->

<?php } ?>

  


