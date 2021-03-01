<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Treville Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Colors Class
 */
class Treville_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Treville Theme is not active.
		if ( ! current_theme_supports( 'treville-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'treville_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Treville_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Treville_Pro_Customizer::get_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {
			$color_variables .= '--page-background-color: ' . $theme_options['page_bg_color'] . ';';

			$custom_css .= '
				/* Link and Button Color Setting */
				a:link,
				a:visited,
				.post-slider-controls .zeeflex-direction-nav a:hover,
				.has-primary-color {
					color: ' . $theme_options['link_color'] . ';
				}

				a:hover,
				a:focus,
				a:active {
					color: #454545;
				}

				blockquote {
					border-color: ' . $theme_options['link_color'] . ';
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.more-link,
				.entry-categories .meta-categories a,
				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:active,
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:active,
				.pagination a:hover,
				.pagination a:active,
				.pagination .current,
				.infinite-scroll #infinite-handle span,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab,
				.tzwb-social-icons .social-icons-menu li a:link,
				.tzwb-social-icons .social-icons-menu li a:visited,
				.scroll-to-top-button,
				.scroll-to-top-button:focus,
				.scroll-to-top-button:active {
					color: #fff;
					background: ' . $theme_options['link_color'] . ';
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.more-link:hover,
				.more-link:active,
				.infinite-scroll #infinite-handle span:hover,
				.tzwb-social-icons .social-icons-menu li a:active,
				.tzwb-social-icons .social-icons-menu li a:hover,
				.scroll-to-top-button:hover {
					background: #454545;
				}

				.has-primary-background-color {
					background-color: ' . $theme_options['link_color'] . ';
				}
			';
		}

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default_options['header_color'] ) {

			$custom_css .= '
				/* Header Color Setting */
				.site-header,
				.top-navigation ul ul {
					background: ' . $theme_options['header_color'] . ';
				}
			';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['header_color'] ) ) {
				$custom_css .= '
					.site-description,
					.secondary-navigation.toggled-on,
					.top-navigation ul,
					.top-navigation ul a,
					.top-navigation ul ul,
					.top-navigation ul ul a {
						border-color: rgba(0,0,0,0.2);
					}

					.site-title,
					.site-title a:link,
					.site-title a:visited,
					.site-description,
					.top-navigation ul a,
					.top-navigation ul a:link,
					.top-navigation ul a:visited,
					.mobile-menu-toggle,
					.mobile-menu-toggle:focus,
					.header-social-icons .social-icons-menu li a:link,
					.header-social-icons .social-icons-menu li a:visited {
					    color: #454545;
					}

					.site-title a:hover,
					.site-title a:active,
					.top-navigation ul a:hover,
					.top-navigation ul a:active,
					.mobile-menu-toggle:hover,
					.mobile-menu-toggle:active,
					.header-social-icons .social-icons-menu li a:hover,
					.header-social-icons .social-icons-menu li a:active {
						color: rgba(0,0,0,0.5);
					}

					.mobile-menu-toggle .icon,
					.top-navigation .dropdown-toggle .icon,
					.top-navigation ul .menu-item-has-children > a > .icon {
					    fill: #454545;
					}

					.mobile-menu-toggle:hover .icon,
					.mobile-menu-toggle:active .icon,
					.top-navigation .dropdown-toggle:hover .icon,
					.top-navigation .dropdown-toggle:active .icon,
					.top-navigation ul .menu-item-has-children > a:hover > .icon,
					.top-navigation ul .menu-item-has-children > a:active > .icon {
						fill: rgba(0,0,0,0.5);
					}
				';
			}
		}

		// Set Main Navigation Color.
		if ( $theme_options['navi_color'] !== $default_options['navi_color'] ) {

			$custom_css .= '
				/* Main Navigation Color Setting */
				.primary-navigation-wrap,
				.main-navigation ul ul,
				.header-search,
				.header-search .search-form .search-field,
				.header-search .search-form .search-submit {
					background: ' . $theme_options['navi_color'] . ';
				}
			';

			// Check if a light background color was chosen.
			if ( self::is_color_dark( $theme_options['navi_color'] ) ) {
				$custom_css .= '
					.primary-navigation-wrap,
					.main-navigation ul,
					.main-navigation ul a,
					.main-navigation ul ul,
					.main-navigation ul ul a,
					.main-navigation ul ul li:last-child > a,
					.header-search .search-form .search-field,
					.primary-navigation-wrap.toggled-on .header-search {
						border-color: rgba(255,255,255,0.1);
					}

					.main-navigation ul a,
					.main-navigation ul a:link,
					.main-navigation ul a:visited,
					.header-search .search-form .search-field:focus,
					.header-search .search-form .search-submit .genericon-search {
					    color: #ffffff;
					}

					.main-navigation ul a:hover,
					.main-navigation ul a:active,
					.header-search .search-form .search-field,
					.header-search .search-form .search-submit:hover .genericon-search,
					.header-search .search-form .search-submit:active .genericon-search {
						color: rgba(255,255,255,0.5);
					}

					.main-navigation .dropdown-toggle .icon,
					.main-navigation ul .menu-item-has-children > a > .icon {
					    fill: #ffffff;
					}

					.main-navigation .dropdown-toggle:hover .icon,
					.main-navigation .dropdown-toggle:active .icon,
					.main-navigation ul .menu-item-has-children > a:hover > .icon,
					.main-navigation ul .menu-item-has-children > a:active > .icon {
						fill: rgba(255,255,255,0.5);
					}
				';
			}
		}

		// Set Title Color.
		if ( $theme_options['title_color'] != $default_options['title_color'] ) {

			$custom_css .= '
				/* Post Titles Primary Color Setting */
				.page-title,
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited {
					color: ' . $theme_options['title_color'] . ';
				}

				.entry-title a:hover,
				.entry-title a:active {
					color: #454545;
				}
			';
		}

		// Set Border Color.
		if ( $theme_options['border_color'] !== $default_options['border_color'] ) {

			$custom_css .= '
				/* Border Color Setting */
				.widget,
				.widget-header,
				.widget-magazine-columns .magazine-column .magazine-column-content,
				.type-post,
				.type-page,
				.type-attachment,
				.comments-area,
				.comment-respond,
				.comments-header,
				.comment-reply-title,
				.page-header .archive-title {
					box-shadow: inset 0 2px ' . $theme_options['border_color'] . ';
				}

				.treville-magazine-columns-widget {
					box-shadow: none;
				}

				.sticky {
					box-shadow: inset 0 8px ' . $theme_options['border_color'] . ';
				}
			';
		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {

			$custom_css .= '
				/* Widget Titles Color Setting */
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited,
				.page-header .archive-title,
				.comments-header .comments-title,
				.comment-reply-title {
					color: ' . $theme_options['widget_title_color'] . ';
				}

				.widget-title a:hover,
				.widget-title a:active {
					color: #454545;
				}
			';
		}

		// Set Footer Widgets Color.
		if ( $theme_options['footer_widgets_color'] != $default_options['footer_widgets_color'] ) {

			$custom_css .= '
				.footer-widgets-background {
					background: ' . $theme_options['footer_widgets_color'] . ';
				}
				';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['footer_widgets_color'] ) ) {
				$custom_css .= '
					.footer-widgets .widget {
						border-color: rgba(0,0,0,0.05);
					}

					.footer-widgets .widget-title {
						background: rgba(0,0,0,0.025);
						border-bottom: 1px solid rgba(0,0,0,0.025);
					}

					.footer-widgets .widget,
					.footer-widgets .widget-title,
					.footer-widgets .widget-title a:link,
					.footer-widgets .widget-title a:visited,
					.footer-widgets .widget a:link,
					.footer-widgets .widget a:visited  {
						color: #454545;
					}

					.footer-widgets .widget-title a:hover,
					.footer-widgets .widget-title a:active,
					.footer-widgets .widget a:hover,
					.footer-widgets .widget a:active {
						color: rgba(0,0,0,0.5);
					}
				';
			}
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] != $default_options['footer_color'] ) {

			$custom_css .= '
				.footer-wrap {
					background: ' . $theme_options['footer_color'] . ';
				}
				';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$custom_css .= '
					.site-footer,
					.site-footer .site-info,
					.site-footer .site-info a:link,
					.site-footer .site-info a:visited,
					.footer-navigation-menu a:link,
					.footer-navigation-menu a:visited {
						color: #454545;
					}

					.site-footer .site-info a:hover,
					.site-footer .site-info a:active,
					.footer-navigation-menu a:hover,
					.footer-navigation-menu a:active {
						color: rgba(0,0,0,0.5);
					}
				';
			}
		}

		// Set Color Variables.
		if ( '' !== $color_variables ) {
			$custom_css .= ':root {' . $color_variables . '}';
		}

		return $custom_css;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'treville_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'treville-pro' ),
			'priority' => 60,
			'panel'    => 'treville_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Treville_Pro_Customizer::get_default_options();

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'treville_theme_options[header_color]', array(
			'default'           => $default_options['header_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[header_color]', array(
				'label'    => _x( 'Header', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[header_color]',
				'priority' => 10,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'treville_theme_options[navi_color]', array(
			'default'           => $default_options['navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[navi_color]', array(
				'label'    => _x( 'Main Navigation', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[navi_color]',
				'priority' => 20,
			)
		) );

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'treville_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[link_color]', array(
				'label'    => _x( 'Links and Buttons', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[link_color]',
				'priority' => 30,
			)
		) );

		// Add Title Color setting.
		$wp_customize->add_setting( 'treville_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[title_color]', array(
				'label'    => _x( 'Post Titles', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[title_color]',
				'priority' => 40,
			)
		) );

		// Add Border Color setting.
		$wp_customize->add_setting( 'treville_theme_options[border_color]', array(
			'default'           => $default_options['border_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[border_color]', array(
				'label'    => _x( 'Borders', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[border_color]',
				'priority' => 50,
			)
		) );

		// Add Widget Title Color setting.
		$wp_customize->add_setting( 'treville_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[widget_title_color]', array(
				'label'    => _x( 'Widget Titles', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[widget_title_color]',
				'priority' => 60,
			)
		) );

		// Add Footer Widget Color setting.
		$wp_customize->add_setting( 'treville_theme_options[footer_widgets_color]', array(
			'default'           => $default_options['footer_widgets_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[footer_widgets_color]', array(
				'label'    => _x( 'Footer Widgets', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[footer_widgets_color]',
				'priority' => 70,
			)
		) );

		// Add Footer Color setting.
		$wp_customize->add_setting( 'treville_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'treville_theme_options[footer_color]', array(
				'label'    => _x( 'Footer', 'color setting', 'treville-pro' ),
				'section'  => 'treville_pro_section_colors',
				'settings' => 'treville_theme_options[footer_color]',
				'priority' => 80,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Treville_Pro_Custom_Colors', 'setup' ) );
