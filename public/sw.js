var cacheName = "shell-content";
var filesToCache = [
    "/css/materialize-prod.css", "/css/datatables.materialize.css", "/css/mocha.css",
    "/js/mocha.js", "/js/expect.js", "/js/jquery.expect.js", "/js/jquery.datatables.min.js", "/js/jquery.min.js", "/js/materialize.min.js", "/js/code-render.js", "/js/code-grammar.js", "/css/trumbowyg.css", "/js/wyg.js",
    "/codemirror/codemirror.css", "/codemirror/codemirror.js", "/codemirror/material.css", "/codemirror/addon/lint/lint.css", "/codemirror/addon/hint/show-hint.css", "/codemirror/addon/fold/foldgutter.css", "/codemirror/addon/comment/comment.js", "/codemirror/addon/lint/lint.js", "/codemirror/addon/hint/show-hint.js", "/codemirror/addon/fold/foldcode.js", "/codemirror/addon/fold/foldgutter.js", "/codemirror/codemirror_grammar.min.js", "/codemirror/grammars/css.js", "/codemirror/grammars/htmlmixed.js", "/codemirror/grammars/javascript.js", "/codemirror/addon/mode/xml.js", "/codemirror/addon/mode/htmlmixed.js", "/codemirror/addon/mode/css.js", "/codemirror/addon/mode/javascript.js",
    "/fonts/worksans/WorkSans-Light.ttf", "/fonts/worksans/WorkSans-Regular.ttf", "/fonts/worksans/WorkSans-SemiBold.ttf", "/fonts/worksans/WorkSans-Bold.ttf", "/fonts/MaterialIcons-Regular.ttf", "/fonts/MaterialIcons-Regular.woff", "/fonts/MaterialIcons-Regular.woff2",
    "/images/coderoom-logo-white.svg", "/images/coderoom-logo-white.svg", "/images/coderoom-type-emblem.svg", "/images/favicon32x32.png", "/images/icons.svg",
    "/images/icons/icon-72x72.png", "/images/icons/icon-96x96.png", "/images/icons/icon-128x128.png", "/images/icons/icon-144x144.png", "/images/icons/icon-152x152.png", "/images/icons/icon-192x192.png", "/images/icons/icon-384x384.png", "/images/icons/icon-512x512.png",
    "/offline"
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
    if (event.request.url !== "/sw.js" && event.request.url.split('.').pop().match(/^(js|css|png|svg|ttf|woff|woff2)$/)) {
        event.respondWith(
            caches.match(event.request).then(function(response) {
                return response || fetch(event.request);
            })
        );
    }
    else {
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
    }
});
