/**
 * Customizer JS
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Treville Pro
 */

( function( $ ) {

	/* Author Bio checkbox */
	wp.customize( 'treville_theme_options[author_bio]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.single-post .type-post .entry-author' );
			} else {
				showElement( '.single-post .type-post .entry-author' );
			}
		} );
	} );

	/* Link & Button Color Option */
	wp.customize( 'treville_theme_options[link_color]', function( value ) {
		value.bind( function( newval ) {

			$( '.entry-content a:link, .entry-content a:visited, .widget a:link, .widget a:visited, .post-navigation a:link, .post-navigation a:visited, .comments-area a:link, .comments-area a:visited, .breadcrumbs a:link, .breadcrumbs a:visited' )
				.not( $('.footer-widgets .widget a, .tzwb-tabbed-content .tzwb-tabnavi li a, .widget-magazine-posts a, .widget_tag_cloud .tagcloud a') )
				.css( 'color', newval );
			$( '.entry-content a, .post-navigation a, .comments-area a, .breadcrumbs a, .widget a' )
				.not( $('.footer-widgets .widget a, .tzwb-tabbed-content .tzwb-tabnavi li a, .widget-magazine-posts a, .widget_tag_cloud .tagcloud a') )
				.hover( function() { $( this ).css( 'color', '#454545' ); },
					function() { $( this ).css( 'color', newval ); }
				);
			$( '.post-slider-controls .zeeflex-direction-nav a' )
				.hover( function() { $( this ).css( 'color', newval ); },
					function() { $( this ).css( 'color', '#454545' ); }
				);

			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .entry-categories .meta-categories a, .pagination .current, .infinite-scroll #infinite-handle span, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab, .tzwb-social-icons .social-icons-menu li a' )
				.not( $('.header-search .search-form .search-submit') )
				.css( 'color', '#ffffff' )
				.css( 'background', newval );
			$( 'button, input[type="button"], input[type="reset"], input[type="submit"], .more-link, .entry-categories .meta-categories a, .infinite-scroll #infinite-handle span, .tzwb-social-icons .social-icons-menu li a' )
				.not( $('.header-search .search-form .search-submit') )
				.hover( function() { $( this ).css( 'background', '#454545' ).css( 'color', '#ffffff' ); },
					function() { $( this ).css( 'background', newval ).css( 'color', '#ffffff' ); }
				);

			$( '.widget_tag_cloud .tagcloud a, .entry-tags .meta-tags a, .pagination a, .infinite-scroll #infinite-handle span, .tzwb-tabbed-content .tzwb-tabnavi li a' )
				.hover( function() { $( this ).css( 'background', newval ); },
					function() { $( this ).css( 'background', '#454545' ); }
				);

			$( '.has-primary-color' ).css( 'color', newval );
			$( '.has-primary-background-color' ).css( 'background-color', newval );
		} );
	} );

	/* Header Color Option */
	wp.customize( 'treville_theme_options[header_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header, .top-navigation ul ul' )
				.css( 'background', newval );

			var textcolor, hovercolor, bordercolor;

			if( isColorLight( newval ) ) {
				textcolor = '#454545';
				hovercolor = 'rgba(0,0,0,0.5)';
				bordercolor = 'rgba(0,0,0,0.2)';
			} else {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
				bordercolor = 'rgba(255,255,255,0.1)';
			}

			$( '.site-title, .site-title a, .site-description, .top-navigation ul a, .mobile-menu-toggle, .header-social-icons .social-icons-menu li a' )
				.css( 'color', textcolor );
			$( '.site-title, .site-title a, .top-navigation ul a, .mobile-menu-toggle, .header-social-icons .social-icons-menu li a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
			$( '.mobile-menu-toggle .icon, .top-navigation .dropdown-toggle .icon, .top-navigation ul .menu-item-has-children > a > .icon' )
				.css( 'fill', textcolor );
			$( '.mobile-menu-toggle, .top-navigation .dropdown-toggle, .top-navigation ul .menu-item-has-children > a' )
				.hover( function() { $( this ).find('.icon').css( 'fill', hovercolor ); },
						function() { $( this ).find('.icon').css( 'fill', textcolor ); }
				);
			$( '.site-description, .secondary-navigation.toggled-on, .top-navigation ul, .top-navigation ul a, .top-navigation ul ul, .top-navigation ul ul a' )
				.css( 'border-color', bordercolor );
		} );
	} );

	/* Main Navigation Color Option */
	wp.customize( 'treville_theme_options[navi_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.primary-navigation-wrap, .main-navigation ul ul, .header-search, .header-search .search-form .search-field, .header-search .search-form .search-submit' )
				.css( 'background', newval );

			var textcolor, hovercolor, bordercolor;

			if( isColorDark( newval ) ) {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
				bordercolor = 'rgba(255,255,255,0.1)';
			} else {
				textcolor = '#454545';
				hovercolor = 'rgba(0,0,0,0.5)';
				bordercolor = 'rgba(0,0,0,0.2);';
			}

			$( '.main-navigation ul a, .header-search .search-form .search-field, .header-search .search-form .search-submit .genericon-search' )
				.css( 'color', textcolor );
			$( '.main-navigation ul a, .header-search .search-form .search-submit .genericon-search' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
			
			$( '.main-navigation .dropdown-toggle .icon, .main-navigation ul .menu-item-has-children > a > .icon' )
				.css( 'fill', textcolor );
			$( '.main-navigation .dropdown-toggle, .main-navigation ul .menu-item-has-children > a' )
				.hover( function() { $( this ).find('.icon').css( 'fill', hovercolor ); },
						function() { $( this ).find('.icon').css( 'fill', textcolor ); }
				);
			$( '.main-navigation-wrap, .main-navigation ul, .main-navigation ul a, .main-navigation ul ul, .main-navigation ul ul a, .main-navigation ul ul li:last-child > a, .header-search .search-form .search-field, .primary-navigation-wrap.toggled-on .header-search' )
				.css( 'border-color', bordercolor );
		} );
	} );

	/* Title Color Option */
	wp.customize( 'treville_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {

			$( '.page-title, .entry-title, .entry-title a:link, .entry-title a:visited' )
				.css( 'color', newval );
			$( '.entry-title a' )
				.hover( function() { $( this ).css( 'color', '#454545' ); },
						function() { $( this ).css( 'color', newval ); }
				);

		} );
	} );

	/* Border Color Option */
	wp.customize( 'treville_theme_options[border_color]', function( value ) {
		value.bind( function( newval ) {

			$( '.widget, .widget-header, .widget-magazine-columns .magazine-column .magazine-column-content, .type-post, .type-page, .type-attachment, .comments-area, .comment-respond, .comments-header, .comment-reply-title, .page-header .archive-title' )
				.not( $('.footer-widgets .widget, .footer-widgets .widget-header, .widget-magazine-posts .type-post') )
				.css( 'box-shadow', 'inset 0 2px ' + newval );
			$( '.treville-magazine-columns-widget' )
				.css( 'box-shadow', 'none' );

		} );
	} );

	/* Widget Title Color Option */
	wp.customize( 'treville_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {

			$( '.widget-title, .widget-title a:link, .widget-title a:visited, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title' )
				.not( $('.footer-widgets .widget .widget-title, .footer-widgets .widget .widget-title a' ) )
				.css( 'color', newval );
			$( '.widget-title a' )
				.not( $('.footer-widgets .widget .widget-title, .footer-widgets .widget .widget-title a' ) )
				.hover( function() { $( this ).css( 'color', '#454545' ); },
						function() { $( this ).css( 'color', newval ); }
				);
		} );
	} );

	/* Footer Widgets Color Option */
	wp.customize( 'treville_theme_options[footer_widgets_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-widgets-background' )
				.css( 'background', newval );

			var textcolor, hovercolor, bgcolor, bordercolor;

			if( isColorLight( newval ) ) {
				textcolor = '#454545';
				hovercolor = 'rgba(0,0,0,0.5)';
				bgcolor = 'rgba(0,0,0,0.025)';
				bordercolor = 'rgba(0,0,0,0.05)';
			} else {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
				bgcolor = 'rgba(255,255,255,0.025)';
				bordercolor = 'rgba(255,255,255,0.05)';
			}

			$( '.footer-widgets .widget, .footer-widgets .widget-title, .footer-widgets .widget-title a, .footer-widgets .widget a' )
				.css( 'color', textcolor );
			$( '.footer-widgets .widget-title a, .footer-widgets .widget a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);

			$( '.footer-widgets .widget' )
				.css( 'border-color', bordercolor );

			$( '.footer-widgets .widget-title' )
				.css( 'background', bgcolor )
				.css( 'border-color', bgcolor );

		} );
	} );

	/* Footer Color Option */
	wp.customize( 'treville_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			$( '.footer-wrap' )
				.css( 'background', newval );

			var textcolor, hovercolor;

			if( isColorLight( newval ) ) {
				textcolor = '#454545';
				hovercolor = 'rgba(0,0,0,0.5)';
			} else {
				textcolor = '#ffffff';
				hovercolor = 'rgba(255,255,255,0.5)';
			}

			$( '.site-footer, .site-footer .site-info, .site-footer .site-info a, .footer-navigation-menu a' )
				.css( 'color', textcolor );
			$( '.site-footer .site-info a, .footer-navigation-menu a' )
				.hover( function() { $( this ).css( 'color', hovercolor ); },
						function() { $( this ).css( 'color', textcolor ); }
				);
		} );
	} );

	/* Theme Fonts */
	wp.customize( 'treville_theme_options[text_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='treville-pro-custom-text-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#treville-pro-custom-text-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#treville-pro-custom-text-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( 'body, button, input, select, textarea' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'treville_theme_options[title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='treville-pro-custom-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#treville-pro-custom-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#treville-pro-custom-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.site-title, .page-title, .entry-title, .entry-meta' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'treville_theme_options[navi_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='treville-pro-custom-navi-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#treville-pro-custom-navi-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#treville-pro-custom-navi-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.top-navigation ul a, .main-navigation ul a' )
				.css( 'font-family', newFont );

		} );
	} );

	wp.customize( 'treville_theme_options[widget_title_font]', function( value ) {
		value.bind( function( newval ) {

			// Embed Font.
			var fontFamilyUrl = newval.split( " " ).join( "+" );
			var googleFontPath = "https://fonts.googleapis.com/css?family=" + fontFamilyUrl + ":400,700";
			var googleFontSource = "<link id='treville-pro-custom-widget-title-font' href='" + googleFontPath + "' rel='stylesheet' type='text/css'>";
			var checkLink = $( "head" ).find( "#treville-pro-custom-widget-title-font" ).length;

			if (checkLink > 0) {
				$( "head" ).find( "#treville-pro-custom-widget-title-font" ).remove();
			}
			$( "head" ).append( googleFontSource );

			// Set Font.
			var systemFont = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif';
			var newFont = newval === 'SystemFontStack' ? systemFont : newval;

			// Set CSS.
			$( '.widget-title, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title' )
				.css( 'font-family', newFont );

		} );
	} );

	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden'
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible'
		});
	}

	function hexdec( hexString ) {
		hexString = ( hexString + '' ).replace( /[^a-f0-9]/gi, '' );
		return parseInt( hexString, 16 );
	}

	function getColorBrightness( hexColor ) {

		// Remove # string.
		hexColor = hexColor.replace( '#', '' );

		// Convert into RGB.
		var r = hexdec( hexColor.substring( 0, 2 ) );
		var g = hexdec( hexColor.substring( 2, 4 ) );
		var b = hexdec( hexColor.substring( 4, 6 ) );

		return ( ( ( r * 299 ) + ( g * 587 ) + ( b * 114 ) ) / 1000 );
	}

	function isColorLight( hexColor ) {
		return ( getColorBrightness( hexColor ) > 130 );
	}

	function isColorDark( hexColor ) {
		return ( getColorBrightness( hexColor ) <= 130 );
	}

} )( jQuery );
