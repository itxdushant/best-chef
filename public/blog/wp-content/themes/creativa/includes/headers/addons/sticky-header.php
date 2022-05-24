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

if ($creativa_options['opt-sticky-header-style'] == 1) {
	$sticky_header_style = 'sh-show-alw';
}
elseif ($creativa_options['opt-sticky-header-style'] == 2) {
	$sticky_header_style = 'sh-show-scrollup';
}

$nav_sep_class = 'no-nav-separators';
if ($creativa_options['opt-nav-separators'] == 1) {
  $nav_sep_class = 'with-nav-separators';
}

$nav_search_icon = $creativa_options['opt-nav-search'];
$nav_cart_icon = $creativa_options['opt-woo-shop-nav-icon'];
$nav_hamburger_icon = $creativa_options['opt-secondary-nav'];

$nav_icons_class = 'no-nav-icons';
if ($nav_search_icon == 1 || $nav_cart_icon == 1 || $nav_hamburger_icon == 1) {
  $icons_style = $creativa_options['opt-nav-icons-style'];

  $nav_icons_class = 'with-nav-icons ';

  if ($icons_style == 1) {
    $nav_icons_class .= 'nav-icons--text';
  }
  elseif ($icons_style == 2) {
    $nav_icons_class .= 'nav-icons--small';
  }
  elseif ($icons_style == 3) {
    $nav_icons_class .= 'nav-icons--large';
  }
}

$hover_style = 'hover-full';
if ($creativa_options['opt-hover-style'] == 2) {
  $hover_style = 'hover-boxed';
}


?> 
<!-- Sticky Header -->
<div id="sticky-header" class="navbar-sticky hidden-xs hidden-sm <?php echo esc_attr($sticky_header_style) .' '. esc_attr($nav_sep_class) ?> <?php echo esc_attr($menu_position_class) .' '. esc_attr($nav_icons_class) ?>">
    
  <?php 
    if ($creativa_options['opt-navbar-style'] != 4) {
      if (function_exists('creativa_search')) {
        creativa_search();
      }
    }
  ?>

  <div class="container">
		<div class="row">
      <div class="col-md-12 <?php if ($creativa_options['opt-navbar-style'] == 4) { echo 'header-bar-container'; } ?>">
        <div class="navbar-inner">
            <?php 
              if ($creativa_options['opt-navbar-style'] == 4) {
                if (function_exists('creativa_search')) {
                  creativa_search();
                }
              }
            ?>

		        <!-- logotype container -->
		        <div class="logo-sticky">
		          <a href="<?php echo esc_url(home_url( '/' )); ?>">
		            <?php 

                if (  isset($creativa_options['opt-logo-stickyh']['url']) && !empty($creativa_options['opt-logo-stickyh']['url'])) { ?>
                  <img class="logo-img logo-img--sticky raw-img" src="<?php echo esc_url($creativa_options['opt-logo-stickyh']['url']) ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo intval($creativa_options['opt-logo-stickyh']['width']); ?>" height="<?php echo intval($creativa_options['opt-logo-stickyh']['height']); ?>">
                <?php }
		            elseif ( isset($creativa_options['opt-logo']['url']) && !empty($creativa_options['opt-logo']['url']) ) { ?>
		              <img class="logo-img logo-img--sticky raw-img" src="<?php echo esc_url($creativa_options['opt-logo']['url']) ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo intval($creativa_options['opt-logo']['width']); ?>" height="<?php echo intval($creativa_options['opt-logo']['height']); ?>">
		            <?php } 
                else { bloginfo('name'); } ?>

		          </a>
		        </div><!-- logotype container end -->

		        <div class="nav-container">

  		        <nav class="main-nav menu-nav hidden-xs hidden-sm <?php echo esc_attr($hover_style) ?>">     
            
                <?php 
                if ( has_nav_menu( 'main-nav' ) ) {
                  $creativa_meta_custom_menu = $creativa_options['opt-meta-custom-menu'];
                  if ($creativa_meta_custom_menu) {
                    $creativa_menu_id = $creativa_meta_custom_menu;
                  } else {
                    $creativa_menu_id = '';
                  }

                  wp_nav_menu(
                    array(
                      'theme_location'  => 'main-nav',
                      'menu'            => $creativa_menu_id,
                      'link_before'     => '<div class="menu-a-inner"><span>',
                      'link_after'      => '</span></div>',
                    )
                  );
                } else { ?>
                  <div class="menu"><ul><li><a href="<?php echo admin_url('nav-menus.php'); ?>"><div class="menu-a-inner"><span>
                    <?php esc_html_e('Assign menu to this area', 'creativa' ) ?> 
                  </span></div></a></li></ul></div> 
                <?php } ?>

  		        </nav>

              <?php 
                creativa_navicons();
              ?>
              
		        </div>
            
        </div>
			</div>
		</div>
	</div>
</div><!-- Sticky header End -->
