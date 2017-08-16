/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	
	var api = parent.wp.customize;
	var allColor = Array('font_color', 'link_color', 'menu_background', 'menu_link', 'menu_link_hover', 'menu_border_color', 'border_color', 'meta_color', 'secondary_menu_color', 'secondary_menu_color_hover', 'content_background_color', 'content_font_color', 'content_link_color', 'content_meta_color', 'content_section_title_background_color', 'content_section_title_color', 'content_border_color', 'widget_title_color');

	//alert(api.instance('upright_option[menu_link_hover]').get());
	
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	wp.customize( 'upright_option[footer_credit]', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).html( to );
		} );
	} );

	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			writeCSS();
			//$('#extra-color').text( $('#extra-color').text() + '.widget_posts article a.home-thumb:after{background-color:'+to+'}' );
		} );
	} );
	
	function customColorProperty(selector, property, key){
		return selector + '{ ' + property + ':' + api.instance('upright_option[' + key + ']').get() + '; }';
	}
	
	function writeCSS(){
		cssOutput = '';
		cssOutput += customColorProperty('body, .no-heading-style, #secondary .entry-title a, .popular-posts article .home-thumb:after, #secondary input[type=text], #secondary input[type=email], #secondary input[type=password], #secondary textarea', 'color', 'font_color');
		cssOutput += customColorProperty('a, .tabs ul.nav-tab li.tab-active a:before, #secondary .entry-title a:hover, .popular-posts article .home-thumb:hover:after', 'color', 'link_color');
		cssOutput += customColorProperty('.main-navigation, .main-navigation ul ul', 'background-color', 'menu_background');
		cssOutput += customColorProperty('.main-navigation div ul li a, .main-navigation #searchform #s, .main-navigation #searchform:after, .menu-toggle [class^="inline-icon-"]', 'color', 'menu_link');
		cssOutput += customColorProperty('.main-navigation div ul li > a:hover, .main-navigation > div > ul > li.current-menu-item a', 'color', 'menu_link_hover');
		//cssOutput += customColorProperty('.widget_posts article a.home-thumb:after', 'color', 'background_color'); 
		cssOutput += customColorProperty('.main-navigation div > ul ul li a', 'border-bottom-color', 'menu_border_color');
		cssOutput += customColorProperty('.main-navigation > div > ul, .main-navigation #searchform, .menu-toggle a', 'border-left-color', 'menu_border_color');
		cssOutput += customColorProperty('.main-navigation > div > ul, .main-navigation #searchform', 'border-right-color', 'menu_border_color');
		cssOutput += customColorProperty('.main-small-navigation ul li a', 'border-top-color', 'menu_border_color');
		cssOutput += customColorProperty('.secondary-navigation > div > ul > li a, .tabs ul.nav-tab li.second_tab, .tabs ul.nav-tab li.third_tab', 'border-left-color', 'border_color');
		cssOutput += customColorProperty('.widget ul li, .tabs ul.nav-tab li a, .widget_posts article, .widget-title, .secondary-navigation > div > ul ul a', 'border-bottom-color', 'border_color');
		cssOutput += customColorProperty('#secondary input[type=text], #secondary input[type=email], #secondary input[type=password], #secondary textarea', 'border-color', 'border_color');
		cssOutput += customColorProperty('#twitter_account, .tabs ul.nav-tab li a, #secondary, .secondary-navigation, .secondary-navigation > div, .site-info, .site-footer', 'border-top-color', 'border_color');
		cssOutput += customColorProperty('.entry-meta, .entry-meta .comments-link a, .widget_twitter li > a, .tabs ul.nav-tab li a, .widget_nav_menu [class^="icon-"] a:before', 'color', 'meta_color');
		cssOutput += customColorProperty('.widget-title', 'color', 'widget_title_color');
		cssOutput += customColorProperty('.secondary-navigation  a', 'color', 'secondary_menu_color');
		cssOutput += customColorProperty('.secondary-navigation a:hover', 'color', 'secondary_menu_color_hover');
		cssOutput += customColorProperty('#primary', 'background-color', 'content_background_color');
		cssOutput += customColorProperty('.layout-toggle .layout-grid, #carousel-slider .flex-direction-nav a', 'border-right-color', 'content_background_color');
		cssOutput += customColorProperty('#primary, #primary .entry-title a, #primary input[type=text], #primary input[type=email], #primary input[type=password], #primary textarea', 'color', 'content_font_color');
		cssOutput += customColorProperty('#primary a, #primary .entry-title a:hover', 'color', 'content_link_color');
		cssOutput += customColorProperty('#primary button, #primary input[type="button"], #primary input[type="reset"], #primary input[type="submit"]', 'color', 'content_background_color');
		cssOutput += customColorProperty('#primary button, #primary input[type="button"], #primary input[type="reset"], #primary input[type="submit"]', 'background-color', 'content_link_color');
		cssOutput += customColorProperty('#primary button:hover, #primary input[type="button"]:hover, #primary input[type="reset"]:hover, #primary input[type="submit"]:hover', 'background-color', 'content_font_color');
		cssOutput += customColorProperty('#primary .entry-meta, #primary .entry-meta-single, #primary .post-tags, .hentry footer .inline-icon-user, #primary #breadcrumbs, #primary .entry-meta .comments-link a, #comments .commentlist li .comment-meta a, #respond .required-attr', 'color', 'content_meta_color');
		cssOutput += customColorProperty('.section-title, #reply-title, .section-title:after, #reply-title:after, #carousel-slider .flex-direction-nav a', 'background-color', 'content_section_title_background_color');
		cssOutput += customColorProperty('.section-title, #reply-title, .section-title:after, #primary .section-title a, #reply-title:after, #carousel-slider .flex-direction-nav a', 'color', 'content_section_title_color');
		cssOutput += customColorProperty('.layout-toggle a:before', 'color', 'content_section_title_color');
		cssOutput += customColorProperty('#primary #breadcrumbs, #comments .commentlist li article.comment, .single .post .related-box ul li', 'border-bottom-color', 'content_border_color');
		cssOutput += customColorProperty('.hentry:before, .single .post > footer, .page-navigation, #comments .commentlist li article.comment ', 'border-top-color', 'content_border_color');
		cssOutput += customColorProperty('.hentry blockquote', 'border-left-color', 'content_border_color');
		cssOutput += customColorProperty('#primary input[type=text], #primary input[type=email], #primary input[type=password], #primary textarea, .wp-caption, pre', 'border-color', 'content_border_color');
		cssOutput += '.widget_posts article a.home-thumb:after, .secondary-navigation ul ul{background-color:'+ api.instance('background_color').get() +';}';
		$('#extra-color').text(cssOutput);
	}
	//writeCSS();
	for( i=0; i<allColor.length; i++){
		wp.customize( 'upright_option['+allColor[i]+']', function( value ) {
			value.bind( function( to ) {
				writeCSS();
			} );
		} );
	}

} )( jQuery );