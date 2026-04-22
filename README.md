# Sistem Informasi Agenda Pimpinan 📅

**Sistem Informasi Agenda Pimpinan** adalah aplikasi berbasis web yang dirancang untuk membantu pengelolaan jadwal kegiatan pimpinan secara terstruktur dan efisien. Sistem ini menyediakan dua sisi utama: halaman staf/petugas untuk operasional lapangan, serta halaman admin untuk manajemen agenda dan penugasan.

Aplikasi ini dibangun menggunakan framework **Laravel 10** dengan tampilan modern berbasis **Tailwind CSS** dan **Preline UI**, serta mendukung pengelolaan dokumen digital terintegrasi.

---

## 🚀 Fitur Utama

### 👤 Halaman Staf / Petugas (Front-End)
* **Dashboard Ringkasan:** Menampilkan statistik singkat kegiatan dan 5 agenda terdekat.
* **Jadwal Penugasan Personal:** Informasi detail acara seperti waktu, lokasi, dan pejabat yang hadir, khusus untuk petugas terkait.
* **Akses Dokumen Digital:** Mendukung pembacaan dan unduhan file PDF (sambutan kegiatan) serta akses ke tautan meeting atau referensi.

### 🛠️ Halaman Admin (Back-End)
* **Dashboard Manajemen:** Ringkasan jumlah total agenda, total petugas, dan daftar agenda mendatang.
* **Manajemen Agenda Pejabat:** Fitur CRUD (Create, Read, Update, Delete) untuk mengelola jadwal kegiatan, termasuk upload file PDF.
* **Manajemen Penugasan (Multi-User):** Admin dapat menetapkan satu atau lebih petugas dalam satu kegiatan.
* **Pencarian Rentang Waktu:** Filter agenda berdasarkan tanggal mulai dan tanggal akhir untuk mempermudah pencarian data.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 10 (PHP Framework)
* **Frontend:** Blade Templates
* **Asset Bundling:** Vite
* **Database:** MySQL
* **Styling:** Tailwind CSS & Preline UI

---

## 📸 Screenshots

| Dashboard Admin | Halaman Petugas |
| :---: | :---: |
| <img width="917" height="508" alt="DashboardAdmin" src="https://github.com/user-attachments/assets/23624162-f677-430b-8d12-f33e54d40e4c" /> | <img width="916" height="506" alt="DashboardPetugas" src="https://github.com/user-attachments/assets/0f1ffb87-406e-43d8-b5b7-40c043d77f26" /> |
