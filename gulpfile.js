// Dependencies
const gulp         = require('gulp');
const sass         = require('gulp-sass')(require('sass'));
const notify       = require('gulp-notify');
const sourcemaps   = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const uglify       = require('gulp-uglify');
const saveLicense  = require('uglify-save-license');


// Path Configs
const config = {
  sassPath: './sass',
  cssPath:  '.',
  npmPath:  './node_modules',
  globalsPath:  './node_modules/globals/g/3'
}

/**
 * Sass Configurations
 *
 * Dev and Prod configuration profiles for sass
 *
 **/

// Production
const sassOptions = {
  outputStyle: 'compressed',
  sourceComments: false,
  includePaths: [
      config.npmPath + '/bootstrap-sass/assets/stylesheets',
      config.sassPath
  ],
  precision: 10
}

//Dev
const sassDevOptions = {
  outputStyle: 'expanded',
  sourceComments: true,
  includePaths: [
      config.npmPath + '/bootstrap-sass/assets/stylesheets',
      config.sassPath
  ],
  precision: 10
}

/**
 * Uglify Options
 *
 * Tell uglify to keep certiain comments, etc
 *
 **/
const uglifyOptions = {
  output: {
    comments: saveLicense
  }
}

/**
 * Sass Compilers
 *
 * Dev and Prod compilers
 *
 **/

gulp.task('sass-dev', function() {
  return gulp
      .src(config.sassPath + '/style.scss')
      .pipe(sourcemaps.init())
      .pipe(sass(sassDevOptions).on('error', notify.onError(function (error) {
          return "Error: " + error.message;
      })))
      .pipe(autoprefixer())
      .pipe(sourcemaps.write())
      .pipe(gulp.dest(config.cssPath));
});

gulp.task('editor-sass-dev', function() {
  return gulp
      .src(config.sassPath + '/block-editor.scss')
      .pipe(sourcemaps.init())
      .pipe(sass(sassDevOptions).on('error', notify.onError(function (error) {
          return "Error: " + error.message;
      })))
      .pipe(autoprefixer())
      .pipe(sourcemaps.write())
      .pipe(gulp.dest('./css'));
});

gulp.task('sass', function() {
  return gulp
      .src(config.sassPath + '/style.scss')
      .pipe(sass(sassOptions).on('error', notify.onError(function (error) {
          return "Error: " + error.message;
      })))
      .pipe(autoprefixer())
      .pipe(gulp.dest(config.cssPath));
});

// Watch function (sass) - dev use only
gulp.task('watch',function() {
  gulp
    .watch(config.sassPath + '/**/*.scss', gulp.parallel(
      'sass-dev',
      'editor-sass-dev'
    ));
});

// Dev - full dev build
gulp.task('dev', gulp.parallel(
            'sass-dev',
            'editor-sass-dev'
          ));

// Default - full production build
gulp.task('default', gulp.parallel(
            'sass',
            'editor-sass-dev'
          ));
