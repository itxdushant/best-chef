<?php 

$creativa_options = creativa_get_options();
$creativa_image_th = creativa_thumbnail_size();
$content_width = creativa_get_content_width();


$blog_layout = $creativa_options['opt-blog-style'];
$standard_media_style = $creativa_options['opt-blog-display-media'];
$format = get_post_format();
$blog_media_class = '';

$allow_media_styles = $creativa_options['opt-allow-media-styles'];

if (has_post_thumbnail() && !post_password_required() && $creativa_options['opt-show-thumbnail'] == true) {
  $blog_media_class = 'blog-media-standard ';
  $creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
  $creativa_image_th[1] = creativa_thumbnail_size(1, 450);

  if ($format == 'gallery' || $format == 'image') {
    $creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
    $creativa_image_th[1] = creativa_thumbnail_size(1, 0);
  }

  if ($standard_media_style == 2 && $allow_media_styles == 1) {
    $blog_media_class = 'blog-media-portrait ';
    $creativa_image_th[0] = creativa_thumbnail_size(0, 380);
    $creativa_image_th[1] = creativa_thumbnail_size(1, 415);

    if (has_post_format('quote') || has_post_format('link')) {
      $blog_media_class = 'blog-media-standard ';
    }
  }
  if ($standard_media_style == 3 && $allow_media_styles == 1) {
    $blog_media_class = 'blog-media-bg ';
    $creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
    $creativa_image_th[1] = creativa_thumbnail_size(1, 0);
  }
} else {
  $blog_media_class = 'blog-media-standard ';
  if ($format == 'gallery') {
    $creativa_image_th[0] = creativa_thumbnail_size(0, $content_width);
    $creativa_image_th[1] = creativa_thumbnail_size(1, 0);
  }
}

// print_r($creativa_image_th);

// has-post-thumbnail when password protected fix
$hpth = '';
if (has_post_thumbnail() && post_password_required()) {
  $hpth = 'has-post-thumbnail ';
}

$display_categories = $creativa_options['opt-display-categories'];
$display_date = $creativa_options['opt-display-date'];
$display_comments = $creativa_options['opt-display-comments'];
$display_author = $creativa_options['opt-display-author'];

if ($display_author == true) { 
  $blog_media_class .= ' shows-author';
}

if ($allow_media_styles == 0) {
  $creativa_image_th[2] = creativa_thumbnail_size(2, false);
}

?>

<!-- Blog Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class($hpth . esc_attr($blog_media_class)); ?>>
  <div class="post-wrap">

    <?php 

      if ( $creativa_options['opt-show-thumbnail'] == 1 ) {
        get_template_part( 'includes/post-layout/post-media/media', get_post_format() ); 
      }
      
    ?>

    <div class="post-content-wrap">
      <div class="post-content-inner">

        <div class="blog-header">

          <?php if ($display_categories == true || $display_date == true || $display_comments == true) { ?>
          <div class="entry-info">
            <?php if ($display_categories == true) { ?>
              <span class="single__entry-info--categories"><?php the_category(',&nbsp;'); ?></span>
            <?php } //endif display_categories ?>
            <?php if ($display_date == true) { ?>
              <a href="<?php the_permalink(); ?>">
                <span class="post-date font-secondary"><?php the_time(get_option('date_format')); ?></span>
              </a>
            <?php } //endif display_date ?>
            <?php if ($display_comments == true) {
                  if (comments_open() && !post_password_required()) { 
                    echo ''.($display_date == true) ? '&middot; ' : '';
                    echo '<a class="comments-link font-secondary" href="'. get_comments_link( get_the_ID() ) .'"> Comments: ';
                    echo '<span class="comments-number">';
                      comments_number('0', '1', '%');
                    echo '</span></a>';
                  }
                } //endif display_comments
            ?>
          </div>

          <?php } //endif entry-info ?>

          <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        </div>

        <div class="blog-content">

          <?php 

          $subtitle_text = $creativa_options['opt-single-subtitle'];
          $subtitle_text_excerpt = $creativa_options['opt-single-subtitle-display'];

          if (!post_password_required()) {
            if (!empty($subtitle_text) && $subtitle_text_excerpt == 1) {
              echo wpautop($subtitle_text);
              echo '<a href="'. get_permalink() .'" class="more-link btn btn-default btn-sm">'. esc_html__('Continue Reading', 'creativa') .'</a>';
            } else {
              if ($creativa_options['opt-blog-page-style'] != 3) {
                if (!post_password_required() && $creativa_options['opt-excerpts'] == 1 ) {
                  the_excerpt();
                } else {
                  the_content(__('Continue Reading', 'creativa'));
                } 
              }
            }
          } else {
            echo get_the_password_form();
          }

          ?>

        </div>

        <?php if ($display_author == true) { ?>
          <div class="entry-by">
              <span class="entry-avatar"><?php echo get_avatar(  get_the_author_meta('ID'), 25 ); ?></span>
              <?php esc_html_e('by ', 'creativa'); ?>
              <span class="entry-author"><?php the_author_posts_link(); ?></span>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</article><!-- Blog Post End -->