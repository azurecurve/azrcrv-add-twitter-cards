/*
 * Adapted from: http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
 */
jQuery( document ).ready(
	function($){
		// remove standard avatar display
		// jQuery('table.form-table tr.user-profile-picture').remove();

		// Uploading files
		var file_frame;

		$( '#azrcrv-atc-upload-image' ).on(
			'click',
			function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media(
					{
						title: $( this ).data( 'uploader_title' ),
						button: {
							text: $( this ).data( 'uploader_button_text' ),
						},
						multiple: false  // Set to true to allow multiple files to be selected
					}
				);

				// When an image is selected, run a callback.
				file_frame.on(
					'select',
					function() {
						// We set multiple to false so only get one image from the uploader
						attachment = file_frame.state().get( 'selection' ).first().toJSON();

						// Do something with attachment.id and/or attachment.url here
						jQuery( '#azrcrv-atc-fallback-image' ).attr( 'src',attachment.url );
						jQuery( '#fallback_image' ).attr( 'value',attachment.url );
					}
				);

				// Finally, open the modal
				file_frame.open();
			}
		);
		$( '#azrcrv-atc-remove-image' ).on(
			'click',
			function( event ){

				// remove image and url
				jQuery( '#azrcrv-atc-fallback-image' ).attr( 'src','' );
				jQuery( '#fallback_image' ).attr( 'value','' );

			}
		);
	}
);
