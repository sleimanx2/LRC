<!doctype html>
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>LRC Intranet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/fonts/weather-icons/css/weather-icons.min.css">

    <link rel="stylesheet" href="/dist/vendor.min.css">
    <link rel="stylesheet" href="/dist/app.min.css">

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyC2OagaYbI14yXJ9D_i-4401gYT0FZN9LY"></script>
    <script type="text/javascript" src="/dist/app.min.js"></script>

</head>
<body>
    <div>
        <div class="phonebook-container">
            @include('partials.phonebook')
        </div>

        <div class="view-container">
            <div class="no-print">
                <section id="header" class="top-header">
                    @include('partials.header')
                </section>
                <section id="sub-header" class="sub-header">
                    @yield('sub-header')
                </section>
            </div>

            <section id="content" class="animate-fade-up">
                <?php $success = Session::get('success') ?>
                @if($success)
                <div class="page">
                    <div class="row">
                        <div class="col-xs-12">
                            <section class="panel panel-default">
                                <div class="panel-body">
                                    <div class="callout-elem callout-elem-success">
                                        <h5>{{ $success }}</h5>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                @endif

                @yield('content')
            </section>
        </div>
    </div>

    @include('partials.common')

@yield('script')
</body>
</html>
