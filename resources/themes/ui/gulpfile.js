const del = require('del');
const gulp = require('gulp');
const npmdist = require('gulp-npm-dist');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const autoprefixer = require("gulp-autoprefixer");
const sourcemaps = require("gulp-sourcemaps");
const cleanCSS = require('gulp-clean-css');

const paths = {
    base: {
        base: {
            dir: './'
        },
        node: {
            dir: './node_modules'
        },
        public: {
            dir: '../../../public/themes/ui'
        },
        packageLock: {
            files: './package-lock.json'
        }
    },
    dist: {
        base: {
            dir: '../../../public/themes/ui',
            files: '../../../public/themes/ui/**/*'
        },
        libs: {
            dir: '../../../public/themes/ui/libs'
        },
        fonts: {
            dir: '../../../public/themes/ui/fonts'
        },
        img: {
            dir: '../../../public/themes/ui/images'
        },
        css: {
            dir: '../../../public/themes/ui/css'
        },
        js: {
            dir: '../../../public/themes/ui/js'
        },
    },
    src: {
        base: {
            dir: './src',
            files: './src/**/*'
        },
        fonts: {
            dir: './src/assets/fonts',
            files: './src/assets/fonts/**/*'
        },
        img: {
            dir: './src/assets/images',
            files: './src/assets/images/**/*'
        },
        css: {
            dir: './src/assets/css',
            files: './src/assets/css/**/*'
        },
        js: {
            dir: './src/assets/js',
            main: './src/assets/js/*.js'
        },
        partials: {
            dir: './src/partials',
            files: './src/partials/**/*'
        },
        scss: {
            dir: './src/assets/scss',
            files: './src/assets/scss/**/*',
            main: './src/assets/scss/*.scss'
        }
    }
};

// Compiling js
gulp.task('js', function () {
    return gulp
        .src(paths.src.js.main)
        .pipe(uglify())
        .pipe(gulp.dest(paths.dist.js.dir));
});

// Compiling scss
gulp.task('scss', function () {
    return gulp
        .src(paths.src.scss.main)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(
            autoprefixer()
        )
        .pipe(gulp.dest(paths.dist.css.dir))
        .pipe(cleanCSS())
        .pipe(
            rename({
                // rename app.css to icons.min.css
                suffix: ".min"
            })
        )
        .pipe(sourcemaps.write("./")) // source maps for icons.min.css
        .pipe(gulp.dest(paths.dist.css.dir));
});

// Clean package.lock
gulp.task('clean:packageLock', function (callback) {
    del.sync(paths.base.packageLock.files);
    callback();
});

// Clean public directory
gulp.task('clean:public', function (callback) {
    del.sync(paths.base.public.dir);
    callback();
});

// Clean dist resource
gulp.task('clean:dist', function (callback) {
    del.sync(paths.dist.base.dir);
    callback();
});

// Copy theme fonts
gulp.task('copy:fonts', function () {
    return gulp
        .src(paths.src.fonts.files)
        .pipe(gulp.dest(paths.dist.fonts.dir));
});

// Copy theme images
gulp.task('copy:images', function () {
    return gulp
        .src(paths.src.img.files)
        .pipe(gulp.dest(paths.dist.img.dir));
});

// Copy theme libs
gulp.task('copy:libs', function () {
    return gulp
        .src(npmdist(), {base: paths.base.node.dir})
        .pipe(rename(function (path) {
            path.dirname = path.dirname.replace(/\/dist/, '').replace(/\\dist/, '');
        }))
        .pipe(gulp.dest(paths.dist.libs.dir));
});

// Theme compiling
gulp.task('build',
    gulp.series(
        gulp.parallel('clean:packageLock', 'clean:dist', 'copy:libs', 'copy:fonts', 'copy:images'),
        'scss', 'js'
    )
);
