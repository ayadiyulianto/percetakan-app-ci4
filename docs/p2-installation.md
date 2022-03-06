---
layout: default
title: Instalasi dan Persiapan Proyek
nav_order: 2
comments: true
---

<!-- markdownlint-disable MD025 MD036 -->

# Instalasi dan Persiapan Proyek

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_.

Halaman ini menjelaskan tentang _tools_ apa saja yang perlu diinstall untuk mengembangkan CodeIginiter 4.

## Instalasi

### XAMPP

- XAMPP merupakan webserver Apache yang sudah terdapat MariaDB (MySQL) dan PHP.
- Download [_di sini_](https://www.apachefriends.org/download.html). Pilih installer dengan PHP 8.0.
- Install secara default di Windows (akan terinstall di direktori _C:\xampp_).
- Setelah terinstall, jalankan XAMPP Control Panel, kemudian jalankan Apache dan MySQL dengan klik tombol start.
- Ingat bahwa Apache dan MySQL harus selalu dijalankan saat mengembangkan website dengan PHP, untuk itu apabila kita mematikan komputer, besok harinya jangan lupa jalankan kembali Apache dan MySQL di XAMPP Control Panel saat ingin melanjutkan pengembangan website.
- _Gambar: XAMPP Control Panel_.
- ![XAMPP Control Panel](/assets/img/xampp-control-panel.JPG)

- :warning: Untuk memaksimalkan CodeIgniter 4, PHP harus ditambahkan ke **PATH** di _system environment Windows_, caranya dapat pembaca pelajari sendiri dengan pencarian di google ["xampp menambahkan php ke path windows"](https://www.google.com/search?q=xampp+menambahkan+php+ke+path+windows). Langkah ini diperlukan karena akan digunakan untuk menjalankan PHP di terminal (CLI). Pastikan perintah _php -v_ memunculkan versi php saat dijalankan di terminal.

### Visual Studio Code

- Text editor yang disarankan, download [_di sini_](https://code.visualstudio.com/download), namun bisa menggunakan text editor lain seperti Notepad++, Sublime Text, dsb. Kelebihan yang ada dengan menggunakan VS Code adalah gratis, sudah tersedia terminal untuk menjalankan CLI, dan banyak tools yang dapat mempermudah penulisan kode.

### CodeIgniter 4

- Tutorial ini akan menggunakan CodeIgniter versi 4, silahkan download [di sini](https://codeigniter.com/download).
- Setelah didownload, ekstrak berkas .zip tersebut, dan ubah nama folder aplikasi menjadi nama website (misal _percetakaan-app_).
- _(Optional)_ Untuk memudahkan pencarian folder aplikasi nantinya, pindahkan folder aplikasi ke direktori _C:\xampp\htdocs_. Folder htdocs ini merupakan folder khusus XAMPP yang dapat diakses langsung melalui _localhost/nama_\__folder_.
- Ubah nama file _env_ menjadi _.env_ , file ini merupakan file environtment untuk mengatur konfigurasi project

## Penyiapan Local Server

### Web Server

Kebutuhan server untuk Codeigniter 4:

- PHP Versi 7.4 ke atas
- MySQL Versi 5.1 ke atas

Setelah menginstal webserver, kita harus mengaktifkan beberapa ekstension yang dibutuhkan untuk pengembangan CI 4:

### Pembuatan Virtual Host

Tambah virtual host ke C:\xampp\apache\conf\extra\httpd-vhosts.conf
```cmd
<VirtualHost *:80>
    ServerAdmin admin@kaber.printing
    DocumentRoot "C:/xampp7.4/htdocs/percetakan-app-ci4/public"
    ServerName kaber.printing
    ErrorLog "logs/kaber.printing-error.log"
    CustomLog "logs/kaber.printing-access.log" common
    <Directory "C:/xampp7.4/htdocs/percetakan-app-ci4/public">
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

1. Buka notepad as administrator
2. Buka C:\Windows\System32\drivers\etc\hosts
3. Tambahkan ip address dan ServerName di virtual host yg ditambahkan di atas.
```cmd
192.168.101.34  kaber.printing
```

{% include disqus.html %}
