<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       loprd.pl
 * @since      1.0.0
 *
 * @package    Creativa_Core
 * @subpackage Creativa_Core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Creativa_Core
 * @subpackage Creativa_Core/includes
 */
class Creativa_Core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Creativa_Core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'creativa-core';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Creativa_Core_Loader. Orchestrates the hooks of the plugin.
	 * - Creativa_Core_i18n. Defines internationalization functionality.
	 * - Creativa_Core_Admin. Defines all hooks for the admin area.
	 * - Creativa_Core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-creativa-core-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-creativa-core-i18n.php';
	
		require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-recent-posts-tab.php';
		require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-recent-projects.php';
		require_once plugin_dir_path( __FILE__ ) . 'widgets/widget-social-icons.php';

		require_once plugin_dir_path( __FILE__ ) . 'external/like-count/like-count.php';

		require_once plugin_dir_path( __FILE__ ) . 'external/images/aq_resizer.php';

		if ( class_exists('ReduxFramework') ) {
			require_once plugin_dir_path( __FILE__ ) . 'redux/loader.php';
		
			function creativa_remove_redux_messages() {
				if(class_exists('ReduxFramework')){
					$_redux_instance = get_redux_instance('creativa_options');
					if ( class_exists('ReduxFrameworkPlugin') ) {
						remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
					}
					if ( class_exists('ReduxFrameworkPlugin') ) {
						remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
					}

					// ReduxFramework::_enqueue_field performance improvement - slow wp_script_is
					remove_action( 'admin_enqueue_scripts', array( ReduxFrameworkPlugin::get_instance(), '_enqueue' ), 1);
					if ( isset ( $_GET['page'] ) && isset( $_redux_instance->args['page_slug'] ) && $_GET['page'] == $_redux_instance->args['page_slug'] ) {
						require_once plugin_dir_path( __FILE__ ) . 'redux/creativa-extensions/metaboxes/enqueue.php';
						$enqueue = new reduxCoreEnqueue ( $_redux_instance );
						$enqueue->init();
					}
				}
			}
			
			/** HOOK TO REMOVE REDUX MESSAGES */
			add_action('init', 'creativa_remove_redux_messages');
		}
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */

		$this->loader = new Creativa_Core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Creativa_Core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Creativa_Core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Creativa_Core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
