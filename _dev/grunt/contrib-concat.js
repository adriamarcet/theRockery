module.exports = function(grunt) {

	grunt.config('concat', {
		// Concatenate JS files and output scripts.js
		dist: {
			src: [
				'js/includes/*.js', // All JS in the libs folder
				'js/dev_scripts.js'  // This specific file
			],
			dest: '../js/scripts.js',
		}
	});
	grunt.loadNpmTasks('grunt-contrib-concat');
};