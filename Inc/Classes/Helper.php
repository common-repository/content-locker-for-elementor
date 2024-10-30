<?php
namespace JLTELCL\Inc\Classes;

class Helper{


	public static function get_page_template_options( $type = '' ) {

		$page_templates = self::ma_get_page_templates( $type );

		$options[-1]   = __( 'Select', 'content-locker-for-elementor' );

		if ( count( $page_templates ) ) {
			foreach ( $page_templates as $id => $name ) {
				$options[ $id ] = $name;
			}
		} else {
			$options['no_template'] = __( 'No saved templates found!', 'content-locker-for-elementor' );
		}

		return $options;
	}


	public static function ma_get_page_templates( $type = '' ) {
		$args = [
			'post_type'         => 'elementor_library',
			'posts_per_page'    => -1,
		];

		if ( $type ) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms' => $type,
				]
			];
		}

		$page_templates = get_posts( $args );

		$options = array();

		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
			foreach ( $page_templates as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}
		return $options;
	}


	public static function cle_elementor_plugin_missing_notice( $args ){

		// default params
		$defaults = array(
			'plugin_name' => '',
			'echo'        => true
		);
		$args = wp_parse_args( $args, $defaults );

		ob_start();
		?>
		<div class="elementor-alert elementor-alert-danger" role="alert">
	        <span class="elementor-alert-title">
	            <?php echo sprintf( esc_html__( '"%s" Plugin is Not Activated!', 'content-locker-for-elementor' ), $args['plugin_name'] )
	            ; ?>
	        </span>
			<span class="elementor-alert-description">
                <?php esc_html_e( 'In order to use this element, you need to install and activate this plugin.',
                    'content-locker-for-elementor' ); ?>
            </span>
		</div>

		<?php
		$notice =  ob_get_clean();

		if( $args['echo'] ){
			echo $notice;
		} else {
			return $notice;
		}
	}



	public static function cle_user_roles(){

		global $wp_roles;

		$all_roles  = $wp_roles->roles;
		$user_roles = [];

		if(!empty($all_roles)){
			foreach($all_roles as $key => $value){
				$user_roles[$key] = $all_roles[$key]['name'];
			}
		}

		return $user_roles;
	}


	public static function cle_warning_messaage($message, $type = 'warning', $close = true) {?>

            <div class="cle-alert elementor-alert elementor-alert-<?php echo $type; ?>" role="alert">

                <span class="elementor-alert-description">
                    <?php echo wp_kses_post( $message ); ?>
                </span>

                <?php if($close) : ?>
                    <button type="button" class="elementor-alert-dismiss" data-dismiss="alert" aria-label="Close">X</button>
                <?php endif; ?>

            </div>

		<?php
	}


	public static function cle_elementor() {
		return \Elementor\Plugin::$instance;
	}

}