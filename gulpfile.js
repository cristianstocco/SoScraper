var gulp = require('gulp');
var argv = require('yargs').argv;
 var notify = require('gulp-notify'); // Sends message notification to you
 var mmq          = require('gulp-merge-media-queries'); // Combine matching media queries into one media query definition.

var $ = require('gulp-load-plugins')({
  lazy: true,
  scope: ['devDependencies'],
  rename: {
    'gulp-if': 'gif'
  }
});

// add file header
var pkg = require('./package.json');
var banner = ['/*',
  'Author: <%= pkg.author.name %>',
  'Author URI: <%= pkg.author.url %>',
  'Description: <%= pkg.description %>',
  'Version: <%= pkg.version %>',
  'License: <%= pkg.license.name %>',
  'License URI: <%= pkg.license.url %>',
  'Text domain: <%= pkg.name %>',
  ' */',
  ''].join('\n');

if (argv.pretty) {
  $.util.log($.util.colors.bgMagenta('Pretty mode ON. Tutti i files non verranno minificati.'));
}

// Sass task, will run when any SCSS files change & BrowserSync
// will auto-update browsers
gulp.task('sass', function () {
  return gulp.src('resources/assets/css/**/**.scss')
    .pipe($.gif(argv.pretty, $.sourcemaps.init()))
    .pipe($.sass())
    .pipe($.plumber())
    .pipe($.autoprefixer({
      browsers: ["last 3 versions", "ie >= 9", "and_chr >= 2.3", "> 1%", "ie 8", "ie 7"]
    }))
    .pipe($.gif(argv.pretty, $.sourcemaps.write('.')))
    .pipe($.gif(!argv.pretty, $.cssnano()))
    .pipe($.header(banner, { pkg : pkg } ))
    .pipe($.plumber.stop())
    .pipe($.gif(argv.pretty, $.size({title: 'CSS'})))
    .pipe(gulp.dest('./public/css/'))
    .pipe( mmq( { log: true } ) ) // Merge Media Queries only for .min.css version.
    .pipe( notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) )
});

// Basic js concat and error-check
gulp.task('js', function() {
  gulp.src(['./resources/assets/js/vendor/**/*.js', './resources/assets/js/build/**/*.js'])
    .pipe($.gif(argv.pretty, $.sourcemaps.init()))
    .pipe($.concat('application.min.js'))
    .pipe($.gif(argv.pretty, $.sourcemaps.write('.')))
    .pipe($.gif(!argv.pretty, $.uglify({ mangle: true })))
    .pipe($.header(banner, { pkg : pkg } ))
    .pipe($.size({title: 'Scripts'}))
    .pipe(gulp.dest('./public/js'))
    .pipe( notify( { message: 'TASK: "Dave_js" Completed! 💯', onLast: true } ) );

});

gulp.task('watch', function() {
  gulp.watch('./resources/assets/css/**/*.scss', ['sass']).on('change', function(event) {
    $.util.log($.util.colors.green('File ' + event.path + ' was ' + event.type + ', running tasks...'));
  });
  gulp.watch(['./resources/assets/js/vendor/**/*.js', './resources/assets/js/build/**/*.js'], ['js']).on('change', function(event) {
    $.util.log($.util.colors.blue('File ' + event.path + ' was ' + event.type + ', running tasks...'));
  });
});

// Default task to be run with `gulp`
gulp.task('default', ['sass', 'js', 'watch']);
