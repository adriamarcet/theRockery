// this is the DEV_SCRIPTS code
// Storing variables
const toggleMenuBtn = document.querySelector('.site__menu--toggle');
const siteMenu 		= document.querySelector('.site-menu');

//This is DoingSome.js code
$(document).ready( function(){
	console.log("hola caracola");

});
function toggleMenu(){
	siteMenu.classList.toggle('is-visible');
}

toggleMenuBtn.addEventListener('click', toggleMenu );
// Using smartresize instead of window resize function @http://goo.gl/8DDYIG
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

// By Chris Coyier & tweaked by Mathias Bynens https://css-tricks.com/fluid-width-youtube-videos/
$(function() {

	// Find all YouTube videos
	var $allVideos = $("iframe[src^='https://www.youtube.com']"),
		// all videos inside .has-embed sections
		$sectionVideos = $(".article__part.has-embed iframe[src^='https://www.youtube.com']"),

		// The element that is fluid width
		$fluidEl = $(".article__part.has-embed");

	// Figure out and save aspect ratio for each video
	$sectionVideos.each(function() {

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
		$sectionVideos.each(function() {

			var $el = $(this);
			$el
				.width(newWidth)
				.height(newWidth * $el.data('aspectRatio'));

		});
	// Kick off one resize to fix all videos on page load
	}).resize();
});
/**
 * A function to overlay a dynamically created baseline grid
 * on a webpage.
 *
 * @version 0.9.11
 * @author John Keyes <john@keyes.ie>
 * @copyright Copyright (c) 2011, John Keyes
 * @link https://github.com/jkeyes/baseline
 * @license http://jkeyes.mit-license.org/
 *
 */

var merge = function(src, dest) {
  for (prop in src) { 
    if (prop in dest) { continue; }
    dest[prop] = src[prop];
  }
}

/* From jQuery: dimensions.js */
function getDimension(elem, name) {
  if (elem === window) {
  	var docElemProp = elem.document.documentElement[ "client" + name ],
  		body = elem.document.body;
  	return elem.document.compatMode === "CSS1Compat" && docElemProp ||
  		body && body[ "client" + name ] || docElemProp;    
  } else {
    return Math.max(
				elem.documentElement["client" + name],
				elem.body["scroll" + name], elem.documentElement["scroll" + name],
				elem.body["offset" + name], elem.documentElement["offset" + name]
			);
	}
}

/**
 * Baseliner.
 */
var Baseliner = function(options) {
  var defaults = {
    'gridColor': [196, 196, 196],
    'gridHeight': 10,
    'gridOffset': 0,
    'gridOpacity': 100,
    'gridSpace': 1
  }
  if (options == null) {
    options = {};
  } else {
    var optint = parseInt(options);
    if (optint != 0 && !isNaN(optint) ) {
      options = { 'gridHeight': optint };
    }
  }
  merge(defaults, options);
  this.opts = options;
  
  var baseliner = this;
  this.overlay_id = 'baseline-overlay'
  this.overlay = null;
  this.showText = document.createTextNode("Show Baseline");
  this.hideText = document.createTextNode("Hide Baseline");

  this.resize = function() {
    if (!this.overlay) return;

    height = getDimension(document, "Height");
    width = getDimension(window, "Width");
    this.overlay.style.width = width + "px";
    this.overlay.style.height = height + "px";
  }
  this.create = function() {
    var _already_overlaid = document.getElementById(this.overlay_id);
    if (_already_overlaid) return;

    this.overlay = document.createElement('div');
    this.overlay.id = this.overlay_id;
    document.body.appendChild(this.overlay);
    this.overlay.style.background =  'url(http://baselinebg.keyes.ie/?h=' + this.opts.gridHeight + '&r=' + this.opts.gridColor[0] + '&g=' + this.opts.gridColor[1] + '&b=' + this.opts.gridColor[2] + '&s=' + this.opts.gridSpace + ') repeat';
    this.overlay.style.position = 'absolute';
    this.overlay.style.top = this.opts.gridOffset + 'px';
    this.overlay.style.left = '0px';
    this.overlay.style.zIndex = 9998;
    this.overlay.style.opacity = this.opts.gridOpacity / 100;
    this.resize()
  }
  this.toggle = function(forced) {
    if (forced) {
      var elem = document.getElementById(this.overlay_id);
      if (elem) {
        document.body.removeChild(elem);
      }
    }
    this.create();
    if (forced || this.overlay.style.display != 'block') {
      if (this.showText.parentNode) {
        this.overlay_it.replaceChild(this.hideText, this.showText);
      }
      this.overlay.style.display = 'block';
    } else {
      if (this.hideText.parentNode) {
        this.overlay_it.replaceChild(this.showText, this.hideText);
      }
      this.overlay.style.display = 'none';
    }
  }
  this.refresh = function(value) {
    var value = parseInt(value);
    if (value < 1 || isNaN(value)) {
      this.value = baseliner.opts.gridHeight;
      baseliner.grid_size.style.backgroundColor = "red";
      baseliner.grid_size.style.color = "white";
      return;
    }
    baseliner.grid_size.style.backgroundColor = "white";
    baseliner.grid_size.style.color = "black";
    if (baseliner.overlay) {
      document.body.removeChild(baseliner.overlay);
      baseliner.overlay = null;
    }
    baseliner.opts.gridHeight = value;
    baseliner.toggle(true);
  }
  this.refreshOffset = function(value) {
    var value = parseInt(value);
    if (value < 0 || isNaN(value)) {
      this.value = baseliner.opts.gridOffset;
      baseliner.grid_offset.style.backgroundColor = "red";
      baseliner.grid_offset.style.color = "white";
      return;
    }
    baseliner.grid_offset.style.backgroundColor = "white";
    baseliner.grid_offset.style.color = "black";
    if (baseliner.overlay) {
      document.body.removeChild(baseliner.overlay);
      baseliner.overlay = null;
    }
    baseliner.opts.gridOffset = value;
    baseliner.toggle(true);
  }

  init = function() {
    switch(baseliner.opts.gridColor) {
      case 'green':
        baseliner.opts.gridColor = [0, 0xFF, 0]; break;
      case 'blue':
        baseliner.opts.gridColor = [0, 0, 0xFF]; break;
      case 'red':
        baseliner.opts.gridColor = [0xFF, 0, 0]; break;
      case 'black':
        baseliner.opts.gridColor = [0, 0, 0]; break;
    }

    var overlay_it = document.createElement('a');
    overlay_it.setAttribute('href', '');
    overlay_it.style.color = '#EEE';
    overlay_it.style.marginRight = '12px';
    overlay_it.appendChild(baseliner.showText);
    
    overlay_it.onclick = function(evt) {
      if (!evt) var evt = window.event;
      baseliner.toggle();
	    evt.cancelBubble = true;
	    if (evt.stopPropagation) {
	      evt.stopPropagation();
	      evt.preventDefault();
	    }
	    return false;
    }
    baseliner.overlay_it = overlay_it;

    var grid_size_label = document.createElement('label');
    grid_size_label.for = 'baseliner_grid_size';
    grid_size_label.innerText = 'Grid Size: ';
    
    var grid_size = document.createElement('input');
    grid_size.size = 3;
    grid_size.type = 'number';
    grid_size.value = baseliner.opts.gridHeight;
    grid_size.style.textAlign = 'center';
    grid_size.style.border = '1px solid #CCC';
    grid_size.style.padding = '1px';
    grid_size.style.marginRight = '5px';
    baseliner.grid_size = grid_size;

    var grid_offset_label = document.createElement('label');
    grid_offset_label.for = 'baseliner_grid_size';
    grid_offset_label.innerText = 'Grid Offset: ';

    var grid_offset = document.createElement('input');
    grid_offset.size = 3;
    grid_offset.type = 'number';
    grid_offset.value = baseliner.opts.gridOffset;
    grid_offset.style.textAlign = 'center';
    grid_offset.style.border = '1px solid #CCC';
    grid_offset.style.padding = '1px';
    baseliner.grid_offset = grid_offset;

    var parent = document.createElement('div');
    parent.style.position = 'relative';
    parent.style.zIndex = 20000;
    parent.style.marginTop = '20px';
    
    var action = document.createElement('div');
    action.id = 'overlay-it';
    action.style.position = 'fixed';
    action.style.bottom = '0px';
    action.style.left = '10px';
    action.style.display = 'inline';
    action.style.padding = '5px 15px';
    action.style.fontFamily = 'Arial, sans-serif';
    action.style.fontSize = '12px';
    action.style.fontWeight = 'bold';
    action.style.textAlign = 'center';
    action.style.backgroundColor = '#333';
    action.style.color = '#EEE';
    
    action.appendChild(overlay_it);
    action.appendChild(grid_size_label);
    action.appendChild(grid_size);
    action.appendChild(grid_offset_label);
    action.appendChild(grid_offset);
    parent.appendChild(action);
    document.body.appendChild(parent);
    
    var timer;

    var _heightChanged = function() {
      window.clearTimeout(timer);
      timer = window.setTimeout(function() { 
          baseliner.refresh(grid_size.value); 
        }, 400);
    };
    
    grid_size.onchange = grid_size.onkeyup = _heightChanged;

    var _offsetChanged = function() {
      window.clearTimeout(timer);
      timer = window.setTimeout(function() {
        baseliner.refreshOffset(grid_offset.value);
      }, 400);
    };

    grid_offset.onchange = grid_offset.onkeyup = _offsetChanged;

    window.onresize = function() {
      baseliner.resize();
    };
    document.onkeyup = function(evt) {
        if (!evt) var evt = window.event;
        var keyCode = evt.keyCode || evt.which;

        if (keyCode == 27) {
          window.clearTimeout(timer);
          timer = window.setTimeout(function() { 
            baseliner.toggle();
          }, 400);
        }
      };
  }
  init();
}


// A regular expression selector. @http://goo.gl/10ttXN
jQuery.expr[':'].regex = function(elem, index, match) {
	var matchParams = match[3].split(','),
		validLabels = /^(data|css):/,
		attr = {
			method: matchParams[0].match(validLabels) ? 
						matchParams[0].split(':')[0] : 'attr',
			property: matchParams.shift().replace(validLabels,'')
		},
		regexFlags = 'ig',
		regex = new RegExp(matchParams.join('').replace(/^s+|s+$/g,''), regexFlags);
	return regex.test(jQuery(elem)[attr.method](attr.property));
}
jQuery(document).ready(function($) {
	
	// function to switch Celcious to Farenheits when clicking the element XXX
	switchDegrees();



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
// function to switch Celcious to Farenheits when clicking the element XXX
/*
	26/03/2016 
	Ways to improve this:

	1
	The trigger method (when the input changes), step number 3, can be in site.js
	That would require to remove the holder function here and make the inner ones
	more generic.

	2
	Changing the degrees for each span.js-temp would be good,
	not only having the capacity to change them all with the swticher
	but also individualy.
	That would require to look if is fahrenheit or not depending on
	if the user had clicked the switcher or not.
	To do that refer to *A

	3 The highlght effect could be more general 
	and be an independent function?
	refer to *B

	4 last point number 4 should be better triggered by the server

	5 The state of the selected degree should be stored in a cookie 
	// in case the user refresh the page it will keep that data saved
*/

function switchDegrees(){

// -- 1 Wrapping the temperature into a span.js-temp 
	// Do some in each Direction list element
	$('.recipe__directions ol li').each( function(){

		// Look inside the matched element for the regular expresion
		// and replace it for the expression inside a span
		$(this).html(function(_, html) {

			// the regexp matches for example 180 ºC (it takes into account the space)
			return html.replace(/(\d+\s+\ºC)/g, '<span class="js-temp">$1</span>');

			//some regexp notes
			// \d{3} means 3 digits
			// [A-Z]{2} Means two letters
			// \° that special character 
			// \s+ one or more white spaces
			// \d+ one or more numbers
			// \d+\s+\°C 
		});
	});


	// *A : When clicking to one .js-temp do something
	$('.js-temp').on("click", function(){

		// doSwitchDegrees( $(this) );
	});


	// Function to convert and return the parameter to farenheits
	function convertToF(celNum) {
		parseFloat(celNum);
		celNum = (celNum * (9 / 5)) + 32;
		// console.log(celNum);
		return celNum;
	}

	// Function to convert and return the parameter to celsius
	function convertToC(fahrNum) {
		parseFloat(fahrNum);
		fahrNum = ( (fahrNum - 32) * 5 / 9 );
		// console.log(fahrNum);
		return fahrNum;
	}

// -- 2 Switching the given span. It should be js-temp
	// Function to switch the given parameter
	function doSwitchDegrees( t ){
		// Store the text of the given element (t)
		// and remove the last 3 characters from it ( i.ex: _ºC)
		var trimed = t.text().slice(0,-3);
		// console.log(trimed);
		
		// *B Highlighting the text with a class
			// -> removing the class to highlight the text
			t.removeClass("js-temp--animated");
			// This trick is to make the class trigger the animation not only one
			// as explained @https://goo.gl/hXwmrl 
			// -> triggering reflow /* The actual magic */
			t.outerWidth( true );
			// -> and re-adding the class
			t.addClass("js-temp--animated");


		if( !t.hasClass('js-temp--fahrenheit') ) {
			// if this has not the class temp fahrenheit
			// store the result of passing the trimed to convertToF
			var transformedToFahrenheits = convertToF( parseFloat(trimed) );
			// Add a specific class to the element
			t.addClass('js-temp--fahrenheit');
			// Remove a specific class to the element
			t.removeClass('js-temp--celsius');

			// replace the text with the converted number plus the sign
			t.text( transformedToFahrenheits + ' ºF');
		}else{

			// store the result of passing the trimed to convertToC
			var transformedToCelsius = convertToC( parseFloat(trimed) );
			// Remove a specific class to the element
			t.addClass('js-temp--celsius');
			// also add a specific class to the element
			t.removeClass('js-temp--fahrenheit');
			// replace the text with the converted number plus the sign
			t.text( transformedToCelsius + ' ºC');
		};
	};

// -- 3 Triggering the switch when input radio change
	// When inputs with name degrees changes do


	$( 'input[name="degrees"]' ).change(function() {
		

		// if the input with id fahrenheit is checked  	
		if( $('#fahrenheits' ).prop( "checked" ) ) {

			// console.log('f is checked');
			$('.recipe__directions ol li .js-temp').each( function(){

				doSwitchDegrees( $(this) );
			});
		}

		if( $('#celsius' ).prop( "checked" ) ) {

			// console.log('c is checked');
			$('.recipe__directions ol li .js-temp').each( function(){

				doSwitchDegrees( $(this) );
			});
		}
	});


// -- 4 if there isn´t at least 1 item to convert 
	// remove the magick markup
	// this should be better triggered by the server
	if(  $('.js-temp').length < 1  ){
		// dont show the switcher --> moved to be the default by css
		// $('.switcher__degrees').css('display','none');
	}else{
		// show the switcher
		$('.switcher__degrees').css('display','block');

		// adapt the element next to it
		$('.recipe__directions--with-switcher .section__title').addClass('js--modified').css({
			'float' : 'left',
			'width' : '80%' // since the switcher will be 20%
		});
	};
}