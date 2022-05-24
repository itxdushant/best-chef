<?php get_header(); ?>

<?php 
  $creativa_options = creativa_get_options();

  $blog_width = $creativa_options['opt-blog-full-width'];

  if (isset($_GET['layout']) && $_GET['layout'] === 'list') {
    $creativa_options['opt-blog-style'] = 1;
  } 
  elseif (isset($_GET['layout']) && $_GET['layout'] === 'masonry') {
    $creativa_options['opt-blog-style'] = 2;
  }

  if (isset($_GET['sidebar']) && $_GET['sidebar'] === 'true') {
    $creativa_options['opt-show-sidebar'] = 1;
  } 
  elseif (isset($_GET['sidebar']) && $_GET['sidebar'] === 'false') {
    $creativa_options['opt-show-sidebar'] = 0;
  }

  if (isset($_GET['sidebar_pos']) && $_GET['sidebar_pos'] === 'right') {
    $creativa_options['opt-blog-sidebar-position'] = 1;
  } 
  elseif (isset($_GET['sidebar_pos']) && $_GET['sidebar_pos'] === 'left') {
    $creativa_options['opt-blog-sidebar-position'] = 2;
  }


  if (isset($_GET['full']) && $_GET['full'] === 'true') {
    $blog_width = 1;
  } 
  elseif (isset($_GET['full']) && $_GET['full'] === 'false') {
    $blog_width = 0;
  }


  // Blog style
  $blog_style = '';  
  $blog_width_class = 'blog-width-standard';
  if ($creativa_options['opt-blog-style'] == 1) {
    $style_class = 'blog-large';
    $blog_style = '';
    if ($blog_width == 1) {
      $blog_width_class = 'blog-width-full blog-fw-large ';
    }
  }
  elseif ($creativa_options['opt-blog-style'] == 2) {
    $style_class = 'blog-masonry blog-grid row bm-hidden';
    $blog_style = 'masonry';
    if ($blog_width == 1) {
      $blog_width_class = 'blog-width-full blog-fw-masonry ';
    }
  }

  $section_class = 'col-md-12 col-md-push-3 no-sidebar';
  $sidebar_class = '';
  $content_class = '';
  
  // Sidebar position
  if (isset($creativa_options['opt-show-sidebar']) && $creativa_options['opt-show-sidebar'] == 1) {
    if ($creativa_options['opt-blog-sidebar-position'] == 1) {
      $section_class = 'col-md-9 sidebar-content';
      $sidebar_class = 'col-md-3';
      $content_class = 'sidebar-right';
    }
    elseif ($creativa_options['opt-blog-sidebar-position'] == 2) {
      $section_class = 'col-md-9 col-md-push-3 sidebar-content';
      $sidebar_class = 'col-md-3 col-md-pull-9';
      $content_class = 'sidebar-left';
    }
  }
  else {
    $section_class = 'col-md-12 no-sidebar';
  }


  $show_thumbnail_class = 'with-thumbnails';
  if ( $creativa_options['opt-show-thumbnail'] == 0 ) {
    $show_thumbnail_class = 'no-thumbnails';
  }


?>
     

<div class="content blog-content-wrap <?php echo esc_attr($blog_width_class) . ' ' . esc_attr($show_thumbnail_class); ?> <?php  if (isset($content_class)) echo esc_attr($content_class); ?> section">
  <div class="container">
    <div class="row">
      <div class="<?php echo esc_attr($section_class); ?>">
        <div id="blog-id" class="<?php echo esc_attr($style_class); ?>">

          <?php
          if(have_posts()) : while(have_posts()) : the_post();
            
            get_template_part( 'includes/post-layout/display', $blog_style );  ?>
    
          <?php endwhile; else : ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class('no-posts'); ?>>

            <h2><?php esc_html_e('No posts were found.', 'creativa'); ?></h2>
          
          </article>

         <?php endif; ?>

        </div>

        <?php
        if ( function_exists('creativa_pagination') ) {
          creativa_pagination();
        }
        ?>
      </div>

      <?php  if ($creativa_options['opt-show-sidebar'] == 1) { ?>
      <aside class="<?php echo esc_attr($sidebar_class); ?> sidebar-wrap">

        <?php get_sidebar(); ?>

      </aside>
      <?php } ?>

    </div>
  </div>
</div>


<?php get_footer(); ?>