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
    <link rel="stylesheet" href="{!! asset('css/materialize.css') !!}">
    @yield('style')
    @include('partials.style')
    @if(Auth::check() AND Auth::user()->hasRole('admin'))
    <style>
        .container { width: 88% }
        header, main, footer { padding-left: 300px }
        .side-nav { overflow-y: scroll; padding-bottom: 100px }
        @media only screen and (max-width : 992px) {
            header, main, footer { padding-left: 0 }
            .side-nav li:first-child { display: none }
        }
        @media only screen and (min-width : 993px) {
            main { padding-top: 40px }
            nav { background-color: transparent; box-shadow: none}
            .side-nav li:first-child { line-height: 56px }
            .side-nav li:first-child a { background-color: #0072FF; color: white; font-size: 1.6rem; line-height: 56px; height: 96px; padding-top: 40px}
        }
    </style>
    @endif
</head>
<body>
    <!-- Always shows a header, even in smaller screens. -->
    <header>
        @if(Auth::check() AND Auth::user()->hasRole('admin'))
        @include('partials.adminnav')
        @else
        @include('partials.nav')
        @endif
    </header>
    <main>
        @yield('content')
    </main>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/materialize.min.js"></script>
    @if(Auth::check() AND Auth::user()->hasRole('admin'))
    <script type="text/javascript">
    (function($){
        $(function(){
            $('.button-collapse').sideNav({
                menuWidth: 300,
                closeOnClick: false,
                draggable: true
            });
        });
    })(jQuery);
    </script>
    @else
    <script type="text/javascript">
    (function($){
        $(function(){
            $('.button-collapse').sideNav({
                menuWidth: 300,
                closeOnClick: true,
                draggable: true
            });
        });
    })(jQuery);
    </script>
    @endif
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
                        Materialize.toast('Offline ready', 4000, 'green accent-4');
                    }
                });
            });
        }
    </script>
    @yield('scripts')
    @include('partials.session')
    <footer class="page-footer slate">
        <!-- <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="grey-text text-lighten-4">Footer Content</h5>
                    <p class="grey-text">You can use rows and columns here to organize your footer content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="grey-text text-lighten-4">Links</h5>
                    <ul>
                        <li><a class="grey-text" href="#!">Link 1</a></li>
                        <li><a class="grey-text" href="#!">Link 2</a></li>
                        <li><a class="grey-text" href="#!">Link 3</a></li>
                        <li><a class="grey-text" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
        <div class="footer-copyright">
            <div class="grey-text container full">
            © 2017 Copyright Text
            <a class="grey-text right" href="https://laurensi.us">Made by Laurensius Adi</a>
            </div>
        </div>
    </footer>
</body>
</html>
