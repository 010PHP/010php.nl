var gulp = require('gulp');
var less = require('gulp-less');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');
/**
 * Set base folder to work from.
 **/
var nodeDir = 'node_modules';
/**
 * Hold the less files to compile our frontend library.
 **/
var lessPaths = [
    nodeDir + "/bootstrap-less/bootstrap",
    nodeDir + "/font-awesome/less",
    nodeDir + "/bootstrap-select/less"
];
/**
 * Hold the javascript files to compile our frontend library.
 **/
var jsPaths = [
    nodeDir + "/jquery/dist/jquery.min.js",
    nodeDir + "/packery/dist/packery.pkgd.min.js",
    nodeDir + "/jquery-countdown/dist/jquery.countdown.min.js",
    nodeDir + "/bootstrap-less/js/bootstrap.min.js",
    nodeDir + "/bootstrap-select/dist/js/bootstrap-select.min.js",
    'app/Resources/js/**/*.js'
];

/**
 * Compiles our less files to our web folder.
 **/
gulp.task('less', function () {
    return gulp.src('./app/Resources/less/**/*.less')
        .pipe(less({
            paths: lessPaths
        }))
        .pipe(gulp.dest('./web/css'));
});

/**
 * Used during development, this will watch our templates and assets folder to compile new css files.
 **/
gulp.task('watch', function () {
    gulp.watch([
        './app/Resources/less/**/*.less',
        './app/Resources/views/**/*.twig'
    ], [
        'less'
    ]);9
});

/**
 * Combines all the javascript sources to our js folder.
 **/
gulp.task('concat', function () {
    return gulp.src(jsPaths)
        .pipe(concat('app.js'))
        .pipe(gulp.dest('./web/js'));
});

/**
 * Copies our font files to the public folder.
 **/
gulp.task('fonts', function () {
    gulp.src('./node_modules/font-awesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./web/fonts'));

    gulp.src('./node_modules/bootstrap-less/fonts/**/*.{ttf,woff,woff2,eof,svg}')
        .pipe(gulp.dest('./web/fonts'));
});


gulp.task('default', ['less', 'concat', 'fonts']);