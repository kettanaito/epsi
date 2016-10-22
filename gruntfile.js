module.exports = function (grunt) {
	'use strict';

	/* Load Grunt tasks */
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	/* Load NPM tasks */
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-browserify');
	grunt.loadNpmTasks('grunt-eslint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	/* Set initial Grunt configurations */
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		/* CSS/LESS */
		less: {
			dist: {
				options: {
					paths: ['less/'],
					compress: false,
					yiucompress: true,
					optimization: 2
				},
				files: {
					'assets/css/main.css': 'less/main.less'
				}
			},
			vendor: {
				options: {
					compress: true,
					yiucompress: true,
					optimization: 4
				},
				files: [{
					expand: true,
					cwd: 'less/',
					src: 'vendor/*.less',
					dest: 'assets/css/',
					ext: '.min.css'
				}]
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 versions']
			},
			dist: {
				files: {
					'assets/css/style.css': 'assets/css/style.css'
				}
			}
		},

		cssmin: {
			options: {
				keepSpecialComments: false,
				rebase: true,
				relativeTo: '.'
			},
			fonts: {
				files: {
					'assets/css/fonts/local.css': 'assets/css/fonts/**/font-face.css'
				}
			},
			dist: {
				files: {
					'assets/css/main.min.css': ['assets/css/main.css', 'assets/css/fonts/local.css']
				}
			}
		},

		/* JavaScript */
		browserify: {
			dist: {
				options: {
					transform: [
						['babelify', { presets: ['es2015'] }]
					],
					browserifyOptions: { debug: true }
				},
				files: [
				{
					expand: true,
					src: 'js/*.js',
					dest: 'assets/',
					ext: '.min.js'
				},
				{
					expand: true,
					src: 'js/vendor/*.js',
					dest: 'assets/',
					ext: '.min.js'
				}
				]
			}
		},

		eslint: {
			options: {
				configFile: '.eslintrc'
			},
			target: 'assets/js/*.js'
		},

		uglify: {
			dist: {
				files: [{
					expand: true,
					src: 'assets/js/*.js'
				}]
			},
			vendor: {
				files: {
					expand: true,
					src: 'assets/js/vendor/',
					ext: '.min.js'
				}
			}
		},

		/* Watch */
		watch: {
			options: {
				event: ['changed', 'added', 'deleted']
			},
			styles: {
				files: ['less/**/*.less'],
				tasks: ['less', 'autoprefixer', 'cssmin']
			},
			scripts: {
				files: ['js/**/*.js'],
				tasks: ['browserify', 'eslint']
			}
		}

	});

	/* Tasks sequences */
	grunt.registerTask('css', ['less', 'autoprefixer', 'cssmin']);
	grunt.registerTask('fonts', ['cssmin:fonts']);
	grunt.registerTask('dev', ['fonts', 'css', 'browserify', 'eslint', 'uglify', 'watch']);
	grunt.registerTask('default', ['dev']);
}
