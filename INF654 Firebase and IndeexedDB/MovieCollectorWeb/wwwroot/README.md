# The Ultimate Film Collector's Vault — PWA Prototype (HTML + CSS)

## Overview
A Blockbuster‑themed, frontend prototype that helps you browse and curate a personal movie collection. Built as a static HTML/CSS prototype with small page-local JavaScript where noted; designed to be mobile friendly and extended into a Progressive Web App (PWA) with offline support and installability.

## Pages and Purpose
- `index.html` — Login / demo entry (static). “Skip (Demo)” jumps to `home.html`.  
- `home.html` — App hub with tiles for main flows: My Collection, My Wishlist, What to Watch Quiz, Movie Database.  
- `collection.html` — “My Collection”: browse and inspect your saved movies; Filter/Sort UI; image toggle and search.  
- `wishlist.html` — “My Wishlist”: curated wishlist view; same browsing and controls; action to mark movies as collected.  
- `database.html` — “Movie Database”: full collection browser; select movies and Add to Wishlist action.  
- `quiz.html` — Quiz landing: title, short lead, Start button that opens `quiz-form.html`.  
- `quiz-form.html` — Quiz form: responsive, finger‑friendly option grids for user preferences.

## Key UI Elements and How to Use Them
- **Topbar and sticky headers**  
  Topbar is fixed; pages are padded so content is never hidden behind it. Section headers (collection/quiz) are sticky beneath the topbar.

- **Image toggle (Images button)**  
  Toggle shows or hides movie cover images on the current page only. Green = on (images visible), red = off (images hidden). Toggle state is page‑local.

- **Search bar**  
  Type to filter cards by title or metadata (year, genre, rating). Filtering is client‑side and instantaneous. Use Enter or click Search to apply.

- **Filter / Sort details**  
  Lightweight controls using `<details>` and simple lists; these are UI placeholders ready to connect to real filtering logic.

- **Movie cards (grid)**  
  Tap/click a card to select it; selected cards get a green highlight. Click again to deselect. Multiple selections are supported.

- **Action bar (bottom)**  
  When one or more cards are selected an action bar appears:
  - Movie Database page: button reads “Add to Wishlist” and simulates adding selected titles to wishlist (example alert).  
  - Wishlist page: button reads “Movie Collected” and simulates marking selections as collected (example alert).

- **Quiz flow**  
  `quiz.html` is the landing page; the quiz hero stacks above the lead text and Start button for clear mobile layout. `quiz-form.html` contains the responsive question grid; labels are large, touch friendly.

## Data & Sync
- `firebase-init.js` — Firebase config and Firestore helpers including `readById`.
- `idb-store.js` — IndexedDB stores: `movies`, `wishlist`, `syncQueue`.
- `data-store.js` — Unified store; switches online/offline; queues offline ops; auto-syncs on reconnect; toast notifications for user feedback.

## PWA Features

### ✅ Web App Manifest (`manifest.json`)
- Defines app name, short name, description, start URL, display mode, theme and background colors
- Includes responsive icons (`192x192` and `512x512`) for installability across devices
- Linked in the `<head>` of each HTML page

### ✅ Service Worker (`sw.js`)
- Caches essential resources (HTML, CSS, JS, images, icons, manifest)
- Handles fetch events to serve cached content when offline
- Registered in a `<script>` block at the bottom of each HTML page

### ✅ Installability
- App can be installed on desktop and mobile devices
- Launches in standalone mode with splash screen and app icon
- Works offline after initial load

## File Structure
/wwwroot
├── index.html
├── home.html
├── collection.html
├── wishlist.html
├── database.html
├── quiz.html
├── quiz-form.html
├── styles.css
├── manifest.json
├── sw.js
├── /images         # Movie covers, logo, placeholders
├── /icons          # PWA icons (icon-192.png, icon-512.png)
└── README.md

## How to Run and Test Locally

### 🔧 Static Prototype (No Server)
1. Place all files in a folder with `styles.css` and `images/` alongside the HTML files  
2. Open `index.html` in a modern browser (Chrome, Firefox, Edge, Safari)  
3. Navigate through the app using the header and tiles. Test:
   - Image toggle in collection/database/wishlist pages  
   - Search input under the header  
   - Card selection and action bar behavior  
   - Quiz flow and layout

### 🚀 PWA Mode (With ASP.NET Core)
1. Open the solution in Visual Studio 2022 (ASP.NET Core Empty project)
2. Ensure `wwwroot` contains all files listed above
3. In `Program.cs`, enable static file serving:
   ```csharp
   app.UseDefaultFiles();
   app.UseStaticFiles();
4. In launchSettings.json, set "launchUrl": "index.html" for all profiles
5. Press F5 to run the app
6. Open in Chrome and:			
   - Run a Lighthouse audit to verify installability	
   - Install the app via the browser menu or install prompt
   - Simulate offline mode in DevTools → Network → Offline and reload to test caching


Author: Seth Gundlach