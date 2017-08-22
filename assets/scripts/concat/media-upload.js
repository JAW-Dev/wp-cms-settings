/**
 * Media Upload
 */
 jQuery(document).ready(function($){
	 
	var mediaUploader;
	var uploadButton        = $('#upload-button');
	var removeButton        = $('#remove-button');
	var attachmentMediaView = $('#attachment-media-view');
	var browserPreview      = $('#browser-preview');
	var appIconPreview      = $('#app-icon-preview');
	var siteIcon            = $('#site_icon');

	uploadButton.click(function(e) {
		e.preventDefault();
		
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		
		var mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Select'
			},
			library: {
				type: 'image'
			},
			multiple: false
		});
		

		// When a file is selected, grab the URL and set it as the text field's value
		mediaUploader.on('select', function() {
		  var attachment = mediaUploader.state().get('selection').first().toJSON();
		  siteIcon.val(attachment.id);
		  attachmentMediaView.removeClass('no-show-preview');
		  browserPreview.attr('src', attachment.url);
		  appIconPreview.attr('src', attachment.url);
		  uploadButton.text('Change Image');
		});
		// Open the uploader dialog
		mediaUploader.open();
	});
	
	removeButton.click(function() {
		var answer = confirm('Are you sure?');
		if (answer == true) {
			siteIcon.val('0');
			attachmentMediaView.addClass('no-show-preview');
			uploadButton.text('Select Image');
		}
		return false;
	});

});
