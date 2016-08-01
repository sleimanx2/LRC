<!doctype html>
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>LRC Intranet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400'
          rel='stylesheet' type='text/css'>

    <!-- Include Fonts from the theme fonts directory -->
    <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/fonts/weather-icons/css/weather-icons.min.css">

    <!-- Include App-Header in the vendor folder -->
    <script type="text/javascript" src="/dist/app-header.min.js"></script>

    <!-- Theme's own CSS file -->
    <link rel="stylesheet" href="/dist/main.min.css">

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyBTy4pD1NAVrkJFVNry7GVRfec10Q9cw5Q"></script>

    <script type="text/javascript" src="/dist/app.min.js"></script>

</head>
<body data-ng-app="app" id="app" data-custom-background="" data-off-canvas-nav="" data-ng-controller="AdminAppCtrl">

<div>
    <div data-ng-cloak="" class="no-print">
        <aside id="nav-container">
            @include('partials.sidebar')
        </aside>
    </div>

    <div class="view-container">

        <div data-ng-cloak="" class="no-print">
            <section id="header" class="top-header">
                @include('partials.header')
            </section>
        </div>

        <section id="content" class="animate-fade-up">
            <?php $success = Session::get('success') ?>
            @if($success)
                <div class="page ng-scope">
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
</body>
</html>
