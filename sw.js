const STATIC_CACHE_NAME = 'static-cache-v2';
const APP_CACHE_NAME = 'app-cache-v2';

const CACHE_APP = [
  '/',
  'index.php',
  'admin.php'
];
const CACHE_STATIC = [
  'manifest.json',
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

self.addEventListener('install', function (e) {
  e.waitUntil(
    Promise.all([caches.open(STATIC_CACHE_NAME), caches.open(APP_CACHE_NAME), self.skipWaiting()]).then(function (storage) {
      var static_cache = storage[0];
      var app_cache = storage[1];
      return Promise.all([static_cache.addAll(CACHE_STATIC), app_cache.addAll(CACHE_APP)]);
    })
  );
});

self.addEventListener('activate', function (e) {
  e.waitUntil(
    Promise.all([
            self.clients.claim(),
            caches.keys().then(function (cacheNames) {
        return Promise.all(
          cacheNames.map(function (cacheName) {
            if (cacheName !== APP_CACHE_NAME && cacheName !== STATIC_CACHE_NAME) {
              console.log('deleting', cacheName);
              return caches.delete(cacheName);
            }
          })
        );
      })
    ])
  );
});

self.addEventListener('fetch', function (e) {
  const url = new URL(e.request.url);
  if (url.hostname === 'static.mysite.co' || url.hostname === 'cdnjs.cloudflare.com' || url.hostname === 'fonts.googleapis.com') {
    console.log('STATIC_CACHE_NAME');
    e.respondWith(
      caches.match(e.request).then(function (response) {
        if (response) {
          return response;
        }
        var fetchRequest = e.request.clone();

        return fetch(fetchRequest).then(function (response) {
          if (!response || response.status !== 200 || response.type !== 'basic') {
            return response;
          }
          var responseToCache = response.clone();
          caches.open(STATIC_CACHE_NAME).then(function (cache) {
            cache.put(e.request, responseToCache);
          });
          return response;
        });
      })
    );
  } else if (CACHE_APP.indexOf(url.pathname) !== -1) {
    console.log('Cache app');
    e.respondWith(caches.match(e.request));
  }
});
