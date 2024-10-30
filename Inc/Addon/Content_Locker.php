<?php
namespace JLTELCL\Inc\Addon;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use JLTELCL\Inc\Classes\Helper;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 10/02/20
*/

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Content_Locker extends Widget_Base {


	public function get_name() {
		return 'cle-restrict-content';
	}

	public function get_title() {
		return esc_html__( 'Content Locker', 'content-locker-for-elementor');
	}

	public function get_icon() {
		return 'cle-icon cle-restricted';
	}

	public function get_style_depends() {
		return [ 'content-locker-style'];
	}

	public function get_keywords() {
		return [ 'password', 'password protected', 'content locker', 'restrict content', 'protected content', 'age restriction', 'safe', 'age gate', 'age verification'];
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {

		/*
		 * Tab: Content
		 */

		$this->start_controls_section(
			'cle_restrict_content_section',
			[
				'label' => esc_html__( 'Content Lock Type', 'content-locker-for-elementor' )
			]
		);

		$this->add_control(
			'cle_restrict_content_type',
			[
				'label'       => esc_html__('Content Lock Type', 'content-locker-for-elementor'),
				'label_block' => false,
				'type'        => Controls_Manager::SELECT,
				'default'     => 'user',
				'options'     => [
					'user'      		=> esc_html__('User Based', 'content-locker-for-elementor'),
					'password'  		=> esc_html__('Password Based', 'content-locker-for-elementor'),
					'math_captcha'      => esc_html__('Math Captcha', 'content-locker-for-elementor')
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_math_type',
			[
				'label'       => esc_html__('Math Type', 'content-locker-for-elementor'),
				'label_block' => false,
				'type'        => Controls_Manager::SELECT,
				'default'     => 'add',
				'options'     => [
					'add'      			=> esc_html__('Add', 'content-locker-for-elementor'),
					'subtract'  		=> esc_html__('Subtract', 'content-locker-for-elementor')
				],
				'condition'   => [
					'cle_restrict_content_type' => 'math_captcha'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_user_role',
			[
				'label'       => esc_html__( 'Select User Roles', 'content-locker-for-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => Helper::cle_user_roles(),
				'condition'   => [
					'cle_restrict_content_type' => 'user'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_pass',
			[
				'label'     => esc_html__( 'Set Password', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '123456',
				'condition' => [
					'cle_restrict_content_type' => ['password']						
				]
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'cle_restrict_content',
			[
				'label' => esc_html__( 'Content Locker', 'content-locker-for-elementor' ),
			]
		);

		$this->add_control(
			'cle_restrict_content_source',
			[
				'label'   => esc_html__( 'Select Source', 'content-locker-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'         => esc_html__( 'Custom Content', 'content-locker-for-elementor' ),
					'elementor'      => esc_html__( 'Elementor Template', 'content-locker-for-elementor' )
				],
			]
		);


		$this->add_control(
			'cle_restrict_content_elementor_source',
			[
				'label'   => esc_html__( 'Select Source', 'content-locker-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'section',
				'options' => [
					'section'   => esc_html__( 'Saved Section', 'content-locker-for-elementor' ),
					'widget'    => esc_html__( 'Saved Widget', 'content-locker-for-elementor' ),
					'template'  => esc_html__( 'Saved Page Template', 'content-locker-for-elementor' ),
				],
				'condition'   => ['cle_restrict_content_source' => 'elementor'],
			]
		);


		$this->add_control(
			'cle_restrict_content_saved_widget',
			[
				'label'                 => esc_html__( 'Choose Widget', 'content-locker-for-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'options'               => Helper::get_page_template_options( 'widget' ),
				'default'               => '-1',
				'condition'   => ['cle_restrict_content_source' => 'elementor'],
				'conditions'        => [
					'terms' => [
						[
							'name'      => 'cle_restrict_content_elementor_source',
							'operator'  => '==',
							'value'     => 'widget',
						],
					],
				],
			]
		);

		$this->add_control(
			'cle_restrict_content_saved_section',
			[
				'label'                 => esc_html__( 'Choose Section', 'content-locker-for-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'options'               => Helper::get_page_template_options( 'section' ),
				'default'               => '-1',
				'condition'   => ['cle_restrict_content_source' => 'elementor'],

				'conditions'        => [
					'terms' => [
						[
							'name'      => 'cle_restrict_content_elementor_source',
							'operator'  => '==',
							'value'     => 'section',
						],
					],
				],
			]
		);


		$this->add_control(
			'cle_restrict_content_elementor_template',
			[
				'label'                 => esc_html__( 'Choose Template', 'content-locker-for-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'options'               => Helper::get_page_template_options( 'page' ),
				'default'               => '-1',
				'condition'   			=> ['cle_restrict_content_source' => 'elementor'],
				'conditions'        	=> [
					'terms' => [
						[
							'name'      => 'cle_restrict_content_elementor_source',
							'operator'  => '==',
							'value'     => 'template',
						],
					]
				],
			]
		);


		$this->add_control(
			'cle_restrict_content_custom',
			[
				'label'       => esc_html__( 'Custom Content', 'content-locker-for-elementor' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'default'     => esc_html__( 'This is your content that you want to be restricted by either user role or password.', 'content-locker-for-elementor' ),
				'condition'   => [
					'cle_restrict_content_source' => 'custom',
				],
			]
		);

		$this->add_control(
			'cle_restrict_content_show',
			[
				'label'       => esc_html__( 'Show Forcefully for Edit', 'content-locker-for-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'You can show your restricted content in editor for design it.', 'content-locker-for-elementor' ),
				'condition'   => [
					'cle_restrict_content_type'	=> 'password'
				]
			]
		);

		$this->end_controls_section();


		/*
		* Warning Messages
		*/
		$this->start_controls_section(
			'cle_warning_message',
			[
				'label' => esc_html__( 'Warning Message' , 'content-locker-for-elementor' ),
			]
		);

		$this->add_control(
			'cle_warning_type',
			[
				'label'   => esc_html__( 'Message Type', 'content-locker-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'         => esc_html__( 'Custom Message', 'content-locker-for-elementor' ),
					'elementor'      => esc_html__( 'Elementor Template', 'content-locker-for-elementor' ),
					'none'           => esc_html__( 'None', 'content-locker-for-elementor' ),
				],
			]
		);

		$this->add_control(
			'cle_warning_message_template',
			[
				'label'                 => esc_html__( 'Choose Template', 'content-locker-for-elementor' ),
				'type'                  => Controls_Manager::SELECT,
				'options'               => Helper::get_page_template_options( 'page' ),
				'default'               => '-1',
				'conditions'        => [
					'terms' => [
						[
							'name'      => 'cle_warning_type',
							'operator'  => '==',
							'value'     => 'elementor',
						],
					],
				],
			]
		);

		$this->add_control(
			'cle_warning_message_title',
			[
				'label'     => esc_html__('Custom Title', 'content-locker-for-elementor'),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => esc_html__('What\'s','content-locker-for-elementor'),
				'dynamic'   => [ 'active' => true	],
				'condition' => [
					'cle_warning_type' => 'custom',
					'cle_restrict_content_type!'	=> 'password',
				]
			]
		);
		
		$this->add_control(
			'cle_warning_message_text',
			[
				'label'     => esc_html__('Custom Message', 'content-locker-for-elementor'),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => esc_html__('You don\'t have permission to see this content.','content-locker-for-elementor'),
				'dynamic'   => [ 'active' => true	],
				'condition' => [
					'cle_warning_type' => 'custom',						
				]
			]
		);


		$this->add_control(
			'cle_warning_show',
			[
				'label'   => esc_html__('Show Warnings?', 'content-locker-for-elementor'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);			


		$this->add_control(
			'cle_warning_message_close_button',
			[
				'label'   => esc_html__('Close Button', 'content-locker-for-elementor'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);			

		$this->end_controls_section();



		/*
		* Buttons
		*/
		$this->start_controls_section(
			'cle_rc_submit',
			[
				'label' => esc_html__( 'Buttons' , 'content-locker-for-elementor' ),
			]
		);


		$this->add_control(
			'cle_submit_button',
			[
				'label'     => esc_html__('Submit Button', 'content-locker-for-elementor'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Submit','content-locker-for-elementor'),
				'dynamic'   => [ 'active' => true	]
			]
		);
		
		$this->end_controls_section();


		/* Content Locker Style */

		$this->start_controls_section(
			'cle_restrict_content_style',
			[
				'label'     => esc_html__( 'Content Locker', 'content-locker-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'cle_restrict_content_source' => 'custom'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_color',
			[
				'label'     => esc_html__( 'Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-wrap .cle-restrict-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cle_restrict_content_background',
			[
				'label'     => esc_html__( 'Background', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-wrap .cle-restrict-content' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'before',
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-wrap .cle-restrict-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_margin',
			[
				'label'      => esc_html__( 'Margin', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-wrap .cle-restrict-content' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cle_restrict_content_typography',
				'selector' => '{{WRAPPER}} .cle-restrict-content-wrap .cle-restrict-content',
			]
		);

		$this->end_controls_section();



		/* Warning Style */
		$this->start_controls_section(
			'cle_rc_warning_message_style',
			[
				'label'     => esc_html__( 'Message Contents', 'content-locker-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'cle_warning_type' => 'custom'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'cle_restrict_content_box_bg_color',
				'label'     => esc_html__( 'Background', 'content-locker-for-elementor' ),
				'type'		=> 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' =>'.cle-restrict-content-wrap',
				'default' => [
					'background' => 'classic',
					'color'      => '#555'
				]
			]
		);


		// Label 
		$this->add_control(
			'cle_rc_warning_label_heading',
			[
				'label'     => esc_html__( 'Label Warning', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>[
					'cle_warning_type' 			=> 'custom',
					'cle_restrict_content_type'	=> 'math_captcha'
					
				]
			]
		);

		$this->add_control(
			'cle_rc_warning_label_color',
			[
				'label'     => esc_html__( 'Label Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-form label.cle_rc_answer,
					{{WRAPPER}} .cle-restrict-form label.cle_ra_input_year' => 'color: {{VALUE}};'
				],
				'condition' =>[
					'cle_warning_type' 			=> 'custom',
					'cle_restrict_content_type'	=> 'math_captcha'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cle_rc_warning_label_typography',
				'selector' => '{{WRAPPER}} .cle-restrict-form label.cle_rc_answer, {{WRAPPER}} .cle-restrict-form label.cle_ra_input_year',
				'condition' =>[
					'cle_warning_type' 			=> 'custom',
					'cle_restrict_content_type'	=> 'math_captcha'
				]
			]
		);



		// Title
		$this->add_control(
			'cle_rc_warning_title_heading',
			[
				'label'     => esc_html__( 'Title Warning', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' =>[
					'cle_warning_type' 			=> 'custom',
					'cle_restrict_content_type!'	=> 'password'						
				]
			]
		);

		$this->add_control(
			'cle_rc_warning_title_color',
			[
				'label'     => esc_html__( 'Title Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-form .card-title,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-form .card-title,
					{{WRAPPER}} .cle-alert .elementor-alert-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cle_rc_warning_title_typography',
				'selector' => '{{WRAPPER}} .cle-alert .elementor-alert-title,{{WRAPPER}} .cle-restrict-form .card-title, {{WRAPPER}} .cle-restrict-modal .card-title,{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-form .card-title'
			]
		);


		// Message
		$this->add_control(
			'cle_rc_warning_title_typo_desc_heading',
			[
				'label'     => esc_html__( 'Description', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'cle_rc_warning_message_color',
			[
				'label'     => esc_html__( 'Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-message-text .cle-alert, 
					{{WRAPPER}} .cle-restrict-form .card-text,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-form .card-text' => 'color: {{VALUE}};'
				]
			]
		);			
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cle_rc_warning_message_typography',
				'selector' => '{{WRAPPER}} .cle-alert .elementor-alert-description, {{WRAPPER}} .cle-restrict-form .card-text,{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-form .card-text',
				'separator' => 'after',
			]
		);


		$this->add_control(
			'cle_rc_warning_message_background',
			[
				'label'     => esc_html__( 'Warning Message BG', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-message-text .cle-alert,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-message-text .cle-alert' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'cle_rc_warning_message_padding',
			[
				'label'      => esc_html__( 'Padding', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-message-text .cle-alert,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-message-text .cle-alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'cle_rc_warning_message_margin',
			[
				'label'      => esc_html__( 'Margin', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-message-text .cle-alert,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-message-text .cle-alert' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);



		

		$this->end_controls_section();


		$this->start_controls_section(
			'cle_restrict_content_password_input',
			[
				'label'     => esc_html__( 'Password Input', 'content-locker-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'cle_restrict_content_type'	=> 'password'
				]
			]
		);

		$this->start_controls_tabs('cle_restrict_content_password_input_control_tabs');

		$this->start_controls_tab('cle_restrict_content_password_input_normal', [
			'label' => esc_html__( 'Normal', 'content-locker-for-elementor' )
		]);

		$this->add_control(
			'cle_restrict_content_password_input_color',
			[
				'label'     => esc_html__( 'Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_password_input_background',
			[
				'label'     => esc_html__( 'Background Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_password_input_padding',
			[
				'label'      => esc_html__( 'Padding', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_password_input_margin',
			[
				'label'      => esc_html__( 'Margin', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'cle_restrict_content_password_input_border',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass',
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_password_input_radius',
			[
				'label'      => esc_html__( 'Radius', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cle_restrict_content_password_input_shadow',
				'selector' => '{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cle_restrict_content_password_input_typography',
				'selector' => '{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('cle_restrict_content_password_input_hover', [
			'label' => esc_html__( 'Hover', 'content-locker-for-elementor' )
		]);

		$this->add_control(
			'cle_restrict_content_password_input_hover_color',
			[
				'label'     => esc_html__( 'Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_password_input_hover_background',
			[
				'label'     => esc_html__( 'Background Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass:hover' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_password_input_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass:hover' => 'border-color: {{VALUE}};'
				],
				'condition' => [
					'cle_restrict_content_password_input_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cle_restrict_content_password_input_hover_shadow',
				'selector' => '{{WRAPPER}} .cle-restrict-content-fields input.cle-input-pass:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/*
		* Submit Button
		*/
		$this->start_controls_section(
			'cle_restrict_content_submit_button',
			[
				'label'     => esc_html__( 'Submit Button', 'content-locker-for-elementor' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('cle_restrict_content_submit_button_control_tabs');

		$this->start_controls_tab('cle_restrict_content_submit_button_normal', [
			'label' => esc_html__( 'Normal', 'content-locker-for-elementor' )
		]);

		$this->add_control(
			'cle_restrict_content_submit_button_color',
			[
				'label'     => esc_html__( 'Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_submit_button_background',
			[
				'label'     => esc_html__( 'Background Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_submit_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_submit_button_margin',
			[
				'label'      => esc_html__( 'Margin', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'cle_restrict_content_submit_button_border',
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
								{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn',
			]
		);

		$this->add_responsive_control(
			'cle_restrict_content_submit_button_border_radius',
			[
				'label'      => esc_html__( 'Radius', 'content-locker-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'separator'  => 'after',
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cle_restrict_content_submit_button_shadow',
				'selector' => '{{WRAPPER}} .cle-restrict-content-fields button.cle-btn,
								{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cle_restrict_content_submit_button_typography',
				'selector' => '{{WRAPPER}} .cle-restrict-content-fields button.cle-btn, 
								{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('cle_restrict_content_submit_button_hover', [
			'label' => esc_html__( 'Hover', 'content-locker-for-elementor' )
		]);

		$this->add_control(
			'cle_restrict_content_submit_button_hover_color',
			[
				'label'     => esc_html__( 'Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn:hover,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_submit_button_hover_background',
			[
				'label'     => esc_html__( 'Background Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn:hover,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn:hover' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'cle_restrict_content_submit_button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'content-locker-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cle-restrict-content-fields button.cle-btn:hover,
					{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn:hover' => 'border-color: {{VALUE}};'
				],
				'condition' => [
					'cle_restrict_content_submit_button_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'cle_restrict_content_submit_button_hover_shadow',
				'selector' => '{{WRAPPER}} .cle-restrict-content-fields button.cle-btn:hover,
								{{WRAPPER}} {{CURRENT_ITEM}} .cle-restrict-content-fields button.cle-btn:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function cle_current_user_role() {
		if( !is_user_logged_in() ) { return; }
		$user_type    = $this->get_settings('cle_restrict_content_user_role');
		$user_role    = reset(wp_get_current_user()->roles);
		$content_role = ( $user_type ) ? $user_type : [];
		$output       = in_array($user_role, $content_role);
		return $output;
	}

	protected function cle_restrict_content_msg() {
		$settings = $this->get_settings_for_display();
		$close_button = ($settings['cle_warning_message_close_button'] == 'yes') ? true : false;
		?>
		<div class="cle-restrict-content-message">
			<?php if ( $settings['cle_warning_type'] == 'custom' ) { ?>

					<?php if( !isset($_POST['cle_restrict_content_pass']) ) : ?>

						<?php if ( !empty( $settings['cle_warning_message_text'] ) ) : ?>
							<?php if($settings['cle_warning_show'] == 'yes'){?>
								<div class="cle-restrict-content-message-text">
									<?php Helper::cle_warning_messaage($settings['cle_warning_message_text'],'warning',$close_button); ?>
								</div>
							<?php } ?>
						<?php endif; ?>

					<?php elseif(isset($_POST['cle_restrict_content_pass']) && ($settings['cle_restrict_content_pass'] !== $_POST['cle_restrict_content_pass'])) : ?>
						<?php if($settings['cle_warning_show'] == 'yes'){?>
							<?php Helper::cle_warning_messaage( esc_html__('Ops, You entered wrong password!', 'content-locker-for-elementor'), 'warning', $close_button); ?>
						<?php } ?>
					<?php endif; ?>

			<?php } elseif ( 'elementor' == $settings['cle_warning_type'] and !empty( $settings['cle_warning_message_template'] ) ) {
					echo Helper::cle_elementor()->frontend->get_builder_content_for_display(
					        $settings['cle_warning_message_template'] );
				}
			?>
		</div>
		<?php
	}



	// Content Locker
	public function cle_restrict_content() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="cle-restrict-content">
			<?php
				if ( $settings['cle_restrict_content_source'] == 'custom' and !empty( $settings['cle_restrict_content_custom'] ) ) { ?>
					<div class="cle-restrict-content-message">
						<?php echo esc_html( $this->parse_text_editor($settings['cle_restrict_content_custom'])); ?>
					</div>
					<?php
				} elseif ( $settings['cle_restrict_content_source'] == 'elementor' and !empty( $settings['cle_restrict_content_elementor_template'] )) {
					echo Helper::cle_elementor()->frontend->get_builder_content_for_display(
					        $settings['cle_restrict_content_elementor_template'] );
				} elseif ( $settings['cle_restrict_content_elementor_source'] == 'section' and !empty(
				        $settings['cle_restrict_content_saved_section'] )) {
					echo Helper::cle_elementor()->frontend->get_builder_content_for_display(
					        $settings['cle_restrict_content_saved_section'] );
				} elseif ( $settings['cle_restrict_content_elementor_source'] == 'widget' and !empty(
				        $settings['cle_restrict_content_saved_widget'] )) {
					echo Helper::cle_elementor()->frontend->get_builder_content_for_display(
					        $settings['cle_restrict_content_saved_widget'] );
				}
			?>
		</div>
		<?php
	}

	public function cle_rc_password(){?>

		<div class="form-group mb-2">				
			<input type="password" name="cle_restrict_content_pass" class="form-control
			cle-input-pass mr-3 mt-2" placeholder="<?php esc_html_e( 'Enter Password', 'content-locker-for-elementor' ); ?>" size="20"/>
			<?php $this->cle_render_submit_form();?>					
		</div>	
		
	<?php }



	public function cle_rc_age_button_submit(){
		$settings = $this->get_settings_for_display();
		?>
			<h5 class="card-title">
				<?php echo esc_html( $settings['cle_warning_message_title'] );?>
			</h5>
			<p class="card-text">
				<?php echo esc_html( $settings['cle_warning_message_text'] ); ?>
			</p>
			<div class="card-body">				
				<?php echo esc_html( $settings['cle_warning_checkbox_message'] ); ?>
			</div>

		<?php 
	}
	


	public function cle_render_submit_form(){
		global $wp;
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute([
            'button_wrapper' =>[
                'class'	=> [ 							
					'cle-btn',
					'btn',
					'btn-primary',
					'mb-2',
					'mt-3'
				],
				'id' 			=> 'cle-btn',
			],
		]);
		?>
			<span class="cle_rc_submit">
				<button type="submit" name="submit" value="Submit" <?php echo esc_attr( $this->get_render_attribute_string( 'button_wrapper' )); ?> >
					<?php echo esc_html( $settings['cle_submit_button']); ?>
				</button>					
				<input type="hidden" name="action" value="cle_restrict_content" />
			</span>

	<?php }


	public function cle_rc_math_captcha(){
		$settings = $this->get_settings_for_display();
		$math_type = $settings['cle_restrict_content_math_type'];

		
		$digit1 = mt_rand(1,20);
		$digit2 = mt_rand(1,20);
		
		if($math_type == "add") {
			$math = "$digit1 + $digit2";
			$math_hd = $digit1 + $digit2;
		} else if ($math_type == 'subtract') {
			$math = "$digit1 - $digit2";
			$math_hd = $digit1 - $digit2;
		} else if ($math_type == 'multiply') {
			$math = "$digit1 x $digit2";
			$math_hd = $digit1 * $digit2;
		}
		?>

		<div class="form-group text-center cle_rc_answer">		
			<label for="cle_rc_answer" class="cle_rc_answer">
				<?php echo esc_html( $settings['cle_warning_message_title'] );?> <?php echo esc_html( $math ) . ' =   '; ?>
			</label>
			<input class="mt-1 mr-3 ml-3" name="cle_rc_answer" type="text" size="8" />
			<input	name="cle_rc_answer_hd" type="hidden" value="<?php echo esc_html( $math_hd );?>"/>
			
			<?php $this->cle_render_submit_form();?>

		</div>

	<?php
	}


	public function cle_restrict_content_form() {
		$settings = $this->get_settings_for_display();
		
		$this->add_render_attribute([
            'form_wrapper' =>[
                    'class'	=> [ 
						'cle-restrict-form',
						'w-100',
						'form-inline'
					],
					'id' 			=> 'cle-restrict-form-' . $this->get_id(),
					'data-form-id' 	=> 'cle-restrict-form-' . $this->get_id(),
					'method'		=> "post"
				],
		]);

		$this->add_render_attribute([
            'button_wrapper' =>[
                    'class'	=> [ 
						'cle-btn',
						'btn',
						'btn-primary',
						'mb-2',
						'mt-3'
					],
					'id' 			=> 'cle-btn'
				],
		]);

		?>
			<div class="cle-restrict-content-fields">
				<form <?php echo esc_attr( $this->get_render_attribute_string( 'form_wrapper' ) ); ?>>
					<div class="card-body">

						<?php 

							if($settings['cle_restrict_content_type'] == 'password' ){ $this->cle_rc_password(); }

							if($settings['cle_restrict_content_type'] == 'math_captcha' ){ $this->cle_rc_math_captcha(); } 

							$cle_restrict_content_array = array( "password","math_captcha");
							$cle_restrict_content_type_data = $settings['cle_restrict_content_type'];

							if( !in_array($cle_restrict_content_type_data, $cle_restrict_content_array)) { 
								$this->cle_render_submit_form();
							} 
						?>
					</div>

				</form>
			</div>

		<?php
	}


	protected function cle_rc_render_user(){

		// User Based Content Locker
		if( true === $this->cle_current_user_role() ) {
			$this->cle_restrict_content();
		} else {
			$this->cle_restrict_content_msg();
		}
	}

	

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute([
            'wrapper' =>[
				'class'						=> [ 'cle-restrict-content-wrap'],
				'id' 						=> 'cle-restrict-content-' . $this->get_id(),
				'data-restrict-type' 		=> $settings['cle_restrict_content_type']
			]
		]);
	?>

			<section <?php echo esc_attr( $this->get_render_attribute_string( 'wrapper' ) ); ?>>

				<?php 
					
					// On Page Content Lockers
				
					if ( $settings['cle_restrict_content_type'] == 'user' ) {
						
						$this->cle_rc_render_user();

					} elseif ( $settings['cle_restrict_content_type'] == 'password') {
						
						// Password Based Content Locker
						if ( Helper::cle_elementor()->editor->is_edit_mode()) {

							if( $settings['cle_restrict_content_show'] !== 'yes' ) {
								$this->cle_restrict_content_msg();
								$this->cle_restrict_content_form();
							} else {
								$this->cle_restrict_content();
							}

						} else {

							if( !empty($settings['cle_restrict_content_pass']) ) {
								if( isset($_POST['cle_restrict_content_pass']) && ($settings['cle_restrict_content_pass'] === $_POST['cle_restrict_content_pass']) ) {
									if( !session_status() ) { session_start(); }
									$_SESSION['cle_restrict_content_pass'] = true;
									
									$this->cle_restrict_content();
								}
							} else {
								Helper::cle_warning_messaage( esc_html__('Ops, You Forget to set password!', 'content-locker-for-elementor') );
							}

							if( ! isset($_SESSION['cle_restrict_content_pass']) ) {									
								$this->cle_restrict_content_msg();
								$this->cle_restrict_content_form();
							}
						}

					} elseif ( isset($settings['cle_restrict_content_type']) == 'math_captcha') {

						// Math Captcha Content Locker

						if ( Helper::cle_elementor()->editor->is_edit_mode()) {
							$this->cle_restrict_content_msg();
							$this->cle_restrict_content_form();
						} else{
							$cle_rc_answer_hd = isset($_POST['cle_rc_answer_hd']) ? esc_html( $_POST['cle_rc_answer_hd'] ) : "";
							if( !empty($_POST['cle_rc_answer']) && ($_POST['cle_rc_answer'] === $cle_rc_answer_hd)) {
								if( !session_status() ) { session_start(); }
								$this->cle_restrict_content();
							} else if ( ! isset( $_POST['cle_rc_answer'] ) || ! $_POST['cle_rc_answer'] ) {	
								$this->cle_restrict_content_msg();
								$this->cle_restrict_content_form();
							}else {
								Helper::cle_warning_messaage( esc_html__('Ops, you entered wrong number!', 'content-locker-for-elementor') );
								$this->cle_restrict_content_form();
							}
						}
					
					} ?>

                       


			</section>

		<?php
	}

}