📚 Perpus-Digital

Sistem informasi perpustakaan digital berbasis web yang dirancang untuk memudahkan manajemen peminjaman buku dan pendataan koleksi secara efisien. Proyek ini dikembangkan sebagai Project Akhir Mata Kuliah Rekayasa Perangkat Lunak (RPL).
🚀 Fitur Utama

    Manajemen Buku: Pengelolaan data buku, kategori, dan stok secara real-time.
    Sistem Peminjaman: Alur peminjaman dan pengembalian buku yang terintegrasi.
    Dashboard Statistik: Ringkasan data statistik untuk admin dan pengguna.
    Autentikasi: Sistem login dan registrasi yang aman bagi pengguna.
    Pencarian Cepat: Memudahkan pencarian koleksi buku berdasarkan judul atau kategori.

🛠️ Teknologi yang Digunakan
    Framework: Laravel 12
    Bahasa Pemrograman: PHP
    Styling: Tailwind CSS
    Database: MySQL
    
💻 Cara Instalasi

    Clone repository
    git clone https://github.com/chilhan23/perpus-digital.git
    cd perpus-digital

    Instal dependensi
    composer install
    npm install && npm run dev

    Konfigurasi environment
        Salin file .env.example menjadi .env
        Sesuaikan konfigurasi database di file .env
        
    php artisan key:generate

    Migrasi database
    php artisan migrate --seed

    Jalankan aplikasi
    php artisan serve

👤 Kontributor

    Muhammad Rayhan Ramadhan - Developer Utama
