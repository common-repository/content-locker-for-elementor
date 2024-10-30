<?php
namespace JLTELCL\Inc\Classes;

use JLTELCL\Libs\RowLinks;

if ( ! class_exists( 'Row_Links' ) ) {
	/**
	 * Row Links Class
	 *
	 * Jewel Theme <support@jeweltheme.com>
	 */
	class Row_Links extends RowLinks {

		public $is_active;
		public $is_free;

		/**
		 * Construct method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			parent::__construct();

			$this->is_active = false;
			$this->is_free   = true;
		}


		/**
		 * Plugin action links
		 *
		 * @param [type] $links .
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function plugin_action_links( $links ) {
            $links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				'https://master-addons.com/contact-us',
				__( 'Support', 'content-locker-for-elementor' )
			);            
			$links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				'https://master-addons.com/docs/restrict-content',
				__( 'Docs', 'content-locker-for-elementor' )
			);
            $links[] = sprintf(
				'<a href="%1$s">%2$s</a>',
				'https://master-addons.com/pricing',
				__( 'Upgrade', 'content-locker-for-elementor' )
			);
                        
			return $links;
		}
	}
}