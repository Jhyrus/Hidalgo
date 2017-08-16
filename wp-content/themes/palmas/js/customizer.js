/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	var api = parent.wp.customize;

	// Site title and description.
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
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	function writeCSS(){
		cssOutput = '';
		before = '';
		after = '';
		for ( i = 0; i < _customizerCSS.length ; i++ ){
			if ( api.instance( _customizerCSS[i].id ).get() && ( api.instance( _customizerCSS[i].id ).get() !== _customizerCSS[i].default ) ) {
				if ( _customizerCSS[i].mq !== 'global' ) {
					before = _customizerCSS[i].mq + ' { ';
					after = '}';
				}else{
					before = '';
					after = '';
				}
				cssOutput += before;
				if ( _customizerCSS[i].value_in_text == '' ){
					cssOutput += _customizerCSS[i].selector + '{' + _customizerCSS[i].property + ' : ' + api.instance( _customizerCSS[i].id ).get() + _customizerCSS[i].unit + '; }';
				}else{
					str = _customizerCSS[i].value_in_text;
					val = str.replace('%value%', api.instance( _customizerCSS[i].id ).get() );
					cssOutput += _customizerCSS[i].selector + '{' + _customizerCSS[i].property + ' : ' + val + '; }';
				}
				cssOutput += after;
			}
		}

		$('#apply-customizer-css').text(cssOutput);
	}

	for ( i = 0; i < _customizerCSS.length ; i++ ){
		wp.customize( _customizerCSS[i].id, function( value ) {
			value.bind( function( to ){
				writeCSS();
			} );
		});
	}

} )( jQuery );
