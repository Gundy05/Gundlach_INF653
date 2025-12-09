// sw.js
const VERSION = "v4";
const STATIC_CACHE = `static-${VERSION}`;
const ASSETS = [
  "/", // root
  "/index.html",
  "/home.html",
  "/collection.html",
  "/wishlist.html",
  "/database.html",
  "/quiz.html",
  "/quiz-form.html",
  "/styles.css",
  "/manifest.json",
  "/firebase-init.js",
  "/idb-store.js",
  "/data-store.js",
  "/icons/icon-192.png",
  "/icons/icon-512.png",
  // Base images
  "/images/placeholder.jpg",
  "/images/the-avengers.jpg",
  "/images/Bedtime-Stories.jpg",
  "/images/se7en.jpg",
  // Seed sample images
  "/images/dark-knight.jpg",
  "/images/inception.jpg",
  "/images/titanic.jpg",
  "/images/toy-story.jpg",
  "/images/godfather.jpg",
  "/images/black-panther.jpg",
  "/images/parasite.jpg",
  "/images/casablanca.jpg",
  "/images/star-wars.jpg",
  "/images/lion-king.jpg"
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(STATIC_CACHE).then(cache => cache.addAll(ASSETS)).then(() => self.skipWaiting())
  );
});

self.addEventListener("activate", (event) => {
  event.waitUntil(
    caches.keys()
      .then(keys => Promise.all(keys.map(k => (k.startsWith("static-") && k !== STATIC_CACHE) ? caches.delete(k) : null)))
      .then(() => self.clients.claim())
  );
});

self.addEventListener("fetch", (event) => {
  const req = event.request;
  const url = new URL(req.url);

  // Skip Firebase API/CDNs
  if (url.hostname.includes("firebaseio") || url.hostname.includes("googleapis") || url.hostname.includes("gstatic")) {
    return;
  }

  // Navigations: network-first
  if (req.mode === "navigate") {
    event.respondWith(
      fetch(req)
        .then(res => {
          const copy = res.clone();
          caches.open(STATIC_CACHE).then(cache => cache.put(req, copy));
          return res;
        })
        .catch(() => caches.match(req))
    );
    return;
  }

  // Assets: cache-first with index fallback
  if (req.method === "GET") {
    event.respondWith(
      caches.match(req)
        .then(cached => cached || fetch(req).then(res => {
          if (res.status === 200 && res.type === "basic") {
            const copy = res.clone();
            caches.open(STATIC_CACHE).then(cache => cache.put(req, copy));
          }
          return res;
        }).catch(() => caches.match("/index.html")))
    );
  }
});
