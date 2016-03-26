module.exports = function(grunt) {

	grunt.config('sass', {

		// Sass configuration
		dist: {
		    options: {
		        // style: 'compressed'
		        style: 'expanded'
		    },
		    files: {
		        '../css/styles.css': 'sass/project.scss'
		    }
		} 
	});
    grunt.loadNpmTasks('grunt-contrib-sass');
};