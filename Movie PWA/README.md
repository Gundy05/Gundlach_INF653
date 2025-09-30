# The Ultimate Film Collector's Vault — Simple PWA Prototype (HTML + CSS)

## Overview
A Blockbuster‑themed, frontend prototype that helps you browse and curate a personal movie collection. Built as a static HTML/CSS prototype with small pagelocal JavaScript where noted; designed to be mobile friendly and easy to extend into a PWA.

## Pages and purpose
- `index.html` — Login / demo entry (static). “Skip (Demo)” jumps to `home.html`.  
- `home.html` — App hub with tiles for main flows: My Collection, My Wishlist, What to Watch Quiz, Movie Database.  
- `collection.html` — “My Collection”: browse and inspect your saved movies; Filter/Sort UI; image toggle and search.  
- `wishlist.html` — “My Wishlist”: curated wishlist view; same browsing and controls; action to mark movies as collected.  
- `database.html` — “Movie Database”: full collection browser; select movies and Add to Wishlist action.  
- `quiz.html` — Quiz landing: title, short lead, Start button that opens `quiz-form.html`.  
- `quiz-form.html` — Quiz form: responsive, finger‑friendly option grids for user preferences.

## Key UI elements and how to use them
- Topbar and sticky headers  
  - Topbar is fixed; pages are padded so content is never hidden behind it. Section headers (collection/quiz) are sticky beneath the topbar.

- Image toggle (Images button)  
  - Toggle shows or hides movie cover images on the current page only. Green = on (images visible), red = off (images hidden). Toggle state is page‑local.

- Search bar  
  - Type to filter cards by title or metadata (year, genre, rating). Filtering is client‑side and instantaneous. Use Enter or click Search to apply.

- Filter / Sort details  
  - Lightweight controls using `<details>` and simple lists; these are UI placeholders ready to connect to real filtering logic.

- Movie cards (grid)  
  - Tap/click a card to select it; selected cards get a green highlight. Click again to deselect. Multiple selections are supported.

- Action bar (bottom)  
  - When one or more cards are selected an action bar appears:
    - Movie Database page: button reads “Add to Wishlist” and simulates adding selected titles to wishlist (example alert).  
    - Wishlist page: button reads “Movie Collected” and simulates marking selections as collected (example alert).

- Quiz flow  
  - `quiz.html` is the landing page; the quiz hero stacks above the lead text and Start button for clear mobile layout. `quiz-form.html` contains the responsive question grid; labels are large, touch friendly.

## File structure (recommended)
- `index.html`  
- `home.html`  
- `collection.html`  
- `wishlist.html`  
- `database.html`  
- `quiz.html`  
- `quiz-form.html`  
- `styles.css`  
- `/images` (movie covers, logo, placeholders)  
- `README.md`

## How to run and test locally
1. Place the project folder on your machine with `styles.css` and the `images` folder alongside the HTML files.  
2. Open `index.html` in a modern browser (Chrome, Firefox, Edge, Safari). No server required for the static prototype.  
3. Navigate through the app using the header and tiles. Test:
   - Images toggle in collection/database/wishlist pages.  
   - Search input under the header.  
   - Click movie cards to select; watch the action bar appear.  
   - Use the action button to exercise example behavior (alerts in the prototype).  
   - Open the quiz landing and start the quiz to see the form layout.

---

Author: Seth Gundlach
