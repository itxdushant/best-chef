<?php 
  $creativa_options = creativa_get_options();
  $creativa_image_th = creativa_thumbnail_size();

  $audio_link = '';
  if (isset($creativa_options['opt-format-audio-mp3']['url'])) {
    $audio_link = $creativa_options['opt-format-audio-mp3']['url'];
  }
  $audio_embeed = $creativa_options['opt-format-audio-embed'];
  $standard_media_style = $creativa_options['opt-blog-display-media'];


// blog media
if ((has_post_thumbnail() || !empty($audio_link) || !empty($audio_embeed)) && !post_password_required()) {
  global $creativa_options;

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

    if (!empty($audio_link) || !empty($audio_embeed)) {
      if (has_post_thumbnail() && $standard_media_style == 3 && $allow_media_styles == true) {
        $image = wp_get_attachment_image_src($thumb, 'full');
        echo '<div class="post-media-bg-icon"><a href="'. get_permalink() .'" title="'. esc_html__('Click to listen Audio', 'creativa') .'"><i class="icon_headphones"></i></a></div>';
        echo '<div class="blog-media-bg_wrapper" style="background-image: url('.esc_url($image[0]).');"></div>';
        echo '<a href="'. get_permalink() .'" class="blog-media-anchor"></a>';
      } else {

        echo '<div class="fit-vid">';
        
        if ($creativa_options['opt-format-audio-type'] == 2 && !empty($audio_link)) {

          $audio_oga = $creativa_options['opt-format-audio-oga']['url'];
          $song_author = $creativa_options['opt-format-audio-author'];
          $song_title = $creativa_options['opt-format-audio-title'];

          if ($audio_link) { ?>
               
            <!-- JPLAYER -->
            <div id="jplayer-audio-<?php echo get_the_ID(); ?>"></div>

            <div class="audio-player">
              <div class="jp-interface">
                <div id="jp_container_1">

                  <div class="jp-cover">                
                    <?php if (has_post_thumbnail()) { ?>
                      <div class="jp-cover-inner" style="background-image: url(<?php echo esc_url($image[0]) ?>);"></div>
                    <?php } ?>
                  </div>

                  <div class="jp-meta">
                    <div class="play-pause">
                      <a href="javascript:;" class="jp-play" tabindex="1"><i class="arrow_triangle-right"></i></a>
                      <a href="javascript:;" class="jp-pause" tabindex="1"><i class="icon_pause"></i></a>
                    </div>

                    <div class="jp-author">
                      <div class="song-author"><?php echo (!empty($song_author)) ? esc_html($song_author) : esc_html__('Author', 'creativa') ; ?></div>
                      <span class="separator">-</span>
                      <div class="song-title"><?php echo (!empty($song_title)) ? esc_html($song_title) : esc_html__('Song Title', 'creativa') ; ?></div>
                    </div>

                    <div class="jp-time">
                      <div class="jp-current-time"></div>
                      <span class="separator">/</span>
                      <div class="jp-duration"></div>
                    </div>

                    <div class="jp-volume">
                      <a href="javascript:;" class="jp-mute" tabindex="2" title="mute"><i class="icon_volume-high_alt"></i></a>
                      <a href="javascript:;" class="jp-unmute" tabindex="2" title="unmute"><i class="icon_vol-mute_alt"></i></a>
                      <!--volume bar-->
                      <div class="jp-volume-bar">
                          <div class="jp-volume-bar-value"></div>
                      </div>
                    </div>

                    <div class="jp-progress">
                      <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                      </div>
                    </div>

                  </div>
                </div>   
              </div>  

            </div>   

            <script type="text/javascript">
              (function($) {
                "use strict";
              
                $("#jplayer-audio-<?php echo get_the_ID(); ?>").jPlayer({
                  ready: function(event) {
                    $(this).jPlayer("setMedia", {
                      mp3: "<?php echo esc_url($audio_link) ?>",
                      oga: "<?php echo esc_url($audio_oga) ?>"
                    });
                  },
                  swfPath: "http://jplayer.org/latest/js",
                  supplied: "mp3"
                });   

              })(jQuery);          
            </script>
            <!-- JPLAYER END -->

          <?php   } // endif mp3 file not empty 

        } 
        elseif ($creativa_options['opt-format-audio-type'] == 1 && !empty($audio_embeed)) {          
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

            echo wp_kses($creativa_options['opt-format-audio-embed'], $allowed_tags);
        } 

        echo '</div>';
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
    if (!empty($audio_link) || !empty($audio_embeed)) {

      echo '<div class="fit-vid">';
        
        if ($creativa_options['opt-format-audio-type'] == 2 && !empty($audio_link)) {

          $audio_oga = $creativa_options['opt-format-audio-oga']['url'];
          $song_author = $creativa_options['opt-format-audio-author'];
          $song_title = $creativa_options['opt-format-audio-title'];

          if ($audio_link) { ?>
               
            <!-- JPLAYER -->
            <div id="jplayer-audio-<?php echo get_the_ID(); ?>"></div>

            <div class="audio-player">
              <div class="jp-interface">
                <div id="jp_container_1">

                  <div class="jp-cover">                
                    <?php if (has_post_thumbnail()) { ?>
                      <div class="jp-cover-inner" style="background-image: url(<?php echo esc_url($image[0]) ?>);"></div>
                    <?php } ?>
                  </div>

                  <div class="jp-meta">
                    <div class="play-pause">
                      <a href="javascript:;" class="jp-play" tabindex="1"><i class="arrow_triangle-right"></i></a>
                      <a href="javascript:;" class="jp-pause" tabindex="1"><i class="icon_pause"></i></a>
                    </div>

                    <div class="jp-author">
                      <div class="song-author"><?php echo (!empty($song_author)) ? esc_html($song_author) : esc_html__('Author', 'creativa') ; ?></div>
                      <span class="separator">-</span>
                      <div class="song-title"><?php echo (!empty($song_title)) ? esc_html($song_title) : esc_html__('Song Title', 'creativa') ; ?></div>
                    </div>

                    <div class="jp-time">
                      <div class="jp-current-time"></div>
                      <span class="separator">/</span>
                      <div class="jp-duration"></div>
                    </div>

                    <div class="jp-volume">
                      <a href="javascript:;" class="jp-mute" tabindex="2" title="mute"><i class="icon_volume-high_alt"></i></a>
                      <a href="javascript:;" class="jp-unmute" tabindex="2" title="unmute"><i class="icon_vol-mute_alt"></i></a>
                      <!--volume bar-->
                      <div class="jp-volume-bar">
                          <div class="jp-volume-bar-value"></div>
                      </div>
                    </div>

                    <div class="jp-progress">
                      <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                      </div>
                    </div>

                  </div>
                </div>   
              </div>  

            </div>   

            <script type="text/javascript">
              (function($) {
                "use strict";
              
                $("#jplayer-audio-<?php echo get_the_ID(); ?>").jPlayer({
                  ready: function(event) {
                    $(this).jPlayer("setMedia", {
                      mp3: "<?php echo esc_url($audio_link) ?>",
                      oga: "<?php echo esc_url($audio_oga) ?>"
                    });
                  },
                  swfPath: "http://jplayer.org/latest/js",
                  supplied: "mp3"
                });   

              })(jQuery);          
            </script>
            <!-- JPLAYER END -->

          <?php   } // endif mp3 file not empty 

        } 
        elseif ($creativa_options['opt-format-audio-type'] == 1 && !empty($audio_embeed)) {          
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

            echo wp_kses($creativa_options['opt-format-audio-embed'], $allowed_tags);
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




