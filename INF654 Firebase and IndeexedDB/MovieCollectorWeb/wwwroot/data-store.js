// data-store.js
import { moviesCol, wishlistCol, onlineStore } from "./firebase-init.js";
import { idbStore, enqueueSync, drainSyncQueue } from "./idb-store.js";

export const isOnline = () => navigator.onLine;

// Map logical names to collections/stores
const collections = {
  movies: { online: moviesCol, offline: "movies" },
  wishlist: { online: wishlistCol, offline: "wishlist" }
};

// Simple toast notification
export function notify(message) {
  let el = document.getElementById("toast");
  if (!el) {
    el = document.createElement("div");
    el.id = "toast";
    el.style.position = "fixed";
    el.style.bottom = "20px";
    el.style.left = "50%";
    el.style.transform = "translateX(-50%)";
    el.style.background = "#fffb";
    el.style.color = "#000";
    el.style.padding = "8px 12px";
    el.style.borderRadius = "999px";
    el.style.fontWeight = "700";
    el.style.boxShadow = "0 8px 20px rgba(0,0,0,.3)";
    el.style.zIndex = "2000";
    document.body.appendChild(el);
  }
  el.textContent = message;
  el.style.display = "block";
  clearTimeout(el._hideTimer);
  el._hideTimer = setTimeout(() => { el.style.display = "none"; }, 3000);
}

// Unified CRUD with error handling
export const store = {
  async create(target, item) {
    try {
      const cfg = collections[target];
      if (isOnline()) {
        return await onlineStore.create(cfg.online, item);
      } else {
        const saved = await idbStore.create(cfg.offline, item);
        await enqueueSync({ target, type: "create", payload: saved });
        return saved;
      }
    } catch (err) {
      notify("Error creating item: " + err.message);
      console.error(err);
      return null;
    }
  },
  async readAll(target) {
    try {
      const cfg = collections[target];
      return isOnline() ? await onlineStore.readAll(cfg.online) : await idbStore.readAll(cfg.offline);
    } catch (err) {
      notify("Error reading items: " + err.message);
      console.error(err);
      return [];
    }
  },
  async updateById(target, id, patch) {
    try {
      const cfg = collections[target];
      if (isOnline()) {
        return await onlineStore.updateById(cfg.online, id, patch);
      } else {
        const updated = await idbStore.updateById(cfg.offline, id, patch);
        if (updated) await enqueueSync({ target, type: "update", payload: { id, patch } });
        return updated;
      }
    } catch (err) {
      notify("Error updating item: " + err.message);
      console.error(err);
      return null;
    }
  },
  async deleteById(target, id) {
    try {
      const cfg = collections[target];
      if (isOnline()) {
        return await onlineStore.deleteById(cfg.online, id);
      } else {
        const ok = await idbStore.deleteById(cfg.offline, id);
        if (ok) await enqueueSync({ target, type: "delete", payload: { id } });
        return ok;
      }
    } catch (err) {
      notify("Error deleting item: " + err.message);
      console.error(err);
      return false;
    }
  }
};

// Sync processor: replay offline ops to Firebase
async function processSync(op) {
  const { target, type, payload } = op;
  const cfg = collections[target];
  if (!cfg || !isOnline()) return false;

  try {
    switch (type) {
      case "create": {
        const existing = await onlineStore.readById(cfg.online, payload.id);
        if (existing) {
          await onlineStore.updateById(cfg.online, payload.id, payload);
        } else {
          await onlineStore.create(cfg.online, payload);
        }
        return true;
      }
      case "update":
        await onlineStore.updateById(cfg.online, payload.id, payload.patch);
        return true;
      case "delete":
        await onlineStore.deleteById(cfg.online, payload.id);
        return true;
      default:
        return false;
    }
  } catch (err) {
    console.error("Process sync error:", err);
    return false;
  }
}

// Auto-sync when coming back online
window.addEventListener("online", async () => {
  const before = Date.now();
  await drainSyncQueue(processSync);
  notify(`Synced offline changes in ${Date.now() - before} ms`);
});
