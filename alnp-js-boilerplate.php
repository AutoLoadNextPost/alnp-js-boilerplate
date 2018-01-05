<?php
/*
 * Plugin Name: Auto Load Next Post JS Boilerplate
 * Plugin URI:  https://github.com/AutoLoadNextPost/alnp-js-boilerplate
 * Version:     1.0.0
 * Description: Boilerplate for writing plugins for Auto Load Next Post JavaScript
 * Author:      Sébastien Dumont
 * Author URI:  https://sebastiendumont.com
 *
 * Text Domain: alnp-js-boilerplate
 * Domain Path: /languages/
 *
 * Requires at least: 4.5
 * Tested up to: 4.9.1
 *
 * Copyright: © 2018 Sébastien Dumont
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! class_exists( 'ALNP_JS_Boilerplate' ) ) {
	class ALNP_JS_Boilerplate {

		/**
		 * Plugin Version
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 */
		public static $version = '1.0.0';

		/**
		 * @var ALNP_JS_Boilerplate - the single instance of the class.
		 *
		 * @access protected
		 * @static
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Main ALNP_JS_Boilerplate Instance.
		 *
		 * Ensures only one instance of ALNP_JS_Boilerplate is loaded or can be loaded.
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @see    ALNP_JS_Boilerplate()
		 * @return ALNP_JS_Boilerplate - Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Cloning is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Foul!', 'alnp-js-boilerplate' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Foul!', 'alnp-js-boilerplate' ), '1.0.0' );
		}

		/**
		 * Load the plugin.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __construct() {
			$this->init_hooks();
		}

		/**
		 * Initialize hooks.
		 *
		 * @access private
		 * @since  1.0.0
		 */
		private function init_hooks() {
			add_action( 'init', array( $this, 'init_plugin' ), 0 );

			add_action( 'wp_enqueue_scripts', array( $this, 'alnp_enqueue_scripts' ) );
		} // END load_plugin()

		/**
		 * Get the Plugin URL.
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 * @return string
		 */
		public static function plugin_url() {
			return plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
		} // END plugin_url()

		/**
		 * Initialize the plugin if ready.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function init_plugin() {
			// Load text domain.
			load_plugin_textdomain( 'alnp-js-boilerplate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		} // END init_plugin()

		/**
		 * Load JS only on the front end for a single post.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function alnp_enqueue_scripts() {
			if ( is_singular() && get_post_type() == 'post' ) {
				wp_register_script( 'alnp-js-boilerplate', $this->plugin_url() . '/assets/js/alnp-js-boilerplate.js', array( 'jquery' ), '1.0.0' );
				wp_enqueue_script( 'alnp-js-boilerplate' );
			}
		} // END alnp_enqueue_scripts()

	} // END class

} // END if class exists

return ALNP_JS_Boilerplate::instance();
