// firebase-init.js

// Import Firebase core + Firestore
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
import {
  getFirestore,
  collection,
  doc,
  addDoc,
  getDocs,
  updateDoc,
  deleteDoc,
  query,
  where
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-firestore.js";

// 🔹 Import Firebase Authentication
import {
  getAuth,
  onAuthStateChanged,
  signInWithEmailAndPassword,
  createUserWithEmailAndPassword,
  signOut,
  GoogleAuthProvider,
  signInWithPopup
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";

// Your Firebase project configuration
const firebaseConfig = {
  apiKey: "AIzaSyAsfTK3OamNZjuYTEwN7v_HC2LmVweyWpU",
  authDomain: "film-vault-26e14.firebaseapp.com",
  projectId: "film-vault-26e14",
  storageBucket: "film-vault-26e14.firebasestorage.app",
  messagingSenderId: "80943386334",
  appId: "1:80943386334:web:bbbf11119e738e9fddbc4f"
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const db = getFirestore(app);

// 🔹 Initialize Authentication
export const auth = getAuth(app);
export const googleProvider = new GoogleAuthProvider();

// 🔹 Authentication helpers
export const authAPI = {
  onUserChanged: (cb) => onAuthStateChanged(auth, cb),
  signInEmail: (email, password) => signInWithEmailAndPassword(auth, email, password),
  signUpEmail: (email, password) => createUserWithEmailAndPassword(auth, email, password),
  signInGoogle: () => signInWithPopup(auth, googleProvider),
  signOut: () => signOut(auth)
};

// Firestore collections (global for now)
export const moviesCol = collection(db, "movies");
export const wishlistCol = collection(db, "wishlist");

// Online CRUD helpers (unchanged)
export const onlineStore = {
  async create(colRef, item) {
    const toSave = { ...item, id: item.id ?? crypto.randomUUID(), ts: Date.now() };
    const ref = await addDoc(colRef, toSave);
    return { ...toSave, _docId: ref.id };
  },
  async readAll(colRef) {
    const snap = await getDocs(colRef);
    return snap.docs.map(d => ({ _docId: d.id, ...d.data() }));
  },
  async readById(colRef, id) {
    const q = query(colRef, where("id", "==", id));
    const snap = await getDocs(q);
    if (snap.empty) return null;
    const d = snap.docs[0];
    return { _docId: d.id, ...d.data() };
  },
  async updateById(colRef, id, patch) {
    const q = query(colRef, where("id", "==", id));
    const snap = await getDocs(q);
    if (snap.empty) return null;
    const d = snap.docs[0];
    await updateDoc(doc(colRef, d.id), patch);
    return { ...d.data(), ...patch };
  },
  async deleteById(colRef, id) {
    const q = query(colRef, where("id", "==", id));
    const snap = await getDocs(q);
    if (snap.empty) return false;
    const d = snap.docs[0];
    await deleteDoc(doc(colRef, d.id));
    return true;
  }
};
