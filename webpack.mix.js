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
    .less('resources/less/app.less', 'public/css')
    .copyDirectory('node_modules/element-ui/lib/theme-chalk/fonts/','public/css/fonts/')
    .styles(['node_modules/element-ui/lib/theme-chalk/index.css'], 'public/css/element-ui.css');
