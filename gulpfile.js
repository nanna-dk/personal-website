'use strict';
var gulp = require('gulp'),
  browserSync = require('browser-sync').create(),
  reload = browserSync.reload,
  plumber = require('gulp-plumber'),
  sass = require('gulp-sass'),
  concat = require('gulp-concat'),
  jshint = require("gulp-jshint"),
  uglify = require('gulp-uglify'),
  babel  = require('gulp-babel'),
  htmlmin = require('gulp-htmlmin'),
  rename = require("gulp-rename"),
  notify = require("gulp-notify"),
  autoprefixer = require("gulp-autoprefixer"),
  minifyJson = require('gulp-minify-inline-json'),
  pump = require('pump'),
  jsStylish = require('jshint-stylish'),
  svgmin = require('gulp-svgmin');

// Sass compiling options:
var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'compressed'
};

// Autoprefixer options
var autoprefixerOptions = {
  browsers: [
    "last 1 version", "> 1%", "not dead"
  ],
  cascade: false
};

// project paths
var paths = {
  root: "./",
  page: "source.html",
  src: "./src",
  minCss: "./dist/css",
  minJs: "./dist/js",
  minImg: "./dist/img"
};

// List of rssource files to concatenate
var res = {
  bsJs: [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js'
  ],
  customJs: [paths.src + '/js/custom.js'],
  cssSrc: [paths.src + '/scss/custom.scss'],
  minImg: paths.src + '/img/*.svg'
};

function serve(done) {
  browserSync.init({
    host: '127.0.0.1',
    port: 8080,
    open: 'external',
    proxy: '127.0.0.1:8080/personal-website/',
    //server: paths.root,
    index: paths.page,
    online: true,
    notify: false
  });
  done();
}

function imgMin() {
  return gulp
    .src(res.minImg)
    .pipe(svgmin({
        plugins: [{
            cleanupIDs: false
        }, {
            removeUselessDefs: false
        }, {
            removeTitle: false
        }, {
            removeDimensions: false
        }, {
            removeViewBox: false
        }]
    }))
    .pipe(gulp.dest(paths.minImg));
}

// Compile styles
function styles() {
  return gulp
    .src(res.cssSrc)
    .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(concat("bootstrap.min.css"))
    .pipe(gulp.dest(paths.minCss))
    .pipe(browserSync.stream());
}

// Lint scripts
function scriptsLint() {
  var arrays = res.customJs.concat('sw.js');
  return gulp
    .src(arrays)
    .pipe(plumber())
    .pipe(jshint())
    .pipe(jshint.reporter(jsStylish));
  //.pipe(jshint.reporter('fail'));
}

// Transpile, concatenate and minify scripts
function scripts() {
  var arrays = res.bsJs.concat(res.customJs);
  return gulp
    .src(arrays)
    .pipe(plumber())
    .pipe(concat("bootstrap.min.js"))
    .pipe(babel())
    .pipe(uglify())
    .pipe(gulp.dest(paths.minJs))
    .pipe(browserSync.stream());
}

function renameExt() {
  return gulp
    .src(paths.page)
    .pipe(htmlmin({
      removeComments: true,
      collapseWhitespace: true
    }))
    .pipe(rename({
      basename: "index",
      extname: ".php"
    }))
    .pipe(minifyJson())
    .pipe(gulp.dest(paths.root));
}

function watch() {
  gulp
    .watch(res.minImg, imgMin)
    .on("change", reload);
  gulp
    .watch(res.cssSrc, styles)
    .on("change", reload);
  gulp
    .watch(paths.src + '/js/**/*.js', gulp.series(scriptsLint, scripts))
    .on("change", reload);
  gulp
    .watch(paths.page, renameExt)
    .on("change", reload);
}

gulp.task("js", gulp.series(scriptsLint, scripts));

var build = gulp.parallel(styles, "js", renameExt, imgMin);
gulp.task('default', gulp.series(serve, watch, build));
