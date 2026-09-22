# Panduan Deploy SOLVETA ke Shared Hosting cPanel (Rumahweb / Rumah Hosting)
### Framework: CodeIgniter 4 (PHP) & MySQL Localhost

Aplikasi ini telah sepenuhnya dimigrasikan dari Next.js ke **CodeIgniter 4** yang berjalan secara native di server shared hosting berbasis Apache/LiteSpeed tanpa memerlukan Node.js atau daemon server terpisah.

---

## Ringkasan Persiapan

Sebelum memulai, pastikan Anda memiliki akses ke:
1. **cPanel Akun Hosting Anda** (misal: `https://solveta.asia:2083` atau URL login cPanel dari Rumahweb).
2. File arsip siap upload: **`solveta-ci4-cpanel.zip`**
3. File database: **`database.sql`**

---

## Langkah 1: Buat Database MySQL di cPanel

1. Login ke cPanel Anda.
2. Cari dan klik menu **MySQL Database Wizard** (Panduan Basis Data MySQL).
3. **Langkah 1**: Masukkan nama database (misal: `solveta_db`). Nama lengkapnya akan menjadi seperti `usercpanel_solveta_db`. Klik *Next Step*.
4. **Langkah 2**: Buat pengguna database (misal user: `solveta_usr`) dan buat password yang kuat. **Catat nama database, username, dan password ini**. Klik *Create User*.
5. **Langkah 3**: Beri centang pada opsi **ALL PRIVILEGES** (Semua Hak Istimewa), lalu klik *Make Changes* (Buat Perubahan).

---

## Langkah 2: Import Schema Database di phpMyAdmin

1. Kembali ke halaman utama cPanel, cari dan klik menu **phpMyAdmin**.
2. Di panel sebelah kiri phpMyAdmin, klik pada database yang baru saja Anda buat di Langkah 1.
3. Di menu bagian atas, klik tab **Import** (Impor).
4. Klik tombol **Choose File** (Pilih Berkas) dan pilih file **`database.sql`**.
5. Gulir ke bawah dan klik tombol **Import** / **Go** (Kirim).
6. Tunggu beberapa detik hingga muncul pesan sukses berwarna hijau. Seluruh 9 tabel beserta data portofolio, harga, teks, dan akun admin default telah siap digunakan.

---

## Langkah 3: Upload File Website ke File Manager

1. Di cPanel, klik menu **File Manager** (Pengelola Berkas).
2. Di pojok kanan atas File Manager, klik tombol **Settings** (Pengaturan), pastikan opsi **Show Hidden Files (dotfiles)** tercentang, lalu klik *Save*.
3. Masuk ke folder **`public_html`**.
4. Klik tombol **Upload** di bagian atas, lalu pilih file **`solveta-ci4-cpanel.zip`**.
5. Setelah progress upload mencapai 100% (berwarna hijau), kembali ke folder `public_html`.
6. Klik kanan pada file `solveta-ci4-cpanel.zip` lalu pilih **Extract** (Ekstrak) ke direktori `public_html/`.

---

## Langkah 4: Sesuaikan Konfigurasi Database di File `.env`

1. Di dalam folder `public_html`, cari file bernama **`.env`** (jika belum ada, salin/rename dari file `.env.example`).
2. Klik kanan file `.env` lalu pilih **Edit**.
3. Sesuaikan bagian `APP CONFIGURATION` dan `DATABASE CONFIGURATION`:

```ini
CI_ENVIRONMENT = production

# URL website Anda (gunakan https dan sertakan trailing slash /)
app.baseURL = 'https://www.solveta.asia/'

# Database cPanel (Host SELALU bernilai localhost)
database.default.hostname = localhost
database.default.database = usercpanel_solveta_db
database.default.username = usercpanel_solveta_usr
database.default.password = PasswordDatabaseAndaDiCpanel
database.default.DBDriver = MySQLi
database.default.DBPrefix = 
database.default.port = 3306
database.default.charset = utf8mb4
database.default.DBCollat = utf8mb4_unicode_ci
```

4. Klik tombol **Save Changes** (Simpan Perubahan).

---

## Langkah 5: Pengaturan Versi PHP di cPanel

1. Di cPanel, cari menu **Select PHP Version** (atau **MultiPHP Manager**).
2. Pastikan domain `solveta.asia` menggunakan **PHP 8.1**, **PHP 8.2**, atau **PHP 8.3**.
3. Pastikan ekstensi berikut aktif (biasanya sudah aktif secara default):
   - `mysqli` / `pdo_mysql`
   - `mbstring`
   - `intl`
   - `curl`
   - `fileinfo`

---

## Langkah 6: Selesai & Akses Website

- **Website Publik**: Buka `https://www.solveta.asia/`
- **Formulir Pemesanan**: Buka `https://www.solveta.asia/formulir`
- **Portal Admin & CMS**: Buka `https://www.solveta.asia/admin`
  - **Username Default**: `admin`
  - **Password Default**: `admin123`
  - *Catatan: Anda dapat langsung mengubah password ini di Tab Akun & Keamanan setelah berhasil login.*

---

## Keunggulan Konfigurasi Ini

1. **Root Redirection Otomatis**: Dilengkapi file `.htaccess` root yang otomatis mengarahkan akses domain ke folder `public/` tanpa perlu memindahkan file keluar masuk folder.
2. **Koneksi Database Localhost**: Kecepatan query instan dengan latensi minimal karena database dan file website berada di satu server lokal cPanel.
3. **Self-Contained File Upload**: Upload gambar portofolio, logo, dan video langsung tersimpan di folder `public/uploads/` di server hosting Anda sendiri.
