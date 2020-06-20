<?php
/**
 * Order Data
 *
 * @package    Merchant_E_Solutions
 * @subpackage Merchant_E_Solutions/Includes/Classes
 * @author     Jason Witt
 * @copyright  Copyright (c) 2018, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace Merchant_E_Solutions\Includes\Classes\Data;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\OrderData' ) ) {

	/**
	 * Order Data
	 *
	 * @author Jason Witt
	 * @since  1.1.0
	 */
	class OrderData {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function __construct() {}

		/**
		 * Render.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param WC_Order $order       The order object.
		 * @param array    $post_values The post values array.
		 *
		 * @return array
		 */
		public function get( $order, $post_values ) {
			$order_data = array(
				'billing_address_1' => method_exists( $order, 'get_billing_address_1' ) && $order->get_billing_address_1() ? $order->get_billing_address_1() : '',
				'billing_potalcode' => method_exists( $order, 'get_billing_postcode' ) && $order->get_billing_postcode() ? $order->get_billing_postcode() : '',
				'card_number'       => isset( $post_values['card_number'] ) ? str_replace( ' ', '', $post_values['card_number'] ) : '',
				'card_expiry'       => isset( $post_values['card_expiry'] ) ? $post_values['card_expiry'] : '',
				'order_total'       => method_exists( $order, 'get_total' ) && $order->get_total() ? $order->get_total() : '',
				'invoice_number'    => method_exists( $order, 'get_id' ) && $order->get_id() ? $order->get_id() : '',
			);

			return $order_data;
		}
	}
}
