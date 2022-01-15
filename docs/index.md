---
layout: default
---

## Selamat datang di Belajar Membuat Website dengan CodeIgniter 4

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_

CodeIgniter merupakan framework untuk membuat website dengan PHP, selengkapnya kunjungi website resmi [CodeIgniter](https://codeigniter.com/)

### Glosarium

- **CI** : CodeIniter
- **CRUD** : singkatan Create, Read, Update, Delete

### Studi Kasus

Studi kasus yang akan dibuat websitenya adalah sistem manajemen usaha percetakan. Sistem ini membutuhkan :

1. **Authentication dan Authorization** : CRUD Users, Login dan Hak Akses (admin, kasir, dan staff)
2. **Manajemen Produk** : CRUD Produk dan Pilihan Harga
3. **Manajemen Pesanan** : CRUD Keranjang Belanja, Transaksi dan Invoice, Proses Percetakan
4. **Manajemen Pelanggan** : CRUD Pelanggan, Riwayat Transaksi Pelanggan
5. **Laporan Usaha** : Laporan Usaha Bulanan
6. ...

Database yang akan digunakan adalah MySQL. Berikut tabel yang akan dibuat

- **users** : menyimpan info user dan login
- **customers** : menyimpan info pelanggan
- **products** : menyimpan info jenis-jenis printing dan harganya
- **transactions** : menyimpan info transaksi (invoice)
- **carts** : menyimpan daftar belanja per transaksi
- **logs** : menyimpan aktivitas user dalam sistem
- ...

### Persyaratan

- Mengetahui dasar bahasa pemrograman dengan PHP
- Laptop/PC dengan Windows, atau menyesuaikan
- Web browser versi terbaru, dapat menggunakan Chrome, Edge, atau Mozilla, silahkan update agar mempermudah menjalankan website

### Instalasi

- XAMPP
  - XAMPP merupakan webserver Apache yang sudah terdapat MariaDB (MySQL) dan PHP
  - Download [_di sini_](https://www.apachefriends.org/download.html). Pilih installer dengan PHP 8.0.
  - Install secara default di Windows (akan terinstall di direktori _C:\xampp_)
  - Setelah terinstall, jalankan XAMPP Control Panel, kemudian jalankan Apache dan MySQL dengan klik tombol start
  - _Gambar: XAMPP Control Panel_
  - ![XAMPP Control Panel](/assets/img/xampp-control-panel.jpg)
- CodeIgniter 4
  - Kita akan menggunakan CodeIgniter versi 4, silahkan download [di sini](https://codeigniter.com/download)
  - Setelah didownload, ekstrak berkas .zip tersebut, dan ubah nama folder aplikasi menjadi nama website (misal _percetakaan-app_).
  - _(Optional)_ Untuk memudahkan pencarian folder aplikasi nantinya, pindahkan folder aplikasi ke direktori _C:\xampp\htdocs_
- Visual Studio Code
  - Text editor yang disarankan, download [_di sini_](https://code.visualstudio.com/download), namun bisa menggunakan text editor lain seperti Notepad++, Sublime Text, dsb.

### What's Next?

[Dasar MVC (Model, View, Controller)](./dasar-mvc.html).
