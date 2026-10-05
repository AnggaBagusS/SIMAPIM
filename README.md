# SIMAPIM - Sistem Informasi Manajemen Agenda Pimpinan 📅

**SIMAPIM (Sistem Informasi Manajemen Agenda Pimpinan)** adalah platform terpadu berbasis web dan API yang dirancang untuk mempermudah pengelolaan, penjadwalan, penugasan staf protokol, dan dokumentasi kegiatan pimpinan secara terstruktur, transparan, dan *real-time*.

Sistem ini menyediakan dua antarmuka terpisah berbasis hak akses (*Role-Based Access Control*): **Halaman Admin** untuk kendali operasional & penugasan, serta **Halaman Staf / Petugas** untuk operasional lapangan. Dilengkapi juga dengan **RESTful API** siap pakai untuk integrasi aplikasi mobile (Android/iOS).

Aplikasi ini dibangun menggunakan **Laravel 10**, antarmuka modern **Tailwind CSS** & **Preline UI**, serta sistem audit trail dan dokumentasi API interaktif **Swagger UI**.

---

## 🚀 Fitur Utama

### 👤 1. Halaman Staf / Petugas Lapangan
* **Dashboard Operasional Staf:** Statistik ringkas penugasan dan daftar agenda mendatang khusus untuk staf bersangkutan.
* **Jadwal Penugasan Personal:** Rincian lengkap kegiatan (judul acara, tanggal, jam mulai/selesai, lokasi, dan pejabat yang didampingi).
* **Akses Dokumen Sambutan Digital:** Membaca dan mengunduh berkas naskah pidato/sambutan berformat PDF.
* **Dokumentasi Kegiatan Terpadu:** Fitur input dan pembaruan tautan Google Drive dokumentasi foto/kegiatan secara langsung dari lapangan.

### 🛠️ 2. Halaman Administrator
* **Dashboard Manajemen Eksekutif:** Visualisasi metrik kegiatan (total agenda, agenda hari ini, status berlangsung, selesai, terjadwal, dan dibatalkan).
* **Manajemen Agenda Pimpinan (CRUD Lengkap):** Tambah, edit, detail, dan hapus jadwal kegiatan pimpinan dengan validasi terpisah (*Form Requests*).
* **Penugasan Staf Protokol (Tabel Pivot Many-to-Many):** Menugaskan satu atau lebih staf pendamping dalam satu agenda kegiatan secara efisien.
* **Penyimpanan Berkas Terstandarisasi:** Pengelolaan berkas sambutan dan avatar menggunakan *Laravel Storage API* (`storage/app/public`).
* **Pencarian & Filter Multikriteria:** Pencarian berdasarkan kata kunci acara, pejabat, status agenda, serta rentang tanggal pelaksanaan.
* **Audit Trail / Activity Log:** Pencatatan otomatis riwayat aktivitas sistem (siapa yang membuat, mengubah jadwal, atau menghapus agenda beserta perubahan nilainya) menggunakan Spatie Activitylog.

### 🌐 3. RESTful API & Dokumentasi Swagger
* **Stateless Token Authentication:** Autentikasi aman berbasis *Personal Access Token* menggunakan **Laravel Sanctum**.
* **API Resources Transformer:** Format respons JSON terstandarisasi (`success`, `message`, `data`, `meta`).
* **Dokumentasi Interaktif (OpenAPI 3.0 / Swagger UI):** Tersedia antarmuka pengujian API langsung di browser melalui rute `/docs`.

---

## 🛠️ Teknologi yang Digunakan

* **Backend Framework:** Laravel 10 (PHP 8.2+)
* **Database:** MySQL / MariaDB (dengan relasi Pivot Many-to-Many)
* **Frontend:** Laravel Blade Templates
* **Styling & UI:** Tailwind CSS, Preline UI, Google Fonts (Plus Jakarta Sans & Inter)
* **Pop-up & Interactivity:** SweetAlert2 & Vanilla JavaScript
* **API & Security:** Laravel Sanctum (Bearer Token) & CORS Enabled
* **Audit Trail:** Spatie Laravel Activitylog
* **API Documentation:** OpenAPI Specification 3.0.3 & Swagger UI CDN

---

## 📸 Screenshots

| Dashboard Admin | Halaman Petugas |
| :---: | :---: |
| <img width="923" height="503" alt="Screenshot 2026-10-05 094313" src="https://github.com/user-attachments/assets/928e4c37-27db-426b-b96d-bb5a3129fb6f" /> | <img width="926" height="506" alt="Screenshot 2026-10-05 094435" src="https://github.com/user-attachments/assets/3010775d-f84a-4c78-968d-aeb0a73970d0" /> |

---

## 💻 Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan sistem di komputer lokal:

### 1. Klon Repositori
```bash
git clone https://github.com/AnggaBagusS/SIMAPIM.git
cd SIMAPIM
```

### 2. Pasang Dependensi
```bash
composer install
```

### 3. Konfigurasi Lingkungan (`.env`)
Salin file konfigurasi contoh dan buat App Key baru:
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan koneksi database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agenda_pim
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Database & Seeder
Jalankan migrasi seluruh tabel (termasuk tabel pivot `agenda_user` dan `activity_log`) beserta data awal:
```bash
php artisan migrate --seed
```

### 5. Hubungkan Berkas Publik
```bash
php artisan storage:link
```

### 6. Jalankan Server Pengembangan
```bash
php artisan serve
```

---

## 📖 Akses Sistem & Dokumentasi

* **Aplikasi Web**: Buka [http://127.0.0.1:8000](http://127.0.0.1:8000) di browser.
* **Dokumentasi RESTful API (Swagger UI)**: Buka [http://127.0.0.1:8000/docs](http://127.0.0.1:8000/docs).
* **Spesifikasi Mentah OpenAPI**: [http://127.0.0.1:8000/docs/api.json](http://127.0.0.1:8000/docs/api.json).

### Akun Uji Coba Default:
| Peran (Role) | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@gmail.com` | `password` |
| **Staff Protokol** | `staff@gmail.com` | `password` |

---

## 📄 Lisensi
Sistem Informasi Manajemen Agenda Pimpinan (SIMAPIM) dikembangkan untuk keperluan instansi Pemerintah Provinsi Lampung dengan lisensi terbuka [MIT License](LICENSE).


