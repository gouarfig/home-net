var gulp = require('gulp'),
    concat = require('gulp-concat'),
    cssmin = require('gulp-cssmin'),
    uglify = require('gulp-uglify'),
    del = require('del');

gulp.task('default', function() {

});

gulp.task('clean', ['clean:js']);

gulp.task('clean:js', function() {
    return del([
        'app/*.js',
        'app/*.js.map',
    ]);
});