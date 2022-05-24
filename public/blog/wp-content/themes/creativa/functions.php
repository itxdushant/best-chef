<?php
/* ------------------------------------------------------------ */
/* 	Creativa Theme functions */
/* ------------------------------------------------------------ */


/* ------------------------------------------------------------ */
/* 	Define Constants */
/* ------------------------------------------------------------ */
define('THEMEROOT', get_template_directory_uri() );
define('IMAGES', THEMEROOT.'/img');

/* ------------------------------------------------------------ */
/* 	Load text domain
/* ------------------------------------------------------------ */
function creativa_textdomain(){
    load_theme_textdomain('creativa', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'creativa_textdomain');

/* ------------------------------------------------------------ */
/* 	Styles Enqueue */
/* ------------------------------------------------------------ */
function creativa_theme_styles() {
	$theme_info = wp_get_theme();
	$protocol = is_ssl() ? 'https' : 'http';

    wp_register_style( 'bootstrap', THEMEROOT . '/css/bootstrap.min.css', '' , '3.3.0');
    wp_register_style( 'font-awesome', THEMEROOT . '/css/icons/css/font-awesome.min.css', '' , '4.3.0');
    wp_register_style( 'elegant-icons', THEMEROOT . '/css/icons/css/elegant.css', '' , '1.0');
    wp_register_style( 'creativa-fonts', THEMEROOT . '/css/fonts.css', '' , '1.0');

    wp_register_style( 'creativa-style', get_stylesheet_directory_uri() . '/style.css', '' , $theme_info->get( 'Version' ));

    wp_enqueue_style('bootstrap');
    wp_enqueue_style('font-awesome');
    wp_enqueue_style('elegant-icons');
    wp_enqueue_style('creativa-fonts');

    wp_enqueue_style('creativa-style');
}

add_action('wp_enqueue_scripts', 'creativa_theme_styles');

/* ------------------------------------------------------------ */
/* 	Load JS Files */
/* ------------------------------------------------------------ */
function creativa_load_scripts() {
	global $creativa_options, $post;
	$theme_info = wp_get_theme();

    wp_enqueue_script('modernizr', THEMEROOT . '/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js', array('jquery'), '2.6.2', false);
    wp_enqueue_script('jplayer', THEMEROOT . '/js/vendor/jquery.jplayer.min.js', array('jquery'), '2.6.0', false);
	if(is_singular() && comments_open()) wp_enqueue_script( 'comment-reply' );

    if(is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'loprd_maps') ) {
		$creativa_gapi = $creativa_options['opt-google-api-key'];
		$creativa_api_key = (!empty($creativa_gapi)) ? esc_html($creativa_gapi) : '';
        wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key='. $creativa_api_key .'&amp;libraries=geometry', array(), '1.0.0', false );
    }

    wp_enqueue_script('creativa-scripts', THEMEROOT . '/js/theme_scripts.min.js', array('jquery'), $theme_info->get( 'Version' ), true);
    wp_register_script('creativa-canvases', THEMEROOT . '/js/theme_canvases.min.js', array('jquery'), $theme_info->get( 'Version' ), true);

    wp_enqueue_script('main', THEMEROOT . '/js/main.js', array('creativa-scripts'), $theme_info->get( 'Version' ), true);

}

add_action('wp_enqueue_scripts', 'creativa_load_scripts');


/* ------------------------------------------------------------ */
/* 	Nav Register */
/* ------------------------------------------------------------ */
function creativa_register_menus(){
	register_nav_menus(
		array(
			'main-nav' 				=> esc_html__('Main Navigation', 'creativa'),
			'splitted-nav-right'	=> esc_html__('Splitted Nav - Right', 'creativa'),
			'full-mobile-nav' 		=> esc_html__('Mobile/Full Screen Navigation', 'creativa'),
			'copyrights-nav' 		=> esc_html__('Copyright Footer Navigation', 'creativa'),
		)
	);
}

add_action('init', 'creativa_register_menus');

/* ------------------------------------------------------------ */
/* 	Redux */
/* ------------------------------------------------------------ */

function creativa_get_options($opt = null, $opt_val = null) {
	global $creativa_options;

	if ($opt !== null && $opt_val !== null) {
		$creativa_options[$opt] = $opt_val;
	}

	return $creativa_options;
}

if (class_exists( 'ReduxFramework') && class_exists('Creativa_Core')) {

	if (!isset($creativa_options)) {

		if ( file_exists( get_template_directory() . '/loprdCore/creativaRedux/theme-meta-config.php' ) ) {
		    require_once( get_template_directory() . '/loprdCore/creativaRedux/theme-meta-config.php' );
		}

		if ( file_exists( get_template_directory() . '/loprdCore/creativaRedux/theme-config.php' ) ) {
		    require_once( get_template_directory() . '/loprdCore/creativaRedux/theme-config.php' );
		}
	}


	add_action( 'admin_menu', 'creativa_remove_redux_menu',12 );
	function creativa_remove_redux_menu() {
	    remove_submenu_page('tools.php','redux-about');
	}

	include('loprdCore/css/dynamic-styles.php');

} else {
	require_once('loprdCore/creativaRedux/creativa_default_options.php');
}

function creativa_addPanelCSS() {
    wp_register_style('creativa-redux', THEMEROOT .'/loprdCore/css/creativa-redux.css', array( ), time(), 'all');
    wp_enqueue_style('creativa-redux');
}
// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action( 'admin_enqueue_scripts', 'creativa_addPanelCSS', 9999 );

/* ------------------------------------------------------------ */
/* 	Content Width */
/* ------------------------------------------------------------ */
if ( ! isset( $content_width ) ) {
	$content_width = 1300;
}

function creativa_get_content_width() {
    global $content_width;
    return $content_width;
}

function creativa_thumbnails_global() {
    global $creativa_image_th;
    $creativa_image_th = Array();
    // @image[0] = image_w;
    // @image[1] = image_h;
    // @image[2] = allow_post_styles;
}
add_action( 'after_theme_setup', 'creativa_thumbnails_global' );

if ( ! function_exists ( 'creativa_thumbnail_size' ) ) {
	function creativa_thumbnail_size($dim = null, $th_size = null) {
	    global $creativa_image_th;

	    if ($dim !== null && $th_size !== null) {
	    	$creativa_image_th[$dim] = $th_size;
	    }

	    return $creativa_image_th;
	}
}

function creativa_file_exist($url) {
    if (($url == '') || ($url == null)) { return false; }
    $response = wp_remote_head( $url, array( 'timeout' => 5 ) );
    $accepted_status_codes = array( 200, 301, 302 );
    if ( ! is_wp_error( $response ) && in_array( wp_remote_retrieve_response_code( $response ), $accepted_status_codes ) ) {
        return true;
    }
    return false;
}

if ( ! function_exists ( 'creativa_retina_check' ) ) {
	function creativa_retina_check($image_src = null, $class_attr = false) {
		if ($image_src) {
		    preg_match('/^(.+)\.([a-z]{3,4})$/i',$image_src,$m);
		    $retinaImage = $m[1] . '@2x.' . $m[2];

		    if (creativa_file_exist($retinaImage)) {
			    if ($class_attr == true) {
			    	return 'class="img-has-retina"';
			    }
			    elseif ($class_attr == false) {
			    	return 'img-has-retina';
			    }
		    }
		}
	}
}


/* ------------------------------------------------------------ */
/* Portfolio */
/* ------------------------------------------------------------ */
add_filter( 'portfolioposttype_args', 'creativa_portfolio' );
function creativa_portfolio( array $args ) {
	global $creativa_options;
    $labels = array(
			'name'               => esc_html__( 'Portfolio', 'creativa' ),
			'singular_name'      => esc_html__( 'Portfolio Item', 'creativa' ),
			'menu_name'          => esc_html_x( 'Portfolio', 'admin menu', 'creativa' ),
			'name_admin_bar'     => esc_html_x( 'Portfolio Item', 'add new on admin bar', 'creativa' ),
			'add_new'            => esc_html__( 'Add New Item', 'creativa' ),
			'add_new_item'       => esc_html__( 'Add New Portfolio Item', 'creativa' ),
			'new_item'           => esc_html__( 'Add New Portfolio Item', 'creativa' ),
			'edit_item'          => esc_html__( 'Edit Portfolio Item', 'creativa' ),
			'view_item'          => esc_html__( 'View Item', 'creativa' ),
			'all_items'          => esc_html__( 'Portfolio Items', 'creativa' ),
			'search_items'       => esc_html__( 'Search Portfolio', 'creativa' ),
			'parent_item_colon'  => esc_html__( 'Parent Portfolio Item:', 'creativa' ),
			'not_found'          => esc_html__( 'No portfolio items found', 'creativa' ),
			'not_found_in_trash' => esc_html__( 'No portfolio items found in trash', 'creativa' ),
    );
    $args['labels'] = $labels;

    if (isset($creativa_options['opt-portfolio-custom-slug'])) {
	    $get_portfolio_custom_slug = $creativa_options['opt-portfolio-custom-slug'];

		if ($get_portfolio_custom_slug) {
			$portfolio_custom_slug = $get_portfolio_custom_slug;
		} else {
			$portfolio_custom_slug = 'project';
		}
    } else {
		$portfolio_custom_slug = 'project';
    }

    // Update project single permalink format, and archive slug as well.
    $args['rewrite']     = array('slug'=>sanitize_text_field($portfolio_custom_slug),'with_front'=>true);
    $args['has_archive'] = 'projects';

    // Don't forget to visit Settings->Permalinks after changing these to flush the rewrite rules.
    return $args;
}


// Categories
add_filter( 'portfolioposttype_category_args', 'creativa_portfolio_cat' );
function creativa_portfolio_cat( array $args ) {
    $labels = array(
		'name'                       => esc_html__( 'Portfolio Categories', 'creativa' ),
		'singular_name'              => esc_html__( 'Portfolio Category', 'creativa' ),
		'menu_name'                  => esc_html__( 'Portfolio Categories', 'creativa' ),
		'edit_item'                  => esc_html__( 'Edit Portfolio Category', 'creativa' ),
		'update_item'                => esc_html__( 'Update Portfolio Category', 'creativa' ),
		'add_new_item'               => esc_html__( 'Add New Portfolio Category', 'creativa' ),
		'new_item_name'              => esc_html__( 'New Portfolio Category Name', 'creativa' ),
		'parent_item'                => esc_html__( 'Parent Portfolio Category', 'creativa' ),
		'parent_item_colon'          => esc_html__( 'Parent Portfolio Category:', 'creativa' ),
		'all_items'                  => esc_html__( 'All Portfolio Categories', 'creativa' ),
		'search_items'               => esc_html__( 'Search Portfolio Categories', 'creativa' ),
		'popular_items'              => esc_html__( 'Popular Portfolio Categories', 'creativa' ),
		'separate_items_with_commas' => esc_html__( 'Separate portfolio categories with commas', 'creativa' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove portfolio categories', 'creativa' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used portfolio categories', 'creativa' ),
		'not_found'                  => esc_html__( 'No portfolio categories found.', 'creativa' ),
    );
    $args['labels'] = $labels;

    return $args;
}

// tags
add_filter( 'portfolioposttype_tag_args', 'creativa_portfolio_tags' );
function creativa_portfolio_tags( array $args ) {
    $labels = array(
			'name'                       => esc_html__( 'Portfolio Tags', 'creativa' ),
			'singular_name'              => esc_html__( 'Portfolio Tag', 'creativa' ),
			'menu_name'                  => esc_html__( 'Portfolio Tags', 'creativa' ),
			'edit_item'                  => esc_html__( 'Edit Portfolio Tag', 'creativa' ),
			'update_item'                => esc_html__( 'Update Portfolio Tag', 'creativa' ),
			'add_new_item'               => esc_html__( 'Add New Portfolio Tag', 'creativa' ),
			'new_item_name'              => esc_html__( 'New Portfolio Tag Name', 'creativa' ),
			'parent_item'                => esc_html__( 'Parent Portfolio Tag', 'creativa' ),
			'parent_item_colon'          => esc_html__( 'Parent Portfolio Tag:', 'creativa' ),
			'all_items'                  => esc_html__( 'All Portfolio Tags', 'creativa' ),
			'search_items'               => esc_html__( 'Search Portfolio Tags', 'creativa' ),
			'popular_items'              => esc_html__( 'Popular Portfolio Tags', 'creativa' ),
			'separate_items_with_commas' => esc_html__( 'Separate portfolio tags with commas', 'creativa' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove portfolio tags', 'creativa' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used portfolio tags', 'creativa' ),
			'not_found'                  => esc_html__( 'No portfolio tags found.', 'creativa' ),
    );
    $args['labels'] = $labels;

    return $args;
}


function creativa_flush_portfolio() {
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
add_action( 'init', 'creativa_flush_portfolio' );



/* ------------------------------------------------------------ */
/* 	Nav Icons */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_navicons' ) ) {
	function creativa_navicons() {
		global $creativa_options, $woocommerce;

		$hover_style = 'hover-full';
		if ($creativa_options['opt-navbar-style'] != 2 && $creativa_options['opt-navbar-style'] != 3) {
			if ($creativa_options['opt-hover-style'] == 2) {
				$hover_style = 'hover-boxed';
			}
		}

		$nav_search_icon = $creativa_options['opt-nav-search'];
		$nav_cart_icon = $creativa_options['opt-woo-shop-nav-icon'];
		$nav_hamburger_icon = $creativa_options['opt-secondary-nav'];

		$nav_layout = $creativa_options['opt-nav-layout'];

		$mobile_only_class = '';
		if ($nav_search_icon == 0 && $nav_cart_icon == 0 && $nav_hamburger_icon == 0) {
			$mobile_only_class = 'nav--mobile-only';
		}

		// if ($nav_search_icon == 1 || $nav_cart_icon == 1 || $nav_hamburger_icon == 1) {

			$icons_style = $creativa_options['opt-nav-icons-style'];

		?>
		<nav class="main-nav nav-icons <?php echo esc_attr($hover_style) .' '. esc_attr($mobile_only_class) ?>">
			<ul>
				<?php if ($nav_search_icon == 1 && $nav_layout == 1) { ?>
					<li class="nav-search">
						<a href="#"><div class="menu-a-inner"><span><i class="icon_search"></i><?php echo ''.($icons_style == 1) ? esc_html__('Search', 'creativa') : ''; ?></span></div></a>
					</li>
				<?php } ?>
				<?php
				if (function_exists('is_woocommerce') && $nav_cart_icon == true) {
					$cart_url = wc_get_cart_url();
					$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
					$cart_items_count = $woocommerce->cart->cart_contents_count;


				?>
					<li class="nav-bag hidden-xs hidden-sm">
						<a href="<?php echo esc_url($cart_url) ?>"><div class="menu-a-inner"><span><i class="icon_bag_alt"></i>
							<?php
								if ($icons_style == 1) {
									echo '<span class="nav__cart-subtotal">'. $cart_subtotal . '</span>';
								}
								elseif ($icons_style == 2 || $icons_style == 3) {
									echo '<span class="nav__cart-items">'. $cart_items_count . '</span>';
								}
							?>
						</span></div></a>
						<?php if ($nav_layout == 1) { ?>
						<ul class="nav-shopping-cart"><li><div class="hide_cart_widget_if_empty"><div class="widget_shopping_cart_content"></div></div></li></ul>
						<?php } ?>
					</li>
				<?php } ?>
				<?php if ($nav_layout == 1) { ?>
					<li class="nav-secondary-menu <?php echo ''.($nav_hamburger_icon == 1) ? '' : 'hidden-lg hidden-md'; ?>">
						<a href="#" class="secondary-nav-btn"><div class="menu-a-inner"><span><i class="icon_menu"></i><?php echo ''.($icons_style == 1) ? esc_html__('Menu', 'creativa') : ''; ?></span></div></a>
					</li>
				<?php } ?>
				<?php if ($nav_search_icon == 1 && $nav_layout == 2) { ?>
					<li class="nav-search">
						<?php get_search_form(); ?>
					</li>
				<?php } ?>
			</ul>
		</nav>
		<?php // } endif all enabled/dis ?>

		<?php
	}
}


/* ------------------------------------------------------------ */
/* Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links */
/* ------------------------------------------------------------ */
if (function_exists('add_theme_support')) {
	add_theme_support('post-formats', array('image', 'gallery', 'audio', 'video','quote', 'link'));
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_image_size( 'creativa-large', 1200, 9999 );
}


/* ------------------------------------------------------------ */
/* Image Resizer */
/* ------------------------------------------------------------ */

if (file_exists( get_template_directory() .'/loprdCore/AquaResizer/images_regenerate.php' )) {
	require_once( get_template_directory() .'/loprdCore/AquaResizer/images_regenerate.php' );
}

/* ------------------------------------------------------------ */
/* Excerpts */
/* ------------------------------------------------------------ */
function creativa_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action('init', 'creativa_excerpt');


function creativa_custom_excerpt_length( $length ) {
	global $creativa_options;

	if ($creativa_options['opt-excerpts'] == 1) {
		return $creativa_options['opt-excerpt-lenght'];
	} else {
		return 23;
	}

	if (is_search()) {
		return 35;
	}
}
add_filter( 'excerpt_length', 'creativa_custom_excerpt_length', 999 );

function creativa_new_excerpt_more( $more ) {
	return ' [...]<br><br><a class="more-link btn btn-default btn-sm" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__('Continue Reading', 'creativa') . '</a>';
}
add_filter( 'excerpt_more', 'creativa_new_excerpt_more' );


function creativa_more_link( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'creativa_more_link' );

function creativa_more_link_class( $link, $text ) {
    return str_replace('more-link', 'more-link btn btn-default btn-sm', $link);
}
add_action( 'the_content_more_link', 'creativa_more_link_class', 10, 2 );

/* ------------------------------------------------------------ */
/* Add Sidebar Support */
/* ------------------------------------------------------------ */
if (!function_exists('creativa_widgets_init')) {
	function creativa_widgets_init() {
		if (function_exists('register_sidebar')) {
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Main Sidebar', 'creativa' ),
					'id'			=> 'main-sidebar',
					'before_widget' => '<div id="%1$s" class="widget %2$s" >',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Single Post Sidebar', 'creativa' ),
					'id'			=> 'single-post-sidebar',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Footer Area 1', 'creativa' ),
					'id'			=> 'footer-area-1',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Footer Area 2', 'creativa' ),
					'id'			=> 'footer-area-2',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
		
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Footer Area 3', 'creativa' ),
					'id'			=> 'footer-area-3',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Footer Area 4', 'creativa' ),
					'id'			=> 'footer-area-4',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Sidebar Navigation', 'creativa' ),
					'id'			=> 'sidebar-nav',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
			register_sidebar(
				array(
					'name' 			=> esc_html__( 'Shop Sidebar', 'creativa' ),
					'id'			=> 'shop-sidebar',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h6 class="widgettitle">',
					'after_title'   => '</h6>'
				)
			);
		}
	}
}
add_action('widgets_init', 'creativa_widgets_init');


/* ------------------------------------------------------------ */
/* Stag Sidebar */
/* ------------------------------------------------------------ */

function creativa_stag_sidebars() {
	$stag_sidebar_h = array(
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="widgettitle">',
			'after_title'   => '</h6>',
	);

	return $stag_sidebar_h;
}

add_filter('stag_custom_sidebars_widget_args', 'creativa_stag_sidebars', 10, 2);

/* ------------------------------------------------------------ */
/* Wp Title */
/* ------------------------------------------------------------ */
 add_theme_support( 'title-tag' );

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function creativa_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'creativa_render_title' );
}


/* ------------------------------------------------------------ */
/* Post Counter */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_get_post_count' ) ) {
	function creativa_get_post_count($postID){
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '1');
	        return 1;
	    }
	    return $count;
	}
}

if ( ! function_exists ( 'creativa_set_post_count' ) ) {
	function creativa_set_post_count($postID) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 1;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '1');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
}


/* ------------------------------------------------------------ */
/* 	Headers */
/* ------------------------------------------------------------ */

function creativa_header_body_class($classes) {
	global $creativa_options;

	$header_transparency = $creativa_options['opt-navigation-transparency'];

	if ($creativa_options['opt-nav-layout'] == 1) {
		if ($creativa_options['opt-navbar-style'] != 4) {
			if ($header_transparency != 100) {
				$transparent_class = ' header-transparent';
			}
			else {
				$transparent_class = '';
			}
		}

		if ($creativa_options['opt-navbar-style'] == 1) {
			$classes[] = 'header-standard'.$transparent_class. '';
		}
		elseif ($creativa_options['opt-navbar-style'] == 2) {
			$classes[] = 'header-centered'.$transparent_class. '';
		}
		elseif ($creativa_options['opt-navbar-style'] == 3) {
			$classes[] = 'header-splitted'.$transparent_class. '';
		}
		elseif ($creativa_options['opt-navbar-style'] == 4  ) {
			$classes[] = 'header-bar header-transparent';
		}

		if ($creativa_options['opt-nav-full-width'] == true) {
			$classes[] = 'header-full-width';
		}
	}

	return $classes;
}

add_filter( 'body_class', 'creativa_header_body_class' );

if ( ! function_exists ( 'creativa_header_style' ) ) {
	function creativa_header_style() {
		global $creativa_options;

		if ($creativa_options['opt-nav-layout'] == 1) {

			if ($creativa_options['opt-navbar-style'] == 1 || $creativa_options['opt-navbar-style'] == 4) {
				$header_style = '';
			}
			elseif ($creativa_options['opt-navbar-style'] == 2) {
				$header_style = 'centered';
			}
			elseif ($creativa_options['opt-navbar-style'] == 3) {
				$header_style = 'splitted';
			}

			return $header_style;
		}
	}
}

/* ------------------------------------------------------------ */
/* 	Layout */
/* ------------------------------------------------------------ */
function creativa_layout_body_class($classes) {
	global $creativa_options;

	if ($creativa_options['opt-nav-layout'] == 1) {
		$classes[] = 'nav-layout-standard';
	}
	elseif ($creativa_options['opt-nav-layout'] == 2) {
		$classes[] = 'nav-layout-side';

		if ($creativa_options['opt-nav-side-position'] == 1) {
			$classes[] = 'nav-layout-side--left';
		}
		elseif ($creativa_options['opt-nav-side-position'] == 2) {
			$classes[] = 'nav-layout-side--right';
		}

		if ($creativa_options['opt-show-top-bar'] == 1) {
			$classes[] = 'nav-layout-side--top-bar header-full-width';
		}
	}

	if ($creativa_options['opt-layout'] == 1) {
		$classes[] = 'layout-wide';
	}
	elseif ($creativa_options['opt-layout'] == 2) {
		$classes[] = 'layout-boxed';
	}
	elseif ($creativa_options['opt-layout'] == 3) {
		$classes[] = 'layout-bordered';
	}

	return $classes;
}

add_filter( 'body_class', 'creativa_layout_body_class' );


/* ------------------------------------------------------------ */
/* 	Single Cover */
/* ------------------------------------------------------------ */
function creativa_single_cover_class($classes) {
	global $creativa_options, $post;

	if ($creativa_options['opt-title-bar'] == 0 || (is_home() && is_front_page())) {
		$classes[] = 'no--page-title';
	} else {
		$classes[] = 'with--page-title';
	}

	return $classes;
}

add_filter( 'body_class', 'creativa_single_cover_class' );

/* ------------------------------------------------------------ */
/* 	Single Project Layout */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_single_project_layout' ) ) {
	function creativa_single_project_layout() {
		global $creativa_options;

		if ($creativa_options['opt-project-layout'] == 1) {
			$single_project_layout = '';
		}
		elseif ($creativa_options['opt-project-layout'] == 2) {
			$single_project_layout = 'medium';
		}
		elseif ($creativa_options['opt-project-layout'] == 3) {
			$single_project_layout = 'wide';
		}
		elseif ($creativa_options['opt-project-layout'] == 4) {
			$single_project_layout = 'clean';
		}

		return $single_project_layout;
	}
}


/* ------------------------------------------------------------ */
/* Secondary Navigation */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_secondary_nav_style' ) ) {
	function creativa_secondary_nav_style() {
		global $creativa_options;

		if ($creativa_options['opt-secondary-nav-style'] == 1) {
			$secondary_nav_style = 'sidebar';
		}
		elseif ($creativa_options['opt-secondary-nav-style'] == 2) {
			$secondary_nav_style = 'full';
		}

		return $secondary_nav_style;
	}
}

function creativa_secondary_nav_classes($classes) {
	global $creativa_options;

	if ($creativa_options['opt-secondary-nav-style'] == 1) {
		$classes[] = 'secondary-nav--sidebar';
	}
	elseif ($creativa_options['opt-secondary-nav-style'] == 2) {
		$classes[] = 'secondary-nav--full';
	}

	return $classes;
}
add_filter( 'body_class', 'creativa_secondary_nav_classes' );


/* ------------------------------------------------------------ */
/* 	Footer Effects */
/* ------------------------------------------------------------ */
function creativa_footer_effects_class($classes) {
	global $creativa_options, $post;

	$footer_effect = $creativa_options['opt-footer-effect'];

	if ($footer_effect == 2) {
		$classes[] = 'footer--fixed';
	}

	return $classes;
}
add_filter( 'body_class', 'creativa_footer_effects_class' );


/* ------------------------------------------------------------ */
/* Search Bar */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_search' ) ) {
	function creativa_search() {
		global $creativa_options;

		if ($creativa_options['opt-nav-search'] == 1) {
            echo '<div class="search-bar search-bar-hidden">';
				echo '<div class="container"><div class="row"><div class="col-sm-12">';
	            echo '<span class="close-btn"><a href="#"><i class="icon_close"></i></a></span>';
	            get_search_form();
	            echo '</div></div></div>';
            echo '</div>';
		}

	}
}


/* ------------------------------------------------------------ */
/* Search Bar */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_page_share' ) ) {
	function creativa_page_share() {
		global $creativa_options; ?>

		<?php if ($creativa_options['opt-page-share'] == true) { ?>
		<div id="page-shares">
			<ul>
				<li><a href="#" title="<?php esc_html_e('Share this Page', 'creativa') ?>"><i class="fa fa-share-square-o"></i></a>
					<ul>
						<li><a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</li>
			</ul>
		</div>
		<?php } ?>

<?php
	}
}



/* ------------------------------------------------------------ */
/* Page Title */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_page_title' ) ) {
	function creativa_page_title() {

		global $post, $creativa_options, $woocommerce;

		$navbar_style = $creativa_options['opt-navbar-style'];

		$header_transparency = $creativa_options['opt-navigation-transparency'];
		if ($navbar_style == 4) {
			$header_transparency = 0;
		}
		$page_title_background = $creativa_options['opt-pt-bg'];

	if (is_page() || is_archive() || is_404() || is_search() || (is_front_page() && is_home() && $creativa_options['opt-title-bar'] == 1) || (is_singular('portfolio') && $creativa_options['opt-project-layout'] != 4) || (is_singular('post') && $creativa_options['opt-blog-page-style'] != 3) || is_singular('product')) {

			if ($creativa_options['opt-title-bar-centered'] == 1) {
				$pt_title_position = 'page-title-left';
			}
			elseif ($creativa_options['opt-title-bar-centered'] == 2) {
				$pt_title_position = 'page-title-center';
			}

			$scroll_animation = $creativa_options['opt-page-title-animation'];
			$scroll_animation_content = $creativa_options['opt-page-title-animation-content'];
			$scroll_animation_class = '';
			if ($scroll_animation != 0 || $scroll_animation_content != 0) {
				$scroll_animation_class .= 'page-title--animation ';
				// bg animations
				if ($scroll_animation == 1) {
					$scroll_animation_class .= 'page-title__animation--parallax';
				}
				elseif ($scroll_animation == 2) {
					$scroll_animation_class .= 'page-title__animation--scaledown';
				}
				elseif ($scroll_animation == 3) {
					$scroll_animation_class .= 'page-title__animation--scaleup';
				}
				elseif ($scroll_animation == 4) {
					$scroll_animation_class .= 'page-title__animation--fold';
				}
				elseif ($scroll_animation == 5) {
					$scroll_animation_class .= 'page-title__animation--fade';
				}

				//content animations
				if ($scroll_animation_content == 1) {
					$scroll_animation_class .= ' page-title__animation--content-slidedown';
				}
				elseif ($scroll_animation_content == 2) {
					$scroll_animation_class .= ' page-title__animation--content-stretch';
				}
				elseif ($scroll_animation_content == 3) {
					$scroll_animation_class .= ' page-title__animation--content-fadedown';
				}
			}

			$creativa_page_title = $creativa_options['opt-custom-page-title'];
			$creativa_page_subttitle = $creativa_options['opt-page-subtitle'];

			?>

	      	<!-- Page Title Container -->
			<section class="page-title-container <?php echo esc_attr($pt_title_position) .' '. esc_attr($scroll_animation_class) ?>">

				<?php if (!empty($page_title_background['background-image'])) { ?>
					<div class="page-title-bg"></div>
				<?php } ?>

				<?php if ($creativa_options['opt-pt-overlay'] == 1) { ?>
					<div class="page-title__overlay"></div>
				<?php } ?>

				<?php

					$animated_canvas = $creativa_options['opt-animated-canvas-type'];

					if ($animated_canvas != 0) {

						wp_enqueue_script('creativa-canvases');

						// 1:metaBalls
						// 2:bouncyPolygons,
						// 3:bouncyBalls,
						// 4:slowBubbles,
						// 5:confetti,

						$canvasAnimation = $animated_canvas;
						$animColor = $creativa_options['opt-animated-canvas-color'];
						$animCount = $creativa_options['opt-animated-canvas-count'];


						if ($canvasAnimation == 1) {
							$canvas_data = 'data-animation="metaBalls" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 2) {
							$canvas_data = 'data-animation="bouncyPolygons" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 3) {
							$canvas_data = 'data-animation="bouncyBalls" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 4) {
							$canvas_data = 'data-animation="slowBubbles" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 5) {
							$canvas_data = 'data-animation="confetti" data-color="'. esc_attr($animColor['rgba']) .'"';
						}
						elseif ($canvasAnimation == 6) {
							$canvas_data = 'data-animation="linesRain" data-color="'. esc_attr($animColor['rgba']) .'"';
						}
						elseif ($canvasAnimation == 7) {
							$canvas_data = 'data-animation="filmGrain"';
						}

						echo '<canvas class="animated-canvas" '. $canvas_data .'></canvas>';
					} // endif animated canvas

				?>

				<div class="page-title-content">
				    <div class="container">
				      	<div class="row">
				        	<!-- Page Title -->
					        <div class="col-md-12">
								<div class="page-title">
									<div class="title-wrap">
										<?php if (is_search()) { ?>
										<h1 class="creativa-title"><?php esc_html_e('Search results for: ', 'creativa'); ?><span class="font-secondary"><?php echo get_search_query();  ?></span></h1>
										<?php } elseif (is_category()) { ?>
										<h1 class="creativa-title"><?php esc_html_e('Category: ', 'creativa'); ?><span class="font-secondary"><?php echo single_cat_title(); ?></span></h1>
										<?php } elseif (is_tag()) { ?>
										<h1 class="creativa-title"><?php esc_html_e('Tag: ', 'creativa'); ?><span class="font-secondary"><?php echo single_tag_title(); ?></span></h1>
										<?php } elseif (is_author()) { ?>
										<h1 class="creativa-title"><?php esc_html_e('Author: ', 'creativa'); ?><span class="font-secondary"><?php echo  get_the_author(); ?></span></h1>
										<?php } elseif (is_404()) { ?>
										<h1 class="creativa-title"><?php esc_html_e('Page not Found!', 'creativa'); ?></h1>
										<?php } elseif ($woocommerce && is_woocommerce()) { ?>
											<?php if (is_shop() || is_product()) { ?>
												<?php if (!empty($creativa_options['opt-shop-welcome']) && $creativa_options['opt-shop-welcome'] != 'Shop') { ?>
													<h1 class="creativa-title"><?php echo esc_html($creativa_options['opt-shop-welcome']) ?></h1>
												<?php } else { ?>
													<h1 class="creativa-title"><?php esc_html_e('Shop', 'creativa') ?></h1>
												<?php } ?>
											<?php } elseif (is_product_category() || is_product_tag()) { ?>
												<h1 class="creativa-title"><?php esc_html_e('Category:', 'creativa') ?> <span class="font-secondary"><?php single_term_title() ?></span></h1>
											<?php } ?>
										<?php } elseif (is_archive()) { ?>
											<h1 class="creativa-title"><?php esc_html_e('Archive ', 'creativa'); ?></h1>
										<?php } elseif (is_front_page()) { ?>
											<h1 class="creativa-title"><?php esc_html_e('Blog ', 'creativa'); ?></h1>
										<?php } elseif (is_front_page() && is_page()) { ?>
										  	<?php if ($creativa_page_title) { ?>
										  		<?php echo wpautop($creativa_page_title); ?>
												<?php
													if (!empty($creativa_options['opt-page-subtitle'])) { ?>
														<h4 class="creativa-subtitle"><span><?php echo esc_html($creativa_page_subttitle); ?></span></h4>
													<?php }
												?>
										  	<?php } else { ?>
												<h1 class="creativa-title"><?php echo get_the_title($post->ID); ?></h1>
												<?php
													if (!empty($creativa_options['opt-page-subtitle'])) { ?>
														<h4 class="creativa-subtitle"><span><?php echo esc_html($creativa_page_subttitle); ?></span></h4>
													<?php }
												?>
											<?php } ?>
										<?php } elseif ($creativa_options['opt-custom-page-title']) { ?>
										<?php echo wpautop($creativa_page_title); ?>
										<?php
											if (!empty($creativa_options['opt-page-subtitle'])) { ?>
												<h4 class="creativa-subtitle"><span><?php echo esc_html($creativa_page_subttitle); ?></span></h4>
											<?php }
										?>
										<?php } else { ?>
											<?php if (is_single()) { ?>
												<h1 class="single__title creativa-title"><?php single_post_title(); ?></h1>
											<?php } else { ?>
												<h1 class="creativa-title"><?php single_post_title(); ?></h1>
												<?php
													if (!empty($creativa_options['opt-page-subtitle'])) { ?>
														<h4 class="creativa-subtitle"><span><?php echo esc_html($creativa_page_subttitle); ?></span></h4>
													<?php }
												?>
											<?php } ?>
										<?php } ?>

									</div>
								</div>
						    </div><!-- Page Title End -->
					    </div>
					</div>
				</div>

			</section><!-- Page Title Container End -->

		<?php }
	      elseif ($header_transparency != 100 && ((is_home() && is_front_page()) || (is_home() && $creativa_options['opt-title-bar'] == 0) || !is_page_template( 'template-full-width.php' ))) { // single settings
	      	?>
	      		<section class="page-title-container">

			      	<?php if (!empty($page_title_background['background-image'])) { ?>
			      		<div class="page-title-bg"></div>
			      	<?php } ?>

			      	<?php if ($creativa_options['opt-pt-overlay'] == 1) { ?>
			      		<div class="page-title__overlay"></div>
			      	<?php } ?>

			      	<?php

					$animated_canvas = $creativa_options['opt-animated-canvas-type'];

					if ($animated_canvas != 0) {

						wp_enqueue_script('creativa-canvases');

						// 1:metaBalls
						// 2:bouncyPolygons,
						// 3:bouncyBalls,
						// 4:slowBubbles,
						// 5:confetti,

						$canvasAnimation = $animated_canvas;
						$animColor = $creativa_options['opt-animated-canvas-color'];
						$animCount = $creativa_options['opt-animated-canvas-count'];


						if ($canvasAnimation == 1) {
							$canvas_data = 'data-animation="metaBalls" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 2) {
							$canvas_data = 'data-animation="bouncyPolygons" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 3) {
							$canvas_data = 'data-animation="bouncyBalls" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 4) {
							$canvas_data = 'data-animation="slowBubbles" data-color="'. esc_attr($animColor['rgba']) .'" data-balls-count="'. intval($animCount) .'"';
						}
						elseif ($canvasAnimation == 5) {
							$canvas_data = 'data-animation="confetti" data-color="'. esc_attr($animColor['rgba']) .'"';
						}
						elseif ($canvasAnimation == 6) {
							$canvas_data = 'data-animation="linesRain" data-color="'. esc_attr($animColor['rgba']) .'"';
						}
						elseif ($canvasAnimation == 7) {
							$canvas_data = 'data-animation="filmGrain"';
						}

						echo '<canvas class="animated-canvas" '. $canvas_data .'></canvas>';
					} // endif animated canvas

			      	?>

	      		</section>

	      	<?php
	    }
	}
}








/* ------------------------------------------------------------ */
/* Top Bar */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_topbar' ) ) {
	function creativa_topbar() {
		global $creativa_options;

		$top_bar_text = $creativa_options['opt-top-bar-text'];
		$current_user = wp_get_current_user(); ?>



		<?php
		if ($creativa_options['opt-show-top-bar'] == 1) { ?>
			<!-- Top bar -->
		<div id="top-bar">
			<div class="container">
			  <div class="row">
			    <div class="col-md-12">

					<div class="top-bar__content--left">

				      <?php if (!empty($creativa_options['opt-top-bar-text'])) { ?>
				      	<div class="top-bar__content--container">
					        <?php echo wpautop( $top_bar_text, false ); ?>
					        <?php do_action('icl_language_selector'); ?>
				        </div>
				      <?php } ?>

					</div>
					<div class="top-bar__content--right">

				      <?php
				      	if (function_exists('is_woocommerce')) {
				      		if ( is_user_logged_in() ) {
					      		?>
					      		<div class="woo-settings">
					      			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>" class="woo-settings-cog"><?php echo esc_html($current_user->user_login) ?></a>
					      			<ul>
					      				<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ) ?>"><?php esc_html_e('My Account', 'creativa') ?></a></li>
					      				<li><a href="<?php echo wc_customer_edit_account_url() ?>"><?php esc_html_e('Edit Settings', 'creativa') ?></a></li>
					      				<li><a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) ?>" class="btn btn-default btn-block btn-squared"><?php esc_html_e('Sign out', 'creativa') ?></a></li>
					      			</ul>
					      		</div>
					      		<?php
				      		} else { ?>
					      		<div class="woo-settings">
					      			<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="woo-settings-login"><?php ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) ? esc_html_e('Login/Register', 'creativa') : esc_html_e('Login', 'creativa') ?></a>
					      		</div>
				      		<?php
				      		}
				      	}
				      ?>

				      <div class="nav-social-icons hidden-xs hidden-sm"><?php header_social_icons(); ?></div>

					</div>

			    </div>
			  </div>
			</div>
		</div><!-- Top bar End -->
		<?php } ?>
	<?php
	}
}


/* ------------------------------------------------------------ */
/* Pagination */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_pagination' ) ) {
	function creativa_pagination( $query=null ) {
		global $wp_query;
		$query = $query ? $query : $wp_query;
		$big = 999999999;

		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'type' => 'array',
			'total' => $query->max_num_pages,
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'prev_text' => '<span>&larr;</span> ' . esc_html__('Previous Page', 'creativa'),
			'next_text' => esc_html__('Next Page', 'creativa').' <span>&rarr;</span>',
		)
		);


		if ($query->max_num_pages > 1) :
		?>

		<div class="pagination-wrap">
			<ul class="pagination">
			<?php
				foreach ( $paginate as $page ) {
					echo '<li>' . $page . '</li>';
				}
			?>
			</ul>
		</div>

		<?php
	  	endif;
	}
}



/* ------------------------------------------------------------ */
/* Custom Function for Displaying Comments */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_comments' ) ) {
	function creativa_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>

			<li class="pingback" id="comment-<?php comment_ID(); ?>">
				<div <?php comment_class('the-comment'); ?>>
					<div class="comment-content">
						<div class="comment-body">
							<div class="meta"><?php esc_html_e('Pingback:', 'creativa'); ?>
								<?php edit_comment_link(); ?>
							</div>
							<div class="meta"><?php comment_author_link(); ?></div>
						</div>
					</div>
				</div>

		<?php endif; ?>

		<?php if (get_comment_type() == 'comment') : ?>
			<li id="comment-<?php comment_ID(); ?>" >
				<div <?php comment_class('the-comment'); ?>>
		            <div class="avatar">
						<?php
							$avatar_size = 70;
							if ($comment->comment_parent != 0) {
								$avatar_size = 48;
							}

							echo get_avatar($comment, $avatar_size);
						?>
		            </div>
					<div class="comment-content">
						<div class="comment-body">
							<div class="meta font-secondary">by <span class="comment-author"><?php comment_author_link(); ?></span> at <?php comment_date(); ?>, <?php comment_time(); ?>  <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => ''))); ?></div>
							<?php if ($comment->comment_approved == '0') : ?>
								<p class="awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'creativa'); ?></p>
							<?php endif; ?>
							<?php comment_text(); ?>
						</div>
					</div>
				</div>

		<?php endif;
	}
}


/* ------------------------------------------------------------ */
/* Custom Comment Form */
/* ------------------------------------------------------------ */
function creativa_custom_comment_form($defaults) {

	$defaults['comment_notes_before'] = '';
	$defaults['id_form'] = 'comment-form';
	$defaults['comment_field'] = '<textarea placeholder="'. esc_html__('Comment...', 'creativa') .'" name="comment" id="comment" cols="30" rows="6"></textarea>';

	return $defaults;
}

add_filter('comment_form_defaults', 'creativa_custom_comment_form');

function creativa_custom_comment_fields() {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');

	$fields = array(
		'author' => '<div id="comment-input"><div class="input-group">' .
						'<input id="author" name="author" placeholder="'. esc_html__('Name', 'creativa') .''. ($req ? esc_html__(' (required)', 'creativa') : '') .'" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />' .
						'<span class="input-group-addon"><i class="icon_id"></i></span>' .
		            '</div>',
		'email' => '<div class="input-group">' .
						'<input id="email" name="email" placeholder="'. esc_html__('Email', 'creativa') .''. ($req ? esc_html__(' (required)', 'creativa') : '') .'" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />' .
						'<span class="input-group-addon"><i class="icon_mail_alt"></i></span>' .
		            '</div>',
		'url' => '<div class="input-group">' .
						'<input id="url" name="url" type="text" placeholder="'. esc_html__('Website', 'creativa') .'" value="' . esc_attr($commenter['comment_author_url']) . '" />' .
						'<span class="input-group-addon"><i class="icon_link_alt"></i></span>' .
		          '</div></div>'
	);

	return $fields;
}

add_filter('comment_form_default_fields', 'creativa_custom_comment_fields');


/* ------------------------------------------------------------ */
/* Comments Disable for page and portfolio */
/* ------------------------------------------------------------ */

function creativa_default_comments_off( $data ) {
    if( $data['post_type'] == 'portfolio' && $data['post_status'] == 'auto-draft' ) {
        $data['comment_status'] = 0;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'creativa_default_comments_off' );


/* ------------------------------------------------------------ */
/* Header Social icons */
/* ------------------------------------------------------------ */
include('includes/extras/header-social-icons.php');

function creativa_cat_count_span($links) {
  $links = str_replace(' (', ' <span class="count">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
add_filter('wp_list_categories', 'creativa_cat_count_span');


function creativa_archive_count_span($links) {
  $links = str_replace('&nbsp;(', ' <span class="count">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
add_filter('get_archives_link', 'creativa_archive_count_span');

/* ------------------------------------------------------------ */
/* Video conversion */
/* ------------------------------------------------------------ */
if ( ! function_exists ( 'creativa_convert_videos' ) ) {
	function creativa_convert_videos($string) {
	  $rules = array(
	    '#https?://(www\.)?youtube\.com/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)#i' => '<iframe width="560" height="315" src="http://www.youtube.com/embed/$2" style="border:none" allowfullscreen></iframe>',

	    '#https?://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i' => '<iframe src="http://player.vimeo.com/video/$2" width="500" height="281" style="border:none" allowfullscreen></iframe>'
	  );

	  foreach ($rules as $link => $player)
	    $string = preg_replace($link, $player, $string);

	  return $string;
	}
}

/* ------------------------------------------------------------ */
/* TinyMce Creativa Custom */
/* ------------------------------------------------------------ */

include_once('includes/extras/creativa-tinymce-formats.php');

/* ------------------------------------------------------------ */
/* Woocommerce */
/* ------------------------------------------------------------ */
include_once('loprdCore/woocommerce/creativa_woo.php');

/* ------------------------------------------------------------ */
/* Demo Import */
/* ------------------------------------------------------------ */

function creativa_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__('Main Demo', 'creativa'),
            'import_file_url'            => 'http://demo.loprd.pl/creativa/demo-content/main-demo/content.xml',
            'import_widget_file_url'     => 'http://demo.loprd.pl/creativa/demo-content/main-demo/widgets.wie',
            'import_preview_image_url'     => 'http://demo.loprd.pl/creativa/demo-content/main-demo/screen-image.jpg',
            'import_notice'                => esc_html__( 'After you import this demo, you will have to setup <strong>theme options</strong> and the <strong>sliders</strong> separately. <strong>Read more in docs!</strong>', 'creativa' ),
        ),
        array(
            'import_file_name'             => esc_html__('Side Demo', 'creativa'),
            'import_file_url'            => 'http://demo.loprd.pl/creativa/demo-content/side-demo/content.xml',
            'import_widget_file_url'     => 'http://demo.loprd.pl/creativa/demo-content/side-demo/widgets.wie',
            'import_preview_image_url'     => 'http://demo.loprd.pl/creativa/demo-content/side-demo/screen-image.jpg',
            'import_notice'                => esc_html__( 'After you import this demo, you will have to setup <strong>theme options</strong> and the <strong>sliders</strong> separately. <strong>Read more in docs!</strong>', 'creativa' ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'creativa_ocdi_import_files' );

// for is_plugin_activate()
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/loprdCore/TGM/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'creativa_register_js_composer_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function creativa_register_js_composer_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'			=> esc_html__('Creativa Core', 'creativa'), 
            'slug'			=> 'creativa-core', 
            'source'			=> 'creativa-core.zip', 
            'required'			=> true, 
            'version'			=> '0.1',
            'force_activation'		=> true,
            'force_deactivation'	=> false,
            'external_url'		=> '',
        ),
        array(
            'name'      => esc_html__('Redux Framework', 'creativa'),
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
        array(
            'name'			=> esc_html__('WPBakery Visual Composer', 'creativa'), // The plugin name
            'slug'			=> 'js_composer', // The plugin slug (typically the folder name)
            'source'			=> 'js_composer.zip', // The plugin source
            'required'			=> true, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '6.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'			=> esc_html__('Revolution Slider', 'creativa'), // The plugin name
            'slug'			=> 'revslider', // The plugin slug (typically the folder name)
            'source'			=> 'revslider.zip', // The plugin source
            'required'			=> false, // If false, the plugin is only 'recommended' instead of required
            'version'			=> '6.2.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'		=> '', // If set, overrides default API URL and points to an external URL
        ),
        array(
            'name'      => esc_html__('Portfolio Post Type', 'creativa'),
            'slug'      => 'portfolio-post-type',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Stag Custom Sidebars', 'creativa'),
            'slug'      => 'stag-custom-sidebars',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Woocommerce', 'creativa'),
            'slug'      => 'woocommerce',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Contact Form 7', 'creativa'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('One Click Demo Import', 'creativa'),
            'slug'      => 'one-click-demo-import',
            'required'  => false,
        ),
        array(
            'name' => esc_html__('Envato Market', 'omnis'),
            'slug' => 'envato-market',
            'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
            'required' => false,
        ),
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'creativa';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'		=> $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path'		=> THEMEROOT. '/plugins/', // Default absolute path to pre-packaged plugins
        'parent_slug'	=> 'themes.php', // Default parent menu slug
        // 'parent_url_slug'	=> 'themes.php', // Default parent URL slug
        // 'menu'			=> 'install-required-plugins', // Menu slug
        'has_notices'		=> true, // Show admin notices or not
        'is_automatic'		=> true, // Automatically activate plugins after installation or not
        'message'		=> '', // Message to output right before the plugins table
        'strings'		=> array(
            'page_title'			=> esc_html__( 'Install Required Plugins', 'creativa' ),
            'menu_title'			=> esc_html__( 'Install Plugins', 'creativa' ),
            'installing'			=> esc_html__( 'Installing Plugin: %s', 'creativa' ), // %1$s = plugin name
            'oops'				=> esc_html__( 'Something went wrong with the plugin API.', 'creativa' ),
            'notice_can_install_required'	=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'creativa' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'creativa' ), // %1$s = plugin name(s)
            'notice_cannot_install'		=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'creativa' ), // %1$s = plugin name(s)
            'notice_can_activate_required'	=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'creativa' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'creativa' ), // %1$s = plugin name(s)
            'notice_cannot_activate'		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'creativa' ), // %1$s = plugin name(s)
            'notice_ask_to_update'		=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'creativa' ), // %1$s = plugin name(s)
            'notice_cannot_update'		=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'creativa' ), // %1$s = plugin name(s)
            'install_link'			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'creativa' ),
            'activate_link'			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'creativa' ),
            'return'				=> esc_html__( 'Return to Required Plugins Installer', 'creativa' ),
            'plugin_activated'			=> esc_html__( 'Plugin activated successfully.', 'creativa' ),
            'complete'				=> esc_html__( 'All plugins installed and activated successfully. %s', 'creativa' ), // %1$s = dashboard link
            'nag_type'				=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );
    tgmpa( $plugins, $config );
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'creativa_vcSetAsTheme' );
function creativa_vcSetAsTheme() {
	vc_set_as_theme(true);
	vc_disable_frontend();
}
if (class_exists('WPBakeryVisualComposerAbstract')) {
	function creativa_addons_to_vc(){
		require_once get_template_directory() .'/loprdCore/vc_custom/creativa_vc_custom.php';

		$dir = get_template_directory() . '/loprdCore/vc_custom/creativa_vc_templates/';
		vc_set_shortcodes_templates_dir($dir);

	}
	add_action('vc_before_init','creativa_addons_to_vc', 5);
}


add_filter( 'vc_shortcodes_css_class', 'creativa_custom_css_classes_for_vc_row', 10, 2 );
function creativa_custom_css_classes_for_vc_row( $class_string, $tag ) {
  if ( $tag == 'vc_column' || $tag == 'vc_column_inner') {
  	if (!vc_is_frontend_editor()) {
    	$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'vc_col-md-$1', $class_string ); // This will replace "vc_col-sm-%" with "my_col-sm-%"
  	} else {
    	$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'vc_col-sm-$1', $class_string ); // This will replace "vc_col-sm-%" with "my_col-sm-%"
  	}
  }
  return $class_string; // Important: you should always return modified or original $class_string
}

add_filter('wpb_widget_title', 'creativa_override_widget_title', 10, 2);
function creativa_override_widget_title($output = '', $params = array('')) {
  $extraclass = (isset($params['extraclass'])) ? " ".$params['extraclass'] : "";
  return '<h6 class="entry-title'.$extraclass.'">'.$params['title'].'</h6>';
}

// Remove Grid Elements from Menu
function creativa_grid_elements_disable(){
  remove_menu_page( 'edit.php?post_type=vc_grid_item' );
}
add_action( 'admin_menu', 'creativa_grid_elements_disable' );

/**
 * Shortcode Output Function
 * 
 * @param output - shortcode content output
 * @param name - shortcode name
 * 
 * @return output
 */

if (!function_exists('creativa_shortcode_output')) {
	function creativa_shortcode_output($output, $name = null, $atts = null) {
	  if ($output) {
		if ($name && $atts) {
		  return apply_filters('creativa_filter__shortcode_'. esc_attr($name) .'_output', $output, $atts);
		} else {
		  return $output;
		}
	  }
	}
  }

if (!class_exists('Creativa_Core')) {
	if (!function_exists('aq_resize')) {
		function aq_resize($url, $width = 100, $height = 100) {
			if (!$url) { return; }

			return array(
				esc_url($url),
				intval($width),
				intval($height)
			);
		}
	}
}

?>
