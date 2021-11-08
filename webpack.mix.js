const { styles } = require('laravel-mix');
const mix = require('laravel-mix');

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

mix
    .js("resources/views/System/assets/materialize/js/materialize.min.js", "public/assets/js/materialize.min.js")
    .js("resources/views/System/assets/js/system.js", "public/assets/js/system.js")
    .js("node_modules/jquery/dist/jquery.min.js", "public/assets/js/jquery.min.js")
    .js('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/assets/js/bootstrap.min.js')

    .sass('resources/views/System/assets/bootstrap-global.scss', 'public/assets/css/bootstrap.css')
    .sass('resources/views/System/assets/style.scss', 'public/assets/css/styles.css')
    .styles("resources/views/System/assets/materialize/css/materialize.min.css", "public/assets/css/materialize.min.css")
    .copyDirectory("resources/views/System/assets/images", "public/assets/images")
    .version();
