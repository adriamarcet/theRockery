module.exports = function(grunt) {

	grunt.config('sass', {

		// Sass configuration
		dist: {
			options: {
					precision: 15,
					style: 'expanded', // can be nested, compact, compressed, expanded.
				},
			files: {
				'../css/style.css': 'sass/project.scss'
			}
		} 
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
};