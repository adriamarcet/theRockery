module.exports = function(grunt) {

	grunt.config('postcss', {
		options: {
			processors: [
				require("autoprefixer")({ browsers: 'last 2 versions' }),
				require('cssnano')()
			]
		},
		dist: {
			src: '../css/style.css',
			dest: '../css/style.css'
		}
	});

    grunt.loadNpmTasks('grunt-postcss');
};
