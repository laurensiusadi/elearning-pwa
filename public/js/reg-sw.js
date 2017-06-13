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
}
