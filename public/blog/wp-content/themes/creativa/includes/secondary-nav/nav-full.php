<?php 
$creativa_options = creativa_get_options();
?>

<div class="secondary-navigation full-navigation">
	<div class="sec-nav-overlay"></div>
	<div class="full-nav-wrap">

    <div class="sec-nav-close-btn"><a href="#"></a></div>

    <!-- logotype container -->
    <div class="sidebar-nav-logo">
      <a href="<?php echo esc_url(home_url( '/' )); ?>">
        <?php 
        if ( isset($creativa_options['opt-logo-mobile']['url']) && !empty($creativa_options['opt-logo-mobile']['url'])) { ?>
          <img src="<?php echo esc_url($creativa_options['opt-logo-mobile']['url']) ?>" alt="<?php bloginfo('name'); ?>">
        <?php }
        elseif ( isset($creativa_options['opt-logo']['url']) && !empty($creativa_options['opt-logo']['url'])) { ?>
          <img src="<?php echo esc_url($creativa_options['opt-logo']['url']) ?>" alt="<?php bloginfo('name'); ?>">
        <?php } 
        else { bloginfo('name'); } ?>
      </a>
    </div><!-- logotype container end -->

    <?php if ( has_nav_menu( 'full-mobile-nav' ) ) { ?>
      <nav class="full-nav">
        <?php wp_nav_menu(
            array(
              'theme_location' => 'full-mobile-nav',
              'link_before'     => '<span>',
              'link_after'      => '</span>',
            )
          );
        ?>
      </nav>
    <?php
    } else { ?>
      <div class="full-nav"><ul><li><a href="<?php echo admin_url('nav-menus.php'); ?>"><div class="menu-a-inner"><span>
        <?php esc_html_e('Assign mobile menu to this area', 'creativa' ) ?> 
      </span></div></a></li></ul></div> 
    <?php } ?>

	</div>

</div>