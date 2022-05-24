<?php
/*
Template Name: Side Navigation
*/
get_header(); 

  $creativa_options = creativa_get_options();

  if ($creativa_options['opt-side-navigation-position'] == 1) {
    $side_navigation_content = 'col-md-9 col-md-push-3';
    $side_navigation_nav = 'col-md-3 col-md-pull-9';
    $side_nav_page = 'snp-left';
  }
  elseif ($creativa_options['opt-side-navigation-position'] == 2) {
    $side_navigation_content = 'col-md-9';
    $side_navigation_nav = 'col-md-3';
    $side_nav_page = 'snp-right';
  }
?>
     

<div class="content section side-navigation-page <?php echo esc_attr($side_nav_page) ?>">
  <div class="container">
    <div class="row">
      <div class="<?php echo esc_attr($side_navigation_content) ?> content-wrap">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile; endif; ?>
      </div>
      <?php if (!post_password_required()) { ?>
      <aside class="<?php echo esc_attr($side_navigation_nav) ?> sidebar-wrap">

        <?php if ($creativa_options['opt-side-navigation-title']) { ?>
          <h5 class="side-navigation__title"><?php echo esc_html($creativa_options['opt-side-navigation-title']) ?></h5>
        <?php } ?>

        <?php
          $page_ancestors = get_ancestors($post->ID, 'page');
          $page_parent = end($page_ancestors);
        ?>

        <ul class="side-navigation">

          <li class="page_item <?php echo is_page($page_parent) ? 'current_page_item' : '' ?>">
            <a href="<?php echo get_permalink($page_parent); ?>">
              <?php echo get_the_title($page_parent); ?>
            </a>
          </li>

        <?php
          if($page_parent) {
            $page_children = wp_list_pages("title_li=&child_of=".$page_parent."&echo=0");
          }
          else {
            $page_children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
          }
          if ($page_children) {
            echo ''.$page_children; 
          }
        ?>
        </ul>
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