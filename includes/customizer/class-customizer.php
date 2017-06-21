<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Treville Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Customizer Class
 */
class Treville_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Treville Theme is not active.
		if ( ! current_theme_supports( 'treville-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'treville_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		$theme_options = wp_parse_args( get_option( 'treville_theme_options', array() ), self::get_default_options() );

		// Return theme options.
		return $theme_options;

	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'header_search'        => true,
			'scroll_to_top'        => false,
			'footer_text'          => '',
			'credit_link'          => true,
			'header_color'         => '#454545',
			'navi_color'           => '#ffffff',
			'link_color'           => '#1177aa',
			'border_color'         => '#1177aa',
			'title_color'          => '#1177aa',
			'widget_title_color'   => '#454545',
			'footer_widgets_color' => '#454545',
			'footer_color'         => '#454545',
			'text_font'            => 'Gudea',
			'title_font'           => 'Magra',
			'navi_font'            => 'Magra',
			'widget_title_font'    => 'Magra',
			'available_fonts'      => 'favorites',
		);

		return $default_options;

	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {

		wp_enqueue_script( 'treville-pro-customizer-js', TREVILLE_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), TREVILLE_PRO_VERSION, true );

	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {

		wp_enqueue_style( 'treville-pro-customizer-css', TREVILLE_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), TREVILLE_PRO_VERSION );

	}
}

// Run Class.
add_action( 'init', array( 'Treville_Pro_Customizer', 'setup' ) );
