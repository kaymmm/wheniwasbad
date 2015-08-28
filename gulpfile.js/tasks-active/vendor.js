// ==== THEME ==== //

var gulp        = require('gulp'),
    bower       = './bower_components',
    plugins     = require('gulp-load-plugins')({ camelize: true }),
    config      = require('../../gulpconfig').vendor
;

// Copy bower_components to the `build` folder
gulp.task('vendor-bower-build', function() {
  return gulp.src(config.bowerIncludes, {base: bower})
  .pipe(plugins.changed(config.build))
  .pipe(gulp.dest(config.build));
});

// Copy misc. components to the `build` folder
gulp.task('vendor-src-build', function() {
  return gulp.src(config.srcIncludes, {base: './src'})
  .pipe(plugins.changed(config.build))
  .pipe(gulp.dest(config.build));
});

// Copy bower_components to the `dist` folder
gulp.task('vendor-bower-dist', function() {
  return gulp.src(config.bowerIncludes,{base: bower})
  .pipe(plugins.changed(config.dist))
  .pipe(gulp.dest(config.dist));
});

// Copy misc. components to the `dist` folder
gulp.task('vendor-src-dist', function() {
  return gulp.src(config.srcIncludes,{base: './src'})
  .pipe(plugins.changed(config.dist))
  .pipe(gulp.dest(config.dist));
});

// All the theme tasks in one
gulp.task('vendor', ['vendor-bower-build', 'vendor-src-build']);
