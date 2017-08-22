/**
 * Media Upload
 *
 * @author Jason Witt
 * @since 0.0.1
 */
window.siteIcon = {};
( function( window, app ) {

	/**
	 * Initlize.
	 *
	 * @author Jason Witt
	 * @since 0.0.1
	 *
	 * @return void
	 */
	app.init = function() {
		app.cache();
		app.chooseImage();
		app.removeImage();
	};

	/**
	 * Cache the DOM elements.
	 *
	 * @author Jason Witt
	 * @since 0.0.1
	 *
	 * @return void
	 */
	app.cache = function() {
		app.$c = {
			uploadButton: document.getElementById( 'upload-button' ),
			removeButton: document.getElementById( 'remove-button' ),
			attachmentMediaView: document.getElementById( 'attachment-media-view' ),
			browserPreview: document.getElementById( 'browser-preview' ),
			appIconPreview: document.getElementById( 'app-icon-preview' ),
			siteIcon: document.getElementById( 'site_icon' ),
			mediaUploader: false,
		};
	};

	/**
	 * Choose Image.
	 *
	 * @author Jason Witt
	 * @since 0.0.1
	 *
	 * @return void
	 */
	app.chooseImage = function() {

		app.$c.uploadButton.addEventListener( 'click', function( e ) {

			e.preventDefault();

			// If media uploader exists, reopen it.
			if ( app.$c.mediaUploader ) {
				app.$c.mediaUploader.open();
				return;
			}

			// Create the media uploader frame.
			app.$c.mediaUploader = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Select',
				},
				library: {
					type: 'image',
				},
				multiple: false,
			});

			app.onSelect();

			// Open the uploader dialog
			app.$c.mediaUploader.open();
		});
	};

	/**
	 * Select Image.
	 *
	 * @author Jason Witt
	 * @since 0.0.1
	 *
	 * @return void
	 */
	app.onSelect = function() {

		// When a image is selected.
		app.$c.mediaUploader.on( 'select', function() {

			// Get the attachment details.
			var attachment = app.$c.mediaUploader.state().get( 'selection' ).first().toJSON();

			// Set the value on the site_icon field.
			app.$c.siteIcon.value = attachment.id;

			// Remove the 'no-show-preview' class if present.
			app.$c.attachmentMediaView.classList.remove( 'no-show-preview' );

			// Set the URL to the image src attributes.
			app.$c.browserPreview.setAttribute( 'src', attachment.url );
			app.$c.appIconPreview.setAttribute( 'src', attachment.url );

			// Change the button text.
			app.$c.uploadButton.textContent = 'Change Image';
		});
	};

	/**
	 * Remove Image.
	 *
	 * @author Jason Witt
	 * @since 0.0.1
	 *
	 * @return void
	 */
	app.removeImage = function() {
		app.$c.removeButton.addEventListener( 'click', function() {

			// Set the conformation modal.
			var answer = confirm( 'Are you sure?' );

			// If confirmed.
			if ( answer == true ) {

				// Set the site_icon field to 0.
				app.$c.siteIcon.value = '0';

				// Add the 'no-show-preview' class.
				app.$c.attachmentMediaView.classList.add( 'no-show-preview' );

				// Change the button text.
				app.$c.uploadButton.textContent = 'Select Image';
			}
			return false;
		});
	};

	/**
	 * Run the script.
	 *
	 * @author Jason Witt
	 * @since 0.0.1
	 *
	 * @return void
	 */
	app.init();
}( window, window.siteIcon ) );
