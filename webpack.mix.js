const mix = require("laravel-mix");

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

mix.sass("resources/sass/app.scss", "/css")
    .js("resources/js/app.js", "/js")
    .js("resources/js/custom.js", "/js/custom.js")
    .js("resources/js/profile/userprofile.js", "/js/profile/userprofile.js")
    .setPublicPath("public_html");
