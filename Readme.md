# KSI Project

## Tentang Proyek
Repositori ini merupakan hasil **fork** dari proyek sebelumnya yang telah dikembangkan dan disesuaikan untuk kebutuhan UTS.  
Beberapa penyesuaian utama meliputi pengaturan ulang `.env`, penambahan model dan controller baru, serta implementasi autentikasi dan enkripsi pada API.

1. **Clone Repository**
    ```sh
    git clone https://github.com/djambred/ksi.git
    ```
2. **Masuk ke Folder Project**
    ```sh
    cd ksi
    ```
3. **Jalankan Docker**
    ```sh
    docker compose up -d --build
    docker exec -it ksi bash
    composer install
    mv .env.example .env
    php artisan storage:link
    php artisan key:generate
    exit
    code .
    ```
4. **Edit File `.env`**
    - Sesuaikan konfigurasi berikut:
      ```env
      APP_TIMEZONE='Asia/Jakarta'
      APP_URL=http://localhost
      ASSET_URL=http://localhost
      DB_CONNECTION=mariadb
      DB_HOST=db_ksi
      DB_PORT=3306
      DB_DATABASE=ksi
      DB_USERNAME=root
      DB_PASSWORD=p455w0rd
      ```
5. **Setelah Edit `.env`, Masuk Lagi ke Container**
    ```sh
    docker exec -it ksi bash
    chown -R www-data:www-data storage/*
    chown -R www-data:www-data bootstrap/*
    php artisan migrate
    php artisan project:init
    ```

6. **Akses Aplikasi**
    - Buka browser ke `http://localhost`
    - Login:
      ```
      user: admin@admin.com
      pass: password
      ```

## Rancangan Model Data Barang (No. 6)

- Model: `Produk`, `Kategori`, `Supplier`, `Transaksi`, `DetailTransaksi`, `PenyesuaianStok`
- Setiap model memiliki relasi dan field sesuai kebutuhan aplikasi.

## Generate Controller API

Untuk setiap resource, controller API dibuat dengan perintah:
```sh
php artisan make:controller Api/KategoriApiController
```
dst..

## Feeder Data
Untuk mengisi data awal ke dalam database, gunakan:
```sh
php artisan db:seed
```

## Generate Filament Resource
Untuk setiap model, resource filament dibuat dengan perintah:
```sh
php artisan make:filament-resource Kategori
```
dst..

## Enkripsi & Autentikasi API

- **Enkripsi:**  
  Response API pada `ProdukApiController.php`, `TransaksiApiController.php`, dan `DetailTransaksiApiController.php` sudah dienkripsi menggunakan helper `EncryptionHelper`.
- **Autentikasi:**  
  Pada file `routes/api.php`, endpoint penting (produk, transaksi, detail-transaksi, penyesuaian-stok) sudah diamankan dengan middleware `client.auth`.  
  Hanya client dengan token valid yang bisa mengakses endpoint ini.




---

# ARSIP INSTRUCTION
- buka terminal ketikkan
```php
git clone git@github.com:djambred/ksi.git
atau
git clone https://github.com/djambred/ksi.git
```
- masuk ke dalam folder yang telah di clone
```php
cd ksi
docker compose up -d --build
docker exec -it ksi bash
composer install
mv .env.example .env
php artisan storage:link
php artisan key:generate
exit 
code .
```
- edit file .env
```php 
APP_TIMEZONE='Asia/Jakarta'
APP_URL=http://localhost
ASSET_URL=http://localhost
DB_CONNECTION=mariadb
DB_HOST=db_ksi
DB_PORT=3306
DB_DATABASE=ksi
DB_USERNAME=root
DB_PASSWORD=p455w0rd
```
- masih didalam container (docker exec -it ksi bash)
```php
chown -R www-data:www-data storage/*
chown -R www-data:www-data bootstrap/*
php artisan migrate
php artisan project:init
```
- buka browser dan akses localhost
```php
user: admin@admin.com
pass: password
```
- buka postman dan lakukan get ke localhost/api/products
- set authentication in postman to bearer

