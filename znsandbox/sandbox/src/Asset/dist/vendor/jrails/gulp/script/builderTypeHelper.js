var gulp = require('gulp');
var glob = require('glob');
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var concatCss = require('gulp-concat-css');
var replace = require('gulp-replace');
var csso = require('gulp-csso');
var clean = require('gulp-clean');
var helper = require('./helper');

var builder = {
    //firstCharExp: /^([\s\S]{1})/g,
    buildScript: function (sourceMap, targetDest, targetFileName, isMinify) {
        var listFilesDocBlockRails = helper.renderIncludedList(sourceMap);
        var gulp1 = gulp.src(sourceMap, { sourcemaps: true })
            .pipe(concat(targetFileName))
            // Пишем докблок со списком файлов
            //.pipe(replace(this.firstCharExp, listFilesDocBlockRails + '\n\n$1'));
            .pipe(helper.witeToBegin(listFilesDocBlockRails))
        if(isMinify === true) {
            gulp1 = gulp1.pipe(minify());
        }
        gulp1.pipe(gulp.dest(targetDest));
    },
    buildStyle: function (sourceMap, targetDest, targetFileName, isMinify) {
        var listFilesDocBlockStyle = helper.renderIncludedList(sourceMap);
        var gulp1 = gulp.src(sourceMap)
            .pipe(concatCss(targetFileName))
            // Пишем докблок со списком файлов
            //.pipe(replace(this.firstCharExp, listFilesDocBlockStyle + '\n\n$1'));
            .pipe(helper.witeToBegin(listFilesDocBlockStyle))
        if(isMinify === true) {
            gulp1 = gulp1
                .pipe(csso())
                .pipe(minify());
        }
        gulp1.pipe(gulp.dest(targetDest));
    },
    buildPage: function (data, targetDest) {
        scriptList = helper.replaceInArray(data.scriptList, './', '/');
        styleList = helper.replaceInArray(data.styleList, './', '/');
        var scriptCode = helper.generateScriptTags(scriptList);
        var styleCode = helper.generateStyleTags(styleList);
        gulp.src(['./src/index.html'])
            .pipe(replace('<!--SCRIPT_PLACEHOLDER-->', scriptCode))
            .pipe(replace('<!--STYLE_PLACEHOLDER-->', styleCode))
            .pipe(gulp.dest(targetDest));
    },
};

module.exports = builder;