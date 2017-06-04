var cacheName = "shell-content";
var filesToCache = [
    "/css/materialize-prod.css", "/codemirror/codemirror.css", "/codemirror/material.css", "/codemirror/addon/lint/lint.css", "/codemirror/addon/hint/show-hint.css", "/codemirror/addon/fold/foldgutter.css", "/js/jquery.min.js", "/js/materialize.min.js", "/js/code-render.js", "/js/code-grammar.js", "/css/trumbowyg.css", "/js/wyg.js", "/fonts/roboto/Roboto-Medium.woff2", "/fonts/roboto/Roboto-Regular.woff2", "/fonts/roboto/Roboto-Light.woff2", "/offline",
];

self.addEventListener("install", function(event) {
    self.skipWaiting();
    event.waitUntil(
        caches.open(cacheName).then(function(cache) {
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener("activate", function(event) {
  event.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName) {
          return caches.delete(key);
        }
      }));
  }).then(function(){
      return self.clients.claim();
  })
  );
});

self.addEventListener("fetch", function(event) {
    if (event.request.method !== "GET") { return; }
    event.respondWith(
        fetch(event.request).then(function(response) {
            var networkResponse = response.clone();
            caches.open(cacheName).then(function(cache) {
                cache.put(event.request, networkResponse);
            }).catch()
            return response;
        }).catch(function() {
            return caches.match(event.request);
        })
    );
});
