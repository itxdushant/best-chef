<?php 

$creativa_options = creativa_get_options();
$content_width = creativa_get_content_width();

$project_link = $creativa_options['opt-project-link'];
$project_link_url = $creativa_options['opt-project-link-url'];
$project_link_target = $creativa_options['opt-project-link-target'];


?>

<div class="content project-details sidebar-right project-layout--wide">

  <div class="project-slider--content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <!-- project-slider -->
          <div class="project-slider--wide royalSlider rsCreativa rsNavOuter rsNavLarge">

            <?php if ($post->post_content) { ?>
            <div class="rsContent">
              <div class="slider__inner--wrap section"><div class="slider__inner--container">
       
                <div class="row">
                  <div class="col-md-12">

                    <div class="project__description">
                      <?php the_content(); ?>
                    </div>
                  </div>
                </div>

              </div></div>
            </div> <!-- rsContent End -->
            <?php } // endif has content ?>

            <?php if ($project_link != 3) { ?>

            <?php // rsContent gallery

              $project_gallery = $creativa_options['opt-meta-project-gallery']; 
              $project_attachments = explode(',', $project_gallery);

              if ($project_gallery) {

                $image_w = round($content_width, 0);
                $image_h = '';

                foreach ($project_attachments as $project_attachment) {
                  echo '<div class="rsContent">'; // slider container
                  echo '<div class="row"><div class="col-md-12">'; // bootstrap container
                  echo '<div class="slider__inner--wrap section"><div class="slider__inner--container slider__image-container">'; // inner container
                  $project_video = wp_prepare_attachment_for_js( $project_attachment );
                  $check_video = ($project_video['caption'] == '[video]' ? 'data-rsVideo="'. esc_attr(esc_url($project_video['alt'])) .'"' : '');

                        
                  $image_src = wp_get_attachment_image_src($project_attachment, 'full');

                  if (function_exists('aq_resize') && $image_src[1] >= $content_width) {
                    $image = aq_resize( $image_src[0], $image_w, $image_h, true, false );
                  } else {
                    $image = $image_src;
                  }
                  
    
                  echo '<img class="rsImg" src="'. esc_url($image[0]) .'" width="'. esc_attr($image[1]) .'" height="'. esc_attr($image[2]) .'"  alt="'. esc_attr__('Project Gallery Image', 'creativa') .'" '. $check_video .' />';
                  
                  echo '</div></div>'; // inner container end
                  echo '</div></div>'; // bootstrap container end
                  echo '</div>'; // slider container end
                }
              }

            ?>


          </div> <!-- project-slider end -->

          <?php } // endif project link 3 ?>

        </div>
      </div>
    </div>
  </div>

</div>


