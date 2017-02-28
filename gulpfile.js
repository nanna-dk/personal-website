//'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var htmlmin = require('gulp-htmlmin');

// project paths
var paths = {
    webroot: "./",
    src: "./src",
    scss: "./src/scss/bootstrap.scss",
    minCss: "./dist/css",
    minJs: "./dist/js",
    templates: "./src/pages",
};

// List of .js files to concatenate
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
        "./js/customcv.js",
        "./js/custom.js"
    ]
};

// Options
var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed'
};

var autoprefixerOptions = {
    browsers: ['last 4 versions', '> 5%']
};

// Make sass compile and save to css folder
gulp.task('sass', function() {
    return gulp
        .src(paths.scss)
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(paths.minCss));
});


gulp.task('scripts', function() {
    return gulp.src(js.jsSrc)
        .pipe(uglify())
        .pipe(concat('bootstrap.min.js'))
        .pipe(gulp.dest(paths.minJs));
});
gulp.task('minifyHTML', function() {
    return gulp.src(paths.templates + '/*.+(php|html)')
        .pipe(htmlmin({
            removeComments: true,
            collapseWhitespace: true
        }))
        .pipe(gulp.dest(paths.webroot));
});

// Create watch task
gulp.task('watch', function() {
    gulp.watch(paths.src +'/scss/**/*.scss', ['sass']);
    gulp.watch(paths.src + '/js/**/*.js', ['scripts']);
    gulp.watch(paths.templates + '/**/*.+(php|html)', ['minifyHTML']);
});
