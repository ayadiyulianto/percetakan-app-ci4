---
layout: default
title: Studi Kasus
nav_order: 6
---

<!-- markdownlint-disable MD025 MD036 -->

# Studi Kasus

_\*\* docs ini masih dalam pengembangan, materi akan ditambah dan diperbaiki_

Studi kasus yang akan dibuat websitenya adalah sistem manajemen usaha percetakan. Sistem ini membutuhkan :

1. **Authentication dan Authorization** : CRUD Users, Login dan Hak Akses (admin, kasir, dan operator).
2. **Manajemen Produk** : CRUD Produk dan Pilihan Harga.
3. **Manajemen Stok Barang** : CRUD Barang dan Stok untuk penjualan dan bahan percetakan.
4. **Manajemen Pesanan** : CRUD Keranjang Belanja, Transaksi dan Invoice.
5. **Manajemen Produksi** : Manajemen proses produksi.
6. **Manajemen Pelanggan** : CRUD Pelanggan, Riwayat Transaksi Pelanggan.
7. **Laporan Usaha** : Manajemen Modal Usaha, Laporan Untung Rugi, Laporan Usaha Percetakan Bulanan.
8. ...

Database yang akan digunakan adalah MySQL. Berikut tabel yang akan dibuat

| **users...** | menyimpan info user dan login (skema disediakan oleh library IonAuth 4). |
| **tb_pelanggan** | menyimpan info pelanggan. |
| **tb_bahan** | menyimpan info bahan modal percetakanan. |
| **tb_barang** | menyimpan info jenis-jenis printing dan harganya. |
| **tb_bahan_barang** | tabel bantu untuk menyimpan barang A membutuhkan barang apa saja. |
| **tb_transaksi** | menyimpan info transaksi (invoice). |
| **tb_transaksi_biaya_tambahan** | menyimpan biaya-biaya tambahan dalam transaksi. |
| **tb_transaksi_item** | menyimpan info "barang custom" per transaksi. "Barang custom" karena tiap barang yang dipesan pelanggan membutuhkan bahan berbeda-beda. |
| **tb_transaksi_item_barang** | menyimpan barang apa saja yang dibutuhkan untuk membuat "barang custom". |
| ... | table lain menyusul menyesuaikan kebutuhan. |
