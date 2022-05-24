<?php 

$creativa_options = creativa_get_options();
$creativa_image_th = creativa_thumbnail_size();

$standard_media_style = $creativa_options['opt-blog-display-media'];

// blog media
if (has_post_thumbnail() && !post_password_required()) {

  $image_w = (isset($creativa_image_th[0]) && !empty($creativa_image_th[0])) ? $creativa_image_th[0] : '1200';
  $image_h = (isset($creativa_image_th[1]) && !empty($creativa_image_th[1])) ? $creativa_image_th[1] : '';
  $allow_media_styles = (!isset($creativa_image_th[2]) || $creativa_image_th[2] != false) ? true : false;

  // get thumb
  $thumb = get_post_thumbnail_id();

  $image_src = wp_get_attachment_image_src($thumb, 'full');
  if (function_exists('aq_resize') && $image_src[1] >= $image_w && $image_src[2] >= $image_h) {
    $image = aq_resize( $image_src[0], $image_w, $image_h, true, false );
  } else {
    $image = $image_src;
  }
?>

<div class="post-media">

  <?php 
  if (!is_single() && $allow_media_styles == true && $standard_media_style == 3) { ?>
    <?php $image = wp_get_attachment_image_src($thumb, 'full'); ?>
    <div class="blog-media-bg_wrapper" style="background-image: url(<?php echo esc_url($image[0]) ?>);"></div>
    <a href="<?php the_permalink() ?>" class="blog-media-anchor"></a>
  <?php 
  } else {
    if ($image) {
      if (!is_single()) { echo '<a href="'. get_permalink() .'">'; }
      echo '<img src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Post Image', 'creativa') .'" />';
      if (!is_single()) { echo '</a>'; }
    }
  }
  ?>

</div><!-- Blog Media End -->

<?php } ?>

        
        
