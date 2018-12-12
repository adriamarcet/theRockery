module.exports = function(grunt) {

	grunt.config('postcss', {
		options: {
			processors: [
			  require("postcss-cssnext")() // this includes autoprefixes
			]
		},
		dist: {
			src: '../css/style.css',
			dest: '../css/style.css'
		}
	});

    grunt.loadNpmTasks('grunt-postcss');
};