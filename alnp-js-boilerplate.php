<?php
/*
 * Plugin Name: Auto Load Next Post: JS Boilerplate
 * Plugin URI:  https://github.com/AutoLoadNextPost/alnp-js-boilerplate
 * Description: Boilerplate for writing plugins for Auto Load Next Post JavaScript.
 * Author: Auto Load Next Post
 * Author URI: https://autoloadnextpost.com
 * Version: 1.0.0
 * Developer: Sébastien Dumont
 * Developer URI: https://sebastiendumont.com
 * Text Domain: alnp-js-boilerplate
 * Domain Path: /languages/
 *
 * Copyright: © 2018 Sébastien Dumont
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package   Auto Load Next Post: JS Boilerplate
 * @author    Auto Load Next Post
 * @copyright Copyright © 2018, Auto Load Next Post
 * @license   GNU General Public License v3.0 http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! class_exists( 'ALNP_JS_Boilerplate' ) ) {
	class ALNP_JS_Boilerplate {

		/**
		 * @var ALNP_JS_Boilerplate - the single instance of the class.
		 *
		 * @access protected
		 * @static
		 * @since 1.0.0
		 */
		protected static $_instance = null;

		/**
		 * Plugin Version
		 *
		 * @access public
		 * @static
		 * @since  1.0.0
		 */
		public static $version = '1.0.0';

		/**
		 * Required Auto Load Next Post Version
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public $required_alnp = '1.4.8';

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
		} // END instance()

		/**
		 * Cloning is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cloning this object is forbidden.', 'alnp-js-boilerplate' ), self::$version );
		} // END __clone()

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @access public
		 * @since  1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'alnp-js-boilerplate' ), self::$version );
		} // END __wakeup()

		/**
		 * ALNP_JS_Boilerplate Constructor.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return ALNP_JS_Boilerplate
		 */
		public function __construct() {
			$this->init_hooks();
		} // END __construct()

		/**
		 * Initialize hooks.
		 *
		 * @access private
		 * @since  1.0.0
		 */
		private function init_hooks() {
			add_action( 'auto_load_next_post_loaded', array( $this, 'check_required_version' ) );
			add_action( 'init', array( $this, 'load_plugin_textdomain' ), 0 );

			add_action( 'wp_enqueue_scripts', array( $this, 'alnp_enqueue_scripts' ) );
		} // END init_hooks()

		/**
		 * Checks if the required Auto Load Next Post is installed.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return bool
		 */
		public function check_required_version() {
			if ( ! defined( 'AUTO_LOAD_NEXT_POST_VERSION' ) || version_compare( AUTO_LOAD_NEXT_POST_VERSION, $this->required_alnp, '<' ) ) {
				add_action( 'admin_notices', array( $this, 'alnp_not_installed' ) );
				return false;
			}
		} // END check_alnp_installed()

		/**
		 * Required version of Auto Load Next Post is Not Installed Notice.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function alnp_not_installed() {
			echo '<div class="error"><p>' . sprintf( __( 'Auto Load Next Post: JS Boilerplate requires $1%s v$2%s or higher to be installed.', 'alnp-js-boilerplate' ), '<a href="https://autoloadnextpost.com/" target="_blank">Auto Load Next Post</a>', $this->required_alnp ) . '</p></div>';
		} // END alnp_not_installed()

		/*-----------------------------------------------------------------------------------*/
		/*  Helper Functions                                                                 */
		/*-----------------------------------------------------------------------------------*/

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

		/*-----------------------------------------------------------------------------------*/
		/*  Localization                                                                     */
		/*-----------------------------------------------------------------------------------*/

		/**
		 * Make the plugin translation ready.
		 *
		 * Translations should be added in the WordPress language directory:
		 *  - WP_LANG_DIR/plugins/alnp-js-boilerplate-LOCALE.mo
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'alnp-js-boilerplate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		} // END load_plugin_textdomain()

		/**
		 * Load JS only on the front end for a single post.
		 *
		 * @access public
		 * @since  1.0.0
		 * @return void
		 */
		public function alnp_enqueue_scripts() {
			if ( is_singular() && get_post_type() == 'post' ) {
				wp_register_script( 'alnp-js-boilerplate', $this->plugin_url() . '/assets/js/alnp-js-boilerplate.js', array( 'jquery' ), self::$version, true );
				wp_enqueue_script( 'alnp-js-boilerplate' );
			}
		} // END alnp_enqueue_scripts()

	} // END class

} // END if class exists

return ALNP_JS_Boilerplate::instance();
