<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @version       1.0.0
 * @package       JLT_Elementor_Content_Locker
 * @license       Copyright JLT_Elementor_Content_Locker
 */

if ( ! function_exists( 'jltelcl_option' ) ) {
	/**
	 * Get setting database option
	 *
	 * @param string $section default section name jltelcl_general .
	 * @param string $key .
	 * @param string $default .
	 *
	 * @return string
	 */
	function jltelcl_option( $section = 'jltelcl_general', $key = '', $default = '' ) {
		$settings = get_option( $section );

		return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
	}
}

if ( ! function_exists( 'jltelcl_exclude_pages' ) ) {
	/**
	 * Get exclude pages setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltelcl_exclude_pages() {
		return jltelcl_option( 'jltelcl_triggers', 'exclude_pages', array() );
	}
}

if ( ! function_exists( 'jltelcl_exclude_pages_except' ) ) {
	/**
	 * Get exclude pages except setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltelcl_exclude_pages_except() {
		return jltelcl_option( 'jltelcl_triggers', 'exclude_pages_except', array() );
	}
}