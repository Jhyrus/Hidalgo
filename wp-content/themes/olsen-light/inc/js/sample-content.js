jQuery( document ).ready( function( $ ) {
	$( '.olsen-light-sample-content-notice' ).on( 'click', '.notice-dismiss', function( e ) {
		$.ajax( {
			type: 'post',
			url: ajaxurl,
			data: {
				action: 'olsen_light_dismiss_sample_content',
				nonce: olsen_light_SampleContent.dismiss_nonce,
				dismissed: true
			},
			dataType: 'text',
			success: function( response ) {
				//console.log( response );
			}
		} );
	});
} );
