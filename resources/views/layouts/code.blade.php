<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Aksara</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Offline Capable Web Dev Course">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#252E36">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" href="/images/favicon32x32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/icons/icon-192x192.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Aksara">
    <link rel="apple-touch-icon" type="image/png" sizes="192x192" href="/images/icons/icon-192x192.png">
    <link rel="stylesheet" href="{!! asset('css/materialize-prod.css') !!}">
    @include('partials.style')
    @yield('style')
    <style>
        main { flex: 1 0 auto; padding-top: 54px; padding-bottom: 0 }
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
    if ("serviceWorker" in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register("/sw.js").then(function(registration) {
                console.log("[ServiceWorker] Registration successful with scope: ", registration.scope);
            }).catch(function(err) {
                console.log("[ServiceWorker] Registration failed: ", err);
            });
        });
        navigator.serviceWorker.addEventListener("controllerchange", function(event) {
            navigator.serviceWorker.controller.addEventListener("statechange", function() {
                if (this.state === "activated") {
                    Materialize.toast("Offline ready", 4000, "green accent-4");
                }
            });
        });
    }</script>
    @yield('scripts')
    <footer class="page-footer slate">
        <div class="footer-copyright">
            <div class="grey-text container full">
            © 2017 Copyright
            <a class="grey-text right" href="https://laurensi.us">Made by Laurensius Adi</a>
            </div>
        </div>
    </footer>
</body>
</html>
