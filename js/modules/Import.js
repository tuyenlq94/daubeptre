export default function Import() {
	( function ( $ ) {

		const sendAjaxPromise = ( url, type, data ) => new Promise( ( resolve, reject ) => {
			$.ajax( {
				url: url,
				type: type,
				data: data,
				success: function ( result ) {
					resolve( result );
				},
				error: function ( error ) {
					reject( error );
				}
			} );
		} );
		$( '#import-data' ).on( 'change', function ( e ) {
			let input = $( this );

			readXlsxFile( input[ 0 ].files[ 0 ], { dateFormat: 'MM/DD/YY' } ).then( function ( data ) {

				data = data.slice( 1 );
				displayTable( data );
			}, function ( error ) {
				console.error( error );
				alert( "Error while parsing Excel file. See console output for the error stack trace." );
			} );
		} );
		async function displayTable( results ) {
			if ( typeof results == 'object' ) {
				results = Object.values( results );
			}

			if ( Array.isArray( results ) ) {
				for ( let i = 0; i < results.length; i++ ) {

					let $row = results[ i ],
						$loading = $( '.import-wrap-btn' );

					try {
						$loading.addClass( 'loading' );
						const result = await sendAjaxPromise( mona_ajax_url.ajaxURL, 'post', {
							action: 'm_a_import_quiz',
							row: $row
						} );
						$loading.removeClass( 'loading' );
						let html = '',
							$result = JSON.parse( result );

						html = `<li><p>${ $result.mess }</p></li>`;
						$( '.list-response ul' ).append( html );

					} catch ( error ) {
						$loading.removeClass( 'loading' );
						console.log( 'mona_ajax_call_mfa error:', error );
					}
				}
			}

		}

	} )( jQuery );
}