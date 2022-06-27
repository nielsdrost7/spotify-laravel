const mix = require("laravel-mix");


mix.sass("resources/sass/app.scss", "/css")
    .js("resources/js/app.js", "/js")
    .js("resources/js/custom.js", "/js/custom.js")
    .js("resources/js/profile/userprofile.js", "/js/profile/userprofile.js")
    .setPublicPath("public_html");
