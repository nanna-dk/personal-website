'use strict';
var gulp = require('gulp'),
browserSync = require('browser-sync').create(),
plumber = require('gulp-plumber'),
sass = require('gulp-sass'),
concat = require('gulp-concat'),
uglify = require('gulp-uglify'),
htmlmin = require('gulp-htmlmin'),
rename = require("gulp-rename"),
notify = require("gulp-notify"),
autoprefixer = require("gulp-autoprefixer"),
minifyJson = require('gulp-minify-inline-json'),
pump = require('pump');

// Sass compiling options:
var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed'
};

// Autoprefixer options
var autoprefixerOptions = {
  browsers: [
    "last 1 version",
    "> 1%",
    "not dead"
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
  bsJs: [
    'node_modules/jquery/dist/jquery.js',
    'node_modules/bootstrap/dist/js/bootstrap.js'
  ],
  customJs: [
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
  var arrays = res.bsJs.concat(res.customJs);
  pump([
      gulp.src(arrays),
      uglify(),
      concat("bootstrap.min.js"),
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
  gulp.watch(paths.src + '/js/**/*.js', scripts, gulp.series(reload));
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
