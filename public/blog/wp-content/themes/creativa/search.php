<?php get_header();
$creativa_options = creativa_get_options();
global $post;
 ?>
     

      <div class="content sidebar-right section">
        <div class="container">
          <div class="row">
            <section class="col-md-9 sidebar-content">

              <?php
              if(have_posts()) : while(have_posts()) : the_post(); ?>

              
              <?php if( get_post_type($post->ID) == 'post' ){ ?>
                <article class="result result-post format-standard">
                  <small><?php esc_html_e('Post', 'creativa' ); ?></small>
                  <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
                </article>
              <?php }
              
              elseif( get_post_type($post->ID) == 'page' ){ ?>

                <article class="result result-page">
                  <small><?php esc_html_e('Page', 'creativa' ); ?></small>
                  <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php if(has_excerpt()) the_excerpt(); ?>
                </article>
              <?php }
              
              elseif( get_post_type($post->ID) == 'portfolio' ){ ?>
                <article class="result result-portfolio">
                  <small><?php esc_html_e('Portfolio', 'creativa' ); ?></small>
                  <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
                </article>
              <?php }
              
              elseif( get_post_type($post->ID) == 'product' ){ ?>
                <article class="result result-portfolio">
                  <small><?php esc_html_e('Product', 'creativa' ); ?></small>
                  <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
                </article>
              <?php 

              } else { ?>
                <article class="result">
                  <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
                </article>
              <?php } ?>
               
                
        
              <?php endwhile; else : ?>

                <h3><?php esc_html_e('No results were found matching your criteria.', 'creativa'); ?></h3>
                <small><?php esc_html_e('Please try something else.', 'creativa'); ?></small>
              
             <?php endif; ?>

              <?php
              if ( function_exists('creativa_pagination') ) {
                creativa_pagination();
              }
              ?>

            </section>

            <aside class="col-md-3 sidebar-wrap">

              <?php get_sidebar(); ?>

            </aside>
          </div>
        </div>
      </div>


<?php get_footer(); ?>