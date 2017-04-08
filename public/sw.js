var cacheName = 'shell-content';
var filesToCache = [
    '/css/app.css',
    '/css/materialize.css',
    '/js/app.js',
    '/js/jquery.min.js',
    '/js/materialize.min.js',
    '/fonts/roboto/Roboto-Medium.woff2',
    '/fonts/roboto/Roboto-Regular.woff2',
    '/fonts/roboto/Roboto-Light.woff2',
    '/offline',
];

self.addEventListener('install', function(e) {
    console.log('[ServiceWorker] Install');
    self.skipWaiting();
    console.log('[ServiceWorker] Skip waiting');
    e.waitUntil(
        caches.open(cacheName).then(function(cache) {
            console.log('[ServiceWorker] Caching app shell');
            return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activate');
  e.waitUntil(
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

self.addEventListener('fetch', function(e) {
    console.log('[ServiceWorker] Fetch', e.request.url)
    e.respondWith(
        caches.open(cacheName).then(function(cache) {
            return cache.match(e.request).then(function(response) {
                var fetchPromise = fetch(e.request).then(function(networkResponse) {
                    cache.put(e.request, networkResponse.clone());
                    console.log('[ServiceWorker] Network Fetch', e.request.url)
                    return networkResponse;
                })
                return response || fetchPromise;
            })
        })
    );
});

// self.addEventListener('fetch', function(e) {
//     console.log('[ServiceWorker] Fetch', e.request.url)
//     e.respondWith(
//         fetch(e.request).catch(function() {
//             console.log('[ServiceWorker] Return cache', e.request.url);
//             return caches.match(e.request);
//         })
//     );
// });

// self.addEventListener('fetch', function(e) {
//     console.log('[ServiceWorker] Fetch', e.request.url)
//     e.respondWith(
//         // console.log('[ServiceWorker] Return cache', e.request.url)
//         caches.match(e.request).then(function(response) {
//             // console.log('[ServiceWorker] Network Fallback', e.request.url);
//             return response || fetch(e.request);
//         }).catch(function() {
//             console.log('[ServiceWorker] Cache Fallback', e.request.url)
//             return caches.match(e.request);
//         })
//     );
// });
