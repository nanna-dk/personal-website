var version = '1.0';
var cacheName = 'web-cache-' + version;
var dataCacheName = 'web-data-' + version;

//app cache files and data
var filesToCache = [
  '/',
  'index.php',
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

var cachableUrls = [
  'admin.php'
];

self.addEventListener('install', function (e) {
  //console.log('[ServiceWorker] Install');
  e.waitUntil(
    caches.open(cacheName).then(function (cache) {
      //console.log('[ServiceWorker] Caching web...');
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('activate', function (e) {
  //console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function (keyList) {
      return Promise.all(keyList.map(function (key) {
        if (key !== cacheName) {
          //console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );
});

self.addEventListener('fetch', function (e) {
  //console.log("WORKER FETCH CALLED...");
  if (mustCache(e.request.url)) {
    e.respondWith(
      fetch(e.request)
      .then(function (response) {
        return caches.open(dataCacheName).then(function (cache) {
          //console.log("SAVING >>> " + e.request.url);
          cache.put(e.request.url, response.clone());
          return response;
        });
      })
    );
  } else {
    e.respondWith(
      caches.match(e.request).then(function (response) {
        /*var type = response ? "cached" : "network";
        if(response && 'url' in response) {
            console.log(type+": "+response.url);
        }else{
            console.log(type+": "+e.request.url);
        }*/
        return response || fetch(e.request);
      })
    );
  }
});

function mustCache(requestUrl) {
  for (var i = 0; i < cachableUrls.length; i++) {
    if (requestUrl.indexOf(cachableUrls[i]) > -1) {
      return true;
    }
  }
  return false;
}
