<?php if (!post_password_required() ) { ?> 

  <div class="content project-details project-layout-clean full-width-page">
    <?php the_content(); ?>
  </div>

<?php } else { ?>
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php echo get_the_password_form(); ?>
        </div>
      </div>  
    </div>
  </div> <!-- section end -->
<?php } ?> 