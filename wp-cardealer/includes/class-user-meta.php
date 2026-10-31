<?php
/**
 * User Meta
 *
 * @package    wp-cardealer
 * @author     Habq 
 * @license    GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
  	exit;
}

class WP_CarDealer_User_Meta {

	private static $_instance = null;
	private $metas = null;
	private $user_id = null;

	public static function get_instance($user_id) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self($user_id);
		} else {
			self::$_instance->user_id = $user_id;
		}
		return self::$_instance;
	}

	public function __construct($user_id) {
		$this->user_id = $user_id;
		$this->metas = $this->get_user_metas();
	}

	public function get_user_metas() {
		$return = array();
		$fields = WP_CarDealer_Custom_Fields::get_all_custom_fields(array(), false, WP_CARDEALER_USER_PREFIX);
		if ( !empty($fields) ) {
			foreach ($fields as $field) {
				if ( !empty($field['id']) ) {
					$return[$field['id']] = $field;
				}
			}
		}
		return apply_filters('wp-cardealer-get-user-metas', $return);
	}

	public function get_metas() {
		return $this->metas;
	}

	public function check_user_meta_exist($key) {
		if ( isset($this->metas[WP_CARDEALER_USER_PREFIX.$key]) ) {
			return true;
		}
		return false;
	}

	public function check_custom_user_meta_exist($key) {
		if ( isset($this->metas[$key]) ) {
			return true;
		}
		return false;
	}
	
	public function get_user_meta($key) {
		return get_user_meta($this->user_id, WP_CARDEALER_USER_PREFIX.$key, true);
	}

	public function get_custom_user_meta($key) {
		return get_user_meta($this->user_id, $key, true);
	}

	public function get_user_meta_title($key) {
		if ( !empty($this->metas[WP_CARDEALER_USER_PREFIX.$key]) && isset($this->metas[WP_CARDEALER_USER_PREFIX.$key]['name'])) {
			return $this->metas[WP_CARDEALER_USER_PREFIX.$key]['name'];
		}
		return '';
	}

	public function get_custom_user_meta_title($key) {
		if ( !empty($this->metas[$key]) && isset($this->metas[$key]['name'])) {
			return $this->metas[$key]['name'];
		}
		return '';
	}
	
	public function get_custom_meta_field($key) {
		if ( !empty($this->metas[$key]) ) {
			return $this->metas[$key];
		}
		return '';
	}
	
}
