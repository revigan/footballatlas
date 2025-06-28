# ⚽ Football Atlas

Aplikasi web modern untuk mengelola dan menjelajahi data sepak bola dunia, termasuk negara, klub, dan prestasi mereka. Dibangun dengan Laravel 10 dan fitur live search yang canggih.

![Football Atlas](https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue?style=for-the-badge&logo=php)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=for-the-badge&logo=bootstrap)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?style=for-the-badge&logo=mysql)

## 🌟 Fitur Utama

### 🔍 **Live Search System**

-   **Global Live Search**: Pencarian negara dan klub dari navbar
-   **Real-time Search**: Pencarian instan tanpa reload halaman
-   **Advanced Filtering**: Filter berdasarkan konfederasi dan negara
-   **Responsive Design**: Berfungsi optimal di semua perangkat

### 🏳️ **Manajemen Negara**

-   Daftar lengkap negara sepak bola dunia
-   Informasi konfederasi (AFC, UEFA, CONMEBOL, dll)
-   Kode negara dan bendera
-   Jumlah klub per negara

### 🛡️ **Manajemen Klub**

-   Data klub sepak bola dari berbagai negara
-   Informasi stadion dan tahun berdiri
-   Logo klub dengan upload gambar
-   Relasi dengan negara

### 🏆 **Sistem Prestasi**

-   Prestasi klub dan negara
-   Kategori prestasi (Liga, Piala, Internasional)
-   Data tahun dan detail prestasi
-   Statistik lengkap

### 👤 **Sistem Autentikasi**

-   Login dan registrasi user
-   Role-based access control (Admin/User)
-   Dashboard admin untuk manajemen data
-   Middleware keamanan

## 🚀 Teknologi yang Digunakan

### **Backend**

-   **Laravel 10** - PHP Framework
-   **MySQL** - Database
-   **Eloquent ORM** - Database abstraction
-   **Laravel Breeze** - Authentication scaffolding

### **Frontend**

-   **Bootstrap 5.3** - CSS Framework
-   **Bootstrap Icons** - Icon library
-   **Vanilla JavaScript** - Interaktivitas
-   **Glass Morphism** - Modern UI design

## 📋 Prasyarat

Sebelum menjalankan aplikasi, pastikan sistem Anda memenuhi persyaratan berikut:

-   **PHP** >= 8.1
-   **Composer** >= 2.0
-   **MySQL** >= 8.0
-   **Node.js** >= 16.0 (untuk asset compilation)
-   **Web Server** (Apache/Nginx) atau PHP built-in server

## 🛠️ Instalasi

### 1. **Clone Repository**

```bash
git clone https://github.com/yourusername/footballatlas.git
cd footballatlas
```

### 2. **Install Dependencies**

```bash
composer install
npm install
```

### 3. **Environment Setup**

```bash
cp .env.example .env
php artisan key:generate
```

### 4. **Database Configuration**

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=footballatlas
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. **Database Migration & Seeding**

```bash
php artisan migrate
php artisan db:seed
```

### 6. **Storage Setup**

```bash
php artisan storage:link
```

### 7. **Compile Assets**

```bash
npm run dev
```

### 8. **Start Development Server**

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 🔍 Cara Menggunakan Live Search

### **Global Search (Navbar)**

1. Gunakan search box di navbar untuk mencari negara atau klub dari halaman manapun
2. Hasil pencarian akan muncul dalam dropdown dengan glass morphism effect
3. Klik hasil untuk navigasi ke halaman detail

### **Live Search Halaman Negara**

1. Ketik di kolom pencarian untuk mencari negara secara real-time
2. Gunakan dropdown filter untuk memfilter berdasarkan konfederasi
3. URL akan terupdate tanpa reload halaman
4. Gunakan tombol reset untuk clear search dan filter

### **Live Search Halaman Klub**

1. Ketik di kolom pencarian untuk mencari klub berdasarkan nama, stadion, atau tahun berdiri
2. Gunakan dropdown filter untuk memfilter berdasarkan negara
3. Pagination akan terupdate otomatis
4. Gunakan tombol reset untuk clear search dan filter

## 🔧 Cara Menggunakan Aplikasi

### **Manajemen Data**

1. **Login sebagai Admin** untuk akses penuh
2. **Tambah Data**: Gunakan tombol "Tambah" di setiap halaman
3. **Edit Data**: Klik tombol edit pada baris data
4. **Hapus Data**: Klik tombol hapus dengan konfirmasi

### **Navigasi**

-   **Home**: Halaman utama dengan overview
-   **Negara**: Daftar dan manajemen negara
-   **Klub**: Daftar dan manajemen klub
-   **Dashboard**: Panel admin (hanya untuk admin)

## 🔐 Keamanan

-   **CSRF Protection** untuk semua form
-   **Authentication Middleware** untuk halaman admin
-   **Input Validation** untuk semua input user
-   **File Upload Security** untuk gambar
-   **SQL Injection Protection** dengan Eloquent ORM

## 🚀 Deployment

### **Production Setup**

1. Set environment ke production
2. Optimize autoloader: `composer install --optimize-autoloader --no-dev`
3. Cache config: `php artisan config:cache`
4. Cache routes: `php artisan route:cache`
5. Cache views: `php artisan view:cache`

### **Server Requirements**

-   PHP >= 8.1
-   MySQL >= 8.0
-   Web server (Apache/Nginx)
-   SSL certificate (recommended)

## 🤝 Kontribusi

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👨‍💻 Developer

**Farikhin** - [GitHub](https://github.com/revigan) - [WhatsApp](https://wa.me/6281215413573)

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

-   📧 Email: [your-email@example.com]
-   💬 WhatsApp: [6281215413573]
-   🐛 Issues: [GitHub Issues](https://github.com/yourusername/footballatlas/issues)

## 🚨 Security Issues

Jika Anda menemukan security vulnerability:

-   Jangan buat public issue
-   Email ke maintainer secara private
-   Berikan detail lengkap tentang vulnerability

## 📚 Dokumentasi Lengkap

Untuk dokumentasi yang lebih detail, silakan lihat:

-   [API Documentation](API.md)
-   [Deployment Guide](DEPLOYMENT.md)
-   [Features Documentation](FEATURES.md)
-   [Security Policy](SECURITY.md)
-   [Contributing Guidelines](CONTRIBUTING.md)
-   [Changelog](CHANGELOG.md)

---

**⚽ Football Atlas** - Jelajahi dunia sepak bola dengan cara yang modern dan intuitif! 🚀
