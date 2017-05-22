var cacheName = 'shell-content';
var filesToCache = [
    '/css/app.css',
    '/css/materialize.css',
    '/js/all.js',
    '/js/jquery.min.js',
    '/js/materialize.min.js',
    '/js/codemirror.js',
    '/js/trumbowyg.min.js',
    '/fonts/roboto/Roboto-Medium.woff2',
    '/fonts/roboto/Roboto-Regular.woff2',
    '/fonts/roboto/Roboto-Light.woff2',
    '/offline',
];

self.addEventListener('install', function(event) {
    console.log('[ServiceWorker] Install');
    self.skipWaiting();
    console.log('[ServiceWorker] Skip waiting');
    event.waitUntil(
        caches.open(cacheName).then(function(cache) {
            console.log('[ServiceWorker] Caching app shell');
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('activate', function(event) {
  console.log('[ServiceWorker] Activate');
  event.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
  }).then(function(){
      console.log('[ServiceWorker] Claiming clients for version', cacheName);
      return self.clients.claim();
  })
  );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request).then(function(response) {
            var networkResponse = response.clone();
            caches.open(cacheName).then(function(cache) {
                cache.put(event.request, networkResponse);
            }).catch()
            return response;
        }).catch(function() {
            console.log('[ServiceWorker] Cache Fallback', event.request.url);
            return caches.match(event.request);
        })
    );
});
