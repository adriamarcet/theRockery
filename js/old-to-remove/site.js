// Using smartresize instead of window resize function 
// as it is explained in http://www.paulirish.com/2009/throttled-smartresize-jquery-event-handler/
(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');



// Using functin smartresize to adjust youtube embed videos size
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
	// (You'll probably want to debounce this)
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

jQuery(document).ready(function($) {
	






	// Your JavaScript goes here
	var tempeCel =  /(\d+)/;
	console.log(tempeCel);

	var tempCel = $('.recipe__directions li:contains("ºC")');

	tempCel.wrap( "<div class='new'></div>" );

	// Looks and replaces Nota X
	tempCel.html(function(_, html){
		return html.replace(/(\d+)/, '<a href="#$1"><span class="celcius">$1</span></a>');
		// return html.replace(/(Nota /[0-9]/ )/g, '<span class="tagged">$1</span>');
	});

	$('.celcius').css('color','red');

	var celNum = $('.celcius').html();
	console.log(celNum);
	function convertToF() {
		parseFloat(celNum);
		celNum = (celNum * (9 / 5)) + 32;
		return celNum;
	}


	$('.section__title').on("click", function(){
		
		convertToF();
		console.log(celNum);
		$('.celcius').html(celNum);
	});












	// Get all parts of the progress bar.
	var sliderThumbs = $('.slider__extra-images--thumb');

	// With each one, calculate the percentage and apply the width.
	sliderThumbs.each(function()
	{
	    $(this).css('width', (100 / sliderThumbs.length) + '%');
	});

	// how many slides there are
	var sliderElement = $('.slider ul').find('li');

	var i = $('.slider ul li');
	for (i = 0; i <= sliderElement.length; i++) {
	    sliderElement.eq(i).addClass('class'+i);
	}
	
	// using matchMedia API to target mobile
	// matchMedia is like queries in CSS?
	// then trigger some script if mobile is matched
	console.log("hola");
	var mql = window.matchMedia("screen and (max-width: 560px)");
	mql.addListener( function(e){
		
		if(e.matches){
			
			console.log("enter mobile");
		}else{

			console.log("leave mobile");
		}
	});
	
	// Wrapping all 'nota n.' words
	$("a[href^='#']").on("click", function(e) {
	  e.preventDefault();
	  history.pushState({}, "", this.href);
	});
	
	// Looks and replaces Nota X
	$(".article__recipe li:contains('Nota ')").html(function(_, html){
		return html.replace(/(Nota \d)/g, '<a href="#$1"><span class="tagged">$1</span></a>');
		// return html.replace(/(Nota /[0-9]/ )/g, '<span class="tagged">$1</span>');
	});

	$(".article__recipe p:contains('Nota ')").html(function(_, html){
		return html.replace(/(Nota \d)/g, '<span id="$1"class="tagged">$1</span>');
		// return html.replace(/(Nota /[0-9]/ )/g, '<span class="tagged">$1</span>');
	});


	// Adding a class to ingridients list item when click
	$('.ingridients li').on("click",function(){
		$(this).toggleClass('ingridients__selected');
	});

	// SWITCHER
		function change($opt){
			$opt.toggleClass('selected').siblings().toggleClass('selected');
		}

		$('.switcher a').on('click', function(e) {
			e.preventDefault();

			$(this).each(function(){
				if( $(this).hasClass('selected')) {
				}else {
					change( $(this) );
				}
			});

			if( $('.musicSwitch').hasClass('selected') ) {
				$('.section__music').insertBefore('.section__food').show('slow');
			}else {
				$('.section__food').insertBefore('.section__music');
			}
		});


	//missing a condition to do this scripts only inside articles

	// Slider 
		var imageBig = $('.slider__mainImg img').attr('src');

		function swipeImages($source) {
			$('.slider__mainImg').css('background-image', 'url("'+$source+'")' );
		}

		$('.slider ul li img').on( "click", function(){
			
			$imageBig = ($(this).attr('src'));
			swipeImages( $imageBig );
		});


	//Add RIMG img to each image in howto steps.
	// $('.recipe__directions li img').wrap('<div class="rimg" />');
	$('.recipe__directions li img').parent('a').addClass('js-imageInContent');
	
	// For each rimg class add its img as a background image
	$('.rimg').each( function(){
	
		var howToImg = $(this).find('img').attr('src');
		//alert(howToImg);
		$(this).css('background-image', 'url('+howToImg+')');
		// Make the image disapear after embeding its source as a BGImage in its container
		$(this).find('img').css('opacity','0');
	});
});