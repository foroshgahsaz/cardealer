<?php
/**
 * Bootstraps Freezones modules after WP CarDealer core includes.
 *
 * @package wp-cardealer-freezones
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class WP_CarDealer_Freezones_Bootstrap {

	/**
	 * @var bool
	 */
	private static $booted = false;

	public static function init() {
		if ( self::$booted ) {
			return;
		}
		self::$booted = true;

		if ( ! defined( 'WP_CARDEALER_FREEZONES_URL' ) ) {
			define( 'WP_CARDEALER_FREEZONES_URL', wp_cardealer_freezones_url() );
		}

		add_action( 'wp_cardealer_after_core_3rdparty', array( __CLASS__, 'load_elementor' ) );
		add_action( 'wp_cardealer_after_listing_taxonomies', array( __CLASS__, 'maybe_load_location_taxonomy' ), 10, 1 );
		add_action( 'wp_cardealer_before_price_includes', array( __CLASS__, 'load_support_classes' ) );
		add_action( 'wp_cardealer_libraries_loaded', array( __CLASS__, 'load_cmb_extensions' ) );
		add_action( 'wp_cardealer_includes_loaded', array( __CLASS__, 'init_modules' ) );

		register_deactivation_hook(
			WP_CARDEALER_FREEZONES_DIR . 'wp-cardealer-freezones.php',
			array( __CLASS__, 'on_deactivate' )
		);

		add_action(
			'deactivate_wp-cardealer/wp-cardealer.php',
			array( __CLASS__, 'on_core_deactivate' )
		);
	}

	public static function load_elementor() {
		wp_cardealer_freezones_require( 'includes/3rd-party/class-elementor.php' );
	}

	/**
	 * @param array $fields Listing field map keyed by field id.
	 */
	public static function maybe_load_location_taxonomy( $fields ) {
		if ( empty( $fields ) || isset( $fields[ WP_CARDEALER_LISTING_PREFIX . 'location' ] ) ) {
			wp_cardealer_freezones_require( 'includes/taxonomies/class-taxonomy-listing-location.php' );
		}
	}

	public static function load_support_classes() {
		wp_cardealer_freezones_require( 'includes/class-profiler.php' );
		wp_cardealer_freezones_require( 'includes/class-cron-repair.php' );
		wp_cardealer_freezones_require( 'includes/class-speed-probe.php' );
		wp_cardealer_freezones_require( 'includes/class-navasan.php' );
		wp_cardealer_freezones_require( 'includes/class-listing-location.php' );
		wp_cardealer_freezones_require( 'includes/class-listing-body-damage.php' );
	}

	public static function load_cmb_extensions() {
		wp_cardealer_freezones_require( 'libraries/cmb2/cmb_field_body_damage/cmb-field-body-damage.php' );
	}

	public static function init_modules() {
		add_filter(
			'wp_cardealer_languages_directory',
			array( __CLASS__, 'filter_languages_directory' )
		);
	}

	/**
	 * Prefer extension language files when present.
	 *
	 * @param string $lang_dir
	 * @return string
	 */
	public static function filter_languages_directory( $lang_dir ) {
		$local = WP_CARDEALER_FREEZONES_DIR . 'languages/';
		if ( is_dir( $local ) ) {
			return $local;
		}
		return $lang_dir;
	}

	public static function on_deactivate() {
		wp_clear_scheduled_hook( 'wp_cardealer_navasan_refresh_rate' );
	}

	public static function on_core_deactivate() {
		self::on_deactivate();
	}
}
