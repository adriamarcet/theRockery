module.exports = function(grunt) {
	grunt.config('postcss', {

		// Autoprefix styles
		options: {
			map: true, // inline sourcemaps

			processors: [
				//require('pixrem')(), // add fallbacks for rem units
				require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
				//require('cssnano')() // minify the result
			]
		},

		dist: {
			src: '../css/styles.css',
			dest: '../css/styles.css'
		}
	});
    grunt.loadNpmTasks('grunt-postcss');
};