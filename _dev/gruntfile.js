module.exports = function (grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
    });
    grunt.loadTasks('grunt'); //loading the grunt folder here
    grunt.registerTask('default', ['imagemin','watch']);
};

/* OLd grunt setup coming from @https://goo.gl/Ak6Nqy
module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        /*
        // Concatenate JS files and output scripts.js
        concat: {   
            dist: {
                src: [
                    'js/includes/*.js', // All JS in the libs folder
                    'js/dev_scripts.js'  // This specific file
                ],
                dest: '../js/scripts.js',
            }
        },
		

        // Minify code from the scripts output
        uglify: {
            build: {
                src: '../js/scripts.js',
                dest: '../js/scripts.min.js'
            }
        },


        // Sass configuration
        sass: {
            dist: {
                options: {
                    // style: 'compressed'
                    style: 'expanded'
                },
                files: {
                    '../css/styles.css': 'sass/project.scss'
                }
            } 
        },

		*/


        /*
		// Autoprefix styles
		postcss: {

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
		},

		// Optimize images
		imagemin: {
			dynamic: {                         // Another target
				files: [{
					expand: true,                  // Enable dynamic expansion
					cwd: '../_img/',                   // Src matches are relative to this path
					src: ['** / *.{png,jpg,gif}'],   change the slash for comment // Actual patterns to match
					dest: '../img/'                  // Destination path prefix
				}]
			}
		},


		// Watch changes
		watch: {

			// Watch script files
		    scripts: {
		        files: ['js/*.js', 'js/** / *.js'],  // changed slash for comment
		        tasks: ['concat', 'uglify'],
		        options: {
		            spawn: false,
		        },
		    },

		    // Watch style files
		    css: {
		        files: ['sass/*.scss','sass/ * / **.scss'], // changed slash for comment
		        tasks: ['sass','postcss'],
		        options: {
		            spawn: false,
		        }
		    },

		    options: {
		    	// to use this a plugin is needed @https://goo.gl/1dvN5D
		    	livereload: true,
		    }
		},

		*/

	/*
    });
	*/

    // 3. Where we tell Grunt we plan to use this plug-in.
    /*
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    */

	
    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    // grunt.registerTask('default', ['watch', 'imagemin']);
    /*
};
*/