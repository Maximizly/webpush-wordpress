<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.maximizly.app
 * @since      1.0.0
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/includes
 * @author     Maximilian Kern <support@maximizly.app>
 */
class Maximizly_webpush_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        $path = get_home_path();
        file_put_contents($path.'/maximizly-sw.js', "importScripts('https://maximizly.s3.eu-central-1.amazonaws.com/sources/webpush/production/worker/maximizly-sw.js')");
	}

}
