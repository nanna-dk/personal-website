'use strict';
var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var htmlmin = require('gulp-htmlmin');
var rename = require("gulp-rename");
var notify = require("gulp-notify");
var autoprefixer = require("gulp-autoprefixer");
var minifyJson = require('gulp-minify-inline-json');

// Sass compiling options:
var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed'
};

// Autoprefixer options
var autoprefixerOptions = {
  browsers: [
    "last 1 major version",
    ">= 1%",
    "Chrome >= 45",
    "Firefox >= 38",
    "Edge >= 12",
    "Explorer >= 10",
    "iOS >= 9",
    "Safari >= 9",
    "Android >= 4.4",
    "Opera >= 30"
  ],
  cascade: false
};

// project paths
var paths = {
  root: "./",
  src: "./src",
  minCss: "./dist/css",
  minJs: "./dist/js"
};

// List of rssource files to concatenate
var res = {
  jsSrc: [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
     paths.src + "/js/custom.js"
  ],
  cssSrc: [
     paths.src + '/scss/custom.scss'
  ]
};

gulp.task('browser-sync', ['sass'], function() {
    browserSync.init({
        server: "./",
        //proxy: '127.0.0.1:8080',
        index: "source.html",
        online: true,
        notify: false
    });
    gulp.watch(res.cssSrc, ['sass']);
    gulp.watch(res.jsSrc, ['scripts']);
});

gulp.task('sass', function() {
  return gulp.src(res.cssSrc)
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(concat("bootstrap.min.css"))
    .pipe(gulp.dest(paths.minCss))
    .pipe(browserSync.stream());
});

gulp.task('scripts', function() {
  return gulp.src(res.jsSrc)
    .pipe(concat("bootstrap.min.js"))
    .pipe(uglify())
    .pipe(gulp.dest(paths.minJs))
    .pipe(browserSync.stream());
});

gulp.task('minifyJson', function() {
  return gulp.src(res.root + 'includes/tpl/structuredData.php')
    .pipe(minifyJson())
    .pipe(gulp.dest(paths.root + 'includes/tpl/structuredData.php'));
});

gulp.task('rename', function() {
  return gulp.src(paths.root + '/*.html')
    .pipe(rename({
      basename: "index",
      extname: ".php"
    }))
    .pipe(htmlmin({
        removeComments: true,
        collapseWhitespace: true
    }))
    .pipe(minifyJson())
    .pipe(gulp.dest(paths.root));
});

gulp.task('watch', ['browser-sync'], function () {
    gulp.watch(res.cssSrc, ['sass']);
    gulp.watch(res.jsSrc, ['scripts']);
    gulp.watch(paths.root + '/*.html', ['rename']).on('change', browserSync.reload);
});
