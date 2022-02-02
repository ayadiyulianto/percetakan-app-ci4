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

Untuk mempelajari lebih lanjut Migrasi di CodeIgniter 4 bisa baca di [dokumentasi resmi](https://codeigniter4.github.io/userguide/dbmgmt/migration.html).

## Membuat Database di phpmyadmin

Untuk mulai menggunakan database MySQL kita dapat mengunakan _phpmyadmin_. XAMPP sudah menyediakan _phyadmin_, untuk mengaksesnya silahkan buka [localhost/phpmyadmin](http://localhost/phpmyadmin/){: target="\_blank"}. Pastikan sudah menjalankan Apache dan MySQL pada XAMPP Control Panel.

Sebelum memulai proyek, buat dulu database dan user agar CodeIgniter bisa mengaksesnya. Untuk pengembangan di localhost, XAMPP menyediakan user default yaitu:

- username : **root**
- password : (kosongkankan saja)

Untuk databasenya kita buat dulu di phpmyadmin. Buat nama database-nya sesuai website akan dibuat, dalam tutorial ini "percetakan".
![Buat database baru](/assets/img/phpmyadmin-create-database.JPG)

## Nama File Migrasi

Setiap nama file migrasi diawali dengan angka yaitu timestamp (waktu pembuatan) agar dapat diurutkan dan dicatat riwayat migrasinya. Format timestamp yang digunakan adalah **YYYYMMDDHHIISS**. Dilanjutkan dengan nama berupa huruf, yaitu deskripsi dari migrasi yang bersangkutan. Seluruh file migrasi disimpan di folder _/app/Database/Migrations_. Contoh nama file migrasi:

- 20121031100537_add_blog.php
- 2012-10-31-100538_alter_blog_track_views.php
- 2012_10_31_100539_alter_blog_add_translations.php

## Migrasi Database dengan _spark_

CodeIgniter menyediakan CLI tool bernama _spark_ untuk memudahkan proses pengembangan website. Kita akan menggunakan _spark_ untuk memudahkan migrasi database. Berikut command yang tersedia. Apabila gagal menjalankan spark pastikan PHP sudah ditambahkan ke PATH Windows [baca kembali instalasi](/p2-installation)

**migrate**

command ini untuk menjalankan migrasi semua dari semua file migrasi. Sehingga database menjadi update sampai migrasi terakhir.

```powershell
php spark migrate
```

**make:migration**

command ini untuk membuat file migrasi, dengan nama file sesuasi timestamps saat ini.

```powershell
php spark make:migration "nama migrasi"
```

**migrate:rollback**

command ini untuk membatalkan semua migrasi, sehingga database kembali ke keadaan semula.

```powershell
php spark migrate:rollback
```

## Membuat Migrasi Database

Buat migrasi terlebih dahulu dengan _spark_ untuk membuat tabel dan skemanya. Misal

```powershell
php spark make:migration "buat_table_pelanggan"
```

Maka file migrasi akan terbuat di folder \_app/Database/Migrations\_.
Untuk membuat migrasi di CodeIgniter 4 kita akan menggunakan Forge, sebuah class yang disediakan CI 4 untuk memanipulasi database. Selengkapnya lihat di [dokumentasi resmi](https://codeigniter4.github.io/userguide/dbmgmt/forge.html).

Buka file migrasi yang baru terbuat tadi. Kemudian copy-paste kode di bawah ini untuk memanipulasi database pelanggan.

```php
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTablePelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pelanggan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pelanggan', true);
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
```
