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
            'vendor/select2.min.js',
            'extras.js',
            'app/*.js'
        ],
        'resources/assets/scripts',
        'public/dist/app.min.js'
    );

    mix.scripts(
        [
            'vendor/jquery-2.1.1.min.js',
            'vendor/bootstrap.min.js'
        ],
        'resources/assets/scripts',
        'public/dist/app-header.min.js'
    );

    mix.styles(
        [
            'bootstrap.min.css',
            'bootstrap-theme.min.css',
            'select2.css',
            'main.css',
        ],
        'resources/assets/styles',
        'public/dist/main.min.css'
    );
});

