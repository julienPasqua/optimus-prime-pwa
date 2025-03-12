const CACHE_NAME = "pwa-cache-v1";
const urlsToCache = [
  "../index.html",
  "../style.css",
  "../script.js",
  "manifest.json",
  "../src/img/png-clipart-autobot-decal-logo-optimus-prime-sticker-bumblebee-transformer-logo-text-logo.png",
];
self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});
self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
