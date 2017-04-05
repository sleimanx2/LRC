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
            'vendor/jquery/jquery-2.1.1.min.js',
            'vendor/bootstrap/bootstrap.min.js',
            'vendor/select2/select2.min.js',
            'vendor/datetimepicker/datetimepicker.js',
            'main.js'
        ],
        'resources/assets',
        'public/dist/app.min.js'
    );

    mix.styles(
        [
            'vendor/bootstrap/bootstrap.min.css',
            'vendor/select2/select2.css',
            'vendor/datetimepicker/datetimepicker.css',
        ],
        'resources/assets',
        'public/dist/vendor.min.css'
    );

    mix.styles(
        [
            'main.css'
        ],
        'resources/assets',
        'public/dist/app.min.css'
    );
});

