<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.maximizly.app
 * @since      1.0.0
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/admin
 * @author     Maximilian Kern <support@maximizly.app>
 */
class Maximizly_webpush_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version )
    {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
    {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/maximizly_webpush-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
    {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/maximizly_webpush-admin.js', array( 'jquery' ), $this->version, false );
	}

    public function maximizly_webpush_add_settings_page() {
        add_options_page( 'Maximizly Webpush', 'Maximizly Webpush', 'manage_options', 'maximizly_webpush', [$this, 'maximizly_webpush_render_plugin_settings_page'] );
    }

    function maximizly_webpush_register_settings() {
        register_setting( 'maximizly_webpush_options', 'maximizly_webpush_options', [$this, 'maximizly_webpush_options_validate'] );
        add_settings_section( 'general_settings', 'Settings', [$this, 'maximizly_webpush_section_text'], 'maximizly_webpush' );

        add_settings_field( 'maximizly_webpush_setting_enabled', 'Enabled', [$this, 'maximizly_webpush_setting_enabled'], 'maximizly_webpush', 'general_settings' );
        add_settings_field( 'maximizly_webpush_setting_domain', 'Webpush Domain', [$this, 'maximizly_webpush_setting_domain'], 'maximizly_webpush', 'general_settings' );
    }

    public function maximizly_webpush_render_plugin_settings_page() {
        ?>
        <h2>Maximizly Webpush</h2>
        <div class="maximizly-white-container">
        <img src="<?= plugin_dir_url( __FILE__ ) . 'images/maximizly_info.png' ?>">

        <form action="options.php" method="post" style="margin-bottom: 25px;">
            <?php
            settings_fields( 'maximizly_webpush_options' );
            do_settings_sections( 'maximizly_webpush' ); ?>
            <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
        </form>

        <h2>E-Commerce Tracking</h2>
        <?php
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            if (version_compare(WC_VERSION, '3.0', '<')) {
                echo "<p><span style='color:red;'>Inactive:</span> Your Woocommerce Installation must be higher than v3.0.</p>";
            } else {
                echo "<p><span style='color:green;'>Active:</span> Your Orders get tracked by Maximizly.</p>";
            }
        } else {
            echo "<p><span style='color:orange;'>Inactive:</span> No Woocommerce Installtion detected.</p>";
        }
        ?>
        </div>
        <?php
    }

    function maximizly_webpush_options_validate( $input ) {
        $newinput['domain'] = trim( $input['domain'] );
        if(isset($input['enabled'])) {
            $newinput['enabled'] = true;
        } else {
            $newinput['enabled'] = false;
        }

        return $newinput;
    }

    function maximizly_webpush_section_text() {
        echo '<p>Please configure your Webpush Settings here. In order to use the Webpush functionality, you will need an active Subscription at <a href="https://www.maximizly.app" target="_blank">maximizly.app</a> </p>';
    }

    function maximizly_webpush_setting_enabled() {
        $options = get_option( 'maximizly_webpush_options' );
        echo '<input type="checkbox" id="maximizly_webpush_setting_enabled" name="maximizly_webpush_options[enabled]" value="1" ' . (($options['enabled']) ? 'checked' : '') . '>';
        echo 'Activate Webpush Popup';
    }

    function maximizly_webpush_setting_domain() {
        $options = get_option( 'maximizly_webpush_options' );
        echo "<input id='maximizly_webpush_setting_domain' name='maximizly_webpush_options[domain]' type='text' size='80' value='" . esc_attr( $options['domain'] ) . "' />";
        echo "<br>Please enter your webpush domain like in the maximizly backend. e.g maximizly.app";
    }
}
