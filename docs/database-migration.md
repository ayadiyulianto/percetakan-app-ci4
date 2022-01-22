---
layout: default
title: Migrasi Database
nav_order: 5
---

<!-- markdownlint-disable MD025 MD036 -->

# Migrasi Database

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_

Migrasi database adalah perpindahan database dari suatu tempat ke tempat yang lain. Misalnya database di localhost ke server production.

Perpindahan ini biasanya kita lakukan dengan manual, yakni dengan cara export database di localhost, lalu mengimpornya di server production. Cara ini memang bisa dilakukan. Namun jika nanti kita bekerja dengan tim, cara manual ini akan sangat merepotkan. Saat perubahan skema database terjadi, maka tim yang lain juga harus mengikuti. Mau tidak mau, kita harus dump dan export skema milik kita dan memberikan ke semua anggota tim yang terlibat. Belum lagi versi database yang mereka gunakan beragam. Hal ini tentu akan menghambat proses pengembangan website.

Dalam migrasi setiap modifikasi yang dilakukan terhadap database diurutkan berdasarkan waktu dan direkam riwayatnya. Sehingga seluruh pengembangan dapat diaudit dan dilihat semua developer yang terlibat. Dengan migrasi, _deploy_ website di server production tentu akan lebih mudah.

Database yang akan digunakan pada CodeIgniter 4 adalah MySQL. Pembaca diaharapkan sudah mengetahui dasar-dasar MySQL, jika belum silahkan pelajari di pencarian [dasar-dasar MySQL](https://www.google.com/search?q=dasar+dasar+mysql).

## Membuat Database di phpmyadmin

Untuk mulai menggunakan database MySQL kita dapat mengunakan _phpmyadmin_. XAMPP sudah menyediakan _phyadmin_, untuk mengaksesnya silahkan buka [localhost/phpmyadmin](http://localhost/phpmyadmin/){: target="\_blank"}. Pastikan sudah menjalankan Apache dan MySQL pada XAMPP Control Panel.

Sebelum memulai proyek, buat dulu database dan user agar CodeIgniter bisa mengaksesnya. Untuk pengembangan di localhost, XAMPP menyediakan user default yaitu:

- username : **root**
- password : (kosongkankan saja)

Untuk databasenya kita buat dulu di phpmyadmin. Buat nama database-nya sesuai website akan dibuat, dalam tutorial ini "percetakan".
![Buat database baru](/assets/img/phpmyadmin-create-database.JPG)

## Membuat Migrasi Database dengan _spark_
