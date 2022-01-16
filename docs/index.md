---
layout: default
title: Selamat datang
nav_order: 1
---

# Selamat datang di Belajar Membuat Website dengan CodeIgniter 4

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki._

Halaman ini dibuat sebagai tutorial dasar membuat website dengan CodeIgniter 4. CodeIgniter (CI) merupakan framework untuk membuat website dengan PHP, selengkapnya kunjungi website resmi [CodeIgniter](https://codeigniter.com/).

## Glosarium

- **Client** : yang meminta akses website (misal web browser Chrome/Firefox).
- **CLI (Command Line Interface)** : menjalankan perintah di terminal (Command Prompt, Powershell, Git Bash, dsb).
- **CRUD** : singkatan Create, Read, Update, Delete.
- **Migrasi** : skema pembuatan struktur database oleh sistem, kumpulan instruksi migrasi akan berurutan berdasarkan waktu dan di rekam riwayat migrasinya.
- **Web Server** : software (perangkat lunak) yang melayani permintaan akses resource sebuah website dari komputer server melalui HTTP atau HTTPS, contoh Apache, Nginx (_baca: engine x_).

## Persyaratan

- Mengetahui dasar bahasa pemrograman dengan PHP.
- Laptop/PC dengan Windows, atau menyesuaikan.
- Web browser versi terbaru, dapat menggunakan Chrome, Edge, atau Mozilla, silahkan update agar mempermudah pengembangan website.

## Tips dalam mengikuti tutorial ini

- Penjelasan yang ada dalam tutorial ini bersifat **general/umum**, instruksi-instruksi tidak diuraikan secara detail melainkan gambaran umumnya saja.
- Untuk menangangi kekurangan tersebut, penulis akan melampirkan link berupa pencarian dengan Google mengenai bagian-bagian yang dirasa perlu pembelajaran lebih lanjut.
- Apabila terdapat kendala dalam mengikuti tutorial ini, penulis menyarankan pemabca untuk mencari solusinya di Google dahulu, apabila belum ketemu solusi silahkan hubungi penulis dengan kontak yang ada [**di sini**](https://github.com/ayadiyulianto/ayadiyulianto#reach-me-on).
- Tutorial ini bersifat **full-text**, apabila pembaca lebih suka tutorial bersifat video silahkan tonton melalui Youtube [TUTORIAL CODEIGNITER 4 oleh Web Programming UNPAS](https://www.youtube.com/watch?v=VckqV2wC1gs&list=PLFIM0718LjIUkkIq1Ub6B5dYNb6IlMvtc).

## Studi Kasus

Studi kasus yang akan dibuat websitenya adalah sistem manajemen usaha percetakan. Sistem ini membutuhkan :

1. **Authentication dan Authorization** : CRUD Users, Login dan Hak Akses (admin, kasir, dan staff).
2. **Manajemen Produk** : CRUD Produk dan Pilihan Harga.
3. **Manajemen Pesanan** : CRUD Keranjang Belanja, Transaksi dan Invoice, Proses Percetakan.
4. **Manajemen Pelanggan** : CRUD Pelanggan, Riwayat Transaksi Pelanggan.
5. **Laporan Usaha** : Laporan Usaha Bulanan.
6. ...

Database yang akan digunakan adalah MySQL. Berikut tabel yang akan dibuat

| **users** | menyimpan info user dan login. |
| **customers** | menyimpan info pelanggan. |
| **products** | menyimpan info jenis-jenis printing dan harganya. |
| **transactions** | menyimpan info transaksi (invoice). |
| **carts** | menyimpan daftar belanja per transaksi. |
| **logs** | menyimpan aktivitas user dalam sistem. |
| ... | |

## Pertanyaan yang sering diajukan

_\*\* Bagian ini akan diperbarui bila ada pertanyaan tentang halaman ini, apabila pembaca ingin bertanya silahkan kirim email ke adiyulianto888@gmail.com_.
