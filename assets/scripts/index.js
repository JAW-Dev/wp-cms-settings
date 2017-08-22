'use strict';

/**
 * Media Upload
 */
window.mediaUploader = {};
(function (window, app) {

	app.init = function () {
		app.cache();
		app.chooseImage();
		app.deleteImage();
	};

	app.cache = function () {
		app.$c = {
			uploadButton: document.getElementById('upload-button'),
			removeButton: document.getElementById('remove-button'),
			attachmentMediaView: document.getElementById('attachment-media-view'),
			browserPreview: document.getElementById('browser-preview'),
			appIconPreview: document.getElementById('app-icon-preview'),
			siteIcon: document.getElementById('site_icon')
		};
	};

	app.chooseImage = function () {
		var mediaUploader;

		app.$c.uploadButton.addEventListener('click', function (e) {
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
			mediaUploader.on('select', function () {
				var attachment = mediaUploader.state().get('selection').first().toJSON();
				app.$c.siteIcon.value = attachment.id;
				app.$c.attachmentMediaView.classList.remove('no-show-preview');
				app.$c.browserPreview.setAttribute('src', attachment.url);
				app.$c.appIconPreview.setAttribute('src', attachment.url);
				app.$c.uploadButton.textContent = 'Change Image';
			});
			// Open the uploader dialog
			mediaUploader.open();
		});
	};

	app.deleteImage = function () {
		app.$c.removeButton.addEventListener('click', function () {
			var answer = confirm('Are you sure?');
			if (answer == true) {
				app.$c.siteIcon.value = '0';
				app.$c.attachmentMediaView.classList.add('no-show-preview');
				app.$c.uploadButton.textContent = 'Select Image';
			}
			return false;
		});
	};

	app.init();
})(window, window.mediaUploader);

// jQuery(document).ready(function($){
//
// var mediaUploader;
// var uploadButton        = $('#upload-button');
// var removeButton        = $('#remove-button');
// var attachmentMediaView = $('#attachment-media-view');
// var browserPreview      = $('#browser-preview');
// var appIconPreview      = $('#app-icon-preview');
// var siteIcon            = $('#site_icon');
//
// uploadButton.click(function(e) {
// 	e.preventDefault();
//
// 	if (mediaUploader) {
// 		mediaUploader.open();
// 		return;
// 	}
//
// 	var mediaUploader = wp.media.frames.file_frame = wp.media({
// 		title: 'Choose Image',
// 		button: {
// 			text: 'Select'
// 		},
// 		library: {
// 			type: 'image'
// 		},
// 		multiple: false
// 	});
//
//
// 	// When a file is selected, grab the URL and set it as the text field's value
// 	mediaUploader.on('select', function() {
// 	  var attachment = mediaUploader.state().get('selection').first().toJSON();
// 	  siteIcon.val(attachment.id);
// 	  attachmentMediaView.removeClass('no-show-preview');
// 	  browserPreview.attr('src', attachment.url);
// 	  appIconPreview.attr('src', attachment.url);
// 	  uploadButton.text('Change Image');
// 	});
// 	// Open the uploader dialog
// 	mediaUploader.open();
// });
//
// removeButton.click(function() {
// 	var answer = confirm('Are you sure?');
// 	if (answer == true) {
// 		siteIcon.val('0');
// 		attachmentMediaView.addClass('no-show-preview');
// 		uploadButton.text('Select Image');
// 	}
// 	return false;
// });
//
// });
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1lZGlhLXVwbG9hZC5qcyJdLCJuYW1lcyI6WyJ3aW5kb3ciLCJtZWRpYVVwbG9hZGVyIiwiYXBwIiwiaW5pdCIsImNhY2hlIiwiY2hvb3NlSW1hZ2UiLCJkZWxldGVJbWFnZSIsIiRjIiwidXBsb2FkQnV0dG9uIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInJlbW92ZUJ1dHRvbiIsImF0dGFjaG1lbnRNZWRpYVZpZXciLCJicm93c2VyUHJldmlldyIsImFwcEljb25QcmV2aWV3Iiwic2l0ZUljb24iLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInByZXZlbnREZWZhdWx0Iiwib3BlbiIsIndwIiwibWVkaWEiLCJmcmFtZXMiLCJmaWxlX2ZyYW1lIiwidGl0bGUiLCJidXR0b24iLCJ0ZXh0IiwibGlicmFyeSIsInR5cGUiLCJtdWx0aXBsZSIsIm9uIiwiYXR0YWNobWVudCIsInN0YXRlIiwiZ2V0IiwiZmlyc3QiLCJ0b0pTT04iLCJ2YWx1ZSIsImlkIiwiY2xhc3NMaXN0IiwicmVtb3ZlIiwic2V0QXR0cmlidXRlIiwidXJsIiwidGV4dENvbnRlbnQiLCJhbnN3ZXIiLCJjb25maXJtIiwiYWRkIl0sIm1hcHBpbmdzIjoiOztBQUFBOzs7QUFHQUEsT0FBT0MsYUFBUCxHQUF1QixFQUF2QjtBQUNBLENBQUUsVUFBVUQsTUFBVixFQUFrQkUsR0FBbEIsRUFBd0I7O0FBRXpCQSxLQUFJQyxJQUFKLEdBQVcsWUFBVztBQUNyQkQsTUFBSUUsS0FBSjtBQUNBRixNQUFJRyxXQUFKO0FBQ0FILE1BQUlJLFdBQUo7QUFDQSxFQUpEOztBQU1BSixLQUFJRSxLQUFKLEdBQVksWUFBVztBQUN0QkYsTUFBSUssRUFBSixHQUFTO0FBQ1JDLGlCQUFlQyxTQUFTQyxjQUFULENBQXdCLGVBQXhCLENBRFA7QUFFUkMsaUJBQWVGLFNBQVNDLGNBQVQsQ0FBd0IsZUFBeEIsQ0FGUDtBQUdSRSx3QkFBc0JILFNBQVNDLGNBQVQsQ0FBd0IsdUJBQXhCLENBSGQ7QUFJUkcsbUJB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IjpbIi8qKlxuICogTWVkaWEgVXBsb2FkXG4gKi9cbndpbmRvdy5tZWRpYVVwbG9hZGVyID0ge307XG4oIGZ1bmN0aW9uKCB3aW5kb3csIGFwcCApIHtcblx0XG5cdGFwcC5pbml0ID0gZnVuY3Rpb24oKSB7XG5cdFx0YXBwLmNhY2hlKCk7XG5cdFx0YXBwLmNob29zZUltYWdlKCk7XG5cdFx0YXBwLmRlbGV0ZUltYWdlKCk7XG5cdH07XG5cdFxuXHRhcHAuY2FjaGUgPSBmdW5jdGlvbigpIHtcblx0XHRhcHAuJGMgPSB7XG5cdFx0XHR1cGxvYWRCdXR0b24gOiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndXBsb2FkLWJ1dHRvbicpLFxuXHRcdFx0cmVtb3ZlQnV0dG9uIDogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3JlbW92ZS1idXR0b24nKSxcblx0XHRcdGF0dGFjaG1lbnRNZWRpYVZpZXcgOiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYXR0YWNobWVudC1tZWRpYS12aWV3JyksXG5cdFx0XHRicm93c2VyUHJldmlldyAgOiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYnJvd3Nlci1wcmV2aWV3JyksXG5cdFx0XHRhcHBJY29uUHJldmlldyA6IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdhcHAtaWNvbi1wcmV2aWV3JyksXG5cdFx0XHRzaXRlSWNvbiA6IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzaXRlX2ljb24nKVxuXHRcdH07XG5cdH07XG5cdFxuXHRhcHAuY2hvb3NlSW1hZ2UgPSBmdW5jdGlvbigpIHtcblx0XHR2YXIgbWVkaWFVcGxvYWRlcjtcblx0XHRcblx0XHRhcHAuJGMudXBsb2FkQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xuXHRcdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xuXHRcdFx0XG5cdFx0XHRpZiAobWVkaWFVcGxvYWRlcikge1xuXHRcdFx0XHRtZWRpYVVwbG9hZGVyLm9wZW4oKTtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXHRcdFx0XG5cdFx0XHR2YXIgbWVkaWFVcGxvYWRlciA9IHdwLm1lZGlhLmZyYW1lcy5maWxlX2ZyYW1lID0gd3AubWVkaWEoe1xuXHRcdFx0XHR0aXRsZTogJ0Nob29zZSBJbWFnZScsXG5cdFx0XHRcdGJ1dHRvbjoge1xuXHRcdFx0XHRcdHRleHQ6ICdTZWxlY3QnXG5cdFx0XHRcdH0sXG5cdFx0XHRcdGxpYnJhcnk6IHtcblx0XHRcdFx0XHR0eXBlOiAnaW1hZ2UnXG5cdFx0XHRcdH0sXG5cdFx0XHRcdG11bHRpcGxlOiBmYWxzZVxuXHRcdFx0fSk7XG5cdFx0XHRcblxuXHRcdFx0Ly8gV2hlbiBhIGZpbGUgaXMgc2VsZWN0ZWQsIGdyYWIgdGhlIFVSTCBhbmQgc2V0IGl0IGFzIHRoZSB0ZXh0IGZpZWxkJ3MgdmFsdWVcblx0XHRcdG1lZGlhVXBsb2FkZXIub24oJ3NlbGVjdCcsIGZ1bmN0aW9uKCkge1xuXHRcdFx0ICB2YXIgYXR0YWNobWVudCA9IG1lZGlhVXBsb2FkZXIuc3RhdGUoKS5nZXQoJ3NlbGVjdGlvbicpLmZpcnN0KCkudG9KU09OKCk7XG5cdFx0XHQgIGFwcC4kYy5zaXRlSWNvbi52YWx1ZSA9IGF0dGFjaG1lbnQuaWQ7XG5cdFx0XHQgIGFwcC4kYy5hdHRhY2htZW50TWVkaWFWaWV3LmNsYXNzTGlzdC5yZW1vdmUoJ25vLXNob3ctcHJldmlldycpO1xuXHRcdFx0ICBhcHAuJGMuYnJvd3NlclByZXZpZXcuc2V0QXR0cmlidXRlKCdzcmMnLCBhdHRhY2htZW50LnVybCk7XG5cdFx0XHQgIGFwcC4kYy5hcHBJY29uUHJldmlldy5zZXRBdHRyaWJ1dGUoJ3NyYycsIGF0dGFjaG1lbnQudXJsKTtcblx0XHRcdCAgYXBwLiRjLnVwbG9hZEJ1dHRvbi50ZXh0Q29udGVudCA9ICdDaGFuZ2UgSW1hZ2UnO1xuXHRcdFx0fSk7XG5cdFx0XHQvLyBPcGVuIHRoZSB1cGxvYWRlciBkaWFsb2dcblx0XHRcdG1lZGlhVXBsb2FkZXIub3BlbigpO1xuXHRcdH0pO1xuXHR9O1xuXHRcblx0YXBwLmRlbGV0ZUltYWdlID0gZnVuY3Rpb24oKSB7XG5cdFx0YXBwLiRjLnJlbW92ZUJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIGFuc3dlciA9IGNvbmZpcm0oJ0FyZSB5b3Ugc3VyZT8nKTtcblx0XHRcdGlmIChhbnN3ZXIgPT0gdHJ1ZSkge1xuXHRcdFx0XHRhcHAuJGMuc2l0ZUljb24udmFsdWUgPSAnMCc7XG5cdFx0XHRcdGFwcC4kYy5hdHRhY2htZW50TWVkaWFWaWV3LmNsYXNzTGlzdC5hZGQoJ25vLXNob3ctcHJldmlldycpO1xuXHRcdFx0XHRhcHAuJGMudXBsb2FkQnV0dG9uLnRleHRDb250ZW50ID0gJ1NlbGVjdCBJbWFnZSc7XG5cdFx0XHR9XG5cdFx0XHRyZXR1cm4gZmFsc2U7XG5cdFx0fSlcblx0fTtcblx0XG5cdGFwcC5pbml0KCk7XG5cdFxuXHRcbn0pKCB3aW5kb3csIHdpbmRvdy5tZWRpYVVwbG9hZGVyICk7XG5cbi8vIGpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oJCl7XG4vL1xuLy8gdmFyIG1lZGlhVXBsb2FkZXI7XG4vLyB2YXIgdXBsb2FkQnV0dG9uICAgICAgICA9ICQoJyN1cGxvYWQtYnV0dG9uJyk7XG4vLyB2YXIgcmVtb3ZlQnV0dG9uICAgICAgICA9ICQoJyNyZW1vdmUtYnV0dG9uJyk7XG4vLyB2YXIgYXR0YWNobWVudE1lZGlhVmlldyA9ICQoJyNhdHRhY2htZW50LW1lZGlhLXZpZXcnKTtcbi8vIHZhciBicm93c2VyUHJldmlldyAgICAgID0gJCgnI2Jyb3dzZXItcHJldmlldycpO1xuLy8gdmFyIGFwcEljb25QcmV2aWV3ICAgICAgPSAkKCcjYXBwLWljb24tcHJldmlldycpO1xuLy8gdmFyIHNpdGVJY29uICAgICAgICAgICAgPSAkKCcjc2l0ZV9pY29uJyk7XG4vL1xuLy8gdXBsb2FkQnV0dG9uLmNsaWNrKGZ1bmN0aW9uKGUpIHtcbi8vIFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xuLy9cbi8vIFx0aWYgKG1lZGlhVXBsb2FkZXIpIHtcbi8vIFx0XHRtZWRpYVVwbG9hZGVyLm9wZW4oKTtcbi8vIFx0XHRyZXR1cm47XG4vLyBcdH1cbi8vXG4vLyBcdHZhciBtZWRpYVVwbG9hZGVyID0gd3AubWVkaWEuZnJhbWVzLmZpbGVfZnJhbWUgPSB3cC5tZWRpYSh7XG4vLyBcdFx0dGl0bGU6ICdDaG9vc2UgSW1hZ2UnLFxuLy8gXHRcdGJ1dHRvbjoge1xuLy8gXHRcdFx0dGV4dDogJ1NlbGVjdCdcbi8vIFx0XHR9LFxuLy8gXHRcdGxpYnJhcnk6IHtcbi8vIFx0XHRcdHR5cGU6ICdpbWFnZSdcbi8vIFx0XHR9LFxuLy8gXHRcdG11bHRpcGxlOiBmYWxzZVxuLy8gXHR9KTtcbi8vXG4vL1xuLy8gXHQvLyBXaGVuIGEgZmlsZSBpcyBzZWxlY3RlZCwgZ3JhYiB0aGUgVVJMIGFuZCBzZXQgaXQgYXMgdGhlIHRleHQgZmllbGQncyB2YWx1ZVxuLy8gXHRtZWRpYVVwbG9hZGVyLm9uKCdzZWxlY3QnLCBmdW5jdGlvbigpIHtcbi8vIFx0ICB2YXIgYXR0YWNobWVudCA9IG1lZGlhVXBsb2FkZXIuc3RhdGUoKS5nZXQoJ3NlbGVjdGlvbicpLmZpcnN0KCkudG9KU09OKCk7XG4vLyBcdCAgc2l0ZUljb24udmFsKGF0dGFjaG1lbnQuaWQpO1xuLy8gXHQgIGF0dGFjaG1lbnRNZWRpYVZpZXcucmVtb3ZlQ2xhc3MoJ25vLXNob3ctcHJldmlldycpO1xuLy8gXHQgIGJyb3dzZXJQcmV2aWV3LmF0dHIoJ3NyYycsIGF0dGFjaG1lbnQudXJsKTtcbi8vIFx0ICBhcHBJY29uUHJldmlldy5hdHRyKCdzcmMnLCBhdHRhY2htZW50LnVybCk7XG4vLyBcdCAgdXBsb2FkQnV0dG9uLnRleHQoJ0NoYW5nZSBJbWFnZScpO1xuLy8gXHR9KTtcbi8vIFx0Ly8gT3BlbiB0aGUgdXBsb2FkZXIgZGlhbG9nXG4vLyBcdG1lZGlhVXBsb2FkZXIub3BlbigpO1xuLy8gfSk7XG4vL1xuLy8gcmVtb3ZlQnV0dG9uLmNsaWNrKGZ1bmN0aW9uKCkge1xuLy8gXHR2YXIgYW5zd2VyID0gY29uZmlybSgnQXJlIHlvdSBzdXJlPycpO1xuLy8gXHRpZiAoYW5zd2VyID09IHRydWUpIHtcbi8vIFx0XHRzaXRlSWNvbi52YWwoJzAnKTtcbi8vIFx0XHRhdHRhY2htZW50TWVkaWFWaWV3LmFkZENsYXNzKCduby1zaG93LXByZXZpZXcnKTtcbi8vIFx0XHR1cGxvYWRCdXR0b24udGV4dCgnU2VsZWN0IEltYWdlJyk7XG4vLyBcdH1cbi8vIFx0cmV0dXJuIGZhbHNlO1xuLy8gfSk7XG4vL1xuLy8gfSk7XG4iXX0=
