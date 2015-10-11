
	jQuery(document).ready(function($) {

		// Your JavaScript goes here

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

		$("a[href^=#]").on("click", function(e) {
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