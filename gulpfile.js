var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


elixir(function (mix) {

    mix.scripts(
        [
            'vendor/gmap.js',
            'vendor/angular.min.js',
            'vendor/angular-animate.min.js',
            'vendor/angular-route.min.js',
            'vendor/underscore-min.js',
            'vendor/rocha.js',
            'vendor/raphael.min.js',
            'vendor/morris.min.js',
            'vendor/flot_compiled.js',
            'vendor/Chart.min.js',
            'vendor/other_charts.js',
            'vendor/angular-wizard.js',
            'vendor/angular-ui-tree.js',
            'vendor/jquery.vmap.min.js',
            'extras.js',
            'app/*.js'
        ],
        'resources/assets/scripts',
        'public/dist/app.min.js'
    )
});

