<?php 
  $creativa_options = creativa_get_options();
  $creativa_image_th = creativa_thumbnail_size();

  $link = $creativa_options['opt-format-link-url'];
  $link_title = $creativa_options['opt-format-link-url-title'];

  $allow_media_styles = (!isset($creativa_image_th[2]) || $creativa_image_th[2] != false) ? true : false;
  
  $thumb = get_post_thumbnail_id();
  $image_src = wp_get_attachment_image_src($thumb, 'creativa-large');
  $image = $image_src;

// blog media
if (!post_password_required()) { ?>

<div class="post-media">

  <?php 
    $link_url = '#';
    $link_title_output = '';

    if (!empty($link)) {
      $link_url = $link;

        if (!empty($link_title)) {
          $link_title_output = $link_title;
        } else {
          $link_title_output = $link;
        }

    } else {
      $link_title_output = esc_html__('Add link here', 'creativa');
    }

  ?>

  <h2 class="post-title--link">
    <!-- <i class="icon_link_alt"></i> -->
    <a href="<?php echo esc_url($link_url) ?>"><?php echo esc_html($link_title_output) ?></a>
  </h2>
    <?php 
      if (!empty($link) && !empty($link_title)) {
        echo '<span class="link-url-span"><a href="'. esc_url($link) .'">'. esc_html($link) .'</a></span>';
      }
    ?>

  <?php if (has_post_thumbnail() && !post_password_required() && $allow_media_styles == true && $creativa_options['opt-blog-display-media'] == 3) { 
    ?> 
    <?php //if (!is_single()) { ?>
      <div class="blog-media-bg_wrapper" style="background-image: url(<?php echo esc_url($image[0]) ?>);"></div>
    <?php // } ?>
  <?php } ?>

</div><!-- Blog Media End -->

<?php } ?>

        
        
