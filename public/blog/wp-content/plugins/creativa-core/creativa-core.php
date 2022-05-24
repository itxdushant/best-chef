<?php

/**
 *
 * @link              loprd.pl
 * @package           Creativa_Core
 *
 * Plugin Name:       Creativa Core
 * Plugin URI:        loprd.pl
 * Description:       Creativa Theme Core plugin.
 * Version:           0.1
 * Author:            Adrian Lampart
 * Author URI:        loprd.pl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       omnis-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require plugin_dir_path( __FILE__ ) . 'includes/class-creativa-core.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_creativa_core() {

	$plugin = new Creativa_Core();
	$plugin->run();

}
run_creativa_core();
