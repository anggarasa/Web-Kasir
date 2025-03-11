# Website Kasir

Website kasir yang dibangun menggunakan Laravel versi 12 dengan teknologi modern untuk mendukung kemudahan dan efisiensi operasional bisnis.

## Teknologi yang Digunakan

- **Laravel**: Versi 12
- **Livewire**: Versi 3
- **TailwindCSS**: Versi 4
- **Alpine.js**: Versi terbaru
- **Flux UI**: Untuk komponen antarmuka yang responsif
- **Database**: MySQL

## Fitur-Fitur

### Role dan Hak Akses
1. **Super Admin**
   - CRUD User Admin
   - CRUD Customer
   - CRUD Produk
   - Input Payment
   - Melihat Payment History

2. **Admin**
   - CRUD Customer
   - CRUD Produk
   - Input Payment
   - Melihat Payment History

### Deskripsi Fitur
- **CRUD User Admin**: Mengelola akun pengguna dengan role admin.
- **CRUD Customer**: Menambah, mengedit, dan menghapus data pelanggan.
- **CRUD Produk**: Menambah, mengedit, dan menghapus produk yang tersedia.
- **Input Payment**: Memasukkan data pembayaran yang dilakukan pelanggan.
- **Payment History**: Melihat riwayat pembayaran pelanggan.

## Instalasi

1. Clone repository ini ke lokal:
   ```bash
   git clone <repository-url>
   ```

2. Masuk ke direktori proyek:
   ```bash
   cd website-kasir
   ```

3. Instal dependensi menggunakan Composer:
   ```bash
   composer install
   ```

4. Instal dependensi frontend:
   ```bash
   npm install && npm run dev
   ```

5. Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database:
   ```bash
   cp .env.example .env
   ```

6. Generate application key:
   ```bash
   php artisan key:generate
   ```

7. Migrasikan database:
   ```bash
   php artisan migrate
   ```

8. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```

## Penggunaan
- Akses website melalui `http://localhost:8000`.
- Login menggunakan akun sesuai dengan role yang telah dibuat.
