module.exports = function(grunt) {

	// To support SASS/SCSS or Stylus, just install
	// the appropriate grunt package and it will be automatically included
	// in the build process, Sass is included by default:
	//
	// * for SASS/SCSS support, run `npm install --save-dev grunt-contrib-sass`
	// * for Stylus/Nib support, `npm install --save-dev grunt-contrib-stylus`

	var npmDependencies = require('./package.json').devDependencies;
	var hasLess = npmDependencies['grunt-contrib-less'] !== undefined;
	var hasStylus = npmDependencies['grunt-contrib-stylus'] !== undefined;
	var hasAutoprefixer = npmDependencies['grunt-autoprefixer'] !== undefined;
	var hasCopy = npmDependencies['grunt-contrib-copy'] !== undefined;

	grunt.initConfig({

		// Watches for changes and runs tasks
		watch : {
			less : {
				files : ['less/**/*.less'],
				tasks : (hasLess) ? ['less:dev','autoprefixer'] : null,
				options : {
					livereload : true
				}
			},
			stylus : {
				files : ['stylus/**/*.styl'],
				tasks : (hasStylus) ? ['stylus:dev'] : null,
				options: {
					livereload : true
				}
			},
			js : {
				files : ['js/**/*.js'],
				tasks : ['jshint'],
				options : {
					livereload : true
				}
			},
			php : {
				files : ['**/*.php'],
				options : {
					livereload : true
				}
			}
		},

		// JsHint your javascript
		jshint : {
			all : ['js/*.js', '!js/modernizr.js', '!js/*.min.js', '!vendor/**/*.js'],
			options : {
				browser: true,
				curly: false,
				eqeqeq: false,
				eqnull: true,
				expr: true,
				immed: true,
				newcap: true,
				noarg: true,
				smarttabs: true,
				sub: true,
				undef: false
			}
		},

		// Dev and production build for less
		less : {
			options: {
				paths: ['./bower_components'],
			},
			production : {
				files : 
					{
						'css/**/*.css': 'less/**/*.less'
					},
				options :
					{
						cleancss: true,
						compress: true,
						report: 'gzip'
					}
			},
			dev : {
				files : 
					{
						'css/**/*.css': 'less/**/*.less'
					}
			}
		},

		// Dev and production build for stylus
		stylus : {
			production : {
				files : [
					{
						src : ['**/*.styl', '!**/_*.styl'],
						cwd : 'stylus',
						dest : 'css',
						ext: '.css',
						expand : true
					}
				],
				options : {
					compress : true
				}
			},
			dev : {
				files : [
					{
						src : ['**/*.styl', '!**/_*.styl'],
						cwd : 'stylus',
						dest : 'css',
						ext: '.css',
						expand : true
					}
				],
				options : {
					compress : false
				}
			},
		},

		// Add vendor prefixed styles
		autoprefixer: {
		options: {
		  browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1']
		},
		dist: {
		  files: [{
		    expand: true,
		    src: '{,*/}*.css',
		    dest: 'css'
		  }]
		}
		},

		// Copy vendor files to their respective folders
		copy : {
			vendor: {
				files: [
					// jquery.tocify.js
					{expand: true, src: ['bower_components/jquery.tocify.js/src/**/*.min.js'], dest: 'vendor/js/', flatten: true},
					{expand: true, src: ['bower_components/jquery.tocify.js/src/**/*.css'], dest: 'vendor/css/', flatten: true},

					// blueimp-gallery
					{expand: true, src: ['bower_components/blueimp-gallery/js/*.min.js'], dest: 'vendor/js/', flatten: true},
					{expand: true, src: ['bower_components/blueimp-gallery/css/*.min.css'], dest: 'vendor/css/', flatten: true},
					{expand: true, src: ['bower_components/blueimp-gallery/img/*'], dest: 'vendor/img/', flatten: true},

					// Shuffle
					{expand: true, src: ['bower_components/shufflejs/dist/*.min.js'], dest: 'vendor/js/', flatten: true},

					// Waypoints
					{expand: true, src: ['bower_components/jquery-waypoints/*.min.js'], dest: 'vendor/js/', flatten: true}
				]
			}
		},

		// Bower task sets up require config
		bower : {
			all : {
				rjsConfig : 'js/global.js'
			}
		},

		// Require config
		requirejs : {
			production : {
				options : {
					name : 'global',
					baseUrl : 'js',
					mainConfigFile : 'js/global.js',
					out : 'js/optimized.min.js'
				}
			}
		},

		// Image min
		imagemin : {
			production : {
				files : [
					{
						expand: true,
						cwd: 'images',
						src: '**/*.{png,jpg,jpeg}',
						dest: 'images'
					}
				]
			}
		},

		// SVG min
		svgmin: {
			production : {
				files: [
					{
						expand: true,
						cwd: 'images',
						src: '**/*.svg',
						dest: 'images'
					}
				]
			}
		}

	});

	// Default task
	grunt.registerTask('default', ['copy:vendor','watch']);

	// Build task
	grunt.registerTask('build', function() {
		var arr = ['jshint'];

		if (hasCopy) {
			arr.push('copy:vendor');
		}

		if (hasLess) {
			arr.push('less:production');
		}

		if (hasStylus) {
			arr.push('stylus:production');
		}

		arr.push('imagemin:production', 'svgmin:production', 'requirejs:production');

		return arr;
	});

	// Template Setup Task
	grunt.registerTask('setup', function() {
		var arr = [];

		if (hasLess) {
			arr.push['less:dev'];
		}

		if (hasCopy) {
			arr.push['copy'];
		}

		if (hasAutoprefixer) {
			arr.push('autoprefixer');
		}

		if (hasStylus) {
			arr.push('stylus:dev');
		}

		arr.push('bower-install');
	});

	// Load up tasks
	if (hasLess) {
		grunt.loadNpmTasks('grunt-contrib-less');
	}

	if (hasAutoprefixer) {
		grunt.loadNpmTasks('grunt-autoprefixer');
	}

	if (hasStylus) {
		grunt.loadNpmTasks('grunt-contrib-stylus');
	}

	if (hasCopy) {
		grunt.loadNpmTasks('grunt-contrib-copy');
	}
	
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-bower-requirejs');
	grunt.loadNpmTasks('grunt-contrib-requirejs');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-svgmin');

	// Run bower install
	grunt.registerTask('bower-install', function() {
		var done = this.async();
		var bower = require('bower').commands;
		bower.install().on('end', function(data) {
			done();
		}).on('data', function(data) {
			console.log(data);
		}).on('error', function(err) {
			console.error(err);
			done();
		});
	});

};
