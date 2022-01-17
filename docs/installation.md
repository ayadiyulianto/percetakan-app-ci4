---
layout: default
title: Instalasi dan Persiapan Proyek
nav_order: 2
comments: true
---

# Instalasi dan Persiapan Proyek

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_.

## Instalasi

### XAMPP

- XAMPP merupakan webserver Apache yang sudah terdapat MariaDB (MySQL) dan PHP.
- Download [_di sini_](https://www.apachefriends.org/download.html). Pilih installer dengan PHP 8.0.
- Install secara default di Windows (akan terinstall di direktori _C:\xampp_).
- Setelah terinstall, jalankan XAMPP Control Panel, kemudian jalankan Apache dan MySQL dengan klik tombol start.
- _Gambar: XAMPP Control Panel_.
- ![XAMPP Control Panel](/assets/img/xampp-control-panel.JPG)

- Untuk memaksimalkan CodeIgniter 4, PHP harus ditambahkan ke **PATH** di _system environment Windows_, caranya dapat pembaca pelajari sendiri dengan pencarian di google ["xampp menambahkan php ke path windows"](https://www.google.com/search?q=xampp+menambahkan+php+ke+path+windows). Langkah ini diperlukan karena akan digunakan untuk menjalankan PHP di terminal (CLI). Pastikan command _php -v_ memunculkan versi php saat dijalankan di terminal.

### CodeIgniter 4

- Tutorial ini akan menggunakan CodeIgniter versi 4, silahkan download [di sini](https://codeigniter.com/download).
- Setelah didownload, ekstrak berkas .zip tersebut, dan ubah nama folder aplikasi menjadi nama website (misal _percetakaan-app_).
- _(Optional)_ Untuk memudahkan pencarian folder aplikasi nantinya, pindahkan folder aplikasi ke direktori _C:\xampp\htdocs_.

### Visual Studio Code

- Text editor yang disarankan, download [_di sini_](https://code.visualstudio.com/download), namun bisa menggunakan text editor lain seperti Notepad++, Sublime Text, dsb.

{% include disqus.html %}
