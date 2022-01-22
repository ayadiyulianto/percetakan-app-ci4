---
layout: default
title: Struktur Folder CodeIgniter 4
nav_order: 3
comments: true
---

# Struktur Folder CodeIgniter 4

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_.

CodeIgniter 4 sebagai _framework_ PHP memiliki aturan dan struktur folder tersendiri untuk menjalankan tugasnya. Folder dan file dalam _starter project_ (berkas zip yang didownload pertama kali saat memulai proyek ini) sudah disediakan oleh _framework_ CodeIgniter untuk menjalankan fungsi yang membantu mempercepat pembuatan proyek. Bila tidak menggunakan _framework_, kita harus membuat fungsi-fungsi tersebut dari awal agar bisa membuat website dengan performa yang bagus. Struktur folder ini sudah baku dan kita hanya akan mengubah konfigurasi dan membuat file baru untuk menjalankan bisnis proses yang ada. Disini kita akan belajar apa saja fungsi-fungsi folder tersebut.

## Struktur Folder

![Struktur Folder](/assets/img/folder-structure.JPG)
+-- app : merupakan folder utama tempat bisnis proses aplikasi, di folder inilah kita nanti banyak menuliskan kode.
+-- public : merupakan folder yang diakses pengguna website secara langsung lewat internet, hal ini karena disinilah letak file index.php, yang mana merupakan file pertama kali dijalankan bila mengunjungi sebuah website. Pemisahan folder public dengan folder lain digunakan untuk alasan keamanan.
+-- system : merupakan folder dasar dari _framework_ CodeIgniter, yang mengatur agar CodeIgniter dapat berjalan semestinya, kita tidak perlu menyentuh folder ini.
+-- tests : merupakan folder tempat menyimpan file testing otomatis. Daripada developer mencoba fitur-fitur / fungsi dalam aplikasi apakah sudah berjalan baik atau belum secara manual, kita dapat membuat alur testing agar dijalankan secara otomatis oleh komputer. Testing yang baik akan sangat berguna untuk memastikan kode yang dijalankan terhindar dari bug.
+-- writable
+-- .env : singkatan dari environtment, merupakan file untuk menyimpan nilai konfigurasi sistem sesuai dengan lingkungan dijalankan, misal lingkungan development memiliki konfigurasi yang berbeda dengan lingkungan produksi.
+-- composer.json : merupakan file konfigurasi _package_ yang digunakan jika menggunakan _package manager Composer_. Package manager merupakan pengelola package luar (dikembangkan oleh developer lain) yang dapat membantu proses pengembangan software.
+-- spark : merupakan file untuk menjalankan PHP yang dapat membantu pengembangan website dengan CodeIgniter. Contohnya command ''' php spark serve''' yang dijalankan untuk membuat virtual host dari website kita sekaligus mendeploy-nya komputer local.

