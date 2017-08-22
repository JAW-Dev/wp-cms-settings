/**
 * Media Upload
 */
window.mediaUploader = {};
( function( window, app ) {

	app.init = function() {
		app.cache();
		app.chooseImage();
		app.deleteImage();
	};

	app.cache = function() {
		app.$c = {
			uploadButton: document.getElementById( 'upload-button' ),
			removeButton: document.getElementById( 'remove-button' ),
			attachmentMediaView: document.getElementById( 'attachment-media-view' ),
			browserPreview: document.getElementById( 'browser-preview' ),
			appIconPreview: document.getElementById( 'app-icon-preview' ),
			siteIcon: document.getElementById( 'site_icon' ),
		};
	};

	app.chooseImage = function() {
		var mediaUploader;

		app.$c.uploadButton.addEventListener( 'click', function( e ) {

			var mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Select',
				},
				library: {
					type: 'image',
				},
				multiple: false,
			});

			e.preventDefault();

			if ( mediaUploader ) {
				mediaUploader.open();
				return;
			}

			// When a file is selected, grab the URL and set it as the text field's value
			mediaUploader.on( 'select', function() {
				var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
				app.$c.siteIcon.value = attachment.id;
				app.$c.attachmentMediaView.classList.remove( 'no-show-preview' );
				app.$c.browserPreview.setAttribute( 'src', attachment.url );
				app.$c.appIconPreview.setAttribute( 'src', attachment.url );
				app.$c.uploadButton.textContent = 'Change Image';
			});

			// Open the uploader dialog
			mediaUploader.open();
		});
	};

	app.deleteImage = function() {
		app.$c.removeButton.addEventListener( 'click', function() {
			var answer = confirm( 'Are you sure?' );
			if ( answer == true ) {
				app.$c.siteIcon.value = '0';
				app.$c.attachmentMediaView.classList.add( 'no-show-preview' );
				app.$c.uploadButton.textContent = 'Select Image';
			}
			return false;
		});
	};

	app.init();
}( window, window.mediaUploader ) );
