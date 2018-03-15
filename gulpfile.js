//'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var htmlmin = require('gulp-htmlmin');
var rename = require('gulp-rename');
var livereload = require('gulp-livereload');
var wait = require('gulp-wait2'); // Required on localhost

// project paths
var paths = {
    webroot: "./",
    src: "./src",
    scss: "./src/scss/bootstrap.scss",
    minCss: "./dist/css",
    minJs: "./dist/js",
    pages: "./src/pages",
    templates: './src/templates'
};

// List of .js files to concatenate
var js = {
    jsSrc: [
        //"./js/alert.js",
        //paths.src + "/js/button.js",
        //"./js/carousel.js",
        paths.src + "/js/collapse.js",
        //"./js/dropdown.js",
        paths.src + "/js/modal.js",
        //"./js/tooltip.js",
        //"./js/popover.js",
        //"./js/tab.js",
        //"./js/scrollspy.js",
        paths.src + "/js/util.js",
        paths.src + "/js/custom.js"
        //paths.src + "/js/gitHubStats.js"
    ]
};

// Options
var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed'
};

var autoprefixerOptions = {
    browsers: ['last 2 versions', '> 2%']
};

gulp.task('sass', function() {
    return gulp.src(paths.scss)
        .pipe(sass(sassOptions).on('error', sass.logError))
        .pipe(autoprefixer(autoprefixerOptions))
        .pipe(concat('style.css'))
        .pipe(gulp.dest(paths.minCss))
        .pipe(livereload());
});

gulp.task('scripts', function() {
    return gulp.src(js.jsSrc)
        .pipe(uglify())
        .pipe(concat('bootstrap.min.js'))
        .pipe(gulp.dest(paths.minJs))
        .pipe(livereload());
});

gulp.task('rename', function() {
    return gulp.src(paths.webroot + '/*.html')
        //.pipe(wait(5000))
        .pipe(rename({
          basename: "index",
          extname: ".php"
        }))
        .pipe(gulp.dest(paths.webroot));
});

gulp.task('minifyHTML', ['rename'], function() {
    return gulp.src(paths.webroot + '/*.php')
        .pipe(htmlmin({
            removeComments: true,
            collapseWhitespace: true
        }))
        .pipe(gulp.dest(paths.webroot))
        .pipe(livereload());
});

// Create watch task
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch(paths.src + '/scss/**/*.scss', ['sass']);
    gulp.watch(paths.src + '/js/**/*.js', ['scripts']);
    gulp.watch(paths.webroot + '/*.html', ['rename', 'minifyHTML']);
});
