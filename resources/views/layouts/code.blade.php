<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>codekita</title>
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
    <style>
        html,body { min-width: 320px; background-color: #FCFCFC}
        .gradient-1 {
            background: #0575E6;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #021B79, #0575E6);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #021B79, #0575E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
        .gradient-2 {
            background: #00c6ff; /* fallback for old browsers */
            background: -webkit-linear-gradient(to left, #00c6ff , #0072ff); /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to left, #00c6ff , #0072ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
        .slate { background: #252e36; }
        .form-small { max-width: 330px; margin: 0 auto }
        form .chip { margin-top: -8px; margin-bottom: 16px }
        body { display: flex; min-height: 100vh; flex-direction: column }
        main { flex: 1 0 auto; padding-top: 48px }
        nav { top: 0; position: fixed; z-index: 999 ; transition: top 0.25s ease-in-out; height: 48px; line-height: 48px; box-shadow: 0 0 10px 0 rgba(0,0,0,0.25); -moz-box-shadow: 0 0 10px 0 rgba(0,0,0,0.25); -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.25) }
        nav .brand-logo { font-size: 20px }
        .nav-up { top: -52px }
        .nav-wrapper { padding: 0 16px }
        @media only screen and (min-width: 601px) { .nav-up { top: -60px } }
    </style>
</head>
<body>
    <!-- Always shows a header, even in smaller screens. -->
    <header>
    <nav class="gradient-1" role="navigation">
        <div class="nav-wrapper">
            <a id="logo-container" href="{{ url('/') }}" class="brand-logo">codekita</a>
            <ul class="right hide-on-med-and-down">
                @if (!Auth::check())
                    <li><a href="{{ url('login') }}">Please log in</a></li>
                @else
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li>
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                @endif
            </ul>
            <ul id="nav-mobile" class="side-nav">
                @if (!Auth::check())
                    <li><a href="{{ url('login') }}">Please log in</a></li>
                @else
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li><a href="{{ url('user') }}">Welcome, {{ Auth::user()->name }}</a></li>
                    <li><a href="{{ url('logout') }}">Logout</a></li>
                @endif
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
    </nav>
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
            <div class="grey-text container">
            © 2017 Copyright Text
            <a class="grey-text right" href="https://laurensi.us">Made by Laurensius Adi</a>
            </div>
        </div>
    </footer>
</body>
</html>
