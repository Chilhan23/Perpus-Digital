# 📚 PerpusDigi - Digital Library System

[![Laravel 12](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
**PerpusDigi** adalah platform manajemen perpustakaan digital modern yang dibangun untuk memberikan akses pengetahuan tanpa batas. Sistem ini mendukung manajemen buku, sistem peminjaman otomatis, hingga pembuatan invoice PDF secara real-time.

---

## 🚀 Fitur Utama

- **🛡️ Secure Auth & Verification**: Sistem login dengan verifikasi email (MustVerifyEmail).
- **📖 Catalog Management**: Jelajahi koleksi buku dengan filter kategori dan pencarian yang responsif.
- **⏳ Smart Borrowing**: Sistem peminjaman dengan limitasi (Max 3 buku) dan durasi otomatis 7 hari.
- **📄 Pro Invoice Generator**: Download invoice peminjaman otomatis dalam format PDF dengan desain elegan.
- **👑 Admin Dashboard**: Kelola buku, pantau status peminjaman (Dipinjam/Kembali/Terlambat), dan manajemen denda.
- **📱 Ultra Responsive**: Tampilan kece di Laptop maupun HP (Thinkpad Tested!).

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.2+ & Laravel 11
- **Frontend:** Tailwind CSS & Alpine.js
- **Database:** MySQL/MariaDB
- **PDF Engine:** DomPDF
- **Environment:** Developed on **Arch Linux** (Thinkpad T470s)

---

## 💻 Instalasi Lokal

1. **Clone Repository**
   ```bash
   git clone [https://github.com/Chilhan23/Perpus-Digital.git](https://github.com/Chilhan23/Perpus-Digital.git)
   cd Perpus-Digital ```

2. **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3. **Konfigurasi Environment**
    ```bash
        cp .env.example .env
        php artisan key:generate
    ```

4. **Setup Database Dan Seeding**
    ```bash
    php artisan migrate --seed
    ```
5. **Run server**
    ```bash
    php artisan serve
    ```

Developed By Chilhan aka Rayhan