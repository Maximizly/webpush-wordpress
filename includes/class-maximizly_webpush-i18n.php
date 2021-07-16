<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.maximizly.app
 * @since      1.0.0
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/includes
 * @author     Maximilian Kern <support@maximizly.app>
 */
class Maximizly_webpush_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'maximizly_webpush',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
