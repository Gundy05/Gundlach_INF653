const CACHE_NAME = 'film-vault-cache-v1';
const urlsToCache = [
    '/',
    '/index.html',
    '/collection.html',
    '/wishlist.html',
    '/quiz.html',
    '/quiz-form.html',
    '/database.html',
    '/styles.css',
    '/manifest.json',
    '/icons/icon-192.png',
    '/icons/icon-512.png',
    '/the-avengers.jpg',
    '/Bedtime-Stories.jpg',
    '/se7en.jpg'
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(urlsToCache))
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(keys =>
            Promise.all(keys.map(key => {
                if (key !== CACHE_NAME) return caches.delete(key);
            }))
        )
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request).then(response =>
            response || fetch(event.request)
        )
    );
});
