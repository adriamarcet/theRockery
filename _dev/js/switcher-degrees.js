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