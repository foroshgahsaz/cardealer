<?php
/**
 * Resolve includes/assets from the Freezones extension when present, else core.
 *
 * @package wp-cardealer-freezones
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WP_CARDEALER_FREEZONES_DIR' ) ) {
	define( 'WP_CARDEALER_FREEZONES_DIR', trailingslashit( dirname( dirname( __FILE__ ) ) ) );
}

if ( ! defined( 'WP_CARDEALER_FREEZONES_VERSION' ) ) {
	define( 'WP_CARDEALER_FREEZONES_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wp_cardealer_freezones_url' ) ) {
	/**
	 * Public URL for extension static files.
	 *
	 * @return string
	 */
	function wp_cardealer_freezones_url() {
		if ( defined( 'WP_CARDEALER_FREEZONES_URL' ) ) {
			return WP_CARDEALER_FREEZONES_URL;
		}
		return plugins_url( '/', WP_CARDEALER_FREEZONES_DIR . 'wp-cardealer-freezones.php' );
	}
}

if ( ! function_exists( 'wp_cardealer_freezones_require' ) ) {
	/**
	 * Load a file from the extension if it exists, otherwise from WP CarDealer core.
	 *
	 * @param string $relative Path relative to plugin root, e.g. includes/class-price.php
	 * @return bool
	 */
	function wp_cardealer_freezones_require( $relative ) {
		$relative = ltrim( str_replace( '\\', '/', (string) $relative ), '/' );
		$candidate = WP_CARDEALER_FREEZONES_DIR . $relative;

		if ( is_readable( $candidate ) ) {
			require_once $candidate;
			return true;
		}

		if ( ! defined( 'WP_CARDEALER_PLUGIN_DIR' ) ) {
			return false;
		}

		require_once WP_CARDEALER_PLUGIN_DIR . $relative;
		return true;
	}
}

if ( ! function_exists( 'wp_cardealer_freezones_asset_url' ) ) {
	/**
	 * URL for an asset shipped with the extension, or core when not overridden.
	 *
	 * @param string $relative e.g. assets/js/main.js
	 * @return string
	 */
	function wp_cardealer_freezones_asset_url( $relative ) {
		$relative = ltrim( str_replace( '\\', '/', (string) $relative ), '/' );
		$path     = WP_CARDEALER_FREEZONES_DIR . $relative;

		if ( is_readable( $path ) ) {
			return wp_cardealer_freezones_url() . $relative;
		}

		return defined( 'WP_CARDEALER_PLUGIN_URL' ) ? WP_CARDEALER_PLUGIN_URL . $relative : '';
	}
}
