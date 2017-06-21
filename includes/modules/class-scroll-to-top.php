<?php
/**
 * Scroll to Top
 *
 * Displays scroll to top button based on theme options
 *
 * @package Treville Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Scroll to Top Class
 */
class Treville_Pro_Scroll_To_Top {

	/**
	 * Scroll to Top Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Treville Theme is not active.
		if ( ! current_theme_supports( 'treville-pro' ) ) {
			return;
		}

		// Enqueue Scroll-To-Top JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add Scroll-To-Top Checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'scroll_to_top_settings' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Treville_Pro_Customizer::get_theme_options();

		// Call Credit Link function of theme if credit link is activated.
		if ( true === $theme_options['scroll_to_top'] ) :

			wp_enqueue_script( 'treville-pro-scroll-to-top', TREVILLE_PRO_PLUGIN_URL . 'assets/js/scroll-to-top.js', array( 'jquery' ), TREVILLE_PRO_VERSION, true );

		endif;
	}

	/**
	 * Add scroll to top checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function scroll_to_top_settings( $wp_customize ) {

		// Add Scroll to Top headline.
		$wp_customize->add_control( new Treville_Customize_Header_Control(
			$wp_customize, 'treville_theme_options[scroll_top_title]', array(
				'label' => esc_html__( 'Scroll to Top', 'treville-pro' ),
				'section' => 'treville_pro_section_footer',
				'settings' => array(),
				'priority' => 10,
			)
		) );

		// Add Scroll to Top setting.
		$wp_customize->add_setting( 'treville_theme_options[scroll_to_top]', array(
			'default'           => false,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'treville_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'treville_theme_options[scroll_to_top]', array(
			'label'    => __( 'Display Scroll to Top Button', 'treville-pro' ),
			'section'  => 'treville_pro_section_footer',
			'settings' => 'treville_theme_options[scroll_to_top]',
			'type'     => 'checkbox',
			'priority' => 20,
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Treville_Pro_Scroll_To_Top', 'setup' ) );
