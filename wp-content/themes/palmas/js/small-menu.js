/**
 * Handles toggling the main navigation menu for small screens.
 */
jQuery( document ).ready( function( $ ) {
	var $masthead = $( '#masthead' ),
	    timeout = false;

	$.fn.smallMenu = function() {
		$masthead.find( '.site-navigation' ).addClass( 'main-small-navigation' );
		$masthead.find( '.site-navigation div.assistive-text' ).addClass( 'menu-toggle' ).removeClass('assistive-text');
		$masthead.find( '.site-navigation .menu-toggle a > span' ).addClass( 'inline-icon-list' );

		$( '.menu-btn' ).unbind( 'click' ).click( function() {
			$masthead.find( '.site-navigation .menu' ).slideToggle();
			$( this ).toggleClass( 'toggled-on' );
			return false;
		} );
	};

	// Check viewport width on first load.
	if ( $( window ).width() < 720 )
		$.fn.smallMenu();

	// Check viewport width when user resizes the browser window.
	$( window ).resize( function() {
		var browserWidth = $( window ).width();

		if ( false !== timeout )
			clearTimeout( timeout );

		timeout = setTimeout( function() {
			if ( browserWidth < 720 ) {
				$.fn.smallMenu();
			} else {
				$masthead.find( '.site-navigation' ).removeClass( 'main-small-navigation' ).addClass( 'site-navigation' );
				$masthead.find( '.site-navigation .menu-toggle a > span' ).removeClass( 'icon-list' );
				$masthead.find( '.site-navigation .menu-toggle' ).addClass( 'assistive-text' ).removeClass( 'menu-toggle' );
				$masthead.find( '.menu' ).removeAttr( 'style' );
			}
		}, 200 );
	} );
} );