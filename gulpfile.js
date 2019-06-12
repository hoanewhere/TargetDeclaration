var gulp = require('gulp');
var minifycss = require('gulp-minify-css');
var sass = require('gulp-sass');
var watch = require('gulp-watch');

gulp.task('sass', function() {
  gulp.src('./src/scss/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('./src/css'));
});

gulp.task('watch', function() {
  watch('./src/scss/*.scss', gulp.task('sass'));
});

gulp.task('default', gulp.task('sass'));
