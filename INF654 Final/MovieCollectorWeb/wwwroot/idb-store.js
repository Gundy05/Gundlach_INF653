// idb-store.js
const DB_NAME = "film-vault";
const DB_VERSION = 1;
const STORES = ["movies", "wishlist", "syncQueue"]; // syncQueue holds offline ops

function openDB() {
  return new Promise((resolve, reject) => {
    const req = indexedDB.open(DB_NAME, DB_VERSION);
    req.onupgradeneeded = () => {
      const db = req.result;
      STORES.forEach(name => {
        if (!db.objectStoreNames.contains(name)) {
          db.createObjectStore(name, { keyPath: "id" }); // use stable id
        }
      });
    };
    req.onsuccess = () => resolve(req.result);
    req.onerror = () => reject(req.error);
  });
}

async function tx(storeName, mode, cb) {
  const db = await openDB();
  return new Promise((resolve, reject) => {
    const t = db.transaction(storeName, mode);
    const store = t.objectStore(storeName);
    const result = cb(store);
    t.oncomplete = () => resolve(result);
    t.onerror = () => reject(t.error);
    t.onabort = () => reject(t.error || new Error("Transaction aborted"));
  });
}

export const idbStore = {
  async create(storeName, item) {
    const record = { ...item, id: item.id ?? crypto.randomUUID(), ts: Date.now() };
    await tx(storeName, "readwrite", (s) => s.put(record));
    return record;
  },
  async readAll(storeName) {
    return tx(storeName, "readonly", (s) =>
      new Promise((resolve, reject) => {
        const out = [];
        const req = s.openCursor();
        req.onsuccess = () => {
          const cursor = req.result;
          if (cursor) {
            out.push(cursor.value);
            cursor.continue();
          } else resolve(out);
        };
        req.onerror = () => reject(req.error);
      })
    );
  },
  async readById(storeName, id) {
    return tx(storeName, "readonly", (s) => s.get(id));
  },
  async updateById(storeName, id, patch) {
    const existing = await idbStore.readById(storeName, id);
    if (!existing) return null;
    const updated = { ...existing, ...patch, ts: Date.now() };
    await tx(storeName, "readwrite", (s) => s.put(updated));
    return updated;
  },
  async deleteById(storeName, id) {
    await tx(storeName, "readwrite", (s) => s.delete(id));
    return true;
  }
};

// Queue offline operations for later sync
export async function enqueueSync(op) {
  // op: { target:"movies"|"wishlist", type:"create"|"update"|"delete", payload:{...} }
  const record = { id: crypto.randomUUID(), ts: Date.now(), ...op };
  await idbStore.create("syncQueue", record);
  return record;
}

export async function drainSyncQueue(processor) {
  const all = await idbStore.readAll("syncQueue");
  for (const entry of all) {
    try {
      const ok = await processor(entry);
      if (ok) await idbStore.deleteById("syncQueue", entry.id);
    } catch (err) {
      console.error("Sync failed for entry:", entry, err);
    }
  }
}
