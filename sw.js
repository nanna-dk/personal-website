// Service worker
var version = '0.1.0';
var cacheName = 'NEL-${version}';
var urlsToCache = [
  '/',
  'index.php',
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

self.addEventListener('install', function(event) {
  event.waitUntil(caches.open(cacheName).then(function(cache) {
    return cache.addAll(urlsToCache);
  }));
});

self.addEventListener('activate', function(event) {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', function(event) {
  event.respondWith(caches.match(event.request).then(function(response) {
    if (response) {
      return response;
    }
    var fetchRequest = event.request.clone();
    return fetch(fetchRequest).then(function(response) {
      if (!response || response.status !== 200 || response.type !== 'basic') {
        return response;
      }
      var responseToCache = response.clone();
      caches
        .open(cacheName)
        .then(function(cache) {
          cache.put(event.request, responseToCache);
        });
      return response;
    });
  }));
});
