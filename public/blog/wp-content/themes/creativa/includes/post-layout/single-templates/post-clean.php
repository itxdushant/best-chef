<?php 

$creativa_options = creativa_get_options();

?>

<?php if (!post_password_required() ) { ?> 

  <div class="content full-width-page">
      <?php the_content(); ?>
  </div>

  <?php if ($creativa_options['opt-single-clean-meta'] == 1) { ?>
    <div class="content section sidebar-right single-post-info">
      <div class="container">
        <div class="row">
          <div class="col-md-9 sidebar-content">

            <div class="entry-by post-info--clean">
              <div class="by-avatar-wrapper">
                <span class="entry-avatar"><?php echo get_avatar(  get_the_author_meta('ID'), 50 ); ?></span>
                <span class="entry-author font-secondary heading-color"><?php the_author_posts_link(); ?></span>
                <span class="entry-more"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_html_e('more from author', 'creativa') ?></a></span>
              </div>
              <?php if ($creativa_options['opt-author-bio'] == 1) { ?>
                <p class="by-author-desc"><?php the_author_meta('description'); ?></p>
              <?php } ?>
            </div>

          </div>

          <div class="col-md-3">

            <?php if ($creativa_options['opt-share-buttons'] == 1) { ?>
            <div class="post-info--clean">
              <div class="single-posts-shares">
                <div class="shares-count">
                  <h6><?php esc_html_e('Shares', 'creativa') ?></h6>
                </div>
                <ul class="shares-list">
                  <?php if (function_exists('getPostLikeLink')) : ?>
                  <li><?php echo getPostLikeLink( get_the_ID() ); ?></li>
                  <?php endif; ?>
                  <li class="get-share"><a class="share-facebook" data-service="facebook" title="Facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="get-share"><a class="share-twitter" data-service="twitter" title="Twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="get-share"><a class="share-google-plus" data-service="google" title="Google+" href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li class="get-share"><a class="share-linkedin" data-service="linkedin" title="LinkedIn" href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
            <?php } ?>  
         

            <?php if ($creativa_options['opt-tags'] == 1) {
             if (has_tag()) : ?>        

             <div class="post-info--clean">
              <div class="post-tags">
                <?php the_tags("", ""); ?>
              </div>
            </div>    
             
            <?php endif;
            } ?>
          </div>
            
        </div>
      </div>
    </div>
  <?php } //endif display meta box ?>

<?php } ?> 