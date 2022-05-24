<?php
/*
Template Name: Page with Sidebar
*/
 get_header(); ?>

<?php 
  $creativa_options = creativa_get_options();

  // Sidebar position
  if ($creativa_options['opt-meta-template-sidebar-position'] == 2) {
    $section_class = 'col-md-9 sidebar-content';
    $sidebar_class = 'col-md-3';
    $content_class = 'sidebar-right';
  }
  else {
    $section_class = 'col-md-9 col-md-push-3 sidebar-content';
    $sidebar_class = 'col-md-3 col-md-pull-9';
    $content_class = 'sidebar-left';
  }
?>

<div class="content content-sidebar-page <?php  if (isset($content_class)) echo esc_attr($content_class); ?> section">
  <div class="container">
    <div class="row">
      <div class="<?php echo esc_attr($section_class); ?>">
          <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; endif; ?>
      </div>
      <?php if (!post_password_required()) { ?>
      <aside class="<?php echo esc_attr($sidebar_class); ?> sidebar-wrap">
        <?php 
          $sidebar = $creativa_options['opt-meta-select-sidebar'];
          if ($sidebar) {
            if (function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) {
            } else {}
          } else {
            get_sidebar();
          }
        ?>
      </aside>
      <?php } ?>
    </div>
  </div>
</div>

<?php if (comments_open()) { ?>
  <div class="content-separated comment-section section">
    <div class="container">
      <div class="row">
        <div class="col-md-23">
            <div class="comments-area" id="comments">
              <?php comments_template('', true); ?>
            </div> <!-- end comments-area -->
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php get_footer(); ?>
