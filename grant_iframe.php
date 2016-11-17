<?php

/**
 *
 * @since             1.0
 * @package           GrantIframe
 *
 * @wordpress-plugin
 * Plugin Name:       Grant Iframe
 * Description:       Grant iframe to use in wordpress and inside of formidable fields
 * Version:           1.0
 * Author:            gfirem
 * License:           Apache License 2.0
 * License URI:       http://www.apache.org/licenses/
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'GrantIframe' ) ) :

	class GrantIframe {

		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize the plugin.
		 */
		private function __construct() {
			add_filter( 'wp_kses_allowed_html', array( $this, 'grant_iframe_tag' ), 1 );
		}

		public function grant_iframe_tag( $tags ) {
			$tags['iframe'] = array(
				'src'             => true,
				'width'           => true,
				'height'          => true,
				'align'           => true,
				'class'           => true,
				'name'            => true,
				'id'              => true,
				'frameborder'     => true,
				'seamless'        => true,
				'srcdoc'          => true,
				'sandbox'         => true,
				'allowfullscreen' => true
			);

			return $tags;
		}

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

	}

	add_action( 'plugins_loaded', array( 'GrantIframe', 'get_instance' ) );

endif;
