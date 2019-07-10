var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var browserify = require('browserify');
var source = require('vinyl-source-stream');

gulp.task('sass', function() {
  gulp.src('./src/scss/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('./src/css'));
});

gulp.task('watch-css', function() {
  watch('./src/scss/*.scss', gulp.task('sass'));
});

gulp.task('browserify', function() {
  browserify('./src/app/main.js')
  .bundle()
  .pipe(source('bundle.js'))
  .pipe(gulp.dest('./src/app/'));
});

gulp.task('watch-js', function() {
  watch('./src/app/*.js', gulp.task('browserify'));
})

gulp.task('default', gulp.task('sass'));
