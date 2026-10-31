<?php
/**
 * Plugin Name: WP CarDealer Freezones
 * Plugin URI: https://github.com/foroshgahsaz/cardealer
 * Description: سفارشی‌سازی‌های freezonescar برای WP CarDealer (Navasan، هزینه واردات، بدنه، موقعیت، Elementor و بهینه‌سازی). به‌روزرسانی هستهٔ Apus این افزونه را overwrite نمی‌کند.
 * Version: 1.0.0
 * Author: foroshgahsaz
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Requires Plugins: wp-cardealer/wp-cardealer.php
 * Text Domain: wp-cardealer
 *
 * @package wp-cardealer-freezones
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/includes/require-proxy.php';

/**
 * Ensure core is active before booting.
 */
function wp_cardealer_freezones_plugins_loaded() {
	if ( ! class_exists( 'WP_CarDealer' ) ) {
		add_action(
			'admin_notices',
			static function () {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				echo '<div class="notice notice-error"><p>';
				esc_html_e( 'WP CarDealer Freezones requires the WP CarDealer plugin to be installed and active.', 'wp-cardealer' );
				echo '</p></div>';
			}
		);
		return;
	}

	require_once __DIR__ . '/includes/class-bootstrap.php';
	WP_CarDealer_Freezones_Bootstrap::init();
}
add_action( 'plugins_loaded', 'wp_cardealer_freezones_plugins_loaded', 5 );
