<?php 
wp_reset_postdata();
get_header(); 

?>

<?php 
  global $post;
  $creativa_options = creativa_get_options();
  creativa_set_post_count($post->ID);

  $single_layout = $creativa_options['opt-blog-page-style'];

  if ($single_layout == 1 || $single_layout == 3) {
    $section_class = 'col-md-9 sidebar-content';
    $sidebar_class = 'col-md-3';
    $content_class = 'sidebar-right';
  }
  elseif ($single_layout == 2) {
    $section_class = 'col-md-9 col-md-push-3 sidebar-content';
    $sidebar_class = 'col-md-3 col-md-pull-9';
    $content_class = 'sidebar-left';
  }

  if ($single_layout == 1 || $single_layout == 2) {
    $post_template = '';
  }
  elseif ($single_layout == 3) {
    $post_template = 'clean';
  }

  if (!post_password_required() ) { 
    get_template_part('includes/post-layout/single-templates/post', $post_template );
  } else { ?>
  
    <div class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php echo get_the_password_form();  ?>
          </div>
        </div>
      </div>
    </div>

  <?php }

?>
<?php get_footer(); ?>