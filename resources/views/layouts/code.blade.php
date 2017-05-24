<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>coderoom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <!-- Add to homescreen for Chrome on Android -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#00c6ff">
    <meta name="mobile-web-app-capable" content="yes">
    <!-- <link rel="icon" sizes="192x192" href="images/android-desktop.png"> -->
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="codekita">
    <!-- <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png"> -->
    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <!-- <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF"> -->
    <!-- <link rel="shortcut icon" href="images/favicon.png"> -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,light,bolditalic&amp;lang=en"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{!! asset('css/materialize-prod.css') !!}">
    @yield('style')
    @include('partials.style')
    <style>
        main { flex: 1 0 auto; padding-top: 48px; padding-bottom: 0 }
    </style>
</head>
<body>
    <!-- Always shows a header, even in smaller screens. -->
    <header>
    @include('partials.nav')
    </header>
    <main>
        @yield('content')
    </main>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/materialize.min.js"></script>
    <script type="text/javascript">
    (function($){
        $(function(){
            $('.button-collapse').sideNav();
        });
    })(jQuery);
    </script>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                // Registration was successful
                console.log('[ServiceWorker] Registration successful with scope: ', registration.scope);
            }).catch(function(err) {
                // registration failed :(
                console.log('[ServiceWorker] Registration failed: ', err);
            });
            navigator.serviceWorker.addEventListener('controllerchange', function(event) {
                console.log(
                '[controllerchange] A "controllerchange" event has happened ' +
                'within navigator.serviceWorker: ', event
                );
                navigator.serviceWorker.controller.addEventListener('statechange', function() {
                    console.log('[controllerchange][statechange] ' + 'A "statechange" has occured: ', this.state);
                    if (this.state === 'activated') {
                         Materialize.toast('You are offline ready!', 2000);
                    }
                });
            });
        }
    </script>
    @yield('scripts')
    <footer class="page-footer slate">
        <div class="footer-copyright">
            <div class="grey-text container full">
            © 2017 Copyright Text
            <a class="grey-text right" href="https://laurensi.us">Made by Laurensius Adi</a>
            </div>
        </div>
    </footer>
</body>
</html>
