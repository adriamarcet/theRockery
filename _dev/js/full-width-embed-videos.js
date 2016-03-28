// By Chris Coyier & tweaked by Mathias Bynens https://css-tricks.com/fluid-width-youtube-videos/

$(function() {

	// Find all YouTube videos
	var $allVideos = $("iframe[src^='https://www.youtube.com']"),

		// The element that is fluid width
		$fluidEl = $(".article__part.has-embed");

	// Figure out and save aspect ratio for each video
	$allVideos.each(function() {

		$(this)
			.data('aspectRatio', this.height / this.width)
			
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');

	});

	// When the window is resized
	// Using function smartresize to adjust youtube embed videos size
	$(window).smartresize(function() {

		var newWidth = $fluidEl.width();
		
		// Resize all videos according to their own aspect ratio
		$allVideos.each(function() {

			var $el = $(this);
			$el
				.width(newWidth)
				.height(newWidth * $el.data('aspectRatio'));

		});

	// Kick off one resize to fix all videos on page load
	}).resize();

});