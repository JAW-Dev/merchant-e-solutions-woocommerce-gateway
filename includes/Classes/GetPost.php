<?php
/**
 * Get Post
 *
 * Get the submitted $_POST.
 *
 * @package    Merchant_E_Solutions
 * @subpackage Merchant_E_Solutions/Includes/Classes
 * @author     Jason Witt
 * @copyright  Copyright (c) 2018, Jason Witt
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0.0
 */

namespace Merchant_E_Solutions\Includes\Classes;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\GetPost' ) ) {

	/**
	 * Name
	 *
	 * @author Jason Witt
	 * @since  1.1.0
	 */
	class GetPost {

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
		 * Get Post.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return array
		 */
		public static function request() {
			// Bail and return an empty array if there is no post data.
			if ( ! $_POST || empty( $_POST ) ) { // phpcs:ignore
				return array();
			}

			// Ge the sanitized $_POST data.
			$sanitized = self::sanitize_array( $_POST ); // phpcs:ignore

			// If there is sanitized data return it else return false.
			return ! empty( $sanitized ) ? $sanitized : false;
		}

		/**
		 * Sanitize the $_POST array values.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $array The $post array.
		 *
		 * @return array
		 */
		public static function sanitize_array( $array ) {

			// If the $array is an array.
			if ( is_array( $array ) ) {

				// Loop through the array.
				foreach ( $array as $entry ) {

					// If entry is not an array.
					if ( ! is_array( $entry ) ) {

						// Sanitize the data.
						$entry = sanitize_text_field( $entry );
					} else { // Else if entry is an array.

						// Run through the loop again.
						self::sanitize_array( $entry );
					}
				}

				// Return the sanitized array.
				return $array;
			}
			return array();
		}
	}
}
