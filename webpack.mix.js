const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.options({
//    processCssUrls: true,
// });
// mix.sass('resources/assets/sass/materialize.scss', 'public/css/materialize-sass.css');

// mix.styles([
//     'public/codemirror/material.css',
//     'public/codemirror/addon/lint/lint.css',
//     'public/codemirror/addon/hint/show-hint.css',
//     'public/codemirror/addon/fold/foldgutter.css',
// ], 'public/codemirror/codemirror-all.css');

mix.styles([
    'public/css/materialize.css',
], 'public/css/materialize-prod.css');

// mix.scripts([
//     'public/codemirror/codemirror.js',
// ], 'public/codemirror/codemirror-prod.js');
// mix.scripts([
//     'public/codemirror/addon/comment/comment.js',
//     'public/codemirror/addon/lint/lint.js',
//     'public/codemirror/addon/hint/show-hint.js',
//     'public/codemirror/addon/fold/foldcode.js',
//     'public/codemirror/addon/fold/foldgutter.js',
//     'public/codemirror/grammars/css.js',
//     'public/codemirror/grammars/htmlmixed.js',
//     'public/codemirror/grammars/javascript.js',
//     'public/codemirror/codemirror_grammar.min.js',
//     'public/codemirror/addon/mode/xml.js',
//     'public/codemirror/addon/mode/htmlmixed.js',
//     'public/codemirror/addon/mode/css.js',
//     'public/codemirror/addon/mode/javascript.js',
// ], 'public/js/codemirror-all.js');

// mix.scripts([
//     'public/js/trumbowyg.js',
//     'public/js/trumbowyg.preformatted.js'
// ], 'public/js/wyg.js');

// mix.scripts([
//     'public/js/demo.js',
//     // 'public/js/jquery.expect.js',
//     // 'public/js/expect.js',
//     'public/js/main.js'
// ], 'public/js/all.js');
