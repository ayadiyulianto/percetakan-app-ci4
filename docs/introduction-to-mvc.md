---
layout: default
title: MVC (Model, View, Controller)
nav_order: 4
---

<!-- markdownlint-disable MD025 MD036 -->

# Dasar-dasar MVC (Model, View, Controller)

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_

CodeIgniter sebagai _framework_ menggunakan konsep MVC (Model, View, Controller). MVC sendiri merupakan pola desain arsitektur website yang terbagi menjadi tiga bagian, yaitu model, view, dan controller. Konsep ini dapat menjadikan proses pembuatan website menjadi lebih efektif.

- **Model**, bagian yang mengelola dan berhubungan langsung dengan database.
- **View**, bagian yang akan menyajikan tampilan informasi kepada pengguna.
- **Controller**, bagian yang menghubungkan model dan view dalam setiap proses request dari user.

Dengan konsep MVC ini, website seakan memiliki bagian yang terpisah dan bisa dikembangkan masing-masing. Maka, proses pembuatan website bisa dilakukan lebih cepat karena developer akan lebih fokus pada pengerjaan salah satu bagian saja.

## Alur Proses MVC

![Alur Proses MVC](/assets/img/mvc.jpg)

1. **View** akan meminta data untuk ditampilkan dalam bentuk grafis kepada pengguna.
2. Permintaan tersebut diterima oleh **controller** dan diteruskan ke model untuk diproses.
3. **Model** akan mencari dan mengolah data yang diminta di dalam database. Setelah data ditemukan dan diolah, model akan mengirimkan data tersebut kepada controller.
4. **Controller** menerima data hasil pengolahan model dan mengaturnya di bagian view untuk ditampilkan kepada pengguna.
5. **View** menampilkan data/informasi ke pengguna.

{% include disqus.html %}
