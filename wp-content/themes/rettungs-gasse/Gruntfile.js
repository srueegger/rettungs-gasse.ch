module.exports = function( grunt ) {
    'use strict';

    // Load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    // Project configuration
    grunt.initConfig( {
        pkg:    grunt.file.readJSON( 'package.json' ),
        concat: {
            options: {
                stripBanners: true,
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' * Licensed GPLv2+' +
                ' */\n'
            },
            basetheme: {
                src: [
					'node_modules/popper.js/dist/umd/popper.js',
                    'node_modules/bootstrap/dist/js/bootstrap.js',
                    'node_modules/mixitup/dist/mixitup.js',
                    //'node_modules/countup.js/dist/countUp.js',
                    'dev-assets/js/src/main.js'
                ],
                dest: 'dev-assets/js/theme.js'
            }
        },
        jshint: {
            browser: {
                all: [
                    'dev-assets/js/**/*.js'
                ],
                options: {
                    jshintrc: '.jshintrc'
                }
            },
            grunt: {
                all: [
                    'Gruntfile.js'
                ],
                options: {
                    jshintrc: '.gruntjshintrc'
                }
            }
        },
        uglify: {
            all: {
                files: {
                    'dist-assets/js/theme.min.js': ['dev-assets/js/theme.js']
                },
                options: {
                    banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                    ' * <%= pkg.homepage %>\n' +
                    ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                    ' * Licensed GPLv2+' +
                    ' */\n',
                    mangle: {
                        reserved: ['jQuery']
                    }
                }
            }
        },

        sass:   {
            all: {
                files: {
                    'dev-assets/css/theme.css': 'dev-assets/css/src/theme.scss'
                }
            }
        },

        cssmin: {
            options: {
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' * Licensed GPLv2+' +
                ' */\n'
            },
            minify: {
                expand: true,

                cwd: 'dev-assets/css/',
                src: ['theme.css'],

                dest: 'dist-assets/css/',
                ext: '.min.css'
            }
        },

        watch:  {

            sass: {
                files: ['dev-assets/css/_vendor/**/*.scss', 'dev-assets/css/src/**/*.scss'],
                tasks: ['sass', 'cssmin'],
                options: {
                    debounceDelay: 500
                }
            },

            scripts: {
                files: ['dev-assets/js/src/**/*.js', 'dev-assets/js/_vendor/**/*.js'],
                tasks: ['jshint', 'concat', 'uglify'],
                options: {
                    debounceDelay: 500
                }
            }
        }
    } );

    // Default task.

    grunt.registerTask( 'default', ['jshint', 'concat', 'uglify', 'sass', 'cssmin'] );


    grunt.util.linefeed = '\n';
};
