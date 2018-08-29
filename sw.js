// Service worker

const version = '0.1.0';
const cacheName = 'NEL-${version}';
self.addEventListener('install', e => {
  e.waitUntil(caches.open(cacheName).then(cache => {
    return cache.addAll([
      '/',
      'index.php',
      'dist/css/bootstrap.min.css',
      'dist/js/bootstrap.min.js',
      'dist/js/svgxuse.min.js',
      'img/icons/favicon-16x16.png',
      'img/icons/favicon-32x32.png',
      'img/icons/android-chrome-192x192.png',
      'img/icons/android-chrome-256x256.png',
      'img/icons/android-chrome-512x512.png',
      'img/it-cover.jpg',
      'img/icons.svg',
      'favicon.ico'
    ]).then(() => self.skipWaiting());
  }));
});

self.addEventListener('activate', event => {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
  event.respondWith(caches.open(cacheName).then(cache => cache.match(event.request, {ignoreSearch: true})).then(response => {
    return response || fetch(event.request);
  }));
});
