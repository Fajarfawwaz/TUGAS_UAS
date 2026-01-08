# 🍽️ KulinerKu - Digital Restaurant System (UAS Pemrograman Web)

KulinerKu adalah aplikasi manajemen restoran digital yang dibangun menggunakan arsitektur **MVC (Model-View-Controller)** mandiri dengan PHP. Proyek ini dirancang untuk mensimulasikan ekosistem restoran modern, mulai dari pemesanan pelanggan hingga pengelolaan data oleh administrator.

---

## 👤 Identitas Mahasiswa
* **Nama** : Fajar Fawwaz Atallah
* **NIM** : 312410357
* **Kelas** : TI.24.A4
* **Mata Kuliah** : Pemrograman Web

---

## 🔗 Tautan Penting (Links)
* **🌐 Website Demo**: [Lihat Demo KulinerKu](https://fajarfawwaz.github.io/project_uasWEB/)
* **🎥 Penjelasan Video (YouTube)**: [Tonton Presentasi Proyek](https://youtu.be/yWjbWMHmNNM?si=7w1IUMYzHaN-MdYW)

---

## 📂 Struktur Folder Proyek (MVC Architecture)

Berikut adalah susunan folder berdasarkan arsitektur yang digunakan dalam proyek **UAS_WEB**:

```text
UAS_WEB/
├── app/
│   ├── config/         # Konfigurasi Database & Base URL
│   ├── controllers/    # Admin.php, Auth.php, Checkout.php, Home.php, Makanan.php
│   ├── core/           # App.php, Controller.php, Database.php
│   ├── models/         # Makanan_model.php, User_model.php
│   └── views/          # Folder View (Admin, Auth, Checkout, Home, Makanan, Templates)
├── public/
│   ├── css/            # style.css
│   ├── img/            # qris.png & aset gambar lainnya
│   ├── js/             # File JavaScript client-side
│   ├── .htaccess       # URL Rewrite untuk folder public
│   └── index.php       # Entry Point (Front Controller)
├── init.php            # Inisialisasi sistem (Bootstraping)
└── .htaccess           # URL Rewrite Root
```

## 🚀 Fitur Utama

### 1. Sistem Multi-User (Role Based)
* **Admin**: Dashboard untuk memantau omzet, mengelola menu (Tambah, Edit, Hapus), dan melihat riwayat transaksi secara real-time.
* **User/Pelanggan**: Katalog menu interaktif, sistem pencarian, keranjang belanja, dan sistem checkout dengan integrasi QRIS (Simulasi).

### 2. Manajemen Data (CRUD)
* Admin dapat memperbarui daftar menu tanpa perlu menyentuh kode program.
* Data disimpan secara persisten menggunakan `localStorage`, sehingga data tidak hilang saat browser dimuat ulang (refresh).

### 3. Pengalaman Pengguna (UX)
* **Full SPA**: Perpindahan halaman yang instan tanpa *reload* dan tanpa *scrolling* antar bagian.
* **Struk Digital**: Pembuatan struk belanja otomatis setelah transaksi berhasil.
* **Responsive Design**: Menggunakan Bootstrap 5 untuk tampilan yang optimal di desktop maupun perangkat mobile.

---
