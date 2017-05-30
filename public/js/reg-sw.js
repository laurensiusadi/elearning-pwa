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
