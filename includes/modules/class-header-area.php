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

		// Filter Social Menu to add SVG icons.
		add_filter( 'walker_nav_menu_start_el', array( __CLASS__, 'nav_menu_social_icons' ), 10, 4 );

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
	 * Display SVG icons in social links menu.
	 *
	 * @param  string  $item_output The menu item output.
	 * @param  WP_Post $item        Menu item object.
	 * @param  int     $depth       Depth of the menu.
	 * @param  array   $args        wp_nav_menu() arguments.
	 * @return string  $item_output The menu item output with social icon.
	 */
	static function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
		// Return early if no social menu is filtered.
		if ( 'social' !== $args->theme_location ) {
			return $item_output;
		}

		// Get supported social icons.
		$social_icons = self::supported_social_icons();

		// Search if menu URL is in supported icons.
		$icon = 'star';
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== stripos( $item_output, $attr ) ) {
				$icon = esc_attr( $value );
			}
		}

		// Get SVG.
		$svg = apply_filters( 'treville_pro_get_social_svg', self::get_social_svg( $icon ), $item_output );

		// Add SVG to menu item.
		$item_output = str_replace( $args->link_after, $args->link_after . $svg, $item_output );

		return $item_output;
	}

	/**
	 * Return social SVG markup.
	 *
	 * @param string $icon SVG icon id.
	 * @return string $svg SVG markup.
	 */
	static function get_social_svg( $icon = null ) {
		// Return early if no icon was defined.
		if ( empty( $icon ) ) {
			return;
		}

		// Create SVG markup.
		$svg  = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
		$svg .= ' <use xlink:href="' . TREVILLE_PRO_PLUGIN_URL . 'assets/icons/social-icons.svg?ver=20240124#icon-' . esc_html( $icon ) . '"></use> ';
		$svg .= '</svg>';

		return $svg;
	}

	/**
	 * Returns an array of supported social links (URL and icon name).
	 *
	 * @return array $social_links_icons
	 */
	static function supported_social_icons() {
		// Supported social links icons.
		$supported_social_icons = array(
			'500px'           => '500px',
			'amazon'          => 'amazon',
			'apple'           => 'apple',
			'bandcamp'        => 'bandcamp',
			'behance.net'     => 'behance',
			'bitbucket'       => 'bitbucket',
			'codepen'         => 'codepen',
			'deviantart'      => 'deviantart',
			'digg.com'        => 'digg',
			'discord'         => 'discord',
			'dribbble'        => 'dribbble',
			'dropbox.com'     => 'dropbox',
			'etsy.com'        => 'etsy',
			'facebook.com'    => 'facebook',
			'feed'            => 'rss',
			'rss'             => 'rss',
			'flickr.com'      => 'flickr',
			'foursquare.com'  => 'foursquare',
			'github.com'      => 'github',
			'instagram.com'   => 'instagram',
			'linkedin.com'    => 'linkedin',
			'mailto:'         => 'envelope',
			'mastodon'        => 'mastodon',
			'medium.com'      => 'medium-m',
			'meetup.com'      => 'meetup',
			'patreon'         => 'patreon',
			'pinterest'       => 'pinterest-p',
			'getpocket.com'   => 'get-pocket',
			'reddit.com'      => 'reddit-alien',
			'skype.com'       => 'skype',
			'skype:'          => 'skype',
			'slideshare'      => 'slideshare',
			'snapchat.com'    => 'snapchat',
			'soundcloud.com'  => 'soundcloud',
			'spotify.com'     => 'spotify',
			'steam'           => 'steam',
			'strava'          => 'strava',
			'stumbleupon.com' => 'stumbleupon',
			'telegram'        => 'telegram',
			't.me'            => 'telegram',
			'tumblr.com'      => 'tumblr',
			'twitch.tv'       => 'twitch',
			'twitter.com'     => 'twitter',
			'vimeo.com'       => 'vimeo',
			'vine.co'         => 'vine',
			'vk.com'          => 'vk',
			'whatsapp'        => 'whatsapp',
			'wa.me'           => 'whatsapp',
			'wordpress.org'   => 'wordpress',
			'wordpress.com'   => 'wordpress',
			'x.com'           => 'x-twitter',
			'xing.com'        => 'xing',
			'yelp.com'        => 'yelp',
			'youtube.com'     => 'youtube',
		);

		return apply_filters( 'treville_pro_supported_social_icons', $supported_social_icons );
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
