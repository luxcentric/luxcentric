/* File: gulpfile.js */

var fs = require('fs');
var gulp = require('gulp');

// Project plugins
var cleanCss = require('gulp-clean-css');

// Configuration
var config = require('./package.json').gulp;

gulp.task('default', function() {
    return gulp.src('./style.css')
        .pipe(cleanCss())
        .pipe(gulp.dest('./'));
});

