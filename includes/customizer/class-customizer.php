<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Treville Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
		return wp_parse_args( get_option( 'treville_theme_options', array() ), self::get_default_options() );
	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'header_search'             => true,
			'author_bio'                => false,
			'scroll_to_top'             => false,
			'footer_text'               => '',
			'credit_link'               => true,
			'primary_color'             => '#1177aa',
			'secondary_color'           => '#005e91',
			'tertiary_color'            => '#004477',
			'accent_color'              => '#11aa44',
			'highlight_color'           => '#aa1d11',
			'light_gray_color'          => '#e5e5e5',
			'gray_color'                => '#999999',
			'dark_gray_color'           => '#454545',
			'header_color'              => '#454545',
			'navi_color'                => '#ffffff',
			'link_color'                => '#1177aa',
			'link_hover_color'          => '#454545',
			'button_color'              => '#1177aa',
			'button_hover_color'        => '#454545',
			'title_color'               => '#1177aa',
			'title_hover_color'         => '#454545',
			'border_color'              => '#1177aa',
			'widget_title_color'        => '#454545',
			'footer_widgets_color'      => '#454545',
			'footer_color'              => '#454545',
			'text_font'                 => 'Gudea',
			'title_font'                => 'Magra',
			'title_is_bold'             => false,
			'title_is_uppercase'        => false,
			'navi_font'                 => 'Magra',
			'navi_is_bold'              => false,
			'navi_is_uppercase'         => true,
			'widget_title_font'         => 'Magra',
			'widget_title_is_bold'      => false,
			'widget_title_is_uppercase' => true,
		);

		return $default_options;
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {
		wp_enqueue_script( 'treville-pro-customizer-js', TREVILLE_PRO_PLUGIN_URL . 'assets/js/customize-preview.min.js', array( 'customize-preview' ), '20210309', true );
	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {
		wp_enqueue_style( 'treville-pro-customizer-css', TREVILLE_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), '20210212' );
	}
}

// Run Class.
add_action( 'init', array( 'Treville_Pro_Customizer', 'setup' ) );
