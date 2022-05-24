<?php 
  $creativa_options = creativa_get_options();
  $creativa_image_th = creativa_thumbnail_size();

  $quote = $creativa_options['opt-format-quote-content'];
  $quote_author = $creativa_options['opt-format-quote-author'];

  $allow_media_styles = (!isset($creativa_image_th[2]) || $creativa_image_th[2] != false) ? true : false;

// blog media
if (!post_password_required()) { ?>

<div class="post-media">

  <blockquote>
    <p class="h3-size"><?php if (!empty($quote)) {echo esc_html($quote); } else {_e('Quote here', 'creativa'); } ?></p> 
    <?php if (!empty($quote_author)) { ?>
      <footer><?php echo esc_html($quote_author) ?></footer>
    <?php } ?>
  </blockquote>

  <?php if (has_post_thumbnail() && !post_password_required() && $allow_media_styles == true && $creativa_options['opt-blog-display-media'] == 3) { 

    $thumb = get_post_thumbnail_id();
    $image_src = wp_get_attachment_image_src($thumb, 'creativa-large');
    $image = $image_src;
    ?> 
    <?php // if (!is_single()) { ?>
      <div class="blog-media-bg_wrapper" style="background-image: url(<?php echo esc_url($image[0]) ?>);"></div>
    <?php // } ?>
  <?php } ?>

</div><!-- Blog Media End -->

<?php } ?>

        
        
