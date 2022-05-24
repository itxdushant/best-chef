<?php 
$creativa_options = creativa_get_options();

if ($creativa_options['opt-menu-position'] == 1) {
  $menu_position_class = 'nav-menu-left';
}
elseif ($creativa_options['opt-menu-position'] == 2) {
  $menu_position_class = 'nav-menu-center';
}
elseif ($creativa_options['opt-menu-position'] == 3) {
  $menu_position_class = 'nav-menu-right';
}

$nav_sep_class = 'no-nav-separators';
if ($creativa_options['opt-nav-separators'] == 1) {
  $nav_sep_class = 'with-nav-separators';
}

?>

<header>

  <?php 
    if (function_exists('creativa_topbar')) {
      creativa_topbar();
    }
  ?>

  <div id="navbar" class="<?php echo esc_attr($menu_position_class) .' '. esc_attr($nav_sep_class) ?>">
    <div class="logo-wrapper">

      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <!-- logotype container -->
            <div class="logo">
              <a href="<?php echo esc_url(home_url( '/' )); ?>">
                <?php 
                if ( isset($creativa_options['opt-logo']['url']) && !empty($creativa_options['opt-logo']['url']) ) { ?>
                  <img class="logo-img raw-img" src="<?php echo esc_url($creativa_options['opt-logo']['url']) ?>" alt="<?php bloginfo('name'); ?>" <?php echo creativa_retina_check($creativa_options['opt-logo']['url'], true) ?> width="<?php echo intval($creativa_options['opt-logo']['width']); ?>" height="<?php echo intval($creativa_options['opt-logo']['height']); ?>">
                <?php } else { bloginfo('name'); } ?>
              </a>
            </div><!-- logotype container end -->

            <div class="logo-desc hidden-xs"><?php esc_html(bloginfo('description')); ?></div>

            <div class="nav-social-icons hidden-xs hidden-sm"><?php header_social_icons(); ?></div>

          </div>
        </div>
      </div>

    </div>

    <div class="nav-wrapper">

      <div class="container">
        <div class="row">
          <div class="col-md-12 <?php if ($creativa_options['opt-navbar-style'] == 4) { echo 'header-style-bar'; } ?>">

          <?php if ($creativa_options['opt-nav-search'] == 1) {
              echo '<div class="search-bar search-bar-hidden">';
              echo '<span class="close-btn"><a href="#"><i class="fa fa-times"></i></a></span>';
              get_search_form(); 
              echo '</div>';
          } ?>

          <div class="nav-container">

            <nav class="main-nav menu-nav <?php echo ''.($creativa_options['opt-responsive'] == true) ? 'hidden-xs hidden-sm' : '' ?> ">
              <?php 
                $creativa_meta_custom_menu = $creativa_options['opt-meta-custom-menu'];
                if ($creativa_meta_custom_menu) {
                  $creativa_menu_id = $creativa_meta_custom_menu;
                } else {
                  $creativa_menu_id = '';
                }

                wp_nav_menu(
                  array(
                    'theme_location' => 'main-nav',
                    'menu'           => $creativa_menu_id,
                    'link_before'     => '<div class="menu-a-inner"><span>',
                    'link_after'      => '</div></span>',
                  )
                );
              ?>
            </nav>

            <?php 
              creativa_navicons();
            ?>

            <nav class="nav-mobile nav-secondary-nav <?php echo ''.($creativa_options['opt-responsive'] == true) ? 'visible-xs visible-sm' : 'hidden' ?>">
              <a href="#" class="secondary-nav-btn"><i class="fa fa-bars"></i></a>
            </nav>

          </div>

          </div>
        </div>
      </div>

    </div>

  </div>
</header>
