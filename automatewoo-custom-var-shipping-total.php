<?php
/**
 * Plugin Name: AutomateWoo Custom Var Shipping Totals
 * Plugin URI:
 * Description: Adds a rule to check the order shipping total
 * Version: Beta
 * Author: nicw
 * Author URI:
 *
 */

namespace AutomateWoo\CustomAdditions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AW_Custom_Var_Shipping_Total {

	/**
	 * Menu The instance of AW_Custom_Var_Shipping_Total
	 *
	 * @var    object
	 * @access private
	 * @since  1.0.0
	 */
	private static object $instance;

	/**
	 * Main Menu Instance
	 *
	 * Ensures only one instance of Menu is loaded or can be loaded.
	 *
	 * @return  AW_Custom_Var_Shipping_Total instance
	 * @since  1.0.0
	 * @static
	 */
	public static function instance(): object {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {

		add_filter( 'automatewoo/rules/includes', array( $this, 'register_rules' ) );
		add_filter( 'automatewoo/variables', array( $this, 'register_variables' ) );
	}


	/**
	 * Register rules.
	 *
	 * @param array $rules
	 *
	 * @return array
	 */
	public function register_rules( $rules ) {
		$rules['order_shipping_total'] = plugin_dir_path( __FILE__ ) . 'includes/rules/order-shipping-total-rule.php';

		return $rules;
	}

	/**
	 * Register variables.
	 *
	 * @param array $vars
	 *
	 * @return array
	 */
	public function register_variables( $vars ) {

		$vars['order']['shipping_total'] = plugin_dir_path( __FILE__ ) . 'includes/variables/order-shipping-total-variable.php';

		return $vars;
	}


}

add_action( 'plugins_loaded', array( 'AutomateWoo\CustomAdditions\AW_Custom_Var_Shipping_Total', 'instance' ) );