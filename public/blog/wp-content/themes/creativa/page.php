<?php 
wp_reset_postdata();
get_header(); ?>
     
      <div class="content section">
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                
                <?php the_content(); ?>
          
              <?php endwhile; endif; ?>

            </div>
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