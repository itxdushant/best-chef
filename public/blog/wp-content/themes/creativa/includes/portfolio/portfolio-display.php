<?php 
  $creativa_options = creativa_get_options();
  $content_width = creativa_get_content_width();

  if ($creativa_options['opt-portfolio-layout'] == 1) { // 1 column
    $portfolio_layout = 'col-md-12';
    $image_w = round($content_width, 0);
    $image_h = round($content_width / 3, 0);
    $ratio = '3x1';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 2) { // 2 columns
    $portfolio_layout = 'col-sm-6';
    $image_w = round($content_width / 2, 0);
    $image_h = $image_w;
    $ratio = '1x1';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 3) { // 3 columns
    $portfolio_layout = 'col-md-4';
    $image_w = round($content_width / 2, 0);
    $image_h = $image_w;
    $ratio = '1x1';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 4) { // 4 columns
    $portfolio_layout = 'col-md-3';
    $image_w = round($content_width / 2, 0);
    $image_h = $image_w;
    $ratio = '1x1';
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 5) { // masonry

    $masonry_size = $creativa_options['opt-masonry-size'];

    if ($creativa_options['opt-masonry-thumb-size'] == 1) { // small
      $portfolio_layout = ($masonry_size == 1) ? 'col-md-3 masonry__medium' : 'col-md-4 masonry__large';
      $portfolio_layout .= ' col-sm-6 col-xs-6 portfolio_masonry--small';
      $image_w = round($content_width / 2, 0);
      $image_h = $image_w;
      $ratio = '1x1';
    }
    elseif ($creativa_options['opt-masonry-thumb-size'] == 2) { // wide
      $portfolio_layout = ($masonry_size == 1) ? 'col-md-6 masonry__medium' : 'col-md-8 masonry__large';
      $portfolio_layout .= ' col-xs-12 portfolio_masonry--wide';
      $image_w = round($content_width, 0);
      $image_h = $image_w / 2;
      $ratio = '2x1';
    }
    elseif ($creativa_options['opt-masonry-thumb-size'] == 3) { // tall
      $portfolio_layout = ($masonry_size == 1) ? 'col-md-3 masonry__medium' : 'col-md-4 masonry__large';
      $portfolio_layout .= ' col-sm-6 col-xs-6 portfolio_masonry--tall';
      $image_w = round(($content_width / 2), 0);
      $image_h = $image_w * 2;
      $ratio = '1x2';
    }
    elseif ($creativa_options['opt-masonry-thumb-size'] == 4) { // big
      $portfolio_layout = ($masonry_size == 1) ? 'col-md-6 masonry__medium' : 'col-md-8 masonry__large';
      $portfolio_layout .= ' col-xs-12 portfolio_masonry--big';
      $image_w = round($content_width, 0);
      $image_h = $image_w;
      $ratio = '1x1';
    }
  }
  elseif ($creativa_options['opt-portfolio-layout'] == 10) { // 1 column block
    $portfolio_layout = 'col-md-12';
    $image_w = round($content_width, 0);
    $image_h = $image_w;
    $ratio = '1x1';
  }



  if ($creativa_options['opt-project-layout'] == 1 || $creativa_options['opt-project-layout'] == 3 || $creativa_options['opt-project-layout'] == 4 ) {
    $image_g_w = round($content_width, 0);
    $image_g_h = '';
  } 
  elseif ($creativa_options['opt-project-layout'] == 2) {
    $image_g_w = round($content_width * .75, 0);
    $image_g_h = '';
  } 


  $project_gallery = $creativa_options['opt-meta-project-gallery']; 
  $project_attachments = explode(',', $project_gallery);

  $project_link = $creativa_options['opt-project-link'];

  $project_link_url = $creativa_options['opt-project-link-url'];
  $project_link_target = $creativa_options['opt-project-link-target'];
    
  $project_link_href = '';

  if ($project_link == 1) {
    $project_link_href = get_permalink();
  }  
  if ($project_link == 2) {

    if (has_post_thumbnail() || !empty($project_gallery)) {

      $project_link_href = '#';

      if (!empty($project_gallery)) {

        $i = 0;
        foreach ($project_attachments as $project_attachment) {

          $image_caption = wp_prepare_attachment_for_js( $project_attachment );

          if ($image_caption['caption'] == '[video]' && !empty($image_caption['alt'])) {
            $project_image_url[0] = $image_caption['alt'];
            $project_class = 'mfp-iframe';
          }
          else {
            $img_url = wp_get_attachment_image_src($project_attachment, 'full');

            if (function_exists('aq_resize') && $img_url[1] >= $content_width) {
              $project_image_url = aq_resize( $img_url[0], $image_g_w, $image_g_h, true, false);
            } else {
              $project_image_url = $img_url;
            }

            $project_class = 'mfp-image';
          }

          if ($i == 0) {
            $project_link_href = $project_image_url[0];
            $project_link_atts = 'class="portfolio__a--gallery gallery-id-'. get_the_ID() .' '.$project_class.'" data-id="'. get_the_ID() .'" data-effect="mfp-zoom-in" title="'. get_the_title() .'"';
          }

          $i++;
        }
      } else {
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_image_src($thumb, 'full');

        if (function_exists('aq_resize') && $img_url[1] >= $content_width) {
          $image = aq_resize( $img_url[0], $image_g_w, $image_g_h, true, false);
        } else {
          $image = $img_url;
        }
        $project_src = $image[0];
        $project_class = 'mfp-image';
        $project_link_href = $image[0];
        $project_link_atts = 'class="portfolio__a--gallery gallery-id-'. get_the_ID() .' '.$project_class.'" data-id="'. get_the_ID() .'" data-effect="mfp-zoom-in" title="'. get_the_title() .'"';
      }
    }
  }
  elseif ($project_link == 3) {
    if (!empty($project_link_url)) {
      $project_link_href = $project_link_url;
    } else {
      $project_link_href = '#';
    }
  }

 

?>

<?php
  $terms = get_the_terms( get_the_ID() , 'portfolio_category' );

  $isotope_item_categories = '';
  if (!empty($terms)) {

    foreach ( $terms as $term ) {
      $isotope_item_categories .= $term->slug .' ';
    }

  }
?>

<!-- Portfolio item -->
<?php 
  $like_count = get_post_meta( get_the_ID(), "_post_like_count", true );
?>

<div <?php post_class(esc_attr($portfolio_layout) . ' ' . esc_attr($isotope_item_categories)) ?> data-likes="<?php echo (!empty($like_count)) ? esc_attr($like_count) : 0;  ?>" data-views="<?php echo esc_attr(creativa_get_post_count(get_the_ID())) ?>">

  <div class="portfolio-item">
    <a href="<?php echo esc_url($project_link_href) ?>" <?php if ($project_link == 3 && $project_link_target == true ) echo 'target="_blank"'; ?> <?php if ($project_link == 2) echo ''.$project_link_atts; // var escaped ?>>

      <figure class="portfolio_image-container">
        <?php
        $project_gallery = $creativa_options['opt-meta-project-gallery']; 
      
        $project_attachments = explode(',', $project_gallery);

        if (has_post_thumbnail()) { 
          $thumb = get_post_thumbnail_id();
          $img_url = wp_get_attachment_url( $thumb, 'full' ); //get full URL to image (use "large" or "medium" if the images too big)

          if (function_exists('aq_resize')) {
            $image = aq_resize( $img_url, $image_w, $image_h, true, false, true ); //resize & crop the image
          } else {
            $image = wp_get_attachment_image_src($thumb, 'creativa-large');
          }

          if($image) {
            echo '<img class="project-thmb '.creativa_retina_check($image[0], false).'" src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Project Gallery Thumbnail', 'creativa') .'" />';
          }
        }
        elseif ($project_gallery) {
          $img_url = wp_get_attachment_image_src($project_attachments[0], 'full');

          if (function_exists('aq_resize') && $img_url[1] >= $content_width) {
            $image = aq_resize( $img_url[0], $image_w, $image_h, true, false);
          } else {
            $image = $img_url;
          }          

          if($image) {
            echo '<img class="project-thmb '.creativa_retina_check($image[0], false).'" src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'" alt="'. esc_attr__('Project Gallery Thumbnail', 'creativa') .'" />';
          }
        }

        ?>
      </figure>

      <div class="portfolio_hover">

        <div class="portfolio_hover--meta">
        
          <?php if ($creativa_options['opt-porfolio-item-categories'] == 1 ) { ?>
            <?php if (!empty($terms)) { ?>
            <div class="portfolio-item__cats"><?php
                foreach ( $terms as $term ) {
                  echo '<span class="portfolio-cat">'. esc_html($term->name) . '</span>';
                }
              ?></div>
            <?php } ?>
          <?php } ?>
          
          <h3 class="portfolio-item__title"><?php the_title(); ?></h3>

        </div>
      </div> <!-- end porfolio hover -->
    </a>
    <?php 

    if ($project_link == 2) { 
      if (!empty($project_gallery)) {

        $i = 0;
        foreach ($project_attachments as $project_attachment) {

          $image_caption = wp_prepare_attachment_for_js( $project_attachment );

          if ($image_caption['caption'] == '[video]' && !empty($image_caption['alt'])) {
            $project_image_url[0] = $image_caption['alt'];
            $project_class = 'mfp-iframe';
          }
          else {
            $img_url = wp_get_attachment_image_src($project_attachment, 'full');

            if ($img_url[1] >= $content_width) {
              $project_image_url = aq_resize( $img_url[0], $image_g_w, $image_g_h, true, false);
            } else {
              $project_image_url = $img_url;
            }
            $project_class = 'mfp-image';
          }

          if ($i != 0) {
            echo '<a href="'.esc_url($project_image_url[0]).'" class="portfolio__a--gallery hidden gallery-id-'. get_the_ID() .' '.esc_attr($project_class).'" data-id="'.get_the_ID().'" data-effect="mfp-zoom-in" title="'.get_the_title().'"></a>';
          }

          $i++;
        }
      }
    }
    ?>

    <?php 

    if ($creativa_options['opt-quick-view'] == 1 && (has_post_thumbnail() || !empty($project_gallery))) {

      $image_caption = wp_prepare_attachment_for_js( $project_attachments[0] );

      if ($project_gallery) {
        if ($image_caption['caption'] == '[video]' && !empty($image_caption['alt'])) {
          $project_src = $image_caption['alt'];
          $project_class = 'mfp-iframe';
        }
        else {
          //$project_src = $project_attachment['url'];                
          $img_url = wp_get_attachment_image_src($project_attachments[0], 'full');

          if (function_exists('aq_resize') && $img_url[1] >= $content_width) {
            $image = aq_resize( $img_url[0], $image_g_w, $image_g_h, true, false);
          } else {
            $image = $img_url;
          }

          $project_src = $image[0];
          $project_class = 'mfp-image';
        }
      } 
      else {        
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_image_src($thumb, 'full');

        if (function_exists('aq_resize') && $img_url[1] >= $content_width) {
          $image = aq_resize( $img_url[0], $image_g_w, $image_g_h, true, false);
        } else {
          $image = $img_url;
        }
        $project_src = $image[0];
        $project_class = 'mfp-image';
      }
    }

    ?>

    <?php if (($creativa_options['opt-quick-view'] == 1 && (has_post_thumbnail() || !empty($project_gallery))) || ($creativa_options['opt-like-button'] == 1)) { ?>

    <div class="portfolio_info">
      <?php if ($project_link == 1 && $creativa_options['opt-quick-view'] == 1 && (has_post_thumbnail() || !empty($project_gallery))) { ?>
        <a href="<?php echo esc_url($project_src) ?>" class="<?php echo esc_attr($project_class) ?> quick-view info_icon" data-effect="mfp-zoom-in" title="<?php esc_html_e('Quick View - ', 'creativa') . the_title() ?>"><i class="icon_search"></i></a>
      <?php } ?>
      <?php 
        if (function_exists('getPostLikeLink') && $creativa_options['opt-like-button'] == 1) {
          echo getPostLikeLink( get_the_ID() ); 
        }
      ?>
    </div>


    <?php } ?>

  </div>
</div><!-- Portfolio item END -->