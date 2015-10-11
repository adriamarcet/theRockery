module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),


        //GPlugin for concatenate js files
        concat: {   
            dist: {
                src: [
                    'js/*.js' // All JS in the js/ folder
                ],
                dest: 'js/scripts.js'
            }
        },

        //GPlugin for minifying scripts
        uglify: {
            build: {
                src: 'js/scripts.js',
                dest: 'js/scripts.min.js'
            }
        },

        //GPlugin for optimizing the images
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'img/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'img/'
                }]
            }
        },

        //GPlugin for watching folders and running tasks if there's some change
        watch: {
            //Enabling LiveReload (it needs a browser plugin)
            options: {
                livereload: true,
            },
            
            scripts: {
                files: ['js/*.js'],
                tasks: ['concat', 'uglify'],
                options: {
                    spawn: false,
                },
            },

            css: {
                files: ['css/sass/**/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false,
                }
            }
        },

        //GPlugin for SASS preprocessor
        sass: {
            dist: {
                options: {
                    style: 'expanded',
                    precision: 15
                },
                files: {
                    'css/style.css': 'css/sass/project.scss' // 'destination' : 'source'
                }
            } 
        }
    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');


    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat','imagemin','watch']);

};