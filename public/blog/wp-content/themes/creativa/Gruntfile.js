module.exports = function(grunt){

	// Configuration
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		compass: {
			build: {
			    options: {
			    	config: 'sass/config.rb',
			    }
			},
		},

		uglify: {
			js: {
				files: [{
	                expand: true,
	                src: ['js/theme_scripts.js', 
	                	'js/theme_canvases.js'
	                ],
	                ext: '.min.js',
	                dest: ''
                }]
			}
		},

		watch: {
			css: {
			    files: ['sass/*.scss'],
			    tasks: ['compass'],

			    options: {
			     	spawn: false,
			     	interrupt: true,
			    },
			},
			js: {
			    files: ['js/theme_canvases.js'],
			    tasks: ['uglify'],

			    options: {
			     	spawn: false,
			     	interrupt: true,
			    },
			},
		},

		compress: {
		  	main: {
			    options: {
			      	archive: '_theme_zip/<%= pkg.name %>.zip'
			    },
				files: [{
	                expand: true,
	                src: ['**/**', 
	                	'!node_modules/**',
	                	'!.sass-cache', 
	                	'!<%= pkg.name %>.zip',
	                	'!_theme_zip/**',
	                	'!.vscode'
	                ],
	                dest: '<%= pkg.name %>/'
                }]
		  	}
		},		

		jshint: {
		    all: ['js/main.js', 'js/theme_canvases.js']
		},

	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.loadNpmTasks('grunt-contrib-compress');

	// Register Task
	grunt.registerTask('default', ['compass', 'watch']);
	grunt.registerTask('zip', ['compress']);


};	