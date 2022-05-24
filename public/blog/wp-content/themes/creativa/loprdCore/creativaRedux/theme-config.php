<?php
    /**
     * ReduxFramework Creativa Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */


    // This is your option name where all the Redux data is stored.
    $opt_name = "creativa_options";

    // This line is only for altering the demo. Can be easily removed.
    // $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $images_path = get_template_directory_uri() . '/loprdCore/creativaRedux/options_img';

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        'disable_tracking' => true,
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'creativa' ),
        'page_title'           => esc_html__( 'Theme Options', 'creativa' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'creativa' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'creativa' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'creativa' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'creativa' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'creativa' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('General', 'creativa'),
        'desc'      => esc_html__('General Theme Settings.', 'creativa'),
        'icon'      => 'el-icon-cogs',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-logo',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Logo Image', 'creativa'),
                'subtitle'  => esc_html__('Main Logo Image.', 'creativa'),
                'default'   => '',
                'mode'      => 'image',
            ),

            array(
                'id'        => 'opt-logo-stickyh',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Sticky Header Logo Image', 'creativa'),
                'subtitle'  => esc_html__('Sticky Header Custom Logo Image (overwrite main logo).', 'creativa'),
                'default'   => '',
                'required'  => array('opt-show-sticky-header', "=", 1),
                'mode'      => 'image',
            ),

            array(
                'id'        => 'opt-logo-mobile',
                'type'      => 'media',
                'url'       => true,
                'title'     => esc_html__('Mobile Navigation Logo Image', 'creativa'),
                'subtitle'  => esc_html__('Mobile/Full Width Custom Logo Image (overwrite main logo).', 'creativa'),
                'default'   => '',
                'mode'      => 'image',
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Layout', 'creativa'),
        'desc'      => esc_html__('Layout Settings', 'creativa'),
        'icon'      => 'el-icon-website',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(                    



            array(
                'id'        => 'opt-nav-layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Navigation Layout', 'creativa'),
                'subtitle'  => esc_html__('Navigation layout.', 'creativa'),
                'options'   => array(
                    '1' => array('title'=>'Standard', 'alt' => 'Standard Header', 'img' => $images_path .'/option_nav-layout-standard.jpg'),
                    '2' => array('title'=>'Side', 'alt' => 'Side Navigation', 'img' => $images_path .'/option_nav-layout-side.jpg'),
                ),
                'default'   => '1',
            ),

            array(
                'id'        => 'opt-nav-side-position',
                'type'      => 'button_set',
                'title'     => esc_html__('Side Navigation Position', 'creativa'),
                'subtitle'  => esc_html__('Position of page navigation.', 'creativa'),
                'required'  => array('opt-nav-layout', "=", 2),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Left', 
                    '2' => 'Right'
                ), 
                'default'   => '1'
            ),                         

            array(
                'id' => 'section-basic-settings-start',
                'type' => 'section',
                'title' => esc_html__('Body Layout', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ), 

            array(
                'id'        => 'opt-layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Layout', 'creativa'),
                'subtitle'  => esc_html__('Theme layout.', 'creativa'),
                'options'   => array(
                    '1' => array('title'=>'Wide', 'alt' => 'Wide',       'img' => $images_path .'/option_layout-wide.jpg'),
                    '2' => array('title'=>'Boxed', 'alt' => 'Boxed', 'img' => $images_path .'/option_layout-boxed.jpg'),
                    '3' => array('title'=>'Bordered', 'alt' => 'Bordered','img' => $images_path .'/option_layout-bordered.jpg'),
                ),
                'default'   => '1'
            ),

            array(
                'id'            => 'opt-content-width',
                'type'          => 'slider',
                //'required'      => array('opt-title-bar', "=", 1),
                'title'         => esc_html__('Content Width', 'creativa'),
                'subtitle'      => esc_html__('Content Container Width.', 'creativa'),
                'desc'          => esc_html__('Min: 940, max: 1300, default value: 1300', 'creativa'),
                'default'       => 1300,
                'min'           => 940,
                'step'          => 12,
                'max'           => 1300,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-boxed-gap',
                'type'          => 'slider',
                //'required'      => array('opt-title-bar', "=", 1),
                'title'         => esc_html__('Boxed Container Gap', 'creativa'),
                'required'      => array('opt-layout','=','2'),
                'subtitle'      => esc_html__('Gap between content and background.', 'creativa'),
                'desc'          => esc_html__('Min: 30, max: 150, default value: 60', 'creativa'),
                'default'       => 60,
                'min'           => 30,
                'step'          => 5,
                'max'           => 150,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-border-size',
                'type'          => 'slider',
                //'required'      => array('opt-title-bar', "=", 1),
                'title'         => esc_html__('Layout Border Size', 'creativa'),
                'required'      => array('opt-layout','=','3'),
                'subtitle'      => esc_html__('Bordered layout - border padding.', 'creativa'),
                'desc'          => esc_html__('Min: 10, max: 60, default value: 20', 'creativa'),
                'default'       => 20,
                'min'           => 10,
                'step'          => 5,
                'max'           => 60,
                'display_value' => 'text'
            ),

            array(
                'id'       => 'opt-content-padding',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                //'top'           => false,     // Disable the top
                'right'         => false,     // Disable the right
                //'bottom'        => false,     // Disable the bottom
                'left'          => false,     // Disable the left
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                // 'display_units' => true,   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Content Padding', 'creativa' ),
                'subtitle' => esc_html__( 'Content Padding top and bottom dimensions. (default: top: 100px, bottom: 100px)', 'creativa' ),
                'default'  => array(
                    'padding-top'    => '100px',
                    'padding-bottom' => '100px'
                )
            ),

            array(
                'id'        => 'opt-body-bg',
                'type'      => 'background',
                'title'     => esc_html__('Body Background', 'creativa'),
                'required'      => array('opt-layout','!=','1'),
                'subtitle'  => esc_html__('Body background color or image.', 'creativa'),
                //'preview_height' => '100px',
                'preview'   => true,
                'preview_media' => true,
                'transparent' => false,
                'default'   => array(
                    'background-color' => "#282828"
                ),
            ),

            array(
                'id' => 'section-basic-settings-end',
                'type' => 'section',
                'indent' => false 
            ),          


            array(
                'id' => 'section-usability-start',
                'type' => 'section',
                'title' => esc_html__('Usability', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'        => 'opt-page-share',
                'type'      => 'switch',
                'title'     => esc_html__('Page Shares button', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable page shares button.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-back-to-top',
                'type'      => 'switch',
                'title'     => esc_html__('Back to Top Button', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Back to Top button.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id' => 'section-usability-end',
                'type' => 'section',
                'indent' => false 
            ),
        ),
    ) );


    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Header', 'creativa'),
        'desc'      => esc_html__('Header Settings', 'creativa'),
        'icon'      => 'el-icon-chevron-up',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(
            

            array(
                'id'        => 'opt-navbar-style',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Navigation Bar Style', 'creativa'),
                'subtitle'  => esc_html__('Main Navbar style.', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'options'   => array(
                    '1' => array('alt' => 'Header Standard',       'img' => $images_path .'/option_header-standard.jpg'),
                    '3' => array('alt' => 'Header Splitted','img' => $images_path .'/option_header-splitted.jpg'),
                    '4' => array('alt' => 'Header Bar',  'img' => $images_path .'/option_header-bar.jpg'),
                    '2' => array('alt' => 'Header Centered', 'img' => $images_path .'/option_header-centered.jpg'),
                ),
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-nav-full-width',
                'type'      => 'switch',
                'title'     => esc_html__('Navigation Bar - Full Width', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'  => esc_html__('Enable/Disable Full Window Width navigation bar.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'            => 'opt-navbar-height',
                'type'          => 'slider',
                'title'         => esc_html__('Navbar Height', 'creativa'),
                'required' => array( 
                                array('opt-navbar-style','!=','2'), 
                                array('opt-navbar-style','!=','4') 
                ),                        
                'subtitle'      => esc_html__('Navbar height in pixels.', 'creativa'),
                'desc'          => esc_html__('Navbar height. Min: 60, max: 300, default value: 100', 'creativa'),
                'default'       => 100,
                'min'           => 60,
                'step'          => 5,
                'max'           => 300,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-header-height',
                'type'          => 'slider',
                'required'      => array('opt-navbar-style','=','2'),
                'title'         => esc_html__('Header Height', 'creativa'),
                'subtitle'      => esc_html__('Header height in pixels.', 'creativa'),
                'desc'          => esc_html__('Navbar height. Min: 120, max: 500, default value: 150', 'creativa'),
                'default'       => 150,
                'min'           => 120,
                'step'          => 5,
                'max'           => 500,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-header-bar-height',
                'type'          => 'slider',
                'required'      => array('opt-navbar-style','=','4'),
                'title'         => esc_html__('Header Bar Height', 'creativa'),
                'subtitle'      => esc_html__('Header bar height in pixels.', 'creativa'),
                'desc'          => esc_html__('Min: 60, max: 200, default value: 100', 'creativa'),
                'default'       => 100,
                'min'           => 60,
                'step'          => 5,
                'max'           => 200,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-header-bar-gap',
                'type'          => 'slider',
                'required'      => array('opt-navbar-style','=','4'),
                'title'         => esc_html__('Header Bar Gap', 'creativa'),
                'subtitle'      => esc_html__('Header bar top gap.', 'creativa'),
                'desc'          => esc_html__('Min: 30, max: 60, default value: 30', 'creativa'),
                'default'       => 30,
                'min'           => 0,
                'step'          => 5,
                'max'           => 60,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-menu-position',
                'type'      => 'button_set',
                'title'     => esc_html__('Menu Position', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'  => esc_html__('Menu position on navbar.', 'creativa'),                   
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Left', 
                    '2' => 'Center', 
                    '3' => 'Right'
                ), 
                'default'   => '2'
            ),

            array(
                'id'        => 'opt-hover-style',
                'type'      => 'image_select',
                'compiler'  => true,
                // 'required' => array('opt-navbar-style','!=','2'),    
                'title'     => esc_html__('Hover Style', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'  => esc_html__('Main Menu hover style.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Hover Block',       'img' => $images_path .'/option_hover-block.jpg'),
                    '2' => array('alt' => 'Hover Boxed',  'img' => $images_path .'/option_hover-boxed.jpg')
                ),
                'default'   => '1'
            ),
            array(
                'id'        => 'opt-nav-separators',
                'type'      => 'switch',
                'title'     => esc_html__('Header separators', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable header extra separator lines.', 'creativa'),
                'default'   => true,
            ),      



            array(
                'id' => 'section-icons-start',
                'type' => 'section',
                'title' => esc_html__('Nav Icons', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'        => 'opt-nav-search',
                'type'      => 'switch',
                'title'     => esc_html__('Search Icon', 'creativa'),
                'subtitle'  => esc_html__('Search icon in Navbar', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-secondary-nav',
                'type'      => 'switch',
                // 'required'  => array('opt-title-bar', "=", 1),
                'title'     => esc_html__('Hamburger Icon', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'  => esc_html__('Show "Hamburger" icon for secondary/mobile navigation', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'        => 'opt-woo-shop-nav-icon',
                'type'      => 'switch',
                'title'     => esc_html__('Shopping Bag Icon / Cart', 'creativa'),
                'subtitle'  => esc_html__('WooCommerce - Show shopping bag icon and cart in main navigation.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'       => 'opt-nav-icons-style',
                'type'     => 'select',
                'title'    => esc_html__('Icons style', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'options'  => array(
                    '2' => 'Small Icons',
                    '3' => 'Large Icons',
                    '1' => 'Icons with text',
                ),
                'default'   => '2',
            ),

            array(
                'id' => 'section-icons-end',
                'type' => 'section',
                'indent' => false 
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Sticky Header', 'creativa'),
        'desc'      => esc_html__('Sticky Header Settings.', 'creativa'),
        'icon'      => 'el-icon-download-alt',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-show-sticky-header',
                'type'      => 'switch',
                'required'  => array('opt-nav-layout', "=", 1),
                'title'     => esc_html__('Show Sticky Header', 'creativa'),
                'subtitle'  => esc_html__('Show sticky header navigation.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'            => 'opt-sticky-header-height',
                'type'          => 'slider',
                'title'         => esc_html__('Sticky Header Height', 'creativa'),
                'required'  => array('opt-show-sticky-header', "=", 1),    
                'subtitle'      => esc_html__('Sticky Header height in pixels.', 'creativa'),
                'desc'          => esc_html__('Sticky Header height. Min: 60, max: 300, default value: 80', 'creativa'),
                'default'       => 80,
                'min'           => 60,
                'step'          => 5,
                'max'           => 300,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-sticky-header-style',
                'type'      => 'button_set',
                'title'     => esc_html__('Sticky Header Style', 'creativa'),
                'required'  => array('opt-show-sticky-header', "=", 1),
                'subtitle'  => esc_html__('Sticky header is visible on:', 'creativa'),                   
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => esc_html__('Scroll', 'creativa'), 
                    '2' => esc_html__('Scroll Up', 'creativa')
                ), 
                'default'   => '1'
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Top Bar', 'creativa'),
        'desc'      => esc_html__('Top Bar Settings', 'creativa'),
        'icon'      => 'el-icon-eject',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-show-top-bar',
                'type'      => 'switch',
                // 'required'  => array('opt-navbar-style', "!=", 3),
                'title'     => esc_html__('Show Top Bar', 'creativa'),
                'subtitle'  => esc_html__('Enable/disable bar above header.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'        => 'opt-top-bar-text',
                'type'      => 'editor',
                'title'     => esc_html__('Top Bar Text', 'creativa'),
                'required'  => array('opt-show-top-bar', "=", 1),
                'subtitle'  => esc_html__('Additional information text.', 'creativa'),
                'default'   => '',
                    'args'   => array(
                        'wpautop'          => true,
                        'textarea_rows'    => 4,
                        'media_buttons'    => false
                    )
            ),


        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Full Screen/Mobile Navigation', 'creativa'),
        'desc'      => esc_html__('Full Screen Navigation Settings.', 'creativa'),
        'icon'      => 'el-icon-lines',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-secondary-nav-style',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Secondary/Mobile Navigation Style', 'creativa'),
                'subtitle'  => esc_html__('Full Screen/Mobile navigation style.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Sidebar', 'title' => 'Sidebar Nav',       'img' => $images_path .'/option_sec-nav-sidebar.jpg'),
                    '2' => array('alt' => 'Full', 'title' => 'Full Width Nav',   'img' => $images_path .'/option_sec-nav-full.jpg'),
                ),
                'default'   => '1'
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Title Bar', 'creativa'),
        'desc'      => esc_html__('Title Bar Settings.', 'creativa'),
        'icon'      => 'el-icon-fontsize',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(


            array(
                'id'        => 'opt-title-bar',
                'type'      => 'switch',
                'title'     => esc_html__('Title Bar', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable title bar on every page.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-title-bar-centered',
                'type'      => 'button_set',
                'title'     => esc_html__('Page Title Position', 'creativa'),
                'subtitle'  => esc_html__('Position of page title on title bar.', 'creativa'),
                'required'  => array('opt-title-bar', "=", 1),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Side', 
                    '2' => 'Center'
                ), 
                'default'   => '1'
            ),


            array(
                'id'       => 'opt-title-bar-padding',
                'type'     => 'spacing',
                'required'  => array('opt-title-bar', "=", 1),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                // absolute, padding, margin, defaults to padding
                'all'      => false,
                // Have one field that applies to all
                //'top'           => false,     // Disable the top
                'right'         => false,     // Disable the right
                //'bottom'        => false,     // Disable the bottom
                'left'          => false,     // Disable the left
                'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
                //'units_extended'=> 'true',    // Allow users to select any type of unit
                // 'display_units' => true,   // Set to false to hide the units if the units are specified
                'title'    => esc_html__( 'Title Bar Content Margin', 'creativa' ),
                'subtitle' => esc_html__( 'Title Bar top and bottom margin size. (default: top: 100px, bottom: 100px)', 'creativa' ),
                'default'  => array(
                    'padding-top'    => '100px',
                    'padding-bottom' => '100px'
                )
            ),    

            array(
                'id'        => 'opt-title-bar-custom-height',
                'type'      => 'switch',
                // 'required'  => array('opt-navbar-style', "!=", 3),
                'required'  => array('opt-title-bar', "=", 1),
                'title'     => esc_html__('Title Bar Custom Height', 'creativa'),
                'subtitle'  => esc_html__('Enable/disable bar above header.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'       => 'opt-title-bar-height',
                'type'     => 'dimensions',
                'units'    => array('px','%'),
                'required'  => array('opt-title-bar-custom-height', '=', 1),
                'title'    => esc_html__('Title Bar Custom Height', 'creativa'),
                'subtitle' => esc_html__('Allow to set page title custom height.', 'creativa'),
                'width'    => false,
                'height'   => true,
                'default'  => array(
                    'height'   => 0, 
                ),
            ),

            array(
                'id'       => 'opt-page-title-bar-align',
                'type'     => 'select',
                'required'  => array('opt-title-bar-custom-height', '=', 1),
                'title'    => esc_html__('Title Bar Content Vertical Alignment', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => esc_html__('Top', 'creativa'),
                    '2' => esc_html__('Middle', 'creativa'),
                    '3' => esc_html__('Bottom', 'creativa'),
                ),
                'default'  => '2',
            ),   

            array(
                'id' => 'section-animations-start',
                'type' => 'section',
                'title' => esc_html__('Page Title Animations', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'       => 'opt-page-title-animation',
                'type'     => 'select',
                'required'  => array(
                    array('opt-title-bar', "=", 1),
                ),
                'title'    => esc_html__('Scroll Animation - Background', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Select scroll animation for page title background.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '0' => esc_html__('None', 'creativa'),
                    '1' => esc_html__('Parallax', 'creativa'),
                    '2' => esc_html__('Scaledown', 'creativa'),
                    '3' => esc_html__('Scaleup', 'creativa'),
                    '4' => esc_html__('Fold', 'creativa'),
                    '5' => esc_html__('Fade Out', 'creativa'),
                ),
                'default'  => '0',
            ),    

            array(
                'id'       => 'opt-page-title-animation-content',
                'type'     => 'select',
                'required'  => array(
                    array('opt-title-bar', "=", 1),
                ),
                'title'    => esc_html__('Scroll Animation - Content', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Select scroll animation for page title content.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '0' => esc_html__('None', 'creativa'),
                    '1' => esc_html__('Slide Down/Fade Out', 'creativa'),
                    '2' => esc_html__('Stretch/Fade Out', 'creativa'),
                    '3' => esc_html__('Fade Out', 'creativa'),
                ),
                'default'  => '0',
            ),    

            // 1:metaBalls
            // 2:bouncyPolygons,
            // 3:bouncyBalls,
            // 4:slowBubbles,
            // 5:confetti,

            array(
                'id'       => 'opt-animated-canvas-type',
                'type'     => 'select',
                'required'  => array(
                    array('opt-title-bar', "=", 1),
                ),
                'title'    => esc_html__('Canvas Animation', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Select animation for canvas.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '0' => esc_html__('None', 'creativa'),
                    '1' => esc_html__('Animation - Lava Lamp', 'creativa'),
                    '2' => esc_html__('Animation - Bouncy Polygons', 'creativa'),
                    // '3' esc_html__(=> 'Animation - Bouncy Bubbles', 'creativa'),
                    '4' => esc_html__('Animation - iBubbles', 'creativa'),
                    '5' => esc_html__('Animation - Confetti', 'creativa'),
                    '6' => esc_html__('Animation - Lines Rain', 'creativa'),
                    '7' => esc_html__('Animation - Film Grain', 'creativa'),
                ),
                'default'  => '0',
            ),

            array(
                'id' => 'section-canvas-start',
                'type' => 'section',
                // 'title' => esc_html__('Single Post/Project Cover', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => true 
            ),

            array(
                'id'        => 'opt-animated-canvas-color',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Animated Canvas - Color', 'creativa' ),
                'required'  => array(
                    array('opt-title-bar', "=", 1),
                    array('opt-animated-canvas-type', "!=", 0),
                    array('opt-animated-canvas-type', "!=", 7),
                ),
                'subtitle' => esc_html__( 'Select color of animated canvas elements.', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.05),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'            => 'opt-animated-canvas-count',
                'type'          => 'slider',
                'title'         => esc_html__('Animated Canvas - Elements Count', 'creativa'),
                'required'  => array(
                    array('opt-title-bar', "=", 1),
                    array('opt-animated-canvas-type', "!=", 5),
                    array('opt-animated-canvas-type', "!=", 6),
                    array('opt-animated-canvas-type', "!=", 7),
                    array('opt-animated-canvas-type', "!=", 0),
                ),
                // 'subtitle'      => esc_html__('Default cover image height size.', 'creativa'),
                'desc'          => esc_html__('Min: 2, max: 30, default value: 15', 'creativa'),
                'default'       => 15,
                'min'           => 1,
                'max'           => 50,
                'step'          => 1,
                'display_value' => 'text'
            ),

            array(
                'id' => 'section-canvas-end',
                'type' => 'section',
                'indent' => false 
            ),


            array(
                'id' => 'section-animations-end',
                'type' => 'section',
                'indent' => false 
            ),

  
            array(
                'id'     => 'opt-notice-info',
                'type'   => 'info',
                'notice' => false,
                'style'  => 'info',
                'style'  => 'warning',
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Information', 'creativa' ),
                'desc'   => esc_html__( 'Title Bar styling settings like Background, Color and more you will find in "Styling" Section.', 'creativa' )
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Footer', 'creativa'),
        'desc'      => esc_html__('Footer Settings.', 'creativa'),
        'icon'      => 'el-icon-chevron-down',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'       => 'opt-footer-effect',
                'type'     => 'select',
                'title'    => esc_html__('Footer Effects', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Select footer extra effect.', 'creativa'),
                'options'  => array(
                    '1' => 'None',
                    '2' => 'Fixed',
                ),
                'default' => '1',
            ),

            array(
                'id'        => 'opt-footer-widget-area',
                'type'      => 'switch',
                'title'     => esc_html__('Show Widget Area', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Widget Area in Footer.', 'creativa'),
                'default'   => false,
            ),
            array(
                'id'        => 'opt-footer-widget-columns',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Widget Columns', 'creativa'),
                'subtitle'  => esc_html__('Widget Area columns style.', 'creativa'),
                'required'  => array('opt-footer-widget-area','=','1'),
                'options'   => array(
                    '1' => array('title'=>'2 Columns', 'alt' => '2 Columns',       'img' => $images_path .'/option_footer-2col.jpg'),
                    '2' => array('title'=>'3 Columns - First Wide', 'alt' => '3 Columns Wide',  'img' => $images_path .'/option_footer-3col-wide.jpg'),
                    '3' => array('title'=>'3 Columns', 'alt' => '3 Columns', 'img' => $images_path .'/option_footer-3col.jpg'),
                    '4' => array('title'=>'4 Columns', 'alt' => '4 Columns', 'img' => $images_path .'/option_footer-4col.jpg')
                ),
                'default'   => '3'
            ),

            array(
                'id'        => 'opt-copyrights',
                'type'      => 'editor',
                'title'     => esc_html__('Copyright Section Text', 'creativa'),
                'subtitle'  => esc_html__('Copyright section text here.', 'creativa'),
                'default'   => sprintf( wp_kses( __( '<p>&copy; Copyrights 2016 by Creativa. All rights reserved.</p><p>Powered by <a href="%1$s">WordPress.</a></p>', 'creativa' ), array( 'a' => array( 'href' => array() ), 'p' => array() ) ), esc_url( 'http://wordpress.org' ) ),
                'args'   => array(
                    'wpautop'          => false,
                    'textarea_rows'    => 4,
                    'media_buttons'    => false
                )
            ),
            
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Blog', 'creativa'),
        'desc'      => esc_html__('Blog Settings.', 'creativa'),
        'icon'      => 'el-icon-book',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-blog-style',
                'type'      => 'image_select',
                'title'     => esc_html__('Blog Layout', 'creativa'),
                'subtitle'  => esc_html__('Blog Page Style.', 'creativa'),
                'options'   => array(
                    '1' => array('title'=>'Standard', 'alt' => 'Standard Big Thumbnail',       'img' => $images_path .'/option_blog-list.jpg'),
                    '2' => array('title'=>'Masonry', 'alt' => 'Masonry', 'img' => $images_path .'/option_blog-masonry.jpg'),
                ),
                'default'   => '1'
            ),


            array(
                'id'        => 'opt-blog-full-width',
                'type'      => 'switch',
                'title'     => esc_html__('Full Window Width Layout', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable full window width layout.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'        => 'opt-show-sidebar',
                'type'      => 'switch',
                'required' => array('opt-blog-style','!=','4'),
                'title'     => esc_html__('Show Sidebar', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Blog Sidebar.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-blog-sidebar-position',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Sidebar Position', 'creativa'),
                'subtitle'  => esc_html__('Position of sidebar on blog page.', 'creativa'),
                'required' => array('opt-show-sidebar','=','1'),
                'options'   => array(
                    '1' => array('alt' => 'Sidebar Right',  'img' => $images_path .'/option_sidebar-right.jpg'),
                    '2' => array('alt' => 'Sidebar Left', 'img' => $images_path .'/option_sidebar-left.jpg')
                ),
                'default'   => '1'
            ),


            array(
                'id' => 'section-post-display-start',
                'type' => 'section',
                'title' => esc_html__('Post Display Settings', 'creativa'),
                'indent' => false 
            ),


            array(
                'id'        => 'opt-show-thumbnail',
                'type'      => 'switch',
                // 'required' => array('opt-blog-style','=','4'),
                'title'     => esc_html__('Display Thumbnails on Blog Page', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable posts thumbnails on blog page.', 'creativa'),
                'default'   => true,
            ),
            array(
                'id'        => 'opt-allow-media-styles',
                'type'      => 'switch',
                'required' => array('opt-show-thumbnail','=','1'),
                'title'     => esc_html__('Custom Post Media Styles', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable custom post media styles on blog page.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-blog-display-media',
                'type'      => 'image_select',
                'title'     => esc_html__('Post Media Display Style', 'creativa'),
                'required'      => array(
                    array('opt-show-thumbnail','=','1'),
                    array('opt-allow-media-styles','=','1'),
                ),
                'subtitle'  => esc_html__('Default post display style (if post has featured image)', 'creativa'),
                'options'   => array(
                    '1' => array('title'=>'Large', 'alt' => 'Large','img' => $images_path .'/option_post-display-standard.jpg'),
                    '2' => array('title'=>'Portrait', 'alt' => 'Portrait', 'img' => $images_path .'/option_post-display-portrait.jpg'),
                    '3' => array('title'=>'Background', 'alt' => 'Background', 'img' => $images_path .'/option_post-display-bg.jpg'),
                ),
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-excerpts',
                'type'      => 'switch',
                'title'     => esc_html__('Automatic Post Excerpts', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable automatic posts excerpts.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'            => 'opt-excerpt-lenght',
                'type'          => 'slider',
                'title'         => esc_html__('Excerpt Lenght', 'creativa'),
                'required'      => array('opt-excerpts','=','1'), 
                'subtitle'      => esc_html__('Number of words.', 'creativa'),
                'desc'          => esc_html__('Min: 10, max: 200, default value: 35', 'creativa'),
                'default'       => 35,
                'min'           => 10,
                'max'           => 200,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-display-categories',
                'type'      => 'switch',
                'title'     => esc_html__('Display Categories', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable displaying post categories above post title.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-display-date',
                'type'      => 'switch',
                'title'     => esc_html__('Display Date', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable displaying post date above post title.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-display-comments',
                'type'      => 'switch',
                'title'     => esc_html__('Display Comments Count', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable displaying post comments count above post title.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-display-author',
                'type'      => 'switch',
                'title'     => esc_html__('Display Post Author', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable displaying post author under post.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id' => 'section-post-display-end',
                'type' => 'section',
                'indent' => false 
            ),
        ),
    ) );



    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Single Blog Page', 'creativa'),
        'desc'      => esc_html__('Single Blog Page Settings.', 'creativa'),
        'icon'      => 'el-icon-fontsize',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-blog-page-style',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Single Post Layout', 'creativa'),
                'subtitle'  => esc_html__('Blog page style.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Sidebar Right',  'img' => $images_path .'/option_post-layout-right.jpg'),
                    '2' => array('alt' => 'Sidebar Left', 'img' => $images_path .'/option_post-layout-left.jpg'),
                ),
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-single-display-media',
                'type'      => 'switch',
                'title'     => esc_html__('Display Media/Thumbnails', 'creativa'),
                'required'  => array('opt-blog-page-style', "!=", 3),
                'subtitle'  => esc_html__('Enable/Disable media/thumbnails on single post page.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-author-bio',
                'type'      => 'switch',
                'title'     => esc_html__('Author\'s Bio', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Author\'s Bio on post.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-share-buttons',
                'type'      => 'switch',
                'title'     => esc_html__('Share Buttons', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Share buttons on post page.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-tags',
                'type'      => 'switch',
                'title'     => esc_html__('Display Tags', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Tags on post page.', 'creativa'),
                'default'   => true,
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Portfolio', 'creativa'),
        'desc'      => esc_html__('Portfolio Settings.', 'creativa'),
        'icon'      => 'el-icon-brush',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-portfolio-layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Portfolio Layout', 'creativa'),
                'subtitle'  => esc_html__('Main Portfolio layout.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => '1 Column', 'img' => $images_path .'/option_portfolio-1col.jpg'),
                    '2' => array('alt' => '2 Columns',  'img' => $images_path .'/option_portfolio-2col.jpg'),
                    '3' => array('alt' => '3 Columns',  'img' => $images_path .'/option_portfolio-3col.jpg'),
                    '4' => array('alt' => '4 Columns', 'img' => $images_path .'/option_portfolio-4col.jpg'),
                    '5' => array('alt' => 'Masonry', 'img' => $images_path .'/option_portfolio-masonry.jpg')
                ),
                'default'   => '3'
            ),

            array(
                'id'       => 'opt-masonry-size',
                'type'     => 'select',
                'title'    => esc_html__('Masonry Items Size', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Select masonry layout items size.', 'creativa'),
                'required'      => array('opt-portfolio-layout', "=", 5),
                'options'  => array(
                    '1' => 'Medium',
                    '2' => 'Large',
                ),
                'default' => '2',
            ),

            array(
                'id'        => 'opt-portfolio-fullwidth',
                'type'      => 'switch',
                'title'     => esc_html__('Full Width Portfolio', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Full Width portfolio layout.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'            => 'opt-portfolio-items-gap',
                'type'          => 'slider',
                'title'         => esc_html__('Portfolio Items Gap', 'creativa'),                      
                'subtitle'      => esc_html__('Gap between portfolio items in pixels.', 'creativa'),
                'desc'          => esc_html__('Gap size. Min: 0, max: 30, default value: 30', 'creativa'),
                'default'       => 30,
                'min'           => 0,
                'step'          => 1,
                'max'           => 30,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-portfolio-pagination',
                'type'      => 'switch',
                'title'     => esc_html__('Portfolio Pagination', 'creativa'),
                'subtitle'  => esc_html__('Paginate Projects on Portfolio page.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'            => 'opt-portfolio-pper-page',
                'type'          => 'slider',
                'required'      => array('opt-portfolio-pagination', "=", 1),
                'title'         => esc_html__('Projects per Page', 'creativa'),
                'subtitle'      => esc_html__('Number of projects that will show on Page.', 'creativa'),
                'desc'          => esc_html__('Navbar height. Min: 1, max: 20, default value: 5', 'creativa'),
                'default'       => 5,
                'min'           => 1,
                'step'          => 1,
                'max'           => 20,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-portfolio-custom-slug',
                'type'      => 'text',
                'title'     => esc_html__('Custom Slug', 'creativa'),
                'subtitle'  => esc_html__('Your custom slug (e.g project, works etc.)', 'creativa'),
                //'desc'      => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'validate'  => 'str_replace',
                'str'       => array(
                    'search'        => ' ', 
                    'replacement'   => '-'
                ),
                'default'   => 'project',
            ),

            array(
                'id' => 'section-filtering-start',
                'type' => 'section',
                'title' => esc_html__('Portfolio Filtering Settings', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'        => 'opt-portfolio-filtering',
                'type'      => 'switch',
                'title'     => esc_html__('Portfolio Filtering', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable portfolio filtering.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-portfolio-filtering-pos',
                'type'      => 'button_set',
                'title'     => esc_html__('FIltering Position', 'creativa'),
                'required'  => array('opt-portfolio-filtering', "=", 1),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => 'Left', 
                    '2' => 'Center',
                    '3' => 'Right',
                ), 
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-portfolio-sorting',
                'type'      => 'switch',
                'title'     => esc_html__('Portfolio Sorting', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable portfolio sorting.', 'creativa'),
                'required'  => array('opt-portfolio-filtering', "=", 1),
                'default'   => true,
            ),

            array(
                'id' => 'section-filtering-end',
                'type' => 'section',
                'indent' => false 
            ),

            array(
                'id' => 'section-item-display-start',
                'type' => 'section',
                'title' => esc_html__('Project Item Display Settings', 'creativa'),
                //'subtitle' => esc_html__('With the "section" field you can create indent option sections.', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'        => 'opt-portfolio-style',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Portfolio Items Style', 'creativa'),
                'subtitle'  => esc_html__('Portfolio items layout.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Portfolio Item OnHover', 'img' => $images_path .'/option_project-item-hover.jpg'),
                    '2' => array('alt' => 'Portfolio Item Overlay', 'img' => $images_path .'/option_project-item-overlay.jpg'),
                    '3' => array('alt' => 'Portfolio Item Bottom',  'img' => $images_path .'/option_project-item-bottom.jpg')
                ),
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-porfolio-item-categories',
                'type'      => 'switch',
                'title'     => esc_html__('Categories Names', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disale portfolio categories above portfolio title.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-quick-view',
                'type'      => 'switch',
                'title'     => esc_html__('Quick View Button', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable quick view button on portfolio item.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-like-button',
                'type'      => 'switch',
                'title'     => esc_html__('Like Button', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable like button on portfolio item.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id' => 'section-item-display-end',
                'type' => 'section',
                'indent' => false 
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Project Page', 'creativa'),
        'desc'      => esc_html__('Project Page Settings.', 'creativa'),
        'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-project-layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Project page Layout', 'creativa'),
                'subtitle'  => esc_html__('Single project page layout.', 'creativa'),
                'options'   => array(
                    '1' => array('title' => 'Large Images', 'alt' => 'Large',       'img' => $images_path .'/option_project-standard.jpg'),
                    '2' => array('title' => 'Medium Images', 'alt' => 'Medium',  'img' => $images_path .'/option_project-sidebar.jpg'),
                    '3' => array('title' => 'Wide Images', 'alt' => 'Wide',  'img' => $images_path .'/option_project-wide.jpg'),
                ),
                'default'   => '1'
            ),

            array(
                'id'        => 'opt-project-layout-med-sidebar',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Medium Layout Sidebar Position', 'creativa'),
                'subtitle'  => esc_html__('Select medium layout style.', 'creativa'),
                'required' => array('opt-project-layout', "=", 2),
                'options'   => array(
                    '1' => array('alt' => 'Sidebar Right',  'img' => $images_path .'/option_sidebar-right.jpg'),
                    '2' => array('alt' => 'Sidebar Left', 'img' => $images_path .'/option_sidebar-left.jpg'),
                ),
                'default'   => '1',
            ),


            array(
                'id'        => 'opt-project-image-gallery',
                'type'      => 'image_select',
                'compiler'  => true,
                'required' => array(
                        array('opt-project-layout', "!=", 3),
                        array('opt-project-layout', "!=", 4)
                    ),
                'title'     => esc_html__('Project Image Gallery', 'creativa'),
                'subtitle'  => esc_html__('Project images gallery Layout.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Slider',  'img' => $images_path .'/option_project-gallery-slider.jpg'),
                    '2' => array('alt' => 'List',  'img' => $images_path .'/option_project-gallery-list.jpg')
                ),
                'default'   => '2'
            ),

            array(
                'id'        => 'opt-project-shares',
                'type'      => 'switch',
                'title'     => esc_html__('Share Buttons', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable Share buttons on project page.', 'creativa'),
                'default'   => true,
            ),

            array(
                'id'        => 'opt-project-prevnext',
                'type'      => 'switch',
                'title'     => esc_html__('Previous/Next Buttons', 'creativa'),
                'subtitle'  => esc_html__('Enable/Disable previous/next buttons on project page.', 'creativa'),
                'default'   => true,
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('WooCommerce', 'creativa'),
        'desc'      => esc_html__('WooCommerce Settings.', 'creativa'),
        'icon'      => ' el-icon-shopping-cart',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-woo-full-width',
                'type'      => 'switch',
                'title'     => esc_html__('Full Window Width Layout', 'creativa'),
                'subtitle'  => esc_html__('Enable/disable shop full window width layout.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'        => 'opt-woo-shop-layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Shop Layout', 'creativa'),
                // 'subtitle'  => esc_html__('Shop Layout.', 'creativa'),
                'options'   => array(
                    '1' => array('alt' => 'Full Width',  'img' => $images_path .'/option_woo-full.jpg'),
                    '2' => array('alt' => 'Sidebar',       'img' => $images_path .'/option_woo-sidebar.jpg')
                ),
                'default'   => '2'
            ),

            array(
                'id'        => 'opt-woo-shop-sidebar-position',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Sidebar Position', 'creativa'),
                // 'subtitle'  => esc_html__('Select sidebar position.', 'creativa'),
                'required' => array('opt-woo-shop-layout','=','2'),
                'options'   => array(
                    '1' => array('alt' => 'Sidebar Right',  'img' => $images_path .'/option_sidebar-right.jpg'),
                    '2' => array('alt' => 'Sidebar Left', 'img' => $images_path .'/option_sidebar-left.jpg')
                ),
                'default'   => '2'
            ),

            array(
                'id'            => 'opt-woo-shop-items',
                'type'          => 'slider',
                'title'         => esc_html__('Product Items Per Page', 'creativa'),                     
                'subtitle'      => esc_html__('Number of products to display on one page. "0" to display all.', 'creativa'),
                'desc'          => esc_html__('Min: 0, max: 50, default value: 12', 'creativa'),
                'default'       => 12,
                'min'           => 0,
                'step'          => 1,
                'max'           => 50,
                'display_value' => 'text'
            ),

            array(
                'id'            => 'opt-woo-shop-items-columns',
                'type'          => 'slider',
                'title'         => esc_html__('Products Column Number', 'creativa'),                     
                // 'subtitle'      => esc_html__('Columns number', 'creativa'),
                'desc'          => esc_html__('Min: 2, max: 5, default value: 3', 'creativa'),
                'default'       => 3,
                'min'           => 2,
                'step'          => 1,
                'max'           => 5,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-shop-welcome',
                'type'      => 'text',
                'title'     => esc_html__('Shop Title Text', 'creativa'),
                'subtitle'  => esc_html__('Shop page title text.', 'creativa'),
                //'desc'      => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // 'validate'  => 'str_replace',
                // 'str'       => array(
                //     'search'        => ' ', 
                //     'replacement'   => '-'
                // ),
                'validate' => 'no_html',
                'default'   => esc_html__('Shop', 'creativa'),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Social Sharing Links', 'creativa'),
        'desc'      => esc_html__('Start URL`s with "http://"', 'creativa'),
        'icon'      => 'el-icon-share',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-social-facebook-url',
                'type'      => 'text',
                'title'     => esc_html__('Facebook', 'creativa'),
                'subtitle'  => esc_html__('Your facebook profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-twitter-url',
                'type'      => 'text',
                'title'     => esc_html__('Twitter', 'creativa'),
                'subtitle'  => esc_html__('Your twitter profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-google-plus-url',
                'type'      => 'text',
                'title'     => esc_html__('Google+', 'creativa'),
                'subtitle'  => esc_html__('Your google+ profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-flickr-url',
                'type'      => 'text',
                'title'     => esc_html__('Flickr', 'creativa'),
                'subtitle'  => esc_html__('Your flickr profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-linkedin-url',
                'type'      => 'text',
                'title'     => esc_html__('LinkedIn', 'creativa'),
                'subtitle'  => esc_html__('Your linkedin profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-pinterest-url',
                'type'      => 'text',
                'title'     => esc_html__('Pinterest', 'creativa'),
                'subtitle'  => esc_html__('Your pinterest profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-instagram-url',
                'type'      => 'text',
                'title'     => esc_html__('Instagram', 'creativa'),
                'subtitle'  => esc_html__('Your instagram profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-behance-url',
                'type'      => 'text',
                'title'     => esc_html__('Behance', 'creativa'),
                'subtitle'  => esc_html__('Your behance profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-dribbble-url',
                'type'      => 'text',
                'title'     => esc_html__('Dribbble', 'creativa'),
                'subtitle'  => esc_html__('Your dribbble profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-tumblr-url',
                'type'      => 'text',
                'title'     => esc_html__('Tumblr', 'creativa'),
                'subtitle'  => esc_html__('Your tumblr profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-youtube-url',
                'type'      => 'text',
                'title'     => esc_html__('YouTube', 'creativa'),
                'subtitle'  => esc_html__('Your youtube profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-vimeo-url',
                'type'      => 'text',
                'title'     => esc_html__('Vimeo', 'creativa'),
                'subtitle'  => esc_html__('Your vimeo profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-vine-url',
                'type'      => 'text',
                'title'     => esc_html__('Vine', 'creativa'),
                'subtitle'  => esc_html__('Your vine profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-lastfm-url',
                'type'      => 'text',
                'title'     => esc_html__('LastFM', 'creativa'),
                'subtitle'  => esc_html__('Your LastFM profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-deviantart-url',
                'type'      => 'text',
                'title'     => esc_html__('deviantART', 'creativa'),
                'subtitle'  => esc_html__('Your deviantart profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-digg-url',
                'type'      => 'text',
                'title'     => esc_html__('Digg', 'creativa'),
                'subtitle'  => esc_html__('Your digg profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-dropbox-url',
                'type'      => 'text',
                'title'     => esc_html__('Dropbox', 'creativa'),
                'subtitle'  => esc_html__('Your dropbox profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-foursquare-url',
                'type'      => 'text',
                'title'     => esc_html__('Foursquare', 'creativa'),
                'subtitle'  => esc_html__('Your foursquare profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-github-url',
                'type'      => 'text',
                'title'     => esc_html__('GitHub', 'creativa'),
                'subtitle'  => esc_html__('Your github profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-reddit-url',
                'type'      => 'text',
                'title'     => esc_html__('Reddit', 'creativa'),
                'subtitle'  => esc_html__('Your reddit profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-skype-url',
                'type'      => 'text',
                'title'     => esc_html__('Skype', 'creativa'),
                'subtitle'  => esc_html__('Your skype profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-soundcloud-url',
                'type'      => 'text',
                'title'     => esc_html__('SoundCloud', 'creativa'),
                'subtitle'  => esc_html__('Your soundcloud profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-spotify-url',
                'type'      => 'text',
                'title'     => esc_html__('Spotify', 'creativa'),
                'subtitle'  => esc_html__('Your spotify profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-steam-url',
                'type'      => 'text',
                'title'     => esc_html__('Steam', 'creativa'),
                'subtitle'  => esc_html__('Your steam profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-stumbleupon-url',
                'type'      => 'text',
                'title'     => esc_html__('StumbleUpon', 'creativa'),
                'subtitle'  => esc_html__('Your stumbleupon profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-vk-url',
                'type'      => 'text',
                'title'     => esc_html__('VK', 'creativa'),
                'subtitle'  => esc_html__('Your vk profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-wordpress-url',
                'type'      => 'text',
                'title'     => esc_html__('WordPress', 'creativa'),
                'subtitle'  => esc_html__('Your wordpress profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-medium-url',
                'type'      => 'text',
                'title'     => esc_html__('Medium', 'creativa'),
                'subtitle'  => esc_html__('Your medium profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-twitch-url',
                'type'      => 'text',
                'title'     => esc_html__('Twitch', 'creativa'),
                'subtitle'  => esc_html__('Your twitch profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),

            array(
                'id'        => 'opt-social-whatsapp-url',
                'type'      => 'text',
                'title'     => esc_html__('WhatsApp', 'creativa'),
                'subtitle'  => esc_html__('Your whatsapp profile url', 'creativa'),
                'validate'  => 'url',
                'default'   => ''
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(  
        'type' => 'divide',
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Styling', 'creativa'),
        'desc'      => esc_html__('Select section you want to customize.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(
             array(
                'id' => 'section-styling-start',
                'type' => 'section',
                'title' => '',
                'indent' => false 
            ),

            array(
                'id' => 'section-h-end',
                'type' => 'section',
                'indent' => false 
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Body', 'creativa'),
        'desc'      => esc_html__('Body styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'       => 'opt-color-body-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Background Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick a body background color (default: #ffffff)', 'creativa' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'validate' => 'color',
            ),
            array(
                'id'       => 'opt-color-body-grey-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Separated Section BG Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick a separated content section bg color (comments, portfolio meta section, etc.) (default: #fafafa)', 'creativa' ),
                'default'  => '#fafafa',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-color-body-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Text Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick a body text color (default: #8a8a8a)', 'creativa' ),
                'default'  => '#8a8a8a',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-color-headings',
                'type'     => 'color',
                'title'    => esc_html__( 'Headings Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick a headings color (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-color-accent',
                'type'     => 'color',
                'title'    => esc_html__( 'Primary/Accent Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick a accent color for the theme (default: #21ce99)', 'creativa' ),
                'default'  => '#21ce99',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-link-colors',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick link colors. (default: #111111/#111111)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#111111',
                    'hover'   => '#111111',
                )
            ),

            array(
                'id'        => 'opt-border-colors',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Border Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Separators (hr) and elements border colors. (default: rgba(0,0,0,0.05)).', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.05),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),
        ),
    ) );


    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Header', 'creativa'),
        'desc'      => esc_html__('Header styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Navigation ------------------------------------------- /

            array(
                'id'       => 'opt-navigation-color-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Navigation Background Color', 'creativa' ),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle' => esc_html__( 'Pick a navigation bar background color (default: #ffffff)', 'creativa' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'            => 'opt-navigation-transparency',
                'type'          => 'slider',
                'title'         => esc_html__('Header Transparency', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle'      => esc_html__('Header Transparency in % ', 'creativa'),
                // 'desc'          => esc_html__('Navbar height. Min: 1, max: 20, default value: 5', 'creativa'),
                'default'       => 100,
                'min'           => 0,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text'
            ),

            array(
                'id'        => 'opt-navigation-side-bg',
                'type'      => 'background',
                'title'     => esc_html__('Side Navigation Background', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '2'),
                'subtitle'  => esc_html__('Pick Side Navigation background color or image.', 'creativa'),
                'preview_height' => '110px',
                'preview'   => true,
                'preview_media' => true,
                'default'   => array(
                    'background-color' => "#ffffff"
                ),
            ),

            array(
                'id'        => 'opt-navigation-side-overlay',
                'type'      => 'switch',
                'title'     => esc_html__('Side Navigation Background Overlay', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '2'),
                'subtitle'  => esc_html__('Show overlay on side nav image background.', 'creativa'),
                'default'   => false,
            ),

            array(
                'id' => 'section-nav-side-ovr-start',
                'type' => 'section',
                'title' => '',
                'indent' => true 
            ),

            array(
                'id'        => 'opt-navigation-side-overlay-color',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Side Navigation Background Overlay Color', 'creativa' ),
                'required'  => array('opt-navigation-side-overlay','=','1'),
                'subtitle' => esc_html__( 'Picks side nav bg overlay color. (default rgba(0,0,0,0.2))', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.2),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id' => 'section-nav-side-ovr-end',
                'type' => 'section',
                'indent' => false 
            ),

            array(
                'id'        => 'opt-navbar-border',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Navigation Border Color', 'creativa' ),
                'subtitle' => esc_html__( 'Bottom/Side border color. (default: rgba(0,0,0,0.05)).', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.05),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-navigation-separator-color',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Header Separators Color', 'creativa' ),
                'required'  => array(
                    // array('opt-nav-layout', '=', '1'),
                    array('opt-nav-separators', '=', '1')
                ),
                'subtitle' => esc_html__( 'Pick menu link bg color. (default rgba(0,0,0,0.15))', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.15),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id' => 'section-menu-styling-options-start',
                'type' => 'section',
                'title' => esc_html__('Menu', 'creativa'),
                // 'required'  => array('opt-nav-layout', '=', '1'),
                'indent' => false, 
            ),

            array(
                'id'       => 'opt-navigation-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Menu Links Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick menu link colors. (default: #3e3e3e/#919191/#ffffff)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => true, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#3e3e3e',
                    'hover'   => '#919191',
                    'active'  => '#ffffff',
                )
            ),

            array(
                'id'        => 'opt-navigation-color-active-bg',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Menu - Active Link Background', 'creativa'),
                'subtitle' => esc_html__( 'Pick navigation active link background color. (default: #111111)', 'creativa' ),
                'default'   => array('color' => '#111111', 'alpha' => 1),
                // 'required'  => array('opt-nav-layout', '=', '1'),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),


            array(
                'id'       => 'opt-navigation-padding',
                'type'     => 'dimensions',
                'units'    => array('em','px','%'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'title'    => esc_html__('Navigation Items Padding', 'creativa'),
                'subtitle' => esc_html__('Allow your users to choose padding between navigation links. (default: 15px)', 'creativa'),
                'width'    => true,
                'height'   => false,
                'default'  => array(
                    'width'   => 15, 
                ),
            ),

            array(
                'id'       => 'opt-navigation-side-padding',
                'type'     => 'dimensions',
                'units'    => array('em','px','%'),
                'required'  => array('opt-nav-layout', '=', '2'),
                'title'    => esc_html__('Navigation Items Padding', 'creativa'),
                'subtitle' => esc_html__('Allow your users to choose padding between navigation links. (default: 10px)', 'creativa'),
                'width'    => false,
                'height'   => true,
                'default'  => array(
                    'height'   => 10, 
                ),
            ),

            array(
                'id'       => 'opt-navigation-submenu-color-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Background Color', 'creativa' ),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle' => esc_html__( 'Pick a submenu background color (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-navigation-submenu-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Submenu Links Colors', 'creativa' ),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle' => esc_html__( 'Pick submenu link colors. (default: #ffffff/#21ce99)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#21ce99',
                )
            ),

            array(
                'id'        => 'opt-navigation-submenu-border',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Submenu Item Bottom Border Line', 'creativa'),
                'subtitle' => esc_html__( 'Pick submenu border bottom settings. (default: rgba(255,255,255,0.1))', 'creativa' ),
                'default'   => array('color' => '#ffffff', 'alpha' => 0.1),
                'required'  => array('opt-nav-layout', '=', '1'),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-navigation-submenu-padding',
                'type'     => 'dimensions',
                'units'    => array('em','px','%'),
                'title'    => esc_html__('Submenu Item Padding', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'subtitle' => esc_html__('Allow your users to choose padding in submenu links. (default: w:15px h:10px)', 'creativa'),
                'width'    => true,
                'height'   => true,
                'default'  => array(
                    'width'   => 15, 
                    'height'   => 10, 
                ),
            ),

            array(
                'id' => 'section-menu-styling-options-end',
                'required'  => array('opt-nav-layout', '=', '1'),
                'type' => 'section',
                'indent' => false 
            ),


            // Sticky Header -------------------------------------- /
            array(
                'id' => 'section-sticky-h-start',
                'type' => 'section',
                'title' => esc_html__('Sticky Header', 'creativa'),
                'required'  => array('opt-nav-layout', '=', '1'),
                'indent' => false, 
            ),

            array(
                'id'        => 'opt-stickyh-settings',
                'type'      => 'button_set',
                'title'     => esc_html__('Sticky Header Colors', 'creativa'),
                'required'  => array(
                            array('opt-nav-layout', '=', '1'),
                            array('opt-show-sticky-header','=','1'),
                    ),
                // 'subtitle'  => esc_html__('Select overlay backgroud color style.', 'creativa'),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1' => esc_html__('Same As Navigation Bar', 'creativa'), 
                    '2' => esc_html__('Custom Colors', 'creativa')
                ), 
                'default'   => '1'
            ),

            array(
                'id'       => 'opt-stickyheader-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Sticky Header Background', 'creativa' ),
                'required'      => array('opt-stickyh-settings','=','2'),
                'subtitle' => esc_html__( 'Pick color settings for Sticky Header BG. (default: #ffffff)', 'creativa' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'        => 'opt-stickyheader-border-color',
                'type'      => 'color_rgba',
                'required'      => array('opt-stickyh-settings','=','2'),
                'title'    => esc_html__( 'Sticky Header Bottom Border Color', 'creativa' ),
                'subtitle' => esc_html__( 'Separator and bottom border color. (default: rgba(0,0,0,0.05))', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.05),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-stickyheader-separator-color',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Sticky Header Header Separators Color', 'creativa' ),
                'required'  => array(
                    array('opt-nav-separators', '=', '1'),
                    array('opt-stickyh-settings','=','2'),
                ),
                'subtitle' => esc_html__( 'Pick menu link bg color. (default rgba(0,0,0,0.15))', 'creativa' ),
                'default'   => array('color' => '#000', 'alpha' => 0.15),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-stickyh-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Sticky Header Menu Colors', 'creativa' ),
                'required'      => array('opt-stickyh-settings','=','2'),
                'subtitle' => esc_html__( 'Pick menu link colors. (default: #3e3e3e/#919191/#ffffff)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => true, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#3e3e3e',
                    'hover'   => '#919191',
                    'active'   => '#ffffff',
                )
            ),

            array(
                'id'        => 'opt-stickyh-color-active-bg',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Sticky Header - Menu Active Link Background', 'creativa'),
                'subtitle' => esc_html__( 'Pick navigation active link background color. (default: #111111)', 'creativa' ),
                'default'   => array('color' => '#111111', 'alpha' => 1),
                // 'required'  => array('opt-nav-layout', '=', '1'),
                'required'      => array('opt-stickyh-settings','=','2'),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'            => 'opt-stickyh-transparency',
                'type'          => 'slider',
                'title'         => esc_html__('Sticky Header Transparency', 'creativa'),
                'subtitle'      => esc_html__('Sticky Header Transparency in %', 'creativa'),
                'required'  => array(
                            array('opt-nav-layout', '=', '1'),
                            array('opt-show-sticky-header','=','1'),
                    ),
                // 'desc'          => esc_html__('Navbar height. Min: 1, max: 20, default value: 5', 'creativa'),
                'default'       => 96,
                'min'           => 0,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text'
            ),

            array(
                'id'     => 'opt-sticky-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required'  => array(
                            array('opt-show-sticky-header','=','0'),
                    ),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Sticky Header is Disabled.', 'creativa' ),
                'desc'   => esc_html__( 'Go to Header -> Sticky Header Section to Enabled Sticky Header.', 'creativa' )
            ),

            array(
                'id' => 'section-sticky-h-end',
                'required'  => array('opt-nav-layout', '=', '1'),
                'type' => 'section',
                'indent' => false 
            ),
            
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Mobile/Secondary Navigation', 'creativa'),
        'desc'      => esc_html__('Mobile/Secondary Navigation styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Full Width Navigation -------------------------------------- /
            array(
                'id'     => 'opt-sidenav-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required'  => array('opt-nav-layout', "=", 2),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Side Navigations only for Full Theme Layout.', 'creativa' ),
                // 'desc'   => esc_html__( 'Go to Header -> Top Bar Section to Enabled Top Bar', 'creativa' )
            ),

            array(
                'id'        => 'opt-fwnav-overlay-side',
                'type'      => 'color_rgba',
                'required'  => array('opt-secondary-nav-style', "=", 1),
                'title'    => esc_html__( 'Overlay Background - Solid Color', 'creativa' ),
                'subtitle' => esc_html__( 'Overlay Solid Color (default: #000000, alpha: 0.2)', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => '0.2'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-fwnav-overlay-full',
                'type'      => 'color_rgba',
                'required'  => array('opt-secondary-nav-style', "=", 2),
                'title'    => esc_html__( 'Overlay Background - Solid Color', 'creativa' ),
                'subtitle' => esc_html__( 'Overlay Solid Color (default: #000000, alpha: 0.8)', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => '0.8'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-fwnav-sidebar-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Sidebar Background Color', 'creativa' ),
                'required'  => array('opt-secondary-nav-style', "=", 1),
                'subtitle' => esc_html__( 'Pick full width - sidebar nav background color. (default: #ffffff)', 'creativa' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-fwnav-sidebar-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Sidebar Link Colors', 'creativa' ),
                'required'  => array('opt-secondary-nav-style', "=", 1),
                'subtitle' => esc_html__( 'Pick full width - sidebar nav link colors. (default: #3e3e3e/#919191/#ffffff)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => true, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#3e3e3e',
                    'hover'   => '#919191',
                    'active'   => '#ffffff',
                )
            ),

            array(
                'id'        => 'opt-fwnav-sidebar-links-active',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Menu - Active Link Background', 'creativa'),
                'subtitle' => esc_html__( 'Pick navigation active link background color. (default: #111111)', 'creativa' ),
                'default'   => array('color' => '#111111', 'alpha' => 1),
                // 'required'  => array('opt-nav-layout', '=', '1'),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-fwnav-fw-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Full Width Link Colors', 'creativa' ),
                'required'  => array('opt-secondary-nav-style', "=", 2),
                'subtitle' => esc_html__( 'Pick full width nav link colors. (default: #111111/#21ce99/#21ce99)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => true, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#21ce99',
                    'active'   => '#21ce99',
                )
            ),

            array(
                'id'       => 'opt-fwnav-fw-padding',
                'type'     => 'dimensions',
                'units'    => array('em','px','%'),
                'required'  => array('opt-secondary-nav-style', "=", 2),
                'title'    => esc_html__('Full Width Links Padding', 'creativa'),
                'subtitle' => esc_html__('Allow your users to choose padding between navigation links. (default: 25px)', 'creativa'),
                'width'    => false,
                'height'   => true,
                'default'  => array(
                    'height'   => 25, 
                ),
            ),


        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Top Bar', 'creativa'),
        'desc'      => esc_html__('Top Bar styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Top Bar ------------------------------------------- /

            array(
                'id'       => 'opt-topbar-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar Background', 'creativa' ),
                'required'  => array('opt-show-top-bar', "=", 1),
                'subtitle' => esc_html__( 'Pick top bar background color. (default: #ffffff)', 'creativa' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-topbar-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top Bar Text Color', 'creativa' ),
                'required'  => array('opt-show-top-bar', "=", 1),
                'subtitle' => esc_html__( 'Pick top bar text color. (default: #aaaaaa)', 'creativa' ),
                'default'  => '#aaaaaa',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-topbar-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Top Bar Links', 'creativa' ),
                'required'  => array('opt-show-top-bar', "=", 1),
                'subtitle' => esc_html__( 'Pick top bar link colors. (default: same as links)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '',
                    'hover'   => '',
                )
            ),

            array(
                'id'        => 'opt-topbar-border-color',
                'type'      => 'color_rgba',
                'required'  => array('opt-show-top-bar', "=", 1),
                'title'     => esc_html__('Top Bar Bottom Border', 'creativa'),
                'subtitle'  => esc_html__('Pick top bar bottom border color. (default: rgba(0,0,0,0.05)', 'creativa'),
                'default'   => array('color' => '#000000', 'alpha' => '0.05'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'     => 'opt-topbar-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required'  => array('opt-show-top-bar', "=", 0),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Top Bar is Disabled.', 'creativa' ),
                'desc'   => esc_html__( 'Go to Header -> Top Bar Section to Enabled Top Bar', 'creativa' )
            ),

            // array(
            //     'id' => 'section-topbar-end',
            //     'type' => 'section',
            //     'indent' => false 
            // ),



        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Page Title', 'creativa'),
        'desc'      => esc_html__('Page Title styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Page Title ------------------------------------------- /

            array(
                'id'     => 'opt-titlebar-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
   
                'required'  => array('opt-title-bar', "=", 0),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Title Bar Info.', 'creativa' ),
                'desc'   => esc_html__( 'Title bar is disabled for pages, but will be still visible for blog posts, portfolio and archive pages and/or as background for transparent navigation.', 'creativa' )
            ),

            array(
                'id'       => 'opt-pagetitle-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Text Color', 'creativa' ),
                // 'required'      => array('opt-title-bar', "=", 1),
                'subtitle' => esc_html__( 'Pick page title text color. (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),


            array(
                'id'        => 'opt-pt-bg',
                'type'      => 'background',
                'title'     => esc_html__('Page Title Background', 'creativa'),
                // 'required'  => array('opt-title-bar', "=", 1),
                'subtitle'  => esc_html__('Pick Page Title background color or image.', 'creativa'),
                'preview_height' => '110px',
                'preview'   => true,
                'preview_media' => true,
                'default'   => array(
                    'background-color' => "#fafafa"
                ),
            ),

            array(
                'id'        => 'opt-pt-border',
                'type'      => 'border',
                'title'     => esc_html__('Page Title Bottom Border', 'creativa'),
                // 'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle'  => esc_html__('Pick borders settings for footer widget area. (default: none)', 'creativa'),
                'all'       => false,
                'bottom'    => true,
                'top'       => false,
                'left'       => false,
                'right'       => false,
                'default'   => array(
                    'border-color'  => '#f3f3f3', 
                    'border-style'  => 'none', 
                    'border-bottom' => '0px', 
                )
            ),

            array(
                'id'        => 'opt-pt-overlay',
                'type'      => 'switch',
                'title'     => esc_html__('Page Title image bg Overlay', 'creativa'),
                // 'required'  => array('opt-title-bar', "=", 1),
                'subtitle'  => esc_html__('Show overlay on title bar image background. (default: #000000, alpha: 0.8)', 'creativa'),
                'default'   => false,
            ),


            array(
                'id' => 'section-pt-overlay-start',
                'type' => 'section',
                'class' => 'aaa',
                // 'title' => esc_html__('Title Bar', 'creativa'),
                'indent' => true 
            ),

            array(
                'id'       => 'opt-pt-overlay-color-style',
                'type'     => 'select',
                'title'    => esc_html__('Overlay Color Style', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'required'  => array('opt-pt-overlay', "=", 1),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '1' => 'Solid',
                    '2' => 'Gradient',
                ),
                'default'   => '1',
            ),

            array(
                'id'        => 'opt-pt-overlay-bg',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay - Color', 'creativa' ),
                'required'  => array('opt-pt-overlay', "=", 1),
                'subtitle' => esc_html__( 'Page Title image overlay color.', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => '0.3'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-pt-overlay-bg2',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Page Title Overlay - Color 2', 'creativa' ),
                'required'  => array(
                    array('opt-pt-overlay', "=", 1),
                    array('opt-pt-overlay-color-style', "=", 2),
                ),
                'subtitle' => esc_html__( 'Page Title image overlay color.', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => '0.9'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'       => 'opt-pt-overlay-gradient-dir',
                'type'     => 'select',
                'title'    => esc_html__('Overlay Gradient Direction', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'required'  => array(
                    array('opt-pt-overlay', "=", 1),
                    array('opt-pt-overlay-color-style', "=", 2),
                ),
                // 'subtitle' => esc_html__('Choose position where project description and meta will show up.', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '180' => 'Top to Bottom',
                    '90' => 'Left to Right',
                    '135' => 'Top-Left to Bottom-Right',
                ),
                'default'   => '180',
            ),

            array(
                'id' => 'section-pt-overlay-end',
                'type' => 'section',
                'indent' => false 
            ),



        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Blog', 'creativa'),
        'desc'      => esc_html__('Blog styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // BLOG ------------------------------------------- /
            array(
                'id'       => 'opt-blog-heading-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Blog Post Title Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick blog heading colors. (default: #111111/#21ce99)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#111111',
                    'hover'   => '#21ce99',
                )
            ),

            array(
                'id'       => 'opt-blog-cats-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Post Categories Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick categories text color above title. (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-blog-info-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Entry Info Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick entry info text color (date, comments) (default: #6a6a6a)', 'creativa' ),
                'default'  => '#6a6a6a',
                'transparent' => false,
                'validate' => 'color',
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Portfolio', 'creativa'),
        'desc'      => esc_html__('Portfolio styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Portfolio ------------------------------------------- /
            array(
                'id'       => 'opt-portfolio1-heading-color',
                'type'     => 'color',
                'required'  => array('opt-portfolio-style', "!=", 3),
                'title'    => esc_html__( 'Portfolio Item Heading Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick portfolio item heading text color. (default: #ffffff)', 'creativa' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-portfolio3-heading-color',
                'type'     => 'color',
                'required'  => array('opt-portfolio-style', "=", 3),
                'title'    => esc_html__( 'Portfolio Item Heading Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick portfolio item heading text color. (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'        => 'opt-portfolio3-heading-bg',
                'type'      => 'color_rgba',
                'required'  => array('opt-portfolio-style', "=", 3),
                'title'    => esc_html__( 'Portfolio Item Heading Background', 'creativa' ),
                'subtitle' => esc_html__( 'Portfolio Thumbnail overlay color. (default: #ffffff)', 'creativa' ),
                'default'   => array('color' => '#ffffff', 'alpha' => '1'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),


            array(
                'id'        => 'opt-portfolio-th-over',
                'type'      => 'color_rgba',
                'required'  => array('opt-portfolio-style', "!=", 3),
                'title'    => esc_html__( 'Overlay Color', 'creativa' ),
                'subtitle' => esc_html__( 'Portfolio Thumbnail overlay color. (default: rgba(0,0,0,0.2))', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => '0.2'),
                'transparent' => true,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id' => 'section-filtering-style-start',
                'type' => 'section',
                'title' => esc_html__('Portfolio Filtering', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'       => 'opt-portfolio-filters-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Portfolio Filtering Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick portfolio filtering color. (default: #bbbbbb)', 'creativa' ),
                'default'  => '#bbbbbb',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-portfolio-filters-color-active',
                'type'     => 'color',
                'title'    => esc_html__( 'Portfolio Filtering Color - Active', 'creativa' ),
                'subtitle' => esc_html__( 'Pick portfolio filtering active color. (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-portfolio-sorting-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Portfolio Sorting Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick portfolio sorting color. (default: #21ce99)', 'creativa' ),
                'default'  => '#21ce99',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id' => 'section-filtering-style-end',
                'type' => 'section',
                'indent' => false 
            ),


        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Footer', 'creativa'),
        'desc'      => esc_html__('Footer styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        // 'icon'      => 'el-icon-picture',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Footer ------------------------------------------- /,

            array(
                'id'       => 'opt-footer-widgets-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Area Background', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick footer widget area background. (default: #252525)', 'creativa' ),
                'default'  => '#252525',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-widgets-heading',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Area Heading Color', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick footer widget area text color. (default: #696969)', 'creativa' ),
                'default'  => '#696969',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-widgets-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Widget Area Text Color', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick footer widget area text color. (default: #a0a0a0)', 'creativa' ),
                'default'  => '#a0a0a0',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-widgets-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer Widgets Area Link Colors', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick widget area link colors (default: #a0a0a0/#a0a0a0)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#a0a0a0',
                    'hover'   => '#a0a0a0',
                )
            ),

            array(
                'id'       => 'opt-footer-widgets-widget-border',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Footer Widgets Borders Color', 'creativa' ),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle' => esc_html__( 'Pick widgets border colors. (Default: rgba(255,255,255,0.14))', 'creativa' ),
                'default'   => array('color' => '#ffffff', 'alpha' => '0.14'),
                'transparent' => false,
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-footer-widgets-border',
                'type'      => 'border',
                'title'     => esc_html__('Footer Widget Area Borders', 'creativa'),
                'required'  => array('opt-footer-widget-area','=','1'),
                'subtitle'  => esc_html__('Pick borders settings for footer widget area. (default: 1px solid #3a3a3a)', 'creativa'),
                'all'       => false,
                'bottom'    => true,
                'top'       => true,
                'left'       => false,
                'right'       => false,
                'default'   => array(
                    'border-color'  => '#3a3a3a', 
                    'border-style'  => 'none', 
                    'border-bottom' => '0px', 
                    'border-top' => '0px', 
                )
            ),

            array(
                'id'     => 'opt-footer-widget-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required'  => array('opt-footer-widget-area','=','0'),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Widget Area is Disabled.', 'creativa' ),
                'desc'   => esc_html__( 'Go to Footer Section to Enabled Widget Area.', 'creativa' )
            ),

            array(
                'id' => 'section-footer-copy-start',
                'type' => 'section',
                'title' => esc_html__('Copyrights Area', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'       => 'opt-footer-copyrights-bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Area Background', 'creativa' ),
                'subtitle' => esc_html__( 'Pick footer widget area background. (default: #1c1c1c)', 'creativa' ),
                'default'  => '#1c1c1c',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-copyrights-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Copyright Area Text Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick footer widget area text color. (default: #999999)', 'creativa' ),
                'default'  => '#999999',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'       => 'opt-footer-copyrights-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer Copyright Area Link Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick copyrights widget area link colors (default: #cccccc/#cccccc)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#cccccc',
                    'hover'   => '#cccccc',
                )
            ),

            array(
                'id' => 'section-footer-copy-end',
                'type' => 'section',
                'indent' => false 
            ),


        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Widgets', 'creativa'),
        'desc'      => esc_html__('Widgets styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'       => 'opt-widgets-links',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Widgets Links Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick widgets links colors (default: #9a9a9a/#9a9a9a)', 'creativa' ),
                //'regular'   => false, // Disable Regular Color
                //'hover'     => false, // Disable Hover Color
                'active'    => false, // Disable Active Color
                //'visited'   => true,  // Enable Visited Color
                'default'  => array(
                    'regular' => '#9a9a9a',
                    'hover'   => '#9a9a9a',
                )
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Misc', 'creativa'),
        'desc'      => esc_html__('Misc styling options.', 'creativa'),
        'icon'      => 'el-icon-tint',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            // Misc ------------------------------------------- /

            array(
                'id' => 'section-misc-forms-start',
                'type' => 'section',
                'title' => esc_html__('Forms', 'creativa'),
                'indent' => false 
            ),

            array(
                'id'       => 'opt-misc-form-text',
                'type'     => 'color',
                'title'    => esc_html__( 'Form Text Color', 'creativa' ),
                'subtitle' => esc_html__( 'Pick form text color. (default: #111111)', 'creativa' ),
                'default'  => '#111111',
                'transparent' => false,
                'validate' => 'color',
            ),

            array(
                'id'        => 'opt-misc-form-bg',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Border Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick form background color. (default: #ffffff)', 'creativa' ),
                'default'   => array('color' => '#ffffff', 'alpha' => 1),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),

            array(
                'id'        => 'opt-misc-form-border',
                'type'      => 'color_rgba',
                'title'    => esc_html__( 'Border Colors', 'creativa' ),
                'subtitle' => esc_html__( 'Pick form border color. (default: rgba(0,0,0,0.1)).', 'creativa' ),
                'default'   => array('color' => '#000000', 'alpha' => 0.13),
                'options' => array(
                    'allow_empty' => false,
                    'clickout_fires_change' => true,
                ),
                'validate'  => 'colorrgba',
            ),


            array(
                'id' => 'section-misc-forms-end',
                'type' => 'section',
                'indent' => false 
            ),


        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Typography', 'creativa'),
        'desc'      => esc_html__('Select section you want to customize.', 'creativa'),
        'icon'      => 'el-icon-font',
        'class'     => 'creativa_opt_styling',
        'subsection' => false,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(                

            array(
                'id' => 'section-misc-start',
                'type' => 'section',
                'title' => '',
                'indent' => false 
            ),


            array(
                'id' => 'section-misc-end',
                'type' => 'section',
                'indent' => false 
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Body', 'creativa'),
        //'desc'      => esc_html__('Typography settings.', 'creativa'),
        'icon'      => 'el-icon-font',
        'class'     => 'creativa_opt_styling',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'          => 'opt-typo-body',
                'type'        => 'typography', 
                'title'       => esc_html__('Body', 'creativa'),
                'subtitle'    => esc_html__('Defaults: font-family: "Poppins", font-weight: 300, font-size: 14px, line-height: 26px', 'creativa'),
                'google'      => true, 
                'units'       =>'px',
                'color'       => false,
                'font-weight' => true,
                'font-style' => false,
                'text-align'  => false,
                'font-backup' => false,
                'font_family_clear' => false,
                'all_styles'  => true,
                'preview'     => array(
                        'always_display' => false,
                        'text'           => 'Grumpy wizards make toxic... / 0123456789',
                    ),
                'default'     => array(
                    //'color'       => '#333', 
                    'font-weight'  => '300', 
                    'font-family' => 'Poppins', 
                    'google'      => true,
                    'font-size'   => '14px', 
                    'line-height' => '26px',
                ),
            ),

            array(
                'id'       => 'opt-typo-a-weight',
                'type'     => 'select',
                'title'    => esc_html__('Links font-weight', 'creativa'), 
                'select2'  => array( 'allowClear' => false, 'minimumResultsForSearch' => -1),
                'subtitle' => esc_html__('Link font weight (default: 400).', 'creativa'),
                //'desc'     => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                // Must provide key => value pairs for select options
                'options'  => array(
                    '100' => '100',
                    '200' => '200',
                    '300' => '300',
                    '400' => '400',
                    '500' => '500',
                    '600' => '600',
                    '700' => '700',
                    '800' => '800',
                    '900' => '900',
                ),
                'default'   => '400',
            ),

            array(
                'id'          => 'opt-typo-body-secondary',
                'type'        => 'typography', 
                'title'       => esc_html__('Secondary/Serif Font', 'creativa'),
                'subtitle'    => esc_html__('Defaults: font-family: "Rosarivo", font-weight/style: 400', 'creativa'),
                'google'      => true, 
                'units'       =>'px',
                'color'       => false,
                'font-weight' => true,
                'font-style'  => true,
                'font-size'   => false,
                'line-height'   => false,
                'text-align'  => false,
                'font-backup' => false,
                'font_family_clear' => true,
                'subsets'     => false,
                'all_styles'  => true,
                'preview'     => array(
                        'always_display' => false,
                        'text'           => 'Grumpy wizards make toxic... / 0123456789',
                    ),
                'default'     => array(
                    //'color'       => '#333', 
                    'font-weight'  => '400', 
                    'font-style'  => 'normal', 
                    'font-family' => 'Rosarivo', 
                    'google'      => true,
                ),
            ),

        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Headings', 'creativa'),
        //'desc'      => esc_html__('Typography settings.', 'creativa'),
        'icon'      => 'el-icon-font',
        'class'     => 'creativa_opt_styling',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(



            array(
                'id'          => 'opt-typo-basic-headings',
                'type'        => 'typography', 
                'title'       => esc_html__('Headings', 'creativa'),
                'subtitle'    => esc_html__('Defaults: font-family: "Montserrat", font-weight: 700, text-transform: none(null)', 'creativa'),
                'google'      => true, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font-size'   => false,
                'line-height' => false,
                'font_family_clear' => false,
                'all_styles'  => true,
                'preview'     => array(
                    'always_display' => true,
                    'font-size'      => '30px',
                    'text'           => 'Grumpy wizards make toxic... / 0123456789',
                ),
                'default'     => array(
                    'font-weight'  => '700', 
                    // 'font-style'  => 'normal', 
                    'font-family' => 'Montserrat', 
                    // 'google'      => false,
                    'letter-spacing' => '',
                ),
            ),

            array(
                'id'          => 'opt-typo-basic-h1',
                'type'        => 'typography', 
                'title'       => esc_html__('H1', 'creativa'),
                'subtitle'        => esc_html__('Defaults: 44px/48px', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'font_family_clear' => false,
                'default'     => array(
                    'font-size' => '44px',
                    'line-height' => '48px'
                ),
            ),

            array(
                'id'          => 'opt-typo-basic-h2',
                'type'        => 'typography', 
                'title'       => esc_html__('H2', 'creativa'),
                'subtitle'        => esc_html__('Defaults: 32px/38px', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'font_family_clear' => false,
                'default'     => array(
                    'font-size' => '32px',
                    'line-height' => '38px'
                ),
            ),

            array(
                'id'          => 'opt-typo-basic-h3',
                'type'        => 'typography', 
                'title'       => esc_html__('H3', 'creativa'),
                'subtitle'        => esc_html__('Defaults: 26px/34px', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'font_family_clear' => false,
                'default'     => array(
                    'font-size' => '26px',
                    'line-height' => '34px'
                ),
            ),

            array(
                'id'          => 'opt-typo-basic-h4',
                'type'        => 'typography', 
                'title'       => esc_html__('H4', 'creativa'),
                'subtitle'        => esc_html__('Defaults: 18px/28px', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'font_family_clear' => false,
                'default'     => array(
                    'font-size' => '18px',
                    'line-height' => '28px'
                ),
            ),

            array(
                'id'          => 'opt-typo-basic-h5',
                'type'        => 'typography', 
                'title'       => esc_html__('H5', 'creativa'),
                'subtitle'        => esc_html__('Defaults: 15px/24px', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'font_family_clear' => false,
                'default'     => array(
                    'font-size' => '15px',
                    'line-height' => '24px'
                ),
            ),

            array(
                'id'          => 'opt-typo-basic-h6',
                'type'        => 'typography', 
                'title'       => esc_html__('H6 / Small', 'creativa'),
                'subtitle'        => esc_html__('Defaults: 12px/20px', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'font_family_clear' => false,
                'default'     => array(
                    'font-size' => '12px',
                    'line-height' => '20px'
                ),
            ),

            array(
                'id'   =>'divider_1',
                // 'desc' => esc_html__('This is the description field, again good for additional info.', 'creativa'),
                'type' => 'divide',
                'class' => 'hr'
            ),

            array(
                'id'        => 'opt-custom-page-title-typo',
                'type'      => 'switch',
                'title'     => esc_html__('Customize Page Title', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'          => 'opt-page-title-heading',
                'type'        => 'typography', 
                'title'       => esc_html__('Page Title Heading', 'creativa'),
                'required'      => array('opt-custom-page-title-typo','=','1'),
                'google'      => true, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => true,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Page Title',
                ),
                'subtitle'    => esc_html__('Page Title typography.', 'creativa'),
                'default'     => array(
                    'font-weight'  => '', 
                    'font-family' => '', 
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => '',
                    'text-transform' => '',
                    'letter-spacing' => '',
                ),
            ),

            array(
                'id'          => 'opt-page-subtitle-heading',
                'type'        => 'typography', 
                'title'       => esc_html__('Page Subtitle Heading', 'creativa'),
                'required'      => array('opt-custom-page-title-typo','=','1'),
                'google'      => false, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'font-family' => false,
                'font-weight' => false,
                'font-style' => false,
                'text-align'  => false,
                'line-height' => true,
                'letter-spacing' => false,
                'text-transform' => false,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Page Subtitle. Nulla facilisi. Donec suscipit ullamcorper accumsan.',
                ),
                'subtitle'    => esc_html__('Page Subtitle typography.', 'creativa'),
                'default'     => array(
                    'font-weight'  => '', 
                    // 'font-family' => 'Raleway', 
                    // 'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '28px',
                    // 'text-transform' => '',
                    // 'letter-spacing' => '',
                ),
            ),

            array(
                'id'        => 'opt-custom-post-title',
                'type'      => 'switch',
                'title'     => esc_html__('Customize Blog Post Title', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'          => 'opt-post-title',
                'type'        => 'typography', 
                'title'       => esc_html__('Blog Post Title', 'creativa'),
                'required'      => array('opt-custom-post-title','=','1'),
                'google'      => true, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => true,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Hello World!',
                ),
                'subtitle'    => esc_html__('Blog Post Title typography.', 'creativa'),
                'default'     => array(
                    'font-weight'  => '', 
                    'font-family' => '', 
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => '',
                    'text-transform' => '',
                    'letter-spacing' => '',
                ),
            ),

            array(
                'id'        => 'opt-custom-portfolio-title',
                'type'      => 'switch',
                'title'     => esc_html__('Customize Portfolio Item Title', 'creativa'),
                'default'   => false,
            ),

            array(
                'id'          => 'opt-portfolio-title',
                'type'        => 'typography', 
                'title'       => esc_html__('Portfolio Item Title', 'creativa'),
                'required'      => array('opt-custom-portfolio-title','=','1'),
                'google'      => true, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => true,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Portfolio Item',
                ),
                'subtitle'    => esc_html__('Portfolio Item typography. (defaults: font-family: "Raleway", font-size: 24px, line-height: 24px, font-weight: 300, letter-spacing: -1px, text-transform: NULL)', 'creativa'),
                'default'     => array(
                    'font-weight'  => '', 
                    'font-family' => '', 
                    'google'      => true,
                    'font-size'   => '',
                    'line-height' => '',
                    'text-transform' => '',
                    'letter-spacing' => '',
                ),
            ),


        ),
    ) );


    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Navigation', 'creativa'),
        //'desc'      => esc_html__('Typography settings.', 'creativa'),
        'icon'      => 'el-icon-font',
        'class'     => 'creativa_opt_styling',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'          => 'opt-typo-main-nav',
                'type'        => 'typography', 
                'title'       => esc_html__('Main Menu', 'creativa'),
                'google'      => true, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Home Portfolio Blog Contact',
                ),
                'subtitle'    => esc_html__('Main Navigation typography. (defaults: font-family: "Montserrat", font-size: 16px, font-weight: 400, letter-spacing: 0px, text-transform: none)', 'creativa'),
                'default'     => array(
                    'font-weight'  => '400', 
                    'font-family' => 'Montserrat', 
                    'google'      => true,
                    'font-size'   => '16px',
                    'text-transform' => 'none',
                    'letter-spacing' => '0px',
                ),
            ),

            array(
                'id'          => 'opt-typo-main-submenu',
                'type'        => 'typography', 
                'title'       => esc_html__('Sub Menu', 'creativa'),
                'google'      => false, 
                'font-backup' => false,
                'font-family' => false,
                'font-style'  => false,
                'font-weight' => true,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Home Portfolio Blog Contact',
                ),
                'subtitle'    => esc_html__('Main Navigation Submenu typography. (defaults: font-size: 12px, font-weight: NULL = Semibold 600, letter-spacing: 0px, text-transform: NULL)', 'creativa'),
                'default'     => array(
                    'font-weight'  => '400', 
                    'font-size'   => '12px',
                    'text-transform' => 'none',
                    'letter-spacing' => '0px',
                ),
            ),


        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Mobile/Secondary Navigation', 'creativa'),
        //'desc'      => esc_html__('Typography settings.', 'creativa'),
        'icon'      => 'el-icon-font',
        'class'     => 'creativa_opt_styling',
        'subsection' => true,
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'          => 'opt-typo-fullw-nav',
                'type'        => 'typography', 
                'title'       => esc_html__('Full Width Menu', 'creativa'),
                'required'      => array('opt-secondary-nav-style','=','2'),
                'google'      => true, 
                'font-backup' => false,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Home<br><br>Portfolio<br><br>Blog<br><br>Contact',
                ),
                'subtitle'    => esc_html__('Full Width Navigation typography. (defaults: font-family: "Raleway", font-size: 30px, line-height: 18px, font-weight: 300, letter-spacing: 0, text-transform: none )', 'creativa'),
                'default'     => array(
                    'font-weight'  => '400', 
                    'font-family' => 'Montserrat', 
                    'google'      => true,
                    'font-size'   => '22px',
                    // 'line-height'   => '18px',
                    'text-transform' => 'none',
                    'letter-spacing' => '0px',
                ),
            ),

            array(
                'id'          => 'opt-typo-fullw-nav-submenu',
                'type'        => 'typography', 
                'title'       => esc_html__('Full Width Navigation Submenu', 'creativa'),
                'required'      => array('opt-secondary-nav-style','=','2'),
                'google'      => false, 
                'font-backup' => false,
                'font-family' => false,
                'font-style'  => false,
                'font-weight' => true,
                'subsets'     => false,
                'units'       =>'px',
                'color'       => false,
                'text-align'  => false,
                'line-height' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'font_family_clear' => false,
                'preview'     => array(
                    'always_display' => false,
                    'text'           => 'Page<br><br>About us<br><br>Services',
                ),
                'subtitle'    => esc_html__('Main Navigation Submenu typography. (defaults: font-size: 14px)', 'creativa'),
                'default'     => array(
                    'font-weight'  => '400', 
                    'font-size'   => '14px',
                    'text-transform' => 'none',
                    'letter-spacing' => '',
                ),
            ),

            array(
                'id'     => 'opt-fwnav-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required' => array('opt-secondary-nav-style','!=','2'),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Full Width Navigation is Disabled.', 'creativa' ),
                'desc'   => esc_html__( 'Go to Header -> Full Screen/Mobile Navigation to Enabled Full Width Navigation.', 'creativa' )
            ),

        ),
    ) );    

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Google API key', 'creativa'),
        'desc'      => esc_html__('Google API key required for maps.', 'creativa'),
        'icon'      => 'el el-map-marker',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'     => 'opt-fwnav-info',
                'type'   => 'info',
                'notice' => true,
                'style'  => 'info',
                'required' => array('opt-secondary-nav-style','!=','2'),
                'icon'   => 'el-icon-info-sign',
                'title'  => esc_html__( 'Google API key is required for Maps Shortcode.', 'creativa' ),
                'desc'  => sprintf( wp_kses( __( '<a href="%1$s" target="_blank">Click here to generate your API key.</a>', 'creativa' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' ) ),
            ),

            array(
                'id'        => 'opt-google-api-key',
                'type'      => 'text',
                'title'     => esc_html__('Google API key', 'creativa'),
                'subtitle'  => esc_html__('Paste your API key here.', 'creativa'),
                'validate' => 'no_html',
                'default'   => '',
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(        
        'title'     => esc_html__('Custom CSS', 'creativa'),
        'desc'      => esc_html__('Advanced Settings.', 'creativa'),
        'icon'      => 'el-icon-css',
        // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields'    => array(

            array(
                'id'        => 'opt-ace-editor-css',
                'type'      => 'ace_editor',
                'title'     => esc_html__('Custom CSS Code', 'creativa'),
                'subtitle'  => esc_html__('Add your CSS code here.', 'creativa'),
                'mode'      => 'css',
                'theme'     => 'monokai',
                'default'   => ""
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(  
        'type' => 'divide',
    ) );

    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    // add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'creativa' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'creativa' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }