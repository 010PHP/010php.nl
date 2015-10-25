var gulp = require('gulp');
var less = require('gulp-less');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');

var nodeDir = 'node_modules';
var lessPaths = [
    nodeDir + "/bootstrap-less/bootstrap",
    nodeDir + "/font-awesome/less",
    nodeDir + "/bootstrap-select/less"
];
var jsPaths = [
    nodeDir + "/jquery/dist/jquery.min.js",
    nodeDir + "/bootstrap-less/js/bootstrap.min.js",
    nodeDir + "/bootstrap-select/dist/js/bootstrap-select.min.js"
];

gulp.task('less', function () {
    return gulp.src('./app/Resources/less/**/*.less')
        .pipe(less({
            paths: lessPaths
        }))
        .pipe(gulp.dest('./web/css'));
});

gulp.task('watch', function() {
    gulp.watch('./app/Resources/less/**/*.less', ['less']);
});

gulp.task('concat', function () {
    return gulp.src(jsPaths)
        .pipe(concat('app.js'))
        .pipe(gulp.dest('./web/js'));
});

gulp.task('fonts', function () {
    gulp.src('./node_modules/font-awesome/fonts/**/*.{ttf,woff,eof,svg}')
        .pipe(gulp.dest('./web/fonts'));

    gulp.src('./node_modules/bootstrap-less/fonts/**/*.{ttf,woff,eof,svg}')
        .pipe(gulp.dest('./web/fonts'));
});

gulp.task('default', ['less', 'concat','fonts']);