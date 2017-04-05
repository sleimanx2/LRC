<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>LRC Intranet</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>

        <!-- Include Fonts from the theme fonts directory -->
        <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">

        <!-- Theme's own CSS file -->
        <link rel="stylesheet" href="/dist/app.min.css">
    </head>
    <body>
        <div>
            <div>
                @yield('content')
            </div>
        </div>

        <!--Uncomment for deployment using Grunt-->
        <script type="text/javascript" src="/dist/app.min.js"></script>
    </body>
</html>