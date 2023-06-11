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

mix.js('resources/js/app.js', 'public/js').vue()
    .js('resources/js/feed.js', 'public/js').vue()
    .js('resources/js/test.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/base.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/profile.scss', 'public/css')
    .sass('resources/sass/front.scss', 'public/css')
    .sass('resources/sass/feed.scss', 'public/css')
    .sass('resources/sass/matches.scss', 'public/css')
    .sass('resources/sass/mypage.scss', 'public/css')
    .sass('resources/sass/sns.scss', 'public/css')
    .sass('resources/sass/modal.scss', 'public/css');
    
    
