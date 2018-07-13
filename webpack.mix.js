let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .autoload({jquery: ['$', 'window.jQuery', 'jQuery']}) // use autoload cause bootstrap can't find jquery
   .extract([
        'lodash',
        'jquery',
        'bootstrap-sass',
        'axios',
        'vue',
        'flatpickr',
        'autosize',
        'devbridge-autocomplete'
    ])
   .js('resources/assets/js/edit-note.js', 'public/js')

   .js('resources/assets/js/auth/login.js', 'public/js')
   .js('resources/assets/js/auth/register.js', 'public/js')

   .js('resources/assets/js/notes/create-note.js', 'public/js')
   .js('resources/assets/js/notes/medicine-admission-note.js', 'public/js')
   .js('resources/assets/js/notes/medicine-discharge-note.js', 'public/js')

    .js('resources/assets/js/sandbox/vue-controlled-component.js', 'public/js')

   .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
