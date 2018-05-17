var gulp = require('gulp')
var less = require('gulp-less')

gulp.task('less', function () {
    return gulp.src('src/less/*.less')
        .pipe(less())
        .pipe(gulp.dest('css'));
})

gulp.task('watch', function () {
    gulp.watch('src/less/*.less', ['less'])
});

gulp.task('default', ['watch'])