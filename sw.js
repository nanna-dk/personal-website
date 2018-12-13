// Service worker
var CACHE_VERSION = '0.1.2';
var CURRENT_CACHES = {
  prefetch: 'prefetch-cache-v' + CACHE_VERSION
};
var urlsToCache = [
  //'/',
  //'index.php',
  'dist/css/bootstrap.min.css',
  'dist/js/bootstrap.min.js',
  'dist/js/svgxuse.min.js',
  'dist/img/icons.svg',
  'img/icons/favicon-16x16.png',
  'img/icons/favicon-32x32.png',
  'img/icons/android-chrome-192x192.png',
  'img/icons/android-chrome-256x256.png',
  'img/icons/android-chrome-512x512.png',
  'img/icons/safari-pinned-tab.svg',
  'img/icons/mstile-150x150.png',
  'img/it-cover.jpg',
  'favicon.ico'
];

self.addEventListener('install', function (event) {
  var urlsToPrefetch = [
    'dist/css/bootstrap.min.css',
    'dist/js/bootstrap.min.js',
    'dist/js/svgxuse.min.js',
    'dist/img/icons.svg',
    'img/icons/favicon-16x16.png',
    'img/icons/favicon-32x32.png',
    'img/icons/android-chrome-192x192.png',
    'img/icons/android-chrome-256x256.png',
    'img/icons/android-chrome-512x512.png',
    'img/icons/safari-pinned-tab.svg',
    'img/icons/mstile-150x150.png',
    'img/it-cover.jpg',
    'favicon.ico'
  ];

  //console.log('Handling install event. Resources to pre-fetch:', urlsToPrefetch);
  event.waitUntil(
    caches.open(CURRENT_CACHES['prefetch']).then(function (cache) {
      cache.addAll(urlsToPrefetch.map(function (urlToPrefetch) {
        return new Request(urlToPrefetch, {
          mode: 'no-cors'
        });
      })).then(function () {
        //console.log('All resources have been fetched and cached.');
      });
    }).catch(function (error) {
      console.error('Pre-fetching failed:', error);
    })
  );
});


//event.waitUntil(self.clients.claim());

self.addEventListener('activate', function(event) {
  // Delete all caches that aren't named in CURRENT_CACHES.
  // While there is only one cache in this example, the same logic will handle the case where
  // there are multiple versioned caches.
  var expectedCacheNames = Object.keys(CURRENT_CACHES).map(function(key) {
    return CURRENT_CACHES[key];
  });

  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (expectedCacheNames.indexOf(cacheName) === -1) {
            // If this cache name isn't present in the array of "expected" cache names, then delete it.
            console.log('Deleting out of date cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    }).then(function() {
      return clients.claim();
    }).then(function() {
      // After the activation and claiming is complete, send a message to each of the controlled
      // pages letting it know that it's active.
      // This will trigger navigator.serviceWorker.onmessage in each client.
      return self.clients.matchAll().then(function(clients) {
        return Promise.all(clients.map(function(client) {
          return client.postMessage('The service worker has activated and ' +
            'taken control.');
        }));
      });
    })
  );
});


self.addEventListener('fetch', function (event) {
  console.log('Handling fetch event for', event.request.url);
  if (event.request.method !== 'GET') {
    return;
  }
  if (event.request.url.indexOf('includes/') !== -1) {
    return;
  }
  event.respondWith(
    caches.open(CURRENT_CACHES['prefetch']).then(function (cache) {
      return cache.match(event.request).then(function (response) {
        if (response) {
          console.log('Found response in cache:', response);
          return response;
        }
        console.log('Fetching request from the network');
        return fetch(event.request).then(function (networkResponse) {
          cache.put(event.request, networkResponse.clone());
          return networkResponse;
        });
      }).catch(function (error) {
        // Handles exceptions that arise from match() or fetch().
        console.error('Error in fetch handler:', error);
        throw error;
      });
    })
  );
});
