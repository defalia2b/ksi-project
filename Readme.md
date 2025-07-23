# Dokumentasi Proyek: Sistem Inventaris dan Kasir (KSI)

## Studi Kasus: Transformasi Digital "Toko Ritel Jaya Abadi"

### Latar Belakang

"Toko Ritel Jaya Abadi" adalah sebuah toko kelontong skala menengah yang telah beroperasi selama 10 tahun. Selama ini, pemilik toko, Bapak Budi, mengandalkan pencatatan manual menggunakan buku besar dan kalkulator untuk mengelola stok barang, melacak penjualan, dan mengelola hubungan dengan pemasok (supplier).

### Masalah yang Dihadapi

Seiring dengan meningkatnya jumlah pelanggan dan variasi produk, metode manual yang digunakan Bapak Budi menimbulkan berbagai masalah serius:

- **Ketidakakuratan Stok Barang**: Sering terjadi perbedaan antara jumlah stok fisik di rak dengan catatan di buku. Hal ini menyebabkan kerugian, baik karena stok kosong (pelanggan kecewa) maupun stok berlebih (modal tertahan dan risiko barang kedaluwarsa).
- **Proses Transaksi Lambat**: Kasir harus memasukkan harga setiap barang secara manual, yang memperlambat antrean pembayaran dan meningkatkan risiko salah hitung.
- **Sulit Melacak Laporan Penjualan**: Bapak Budi kesulitan mendapatkan gambaran cepat tentang produk mana yang paling laku atau kapan waktu penjualan paling ramai. Laporan penjualan bulanan membutuhkan waktu berhari-hari untuk direkapitulasi.
- **Manajemen Supplier Tidak Efisien**: Informasi kontak dan riwayat pemesanan dari supplier tersebar di berbagai catatan, sehingga sulit untuk melakukan pemesanan ulang atau negosiasi harga.

---

## Solusi yang Ditawarkan oleh Aplikasi

Untuk mengatasi kekacauan ini, "Toko Ritel Jaya Abadi" mengimplementasikan **Aplikasi KSI (Kasir dan Stok Inventaris)**. Aplikasi ini dirancang untuk menjadi pusat kendali operasional toko dengan fitur-fitur yang menjawab langsung setiap masalah.

Aplikasi ini menawarkan solusi digital terpusat yang memungkinkan admin (pemilik atau manajer toko) untuk:

- **Mengelola Produk dan Stok**: Melakukan input data produk baru, memperbarui harga, dan melihat sisa stok secara real-time.
- **Melakukan Penyesuaian Stok**: Mencatat penyesuaian jika ada barang yang rusak atau hilang melalui fitur Penyesuaian Stok.
- **Mencatat Transaksi Penjualan**: Mempercepat layanan kasir dengan sistem pencatatan transaksi yang terintegrasi langsung untuk mengurangi stok.
- **Mengelola Supplier dan Kategori**: Menyimpan data supplier dan mengelompokkan produk berdasarkan kategori untuk manajemen yang lebih rapi.

---

## ✨ Fitur-Fitur Utama Aplikasi

Berdasarkan analisis file Filament Resources, aplikasi ini memiliki beberapa fitur manajemen inti:

- **Manajemen Kategori**: Admin dapat menambah, mengubah, dan menghapus kategori produk untuk pengelompokan yang lebih baik.
- **Manajemen Supplier**: Mengelola data pemasok barang, termasuk nama, alamat, dan kontak yang bisa dihubungi.
- **Manajemen Produk**: Mengelola detail setiap produk, seperti nama, kode, harga beli, harga jual, dan jumlah stok awal. Fitur ini terhubung dengan Kategori dan Supplier.
- **Manajemen Transaksi**: Mencatat semua transaksi penjualan yang terjadi. Setiap transaksi akan berisi detail produk yang dibeli, jumlah, dan total harga.
- **Penyesuaian Stok**: Sebuah fitur khusus untuk mencatat perubahan stok di luar transaksi penjualan (misalnya, stok opname, barang rusak, atau barang hilang).
- **Manajemen Pengguna**: Mengatur siapa saja yang bisa mengakses sistem, dengan peran yang bisa didefinisikan (misalnya, admin atau kasir).

---

## 🗃️ Desain Database

Struktur database dirancang untuk mendukung semua fitur di atas. Berikut adalah rincian tabel utama berdasarkan file migrasi di dalam proyek:

### 1. users (dari 0001_01_01_000000_create_users_table.php)

Menyimpan data login untuk pengguna sistem (Admin/Kasir).

| Kolom    | Tipe Data | Keterangan                  |
|----------|-----------|-----------------------------|
| id       | BIGINT    | Primary Key                 |
| name     | STRING    | Nama pengguna               |
| email    | STRING    | Email unik untuk login      |
| password | STRING    | Kata sandi (sudah di-hash)  |

### 2. kategoris (dari 2025_05_21_155442_create_kategoris_table.php)

Menyimpan daftar kategori produk.

| Kolom | Tipe Data | Keterangan                |
|-------|-----------|---------------------------|
| id    | BIGINT    | Primary Key               |
| nama  | STRING    | Nama kategori (contoh: "Makanan Ringan") |

### 3. suppliers (dari 2025_05_21_155448_create_suppliers_table.php)

Menyimpan data pemasok barang.

| Kolom   | Tipe Data | Keterangan         |
|---------|-----------|--------------------|
| id      | BIGINT    | Primary Key        |
| nama    | STRING    | Nama supplier      |
| alamat  | TEXT      | Alamat supplier    |
| telepon | STRING    | Nomor telepon      |

### 4. produks (dari 2025_05_21_155449_create_produks_table.php)

Tabel inti yang menyimpan semua data produk.

| Kolom       | Tipe Data | Keterangan                        |
|-------------|-----------|-----------------------------------|
| id          | BIGINT    | Primary Key                       |
| kategori_id | FK        | Terhubung ke kategoris.id         |
| supplier_id | FK        | Terhubung ke suppliers.id         |
| nama        | STRING    | Nama produk                       |
| harga_beli  | DECIMAL   | Harga modal dari supplier         |
| harga_jual  | DECIMAL   | Harga jual ke pelanggan           |
| stok        | INTEGER   | Jumlah stok saat ini              |

### 5. transaksis (dari 2025_05_21_155450_create_transaksis_table.php)

Mencatat setiap transaksi (header).

| Kolom             | Tipe Data | Keterangan                        |
|-------------------|-----------|-----------------------------------|
| id                | BIGINT    | Primary Key                       |
| total_harga       | DECIMAL   | Total nilai dari satu transaksi   |
| tanggal_transaksi | DATE      | Tanggal saat transaksi terjadi    |

### 6. detail_transaksis (dari 2025_05_21_155451_create_detail_transaksis_table.php)

Mencatat rincian barang per transaksi.

| Kolom        | Tipe Data | Keterangan                                         |
|--------------|-----------|----------------------------------------------------|
| id           | BIGINT    | Primary Key                                        |
| transaksi_id | FK        | Terhubung ke transaksis.id                         |
| produk_id    | FK        | Terhubung ke produks.id                            |
| jumlah       | INTEGER   | Jumlah produk yang dibeli                          |
| subtotal     | DECIMAL   | Harga total untuk produk ini (harga_jual * jumlah) |

### 7. penyesuaian_stoks (dari 2025_05_21_160355_create_penyesuaian_stoks_table.php)

Mencatat semua aktivitas penyesuaian stok.

| Kolom     | Tipe Data | Keterangan                                      |
|-----------|-----------|-------------------------------------------------|
| id        | BIGINT    | Primary Key                                     |
| produk_id | FK        | Terhubung ke produks.id                         |
| jumlah    | INTEGER   | Jumlah yang disesuaikan (bisa positif/negatif)  |
| keterangan| TEXT      | Alasan penyesuaian (misal: "Barang rusak")     |
| tanggal   | DATE      | Tanggal penyesuaian stok                        |