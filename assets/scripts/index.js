'use strict';

/**
 * Media Upload
 *
 * @author Jason Witt
 * @since 0.0.1
 */
window.siteIcon = {};
(function (window, app) {

	/**
  * Initlize.
  *
  * @author Jason Witt
  * @since 0.0.1
  *
  * @return void
  */
	app.init = function () {
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
	app.cache = function () {
		app.$c = {
			uploadButton: document.getElementById('upload-button'),
			removeButton: document.getElementById('remove-button'),
			attachmentMediaView: document.getElementById('attachment-media-view'),
			browserPreview: document.getElementById('browser-preview'),
			appIconPreview: document.getElementById('app-icon-preview'),
			siteIcon: document.getElementById('site_icon'),
			mediaUploader: false
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
	app.chooseImage = function () {

		app.$c.uploadButton.addEventListener('click', function (e) {

			e.preventDefault();

			// If media uploader exists, reopen it.
			if (app.$c.mediaUploader) {
				app.$c.mediaUploader.open();
				return;
			}

			// Create the media uploader frame.
			app.$c.mediaUploader = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Select'
				},
				library: {
					type: 'image'
				},
				multiple: false
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
	app.onSelect = function () {

		// When a image is selected.
		app.$c.mediaUploader.on('select', function () {

			// Get the attachment details.
			var attachment = app.$c.mediaUploader.state().get('selection').first().toJSON();

			// Set the value on the site_icon field.
			app.$c.siteIcon.value = attachment.id;

			// Remove the 'no-show-preview' class if present.
			app.$c.attachmentMediaView.classList.remove('no-show-preview');

			// Set the URL to the image src attributes.
			app.$c.browserPreview.setAttribute('src', attachment.url);
			app.$c.appIconPreview.setAttribute('src', attachment.url);

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
	app.removeImage = function () {
		app.$c.removeButton.addEventListener('click', function () {

			// Set the conformation modal.
			var answer = confirm('Are you sure?');

			// If confirmed.
			if (answer == true) {

				// Set the site_icon field to 0.
				app.$c.siteIcon.value = '0';

				// Add the 'no-show-preview' class.
				app.$c.attachmentMediaView.classList.add('no-show-preview');

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
})(window, window.siteIcon);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm1lZGlhLXVwbG9hZC5qcyJdLCJuYW1lcyI6WyJ3aW5kb3ciLCJzaXRlSWNvbiIsImFwcCIsImluaXQiLCJjYWNoZSIsImNob29zZUltYWdlIiwicmVtb3ZlSW1hZ2UiLCIkYyIsInVwbG9hZEJ1dHRvbiIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJyZW1vdmVCdXR0b24iLCJhdHRhY2htZW50TWVkaWFWaWV3IiwiYnJvd3NlclByZXZpZXciLCJhcHBJY29uUHJldmlldyIsIm1lZGlhVXBsb2FkZXIiLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInByZXZlbnREZWZhdWx0Iiwib3BlbiIsIndwIiwibWVkaWEiLCJ0aXRsZSIsImJ1dHRvbiIsInRleHQiLCJsaWJyYXJ5IiwidHlwZSIsIm11bHRpcGxlIiwib25TZWxlY3QiLCJvbiIsImF0dGFjaG1lbnQiLCJzdGF0ZSIsImdldCIsImZpcnN0IiwidG9KU09OIiwidmFsdWUiLCJpZCIsImNsYXNzTGlzdCIsInJlbW92ZSIsInNldEF0dHJpYnV0ZSIsInVybCIsInRleHRDb250ZW50IiwiYW5zd2VyIiwiY29uZmlybSIsImFkZCJdLCJtYXBwaW5ncyI6Ijs7QUFBQTs7Ozs7O0FBTUFBLE9BQU9DLFFBQVAsR0FBa0IsRUFBbEI7QUFDRSxXQUFVRCxNQUFWLEVBQWtCRSxHQUFsQixFQUF3Qjs7QUFFekI7Ozs7Ozs7O0FBUUFBLEtBQUlDLElBQUosR0FBVyxZQUFXO0FBQ3JCRCxNQUFJRSxLQUFKO0FBQ0FGLE1BQUlHLFdBQUo7QUFDQUgsTUFBSUksV0FBSjtBQUNBLEVBSkQ7O0FBTUE7Ozs7Ozs7O0FBUUFKLEtBQUlFLEtBQUosR0FBWSxZQUFXO0FBQ3RCRixNQUFJSyxFQUFKLEdBQVM7QUFDUkMsaUJBQWNDLFNBQVNDLGNBQVQsQ0FBeUIsZUFBekIsQ0FETjtBQUVSQyxpQkFBY0YsU0FBU0MsY0FBVCxDQUF5QixlQUF6QixDQUZOO0FBR1JFLHdCQUFxQkgsU0FBU0MsY0FBVCxDQUF5Qix1QkFBekIsQ0FI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c291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBNZWRpYSBVcGxvYWRcbiAqXG4gKiBAYXV0aG9yIEphc29uIFdpdHRcbiAqIEBzaW5jZSAwLjAuMVxuICovXG53aW5kb3cuc2l0ZUljb24gPSB7fTtcbiggZnVuY3Rpb24oIHdpbmRvdywgYXBwICkge1xuXG5cdC8qKlxuXHQgKiBJbml0bGl6ZS5cblx0ICpcblx0ICogQGF1dGhvciBKYXNvbiBXaXR0XG5cdCAqIEBzaW5jZSAwLjAuMVxuXHQgKlxuXHQgKiBAcmV0dXJuIHZvaWRcblx0ICovXG5cdGFwcC5pbml0ID0gZnVuY3Rpb24oKSB7XG5cdFx0YXBwLmNhY2hlKCk7XG5cdFx0YXBwLmNob29zZUltYWdlKCk7XG5cdFx0YXBwLnJlbW92ZUltYWdlKCk7XG5cdH07XG5cblx0LyoqXG5cdCAqIENhY2hlIHRoZSBET00gZWxlbWVudHMuXG5cdCAqXG5cdCAqIEBhdXRob3IgSmFzb24gV2l0dFxuXHQgKiBAc2luY2UgMC4wLjFcblx0ICpcblx0ICogQHJldHVybiB2b2lkXG5cdCAqL1xuXHRhcHAuY2FjaGUgPSBmdW5jdGlvbigpIHtcblx0XHRhcHAuJGMgPSB7XG5cdFx0XHR1cGxvYWRCdXR0b246IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAndXBsb2FkLWJ1dHRvbicgKSxcblx0XHRcdHJlbW92ZUJ1dHRvbjogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoICdyZW1vdmUtYnV0dG9uJyApLFxuXHRcdFx0YXR0YWNobWVudE1lZGlhVmlldzogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoICdhdHRhY2htZW50LW1lZGlhLXZpZXcnICksXG5cdFx0XHRicm93c2VyUHJldmlldzogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoICdicm93c2VyLXByZXZpZXcnICksXG5cdFx0XHRhcHBJY29uUHJldmlldzogZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoICdhcHAtaWNvbi1wcmV2aWV3JyApLFxuXHRcdFx0c2l0ZUljb246IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCAnc2l0ZV9pY29uJyApLFxuXHRcdFx0bWVkaWFVcGxvYWRlcjogZmFsc2UsXG5cdFx0fTtcblx0fTtcblxuXHQvKipcblx0ICogQ2hvb3NlIEltYWdlLlxuXHQgKlxuXHQgKiBAYXV0aG9yIEphc29uIFdpdHRcblx0ICogQHNpbmNlIDAuMC4xXG5cdCAqXG5cdCAqIEByZXR1cm4gdm9pZFxuXHQgKi9cblx0YXBwLmNob29zZUltYWdlID0gZnVuY3Rpb24oKSB7XG5cblx0XHRhcHAuJGMudXBsb2FkQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoICdjbGljaycsIGZ1bmN0aW9uKCBlICkge1xuXG5cdFx0XHRlLnByZXZlbnREZWZhdWx0KCk7XG5cblx0XHRcdC8vIElmIG1lZGlhIHVwbG9hZGVyIGV4aXN0cywgcmVvcGVuIGl0LlxuXHRcdFx0aWYgKCBhcHAuJGMubWVkaWFVcGxvYWRlciApIHtcblx0XHRcdFx0YXBwLiRjLm1lZGlhVXBsb2FkZXIub3BlbigpO1xuXHRcdFx0XHRyZXR1cm47XG5cdFx0XHR9XG5cblx0XHRcdC8vIENyZWF0ZSB0aGUgbWVkaWEgdXBsb2FkZXIgZnJhbWUuXG5cdFx0XHRhcHAuJGMubWVkaWFVcGxvYWRlciA9IHdwLm1lZGlhKHtcblx0XHRcdFx0dGl0bGU6ICdDaG9vc2UgSW1hZ2UnLFxuXHRcdFx0XHRidXR0b246IHtcblx0XHRcdFx0XHR0ZXh0OiAnU2VsZWN0Jyxcblx0XHRcdFx0fSxcblx0XHRcdFx0bGlicmFyeToge1xuXHRcdFx0XHRcdHR5cGU6ICdpbWFnZScsXG5cdFx0XHRcdH0sXG5cdFx0XHRcdG11bHRpcGxlOiBmYWxzZSxcblx0XHRcdH0pO1xuXG5cdFx0XHRhcHAub25TZWxlY3QoKTtcblxuXHRcdFx0Ly8gT3BlbiB0aGUgdXBsb2FkZXIgZGlhbG9nXG5cdFx0XHRhcHAuJGMubWVkaWFVcGxvYWRlci5vcGVuKCk7XG5cdFx0fSk7XG5cdH07XG5cblx0LyoqXG5cdCAqIFNlbGVjdCBJbWFnZS5cblx0ICpcblx0ICogQGF1dGhvciBKYXNvbiBXaXR0XG5cdCAqIEBzaW5jZSAwLjAuMVxuXHQgKlxuXHQgKiBAcmV0dXJuIHZvaWRcblx0ICovXG5cdGFwcC5vblNlbGVjdCA9IGZ1bmN0aW9uKCkge1xuXG5cdFx0Ly8gV2hlbiBhIGltYWdlIGlzIHNlbGVjdGVkLlxuXHRcdGFwcC4kYy5tZWRpYVVwbG9hZGVyLm9uKCAnc2VsZWN0JywgZnVuY3Rpb24oKSB7XG5cblx0XHRcdC8vIEdldCB0aGUgYXR0YWNobWVudCBkZXRhaWxzLlxuXHRcdFx0dmFyIGF0dGFjaG1lbnQgPSBhcHAuJGMubWVkaWFVcGxvYWRlci5zdGF0ZSgpLmdldCggJ3NlbGVjdGlvbicgKS5maXJzdCgpLnRvSlNPTigpO1xuXG5cdFx0XHQvLyBTZXQgdGhlIHZhbHVlIG9uIHRoZSBzaXRlX2ljb24gZmllbGQuXG5cdFx0XHRhcHAuJGMuc2l0ZUljb24udmFsdWUgPSBhdHRhY2htZW50LmlkO1xuXG5cdFx0XHQvLyBSZW1vdmUgdGhlICduby1zaG93LXByZXZpZXcnIGNsYXNzIGlmIHByZXNlbnQuXG5cdFx0XHRhcHAuJGMuYXR0YWNobWVudE1lZGlhVmlldy5jbGFzc0xpc3QucmVtb3ZlKCAnbm8tc2hvdy1wcmV2aWV3JyApO1xuXG5cdFx0XHQvLyBTZXQgdGhlIFVSTCB0byB0aGUgaW1hZ2Ugc3JjIGF0dHJpYnV0ZXMuXG5cdFx0XHRhcHAuJGMuYnJvd3NlclByZXZpZXcuc2V0QXR0cmlidXRlKCAnc3JjJywgYXR0YWNobWVudC51cmwgKTtcblx0XHRcdGFwcC4kYy5hcHBJY29uUHJldmlldy5zZXRBdHRyaWJ1dGUoICdzcmMnLCBhdHRhY2htZW50LnVybCApO1xuXG5cdFx0XHQvLyBDaGFuZ2UgdGhlIGJ1dHRvbiB0ZXh0LlxuXHRcdFx0YXBwLiRjLnVwbG9hZEJ1dHRvbi50ZXh0Q29udGVudCA9ICdDaGFuZ2UgSW1hZ2UnO1xuXHRcdH0pO1xuXHR9O1xuXG5cdC8qKlxuXHQgKiBSZW1vdmUgSW1hZ2UuXG5cdCAqXG5cdCAqIEBhdXRob3IgSmFzb24gV2l0dFxuXHQgKiBAc2luY2UgMC4wLjFcblx0ICpcblx0ICogQHJldHVybiB2b2lkXG5cdCAqL1xuXHRhcHAucmVtb3ZlSW1hZ2UgPSBmdW5jdGlvbigpIHtcblx0XHRhcHAuJGMucmVtb3ZlQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoICdjbGljaycsIGZ1bmN0aW9uKCkge1xuXG5cdFx0XHQvLyBTZXQgdGhlIGNvbmZvcm1hdGlvbiBtb2RhbC5cblx0XHRcdHZhciBhbnN3ZXIgPSBjb25maXJtKCAnQXJlIHlvdSBzdXJlPycgKTtcblxuXHRcdFx0Ly8gSWYgY29uZmlybWVkLlxuXHRcdFx0aWYgKCBhbnN3ZXIgPT0gdHJ1ZSApIHtcblxuXHRcdFx0XHQvLyBTZXQgdGhlIHNpdGVfaWNvbiBmaWVsZCB0byAwLlxuXHRcdFx0XHRhcHAuJGMuc2l0ZUljb24udmFsdWUgPSAnMCc7XG5cblx0XHRcdFx0Ly8gQWRkIHRoZSAnbm8tc2hvdy1wcmV2aWV3JyBjbGFzcy5cblx0XHRcdFx0YXBwLiRjLmF0dGFjaG1lbnRNZWRpYVZpZXcuY2xhc3NMaXN0LmFkZCggJ25vLXNob3ctcHJldmlldycgKTtcblxuXHRcdFx0XHQvLyBDaGFuZ2UgdGhlIGJ1dHRvbiB0ZXh0LlxuXHRcdFx0XHRhcHAuJGMudXBsb2FkQnV0dG9uLnRleHRDb250ZW50ID0gJ1NlbGVjdCBJbWFnZSc7XG5cdFx0XHR9XG5cdFx0XHRyZXR1cm4gZmFsc2U7XG5cdFx0fSk7XG5cdH07XG5cblx0LyoqXG5cdCAqIFJ1biB0aGUgc2NyaXB0LlxuXHQgKlxuXHQgKiBAYXV0aG9yIEphc29uIFdpdHRcblx0ICogQHNpbmNlIDAuMC4xXG5cdCAqXG5cdCAqIEByZXR1cm4gdm9pZFxuXHQgKi9cblx0YXBwLmluaXQoKTtcbn0oIHdpbmRvdywgd2luZG93LnNpdGVJY29uICkgKTtcbiJdfQ==
