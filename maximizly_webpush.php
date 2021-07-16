<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.maximizly.app
 * @since             1.0.0
 * @package           Maximizly_webpush
 *
 * @wordpress-plugin
 * Plugin Name:       Maximizly Webpush
 * Plugin URI:        https://www.maximizly.app
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Maximilian Kern
 * Author URI:        https://www.maximizly.app
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       maximizly_webpush
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MAXIMIZLY_WEBPUSH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-maximizly_webpush-activator.php
 */
function activate_maximizly_webpush() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-maximizly_webpush-activator.php';
	Maximizly_webpush_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-maximizly_webpush-deactivator.php
 */
function deactivate_maximizly_webpush() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-maximizly_webpush-deactivator.php';
	Maximizly_webpush_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_maximizly_webpush' );
register_deactivation_hook( __FILE__, 'deactivate_maximizly_webpush' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-maximizly_webpush.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_maximizly_webpush() {

	$plugin = new Maximizly_webpush();
	$plugin->run();

}
run_maximizly_webpush();
