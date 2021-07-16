<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.maximizly.app
 * @since      1.0.0
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Maximizly_webpush
 * @subpackage Maximizly_webpush/public
 * @author     Maximilian Kern <support@maximizly.app>
 */
class Maximizly_webpush_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version )
    {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
    {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/maximizly_webpush-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
    {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/maximizly_webpush-public.js', array( 'jquery' ), $this->version, false );

	}

	public function maximizly_hook_header()
    {
	    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/header_code.php';
    }

    function maximizly_track_ecommerce( $order_id ) {
        if ( ! $order_id )
            return;

        // Allow code execution only once
        if( ! get_post_meta( $order_id, '_thankyou_action_done', true ) ) {

            // Get an instance of the WC_Order object
            $order = wc_get_order( $order_id );

            ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        maximizly.push([
                            'trackEcommerceOrder',
                            "<?=  $order->get_order_number() ?>",
                            <?=  $order->get_total() ?>,
                            <?= $order->get_currency() ?>
                        ]);
                    });
                </script>
            <?php

            // Flag the action as done
            $order->update_meta_data( '_thankyou_action_done', true );
            $order->save();
        }
    }

}
