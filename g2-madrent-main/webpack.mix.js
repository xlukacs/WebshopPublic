const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/index.scss', 'public/css')
    .sass('resources/sass/products.scss', 'public/css')
    .sass('resources/sass/profile/profile.scss', 'public/css')
    .sass('resources/sass/components.scss', 'public/css')
    .sass('resources/sass/admin/adminPanel.scss', 'public/css')
    .sourceMaps()
    .js('resources/js/custom.js', 'public/js');
