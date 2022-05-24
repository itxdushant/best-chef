<?php get_header(); ?>
     

      <div class="content sidebar-right section four-zero-four">
        <div class="container">
          <div class="row">

            <div class="col-lg-8 col-lg-offset-2 col-md-12">
              <div class="fof-number--wrapper">
                <h2 class="fof-number">4</h2>
                <h2 class="fof-number">0</h2>
                <h2 class="fof-number">4</h2>
              </div>
            
              <h5><?php esc_html_e('Sorry!', 'creativa' ) ?></h5>
              <h2 class="hero"><?php esc_html_e('The page you were looking for could not be found.', 'creativa' ) ?></h2>

              <hr>

              <div class="row fof-search">

                <div class="col-md-8"><?php get_search_form(); ?></div>
                <div class="col-md-4"><a href="<?php echo esc_url(home_url( '/' )); ?>" class="btn btn-default pull-right btn-block">Back to Home</a></div>

              </div>
            </div>

          </div>
        </div>
      </div>


<?php get_footer(); ?>