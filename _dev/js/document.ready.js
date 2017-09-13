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