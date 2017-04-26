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
            'vendor/moment/moment.min.js',
            'vendor/datetimepicker/datetimepicker.js',
            'vendor/datatables/jquery.datatables.min.js',
            'vendor/sweetalert/sweetalert.min.js',
            'vendor/autogrow/jquery.autogrow.min.js',
            'vendor/toastr/toastr.min.js',
            'vendor/tagsinput/tagsinput.js',
            'main.js',
        ],
        'resources/assets',
        'public/dist/app.min.js'
    );

    mix.styles(
        [
            'vendor/bootstrap/bootstrap.min.css',
            'vendor/select2/select2.css',
            'vendor/datetimepicker/datetimepicker.css',
            'vendor/datatables/jquery.datatables.min.css',
            'vendor/sweetalert/sweetalert.min.css',
            'vendor/toastr/toastr.min.css',
            'vendor/tagsinput/tagsinput.css',
        ],
        'resources/assets',
        'public/dist/vendor.min.css'
    );

    mix.styles(
        [
            'main.css',
        ],
        'resources/assets',
        'public/dist/app.min.css'
    );
});
