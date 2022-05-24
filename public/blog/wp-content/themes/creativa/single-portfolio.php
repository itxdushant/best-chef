<?php 

wp_reset_postdata(); 
get_header();

global $post;
$creativa_options = creativa_get_options();
creativa_set_post_count($post->ID);

if (!post_password_required() ) { 
  get_template_part('includes/portfolio/project-templates/project', creativa_single_project_layout() );
?> 

  <?php 

    $project_shares = $creativa_options['opt-project-shares'];
    $project_prevnext = $creativa_options['opt-project-prevnext'];

    if ($project_shares == 1 || $project_prevnext == 1 ) {
  ?>

  <div class="content-separated project__bottom-meta--container section">
    <div class="container">

      <?php 

        $terms = get_the_terms( $post->ID , 'portfolio_category' );
        $project_year = $creativa_options['opt-meta-project-year'];
        $project_client = $creativa_options['opt-meta-project-client'];
        $project_url = $creativa_options['opt-meta-project-url'];
        $project_info_custom = $creativa_options['opt-meta-project-custom'];

        if (!empty($terms) || !empty($project_year) || !empty($project_client) || !empty($project_url) || !empty($project_info_custom[0])) {

      ?>

      <div class="row row-project-info">
        <div class="col-md-12">
          <div class="project--info">

            <h5 class="project--info__details"><?php esc_html_e('Details', 'creativa') ?></h5>

            <ul>


              <?php 
              if (!empty($terms)) {
              ?>
              <li class="project--info__item">
                <span class="project--info__title"><?php esc_html_e('Category', 'creativa') ?></span>
                <span class="project--info__content project--info__categories font-secondary">
                  <?php 
                    foreach ( $terms as $term ) {
                      echo '<span>'. ucfirst($term->name) . '</span>';
                    }
                  ?>
                </span>
              </li>
              <?php } // endig categories?>

              <?php
              if (!empty($project_year)) {
              ?>
              <li class="project--info__item">
                <span class="project--info__title"><?php esc_html_e('Date', 'creativa') ?></span>
                <span class="project--info__content font-secondary"><?php echo esc_html($project_year); ?></span>
              </li>
              <?php } // endif project-year ?>

              <?php
              if (!empty($project_client)) {
              ?>
              <li class="project--info__item">
                <span class="project--info__title"><?php esc_html_e('Client', 'creativa') ?></span>
                <span class="project--info__content font-secondary"><?php echo esc_html($project_client); ?></span>
              </li>
              <?php } // endif project-client ?> 

              <?php
              if (!empty($project_info_custom[0])) {
                foreach ($project_info_custom as $project_info_fields) {
                  $projec_info_field = explode('|', $project_info_fields); ?>
                  <li class="project--info__item">
                    <span class="project--info__title"><?php echo isset($projec_info_field[0]) ? esc_html($projec_info_field[0]) : ''; ?></span>
                    <span class="project--info__content font-secondary"><?php echo isset($projec_info_field[1]) ? esc_html($projec_info_field[1]) : ''; ?></span>
                  </li>
                <?php } ?>
              <?php } // endif project-client ?> 

            </ul>

              <?php
              if (!empty($project_url)) {

                $project_url_text = $creativa_options['opt-meta-project-url-text'];
                $project_url_text_output = (!empty($project_url_text)) ? $project_url_text : esc_html__('Launch Project', 'creativa') ;
              ?>
              <div class="project--info__item project__url">
                <a href="<?php echo esc_url($project_url) ?>" class="btn btn-default" target="_blank"><?php echo esc_html($project_url_text_output) ?></a>
              </div>
              <?php } // endif project-url ?>

          </div>
        </div>
      </div>

      <?php } // endif not empty project info ?>

      <div class="row row-shares">
        <div class="col-md-12">

          <div class="project__bottom-meta">

            <?php if ($project_shares == 1) { ?>

            <div class="single-posts-shares">
              <div class="shares-count">
                <!-- <span class="share-number-total hero"></span> -->
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
                <li class="get-share"><a class="share-pinterest" data-service="pinterest" title="Pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
              </ul>
            </div>

            <?php } // endif shares ?>

            <?php if ($project_prevnext == 1) { ?>

            <div class="prev-next__project--wrapper">
              <ul class="prev-next__project">
              <?php

                // previous post
                $previous_post = get_next_post();          
                if ($previous_post) {
                  echo '<li class="project__previous">';
                    echo '<a href="'. get_permalink($previous_post->ID) .'">';
                      echo '<div class="prev-next-post_title">';
                      echo '<span class="font-secondary">'. esc_html__('&#8592; Previous', 'creativa') .'</span>';
                      echo '<div class="heading">'. esc_html($previous_post->post_title). '</div>';
                      echo '</div>';
                      $image_id = get_post_thumbnail_id($previous_post->ID);
                      $image_url = wp_get_attachment_image_src( $image_id, 'thumbnail');
                      echo '<div class="prev-next-post_thumb" style="background-image: url('. esc_url($image_url[0]) .');"></div>';
                    echo '</a>';
                  echo '</li>';
                }

                // next post
                $next_post = get_previous_post();
                if ($next_post) {
                  echo '<li class="project__next">';
                    echo '<a href="'. get_permalink($next_post->ID) .'">';
                      echo '<div class="prev-next-post_title">';
                      echo '<span class="font-secondary">'. esc_html__('Next &#8594;', 'creativa') .'</span>';
                      echo '<div class="heading">'. esc_html($next_post->post_title). '</div>';
                      echo '</div>';
                      $image_id = get_post_thumbnail_id($next_post->ID);
                      $image_url = wp_get_attachment_image_src( $image_id, 'thumbnail');
                      echo '<div class="prev-next-post_thumb" style="background-image: url('. esc_url($image_url[0]) .');"></div>';
                    echo '</a>';
                  echo '</li>';
                }
              ?>
              </ul>
            </div>

            <?php } // endif prevnext ?>

          </div>

        </div>

      </div>
    </div>
  </div>

  <?php } // endif shares - prevnext ?>

  <?php if (comments_open()) { ?>

   <div class="content-separated comment-section section">
    <div class="container">
      <div class="row">
        <div class="col-md-9 sidebar-content">
            <div class="comments-area" id="comments">
              <?php comments_template('', true); ?>
            </div> <!-- end comments-area -->
        </div>
      </div>
    </div>
  </div>

  <?php } ?>


<?php } else { ?>

<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php echo get_the_password_form();  ?>
      </div>
    </div>
  </div>
</div>

<?php } ?> 


<?php get_footer(); ?>