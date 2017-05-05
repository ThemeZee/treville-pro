<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Treville theme to display widgets
 *
 * @package Treville Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Bar Class
 */
class Treville_Pro_Header_Area {

	/**
	 * Footer Widgets Setup
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

	}

	/**
	 * Displays social icons menu in header area
	 *
	 * @return void
	 */
	static function display_social_icons() {

		// Check if there are menus.
		if ( has_nav_menu( 'social' ) ) {

			echo '<div id="header-social-icons" class="social-icons-navigation clearfix">';

			// Display Social Icons Menu.
			wp_nav_menu( array(
				'theme_location' => 'social',
				'container' => false,
				'menu_class' => 'social-icons-menu',
				'echo' => true,
				'fallback_cb' => '',
				'link_before' => '<span class="screen-reader-text">',
				'link_after' => '</span>',
				'depth' => 1,
				)
			);

			echo '</div>';

		}
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
