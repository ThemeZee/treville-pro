<?php
/**
 * Header Area Class
 *
 * Displays Social Icons and Search Form in Header.
 *
 * @package Treville Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Area Class
 */
class Treville_Pro_Header_Area {

	/**
	 * Header Area Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Treville Theme is not active.
		if ( ! current_theme_supports( 'treville-pro' ) ) {
			return;
		}

		// Display Social Icons.
		add_action( 'treville_header_area', array( __CLASS__, 'display_social_icons' ) );

		// Display Header Search.
		add_action( 'treville_header_search', array( __CLASS__, 'display_header_search' ) );

		// Add Header Settings in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'header_settings' ) );
	}

	/**
	 * Displays social icons menu in header area
	 *
	 * @return void
	 */
	static function display_social_icons() {

		// Check if there are menus.
		if ( has_nav_menu( 'social' ) ) {

			echo '<div id="header-social-icons" class="header-social-icons social-icons-navigation clearfix">';

			// Display Social Icons Menu.
			wp_nav_menu( array(
				'theme_location' => 'social',
				'container'      => false,
				'menu_class'     => 'social-icons-menu',
				'echo'           => true,
				'fallback_cb'    => '',
				'link_before'    => '<span class = "screen-reader-text">',
				'link_after'     => '</span>',
				'depth'          => 1,
			) );

			echo '</div>';

		}
	}

	/**
	 * Displays header search in main navigation menu.
	 *
	 * @return void
	 */
	static function display_header_search() {

		// Get Theme Options from Database.
		$theme_options = Treville_Pro_Customizer::get_theme_options();

		// Check if header search is enabled in settings.
		if ( true === $theme_options['header_search'] ) :

			echo '<div class="header-search">';

			get_search_form();

			echo '</div>';

		endif;

	}

	/**
	 * Add header settings
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_settings( $wp_customize ) {

		// Add Header Search Title.
		$wp_customize->add_control( new Treville_Customize_Header_Control(
			$wp_customize, 'treville_theme_options[header_search_title]', array(
				'label'    => esc_html__( 'Header Search', 'treville-pro' ),
				'section'  => 'treville_section_general',
				'settings' => array(),
				'priority' => 20,
			)
		) );

		// Add Header Search setting.
		$wp_customize->add_setting( 'treville_theme_options[header_search]', array(
			'default'           => true,
			'type'              => 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'treville_sanitize_checkbox',
		) );
		$wp_customize->add_control( 'treville_theme_options[header_search]', array(
			'label'    => __( 'Display search field in main navigation', 'treville-pro' ),
			'section'  => 'treville_section_general',
			'settings' => 'treville_theme_options[header_search]',
			'type'     => 'checkbox',
			'priority' => 21,
		) );
	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Treville Theme is not active.
		if ( ! current_theme_supports( 'treville-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'social' => esc_html__( 'Social Icons', 'treville-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Treville_Pro_Header_Area', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Treville_Pro_Header_Area', 'register_nav_menus' ), 20 );
