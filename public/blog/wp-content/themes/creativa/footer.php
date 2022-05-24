<?php 
  global $creativa_options;

?> 
  </div><!-- content-wrapper end -->

  <?php if ($creativa_options['opt-show-footer'] == 1) { ?>

  <footer id="footer-wrapper">

    <?php if ($creativa_options['opt-footer-widget-area'] == 1) { 

      if ($creativa_options['opt-footer-widget-columns'] == 1) {
        $foot_widget_column_1 = 'col-md-6';
        $foot_widget_column_2 = 'col-md-6';
      }
      elseif ($creativa_options['opt-footer-widget-columns'] == 2) {
        $foot_widget_column_1 = 'col-md-6';
        $foot_widget_column_2 = 'col-md-3';
        $foot_widget_column_3 = 'col-md-3';
      }
      elseif ($creativa_options['opt-footer-widget-columns'] == 3) {
        $foot_widget_column_1 = 'col-md-3';
        $foot_widget_column_2 = 'col-md-7';
        $foot_widget_column_3 = 'col-md-2';
      }
      elseif ($creativa_options['opt-footer-widget-columns'] == 4) {
        $foot_widget_column_1 = 'col-md-3';
        $foot_widget_column_2 = 'col-md-3';
        $foot_widget_column_3 = 'col-md-3';
        $foot_widget_column_4 = 'col-md-3';
      }

    ?>

    <!-- Footer - Widgets Area -->
    <section id="footer-widget-area">
      <div class="container">
        <div class="row">

          
          <div class="<?php echo esc_attr($foot_widget_column_1) ?>">

            <?php if (is_active_sidebar( 'footer-area-1' )) { ?>
              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-area-1') ) : else : ?>   
              <?php endif; ?>     
            <?php } else { ?>
             <div class="widget">      
                <?php if (current_user_can( 'administrator' )) { ?>
                  <h6 class="widgettitle"><?php esc_html_e('Footer Area 1', 'creativa') ?></h6>
                  <p class="no-widget-added">
                    <a href="<?php echo admin_url('widgets.php'); ?>"><?php esc_html_e('Click here to assign a widget to this area.', 'creativa') ?></a>
                  </p>
                <?php } ?>
              </div>   
            <?php } ?>

          </div>

          
          <div class="<?php echo esc_attr($foot_widget_column_2) ?>">

            <?php if (is_active_sidebar( 'footer-area-2' )) { ?>
              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-area-2') ) : else : ?>   
              <?php endif; ?>        
            <?php } else { ?>
             <div class="widget">      
                <?php if (current_user_can( 'administrator' )) { ?>
                  <h6 class="widgettitle"><?php esc_html_e('Footer Area 2', 'creativa') ?></h6>
                  <p class="no-widget-added">
                    <a href="<?php echo admin_url('widgets.php'); ?>"><?php esc_html_e('Click here to assign a widget to this area.', 'creativa') ?></a>
                  </p>
                <?php } ?>
              </div>   
            <?php } ?>

          </div>

          
        <?php  if ($creativa_options['opt-footer-widget-columns'] != 1) { ?>
          <div class="<?php echo esc_attr($foot_widget_column_3) ?>">

            <?php if (is_active_sidebar( 'footer-area-3' )) { ?>
              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-area-3') ) : else : ?>   
              <?php endif; ?>       
            <?php } else { ?>
             <div class="widget">      
                <?php if (current_user_can( 'administrator' )) { ?>
                  <h6 class="widgettitle"><?php esc_html_e('Footer Area 3', 'creativa') ?></h6>
                  <p class="no-widget-added">
                    <a href="<?php echo admin_url('widgets.php'); ?>"><?php esc_html_e('Click here to assign a widget to this area.', 'creativa') ?></a>
                  </p>
                <?php } ?>
              </div>   
            <?php } ?>

          </div>
        <?php } ?>

          
        <?php  if ($creativa_options['opt-footer-widget-columns'] == 4) { ?>
          <div class="<?php echo esc_attr($foot_widget_column_4) ?>">

            <?php if (is_active_sidebar( 'footer-area-4' )) { ?>
              <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-area-4') ) : else : ?>   
              <?php endif; ?>       
            <?php } else { ?>
             <div class="widget">      
                <?php if (current_user_can( 'administrator' )) { ?>
                  <h6 class="widgettitle"><?php esc_html_e('Footer Area 4', 'creativa') ?></h6>
                  <p class="no-widget-added">
                    <a href="<?php echo admin_url('widgets.php'); ?>"><?php esc_html_e('Click here to assign a widget to this area.', 'creativa') ?></a>
                  </p>
                <?php } ?>
              </div>   
            <?php } ?>

          </div>
        <?php } ?>

        </div>
      </div>
    </section><!-- Footer - Widgets Area End -->
    <?php } // if footer widget area ?>

    <!-- Footer - Copyrights -->
    <div id="copyrights">
      <div class="container">
        <div class="row">

          <?php
            $copyrights_col_class = 'col-md-12'; 
            if (has_nav_menu( 'copyrights-nav' )) {
              $copyrights_col_class = 'col-md-6'; 
            }
          ?>

          <div class="<?php echo esc_attr($copyrights_col_class) ?>">
            <?php 

              $copyrights_text = $creativa_options['opt-copyrights'];
              $copyrights_text_kses = array(
                  'a' => array(
                      'href' => array(),
                      'title' => array()
                  ),
                  'i' => array(
                      'class' => array(),
                  ),
                  'img' => array(
                      'src' => array(),
                      'alt' => array(),
                  ),
                  'strong' => array(),
                  'br' => array(),
                  'p' => array(),
              );

              echo wp_kses( $copyrights_text, $copyrights_text_kses);

            ?>
          </div>

          <?php if (has_nav_menu( 'copyrights-nav' )) { ?>
            <div class="<?php echo esc_attr($copyrights_col_class) ?>">
              <?php 
                  wp_nav_menu(
                    array(
                      'theme_location' => 'copyrights-nav',
                      'depth'          => -1,
                  ));
              ?>
            </div>
          <?php } ?>

        </div>
      </div>
    </div><!-- Footer - Copyrights End -->

  </footer>

  <?php } // blank template endif ?>

  </div><!-- layout wrapper end -->

    <?php 

    if ($creativa_options['opt-nav-layout'] == 2 && $creativa_options['opt-show-header'] == 1) { ?>

      </div><!-- side-nav--content-wrapper end -->
    <?php } ?>
  
    <?php 
    

      get_template_part('includes/secondary-nav/nav', creativa_secondary_nav_style() );


      if ($creativa_options['opt-back-to-top'] == 1) { ?>
        <div class="back-to-top btt-hidden hidden-xs hidden-sm">
          <a href="#" class="back-to-top-btn" title="<?php esc_html_e('Back to Top', 'creativa') ?>">
            <i class="arrow_up"></i>
          </a>
        </div>
      <?php }

    ?>

    <?php wp_footer(); ?>

  </body>
</html>