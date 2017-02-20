//'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var input = './scss/bootstrap.scss';
var output = './dist/css';
var sassOptions = {
    errLogToConsole: true
    //outputStyle: 'compressed'
};
var autoprefixer = require('gulp-autoprefixer');
var autoprefixerOptions = {
    browsers: ['last 4 versions', '> 5%']
};

// Make sass compile and save to css folder
gulp.task('sass', function () {
    return gulp
        .src(input)
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(output));
});

// List of files to concatenate
var js = {
    jsSrc: [
        //"./js/alert.js",
        "./js/button.js",
        //"./js/carousel.js",
        "./js/collapse.js",
        //"./js/dropdown.js",
        "./js/modal.js",
        //"./js/tooltip.js",
        //"./js/popover.js",
        //"./js/tab.js",
        //"./js/scrollspy.js",
        "./js/util.js",
        "./js/custom.js"
    ]
};
gulp.task('scripts', function () {
    return gulp.src(js.jsSrc)
        .pipe(uglify())
        .pipe(concat('bootstrap.min.js'))
        .pipe(gulp.dest('./dist/js'));
});

// Create watch task
gulp.task('watch', function () {
    gulp.watch('./scss/**/*.scss', ['sass']);
    gulp.watch('./js/**/*.js', ['scripts']);
});
