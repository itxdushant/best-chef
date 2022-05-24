<?php 

$creativa_options = creativa_get_options();
$content_width = creativa_get_content_width();

$project_link = $creativa_options['opt-project-link'];
$project_link_url = $creativa_options['opt-project-link-url'];
$project_link_target = $creativa_options['opt-project-link-target'];

?>

<div class="content project-details section single--section sidebar-right project-layout--large">

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <?php if ($project_link == 3 && !empty($project_link_url)) { ?>
          <h3 class="single__portfolio__url">
            <a href="<?php echo esc_url($project_link_url) ?>" <?php if ($project_link_target == true) echo 'target="_blank"'; ?>><?php echo esc_html($project_link_url) ?></a>
          </h3>
        <?php } ?>

        <?php if ($project_link != 3) { ?>

        <?php 
          if ($creativa_options['opt-project-image-gallery'] == 1) {
            $project_gallery_style = 'image-slider royalSlider rsCreativa rsNavInner rsArrowHover rsNavLarge';
          }
          elseif ($creativa_options['opt-project-image-gallery'] == 2) {
            $project_gallery_style = 'project-image-inline';
          }
        ?>

        <div class="project__description">
          <?php the_content(); ?>
        </div>

        <?php 

          $project_gallery = $creativa_options['opt-meta-project-gallery']; 
          $project_attachments = explode(',', $project_gallery);

          if ($project_gallery) {
            echo '<div data-nav="nav_bullets" class="project-gallery '. $project_gallery_style. '" data-autoplay="0">';

              $image_w = round($content_width, 0);
              $image_h = '';

              foreach ($project_attachments as $project_attachment) {
                echo '<div class="rsContent">'; 
                $project_video = wp_prepare_attachment_for_js( $project_attachment );
                $check_video = ($project_video['caption'] == '[video]' ? 'data-rsVideo="'. esc_attr(esc_url($project_video['alt'])) .'"' : '');

                      
                $image_src = wp_get_attachment_image_src($project_attachment, 'full');

                if (function_exists('aq_resize') && $image_src[1] >= $content_width) {
                  $image = aq_resize( $image_src[0], $image_w, $image_h, true, false );
                } else {
                  $image = $image_src;
                }
                
                if ($creativa_options['opt-project-image-gallery'] == 2 && $project_video['caption'] == '[video]') {
                  echo '<div class="fit-vid">';
                  $video_link = $project_video['alt'];
                  echo creativa_convert_videos(esc_url($video_link));
                  echo '</div>';
                } 
                else {
                  echo '<img class="rsImg" src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'"  alt="'. esc_attr__('Project Gallery Image', 'creativa') .'" '. $check_video .' />';
                }
                
       
                echo '</div>';
              }

            echo '</div>';
          }

        ?>

        <?php } // endif project link 3 ?>

      </div> <!-- section end -->
    </div>
  </div>

</div>


