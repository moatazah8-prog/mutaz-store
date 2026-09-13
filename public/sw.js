const CACHE_NAME = 'mutaz-store-v1';

const FILES = [
    '/',
    '/products',
    '/manifest.json'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(FILES))
    );
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
    event.respondWith(
        fetch(event.request).catch(() => caches.match(event.request))
    );
});
