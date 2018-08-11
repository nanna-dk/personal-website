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
var pump = require('pump');

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
  page: "source.html",
  src: "./src",
  minCss: "./dist/css",
  minJs: "./dist/js"
};

// List of rssource files to concatenate
var res = {
  jsSrc: [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
     paths.src + '/js/custom.js'
  ],
  cssSrc: [
     paths.src + '/scss/custom.scss'
  ]
};

function reload(done) {
  browserSync.reload();
  done();
}

function serve(done) {
  browserSync.init({
      server: "./",
      //proxy: '127.0.0.1:8080',
      index: paths.page,
      online: true,
      notify: false
  });
  done();
}

function styles() {
  return gulp.src(res.cssSrc)
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(concat("bootstrap.min.css"))
    .pipe(gulp.dest(paths.minCss))
    .pipe(browserSync.stream());
}

function scripts(cb) {
  pump([
      gulp.src(res.jsSrc),
      concat("bootstrap.min.js"),
      uglify(),
      gulp.dest(paths.minJs),
      browserSync.stream()
    ],
      cb
    );
}

function renameExt() {
  return gulp.src(paths.page)
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
}

function watch() {
  gulp.watch(res.cssSrc, styles, gulp.series(reload));
  gulp.watch(res.jsSrc, scripts, gulp.series(reload));
  gulp.watch(paths.page, renameExt).on('change', browserSync.reload);
}

exports.reload = reload;
exports.styles = styles;
exports.scripts = scripts;
exports.renameExt = renameExt;
exports.watch = watch;

var build = gulp.parallel(styles, scripts, renameExt);

gulp.task('build', build);

gulp.task('default', gulp.series(serve, watch, build));
