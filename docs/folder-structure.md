---
layout: default
title: Struktur Folder CodeIgniter 4
nav_order: 3
comments: true
---

<!-- markdownlint-disable MD025 MD033 MD036 -->

# Struktur Folder CodeIgniter 4

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_.

CodeIgniter 4 sebagai _framework_ PHP memiliki aturan dan struktur folder tersendiri untuk menjalankan tugasnya. Folder dan file dalam _starter project_ (berkas zip yang didownload pertama kali saat memulai proyek ini) sudah disediakan oleh _framework_ CodeIgniter untuk menjalankan fungsi yang membantu mempercepat pembuatan proyek. Bila tidak menggunakan _framework_, kita harus membuat fungsi-fungsi tersebut dari awal agar bisa membuat website dengan performa yang bagus. Struktur folder ini sudah baku dan kita hanya akan mengubah konfigurasi dan membuat file baru untuk menjalankan alur proses sesuai kebutuhan website. Disini kita akan belajar apa saja fungsi-fungsi folder tersebut.

## Struktur folder utama

![Struktur folder utama CI4](/assets/img/folder-structure.JPG)

<dl>
<dt>app</dt>
<dd>folder utama tempat alur proses aplikasi, di folder inilah kita nanti banyak menuliskan kode.</dd>
<dt>public</dt>
<dd>folder yang diakses pengguna website secara langsung lewat internet, hal ini karena disinilah letak file index.php, yang mana merupakan file pertama kali dijalankan bila mengunjungi sebuah website. Pemisahan folder public dengan folder lain adalah untuk mengamankan source code website. Di folder ini juga kita meletakkan file-file statis dari website kita, seperti file css, js, images, dsb.</dd>
<dt>system</dt>
<dd>folder dasar dari <i>framework</i> CodeIgniter, yang mengatur agar CodeIgniter dapat berjalan semestinya, kita tidak perlu menyentuh folder ini.</dd>
<dt>tests</dt>
<dd>folder tempat menyimpan file testing otomatis. Daripada developer mencoba fitur-fitur / fungsi dalam aplikasi apakah sudah berjalan baik atau belum secara manual, kita dapat membuat alur testing agar dijalankan secara otomatis oleh komputer. Testing yang baik akan sangat berguna untuk memastikan kode yang dijalankan terhindar dari bug.</dd>
<dt>writable</dt>
<dd>folder untuk menyimpan file-file yang akan dibuat selama website berjalan seperti <i>cache, logs, uploads file, dsb</i>.</dd>
<dt>.env</dt>
<dd>singkatan dari environtment, merupakan file untuk menyimpan nilai konfigurasi sistem sesuai dengan lingkungan dijalankan, misal lingkungan development memiliki konfigurasi yang berbeda dengan lingkungan produksi.</dd>
<dt>composer.json</dt>
<dd>file konfigurasi <i>package</i> yang digunakan jika menggunakan <i>package manager Composer</i>. Package manager merupakan pengelola package luar (dikembangkan oleh developer lain) yang dapat membantu proses pengembangan software.</dd>
<dt>spark</dt>
<dd>file untuk menjalankan PHP yang dapat membantu pengembangan website dengan CodeIgniter. Contohnya command ''' php spark serve''' yang dijalankan untuk membuat virtual host dari website kita sekaligus mendeploy-nya komputer local.</dd>
</dl>

## Struktur folder _app_

![Struktur folder app CI4](/assets/img/folder-app.JPG)

<dl>
    <dt>Config</dt>
        <dd>folder tempat mengatur konfigurasi CodeIgniter, seperti url, autoload, database, filters, routes, dsb. Untuk konfigurasi yang tergantung dengan environtment (development atau production), lebih baik ubah pada file  <i>.env</i> di folder utama.</dd>
    <dt>Controllers</dt>
        <dd>folder dari logika/alur proses website yang akan dikembangkan (Controller dari konsep MVC).</dd>
    <dt>Database</dt>
        <dd>folder untuk migrasi database dan seeding database, berkaitan dengan pembuatan dan modifikasi database.</dd>
    <dt>Filters</dt>
        <dd>folder untuk menyimpan berkas Filter, berkaitan dengan fungsi yang berjalan sebelum/sesudah suatu controller dijalankan.</dd>
    <dt>Helpers</dt>
        <dd>folder untuk menyimpan fungsi-fungsi tunggal (dapat berdiri sendiri) yang sering diakses untuk membantu pengembangan webite.</dd>
    <dt>Languages</dt>
        <dd>folder tempat translasi multibahasa.</dd>
    <dt>Libraries</dt>
        <dd>folder untuk menyimpan <i>Class/File</i> lain yang tidak termasuk salah-satu folder di atas (atau di bawah ini).</dd>
    <dt>Models</dt>
        <dd>folder dari entiti bisnis yang disimpan dalam database (Model dari konsep MVC).</dd>
    <dt>ThirdParty</dt>
        <dd>folder untuk menyimpan library pihak ketiga yang dapat membantu pengembangan website. Daripada membuat sendiri dari awal sebuah fungsi/fitur tertentu, kita dapat menggunakan library yang dibuat oleh developer lain.</dd>
    <dt>Views</dt>
        <dd>folder untuk menyimpan file yang berhubungan dengan tampilan yang akan terlihat di browser client (UI/antar muka), berupa file-file html dan/atau javascript (View dari konsep MVC).</dd>
</dl>

{% include disqus.html %}
