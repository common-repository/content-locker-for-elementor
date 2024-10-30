<?php
namespace JLTELCL\Libs;

// No, Direct access Sir !!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Assets' ) ) {

	/**
	 * Assets Class
	 *
	 * Jewel Theme <support@jeweltheme.com>
	 * @version     1.0.2
	 */
	class Assets {

		/**
		 * Constructor method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'jltelcl_enqueue_scripts' ), 100 );
			add_action( 'admin_enqueue_scripts', array( $this, 'jltelcl_admin_enqueue_scripts' ), 100 );
			
			// Elementor Dependencies
			add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'jltelcl_editor_styles' ]);			
		}


		/**
		 * Editor Styles
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltelcl_editor_styles() {
			wp_enqueue_style( 'content-locker-for-elementor-editor', JLTELCL_ASSETS . 'css/content-locker-for-elementor-editor.css', JLTELCL_VER, 'all' );
		}

		/**
		 * Get environment mode
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function get_mode() {
			return defined( 'WP_DEBUG' ) && WP_DEBUG ? 'development' : 'production';
		}

		/**
		 * Enqueue Scripts
		 *
		 * @method wp_enqueue_scripts()
		 */
		public function jltelcl_enqueue_scripts() {

			// CSS Files .
			wp_enqueue_style( 'content-locker-for-elementor-frontend', JLTELCL_ASSETS . 'css/content-locker-for-elementor-frontend.css', JLTELCL_VER, 'all' );

			// JS Files .
			wp_enqueue_script( 'content-locker-for-elementor-frontend', JLTELCL_ASSETS . 'js/content-locker-for-elementor-frontend.js', array( 'jquery' ), JLTELCL_VER, true );
		}


		/**
		 * Enqueue Scripts
		 *
		 * @method admin_enqueue_scripts()
		 */
		public function jltelcl_admin_enqueue_scripts() {
			// CSS Files .
			wp_enqueue_style( 'content-locker-for-elementor-admin', JLTELCL_ASSETS . 'css/content-locker-for-elementor-admin.css', array( 'dashicons' ), JLTELCL_VER, 'all' );

			// JS Files .
			wp_enqueue_script( 'content-locker-for-elementor-admin', JLTELCL_ASSETS . 'js/content-locker-for-elementor-admin.js', array( 'jquery' ), JLTELCL_VER, true );
			wp_localize_script(
				'content-locker-for-elementor-admin',
				'JLTELCLCORE',
				array(
					'admin_ajax'        => admin_url( 'admin-ajax.php' ),
					'recommended_nonce' => wp_create_nonce( 'jltelcl_recommended_nonce' ),
				)
			);
		}
	}
}