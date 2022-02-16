const mix = require('laravel-mix');
const { max } = require('lodash');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.copy('resources/assets/img', 'public/img');

mix.scripts([

    'resources/assets/js/core/popper.min.js',
    'resources/assets/js/core/bootstrap.min.js',

    'resources/assets/vendor/jquery/dist/jquery.min.js',
    'resources/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',


], 'public/adm/js/admin.js');


mix.sass('resources/assets/scss/app.scss', 'public/adm/css/admin.css');

mix.js('resources/assets/js/app.js', 'public/js');
