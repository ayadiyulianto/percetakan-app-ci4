-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 11:26 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandbox_percetakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '20181211100537', 'IonAuth\\Database\\Migrations\\Migration_Install_ion_auth', '', 'IonAuth', 1645924990, 1),
(11, '2022-01-30-044510', 'App\\Database\\Migrations\\BuatTablePelanggan', 'default', 'App', 1646021974, 2),
(12, '2022-01-30-044601', 'App\\Database\\Migrations\\BuatTableBahan', 'default', 'App', 1646021974, 2),
(13, '2022-01-30-044701', 'App\\Database\\Migrations\\BuatTableBarang', 'default', 'App', 1646021974, 2),
(14, '2022-01-30-044801', 'App\\Database\\Migrations\\BuatTableBahanBarang', 'default', 'App', 1646021974, 2),
(15, '2022-01-30-045710', 'App\\Database\\Migrations\\BuatTableTransaksi', 'default', 'App', 1646021974, 2),
(16, '2022-01-30-045911', 'App\\Database\\Migrations\\BuatTableTransaksiBiayaTambahan', 'default', 'App', 1646021974, 2),
(17, '2022-01-30-050204', 'App\\Database\\Migrations\\BuatTableTransaksiItem', 'default', 'App', 1646021974, 2),
(18, '2022-01-30-054552', 'App\\Database\\Migrations\\BuatTableTransaksiItemBarang', 'default', 'App', 1646021974, 2),
(19, '2022-02-27-081802', 'App\\Database\\Migrations\\BuatTableSatuan', 'default', 'App', 1646021974, 2),
(20, '2022-02-28-024306', 'App\\Database\\Migrations\\BuatTableKategoriBarang', 'default', 'App', 1646021974, 2),
(21, '2022-02-28-033400', 'App\\Database\\Migrations\\BuatTableBank', 'default', 'App', 1646021974, 2),
(22, '2022-02-28-033506', 'App\\Database\\Migrations\\BuatTableTransaksiPembayaran', 'default', 'App', 1646021974, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan`
--

CREATE TABLE `tb_bahan` (
  `id_bahan` int(10) UNSIGNED NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `satuan_kecil` varchar(50) NOT NULL,
  `stok_satuan_kecil` int(10) NOT NULL DEFAULT 0,
  `satuan_besar` varchar(50) DEFAULT NULL,
  `isi_satuan_besar` int(10) DEFAULT NULL,
  `modal_bahan_satuan_kecil` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `deleted_by` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_bahan`
--

INSERT INTO `tb_bahan` (`id_bahan`, `nama_bahan`, `satuan_kecil`, `stok_satuan_kecil`, `satuan_besar`, `isi_satuan_besar`, `modal_bahan_satuan_kecil`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'A4 Sidu', 'lembar', 100, 'rim', 500, 86, '2022-02-28 00:14:10', '2022-02-28 00:27:01', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_bahan_barang`
--

CREATE TABLE `tb_bahan_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_bahan` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `id_bank` int(5) UNSIGNED NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `norek` varchar(50) NOT NULL,
  `atas_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(10) UNSIGNED NOT NULL,
  `kategori_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `satuan_kecil` varchar(50) NOT NULL,
  `harga_jual_umum` int(10) NOT NULL,
  `harga_jual_reseller` int(10) NOT NULL,
  `harga_jual_terendah` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `deleted_by` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kategori_barang`, `nama_barang`, `deskripsi`, `satuan_kecil`, `harga_jual_umum`, `harga_jual_reseller`, `harga_jual_terendah`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Spanduk', 'Flexy 280', '', 'm2', 24000, 18000, 17000, '2022-02-28 01:50:33', '2022-02-28 01:50:33', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_barang`
--

CREATE TABLE `tb_kategori_barang` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kategori_barang`
--

INSERT INTO `tb_kategori_barang` (`id`, `nama_kategori`) VALUES
(1, 'Spanduk'),
(2, 'Undangan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `tipe_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `no_wa` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `deleted_by` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `tipe_pelanggan`, `nama_pelanggan`, `no_hp`, `no_wa`, `alamat`, `perusahaan`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'umum', 'Adi', NULL, NULL, NULL, NULL, '2022-02-28 05:55:45', '2022-02-27 23:00:12', '2022-02-27 23:00:12', NULL, NULL, NULL),
(2, 'umum', 'Adi Yulianto', '+6282281264609', '082281264609', 'Jl Masjid Al Hikmah 1 No 256, RT 19, Kandang Limun, Muara Bangkahulu', 'Kominfo', '2022-02-27 22:59:20', '2022-02-27 23:00:52', NULL, NULL, NULL, NULL),
(3, 'agent', 'Adi', '+6282281264609', '082281264609', 'Jl Masjid Al Hikmah 1 No 256, RT 19, Kandang Limun, Muara Bangkahulu', 'Kominfo', '2022-02-27 23:15:51', '2022-02-27 23:25:24', '2022-02-27 23:25:24', NULL, NULL, NULL),
(4, 'agent', 'Adi', '+6282281264609', '082281264609', 'Jl Masjid Al Hikmah 1 No 256, RT 19, Kandang Limun, Muara Bangkahulu', 'Kominfo', '2022-02-27 23:25:36', '2022-02-27 23:25:36', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id` int(2) UNSIGNED NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`id`, `nama_satuan`) VALUES
(1, 'pcs'),
(2, 'rim'),
(3, 'lembar'),
(4, 'm2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tgl_order` datetime DEFAULT NULL,
  `id_pelanggan` int(10) UNSIGNED DEFAULT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `no_wa` varchar(50) DEFAULT NULL,
  `tgl_deadline` datetime DEFAULT NULL,
  `kasir` varchar(50) NOT NULL,
  `pembayaran_jenis` varchar(50) DEFAULT NULL,
  `pembayaran_nama_bank` varchar(50) DEFAULT NULL,
  `pembayaran_norek` varchar(50) DEFAULT NULL,
  `pembayaran_atas_nama` varchar(50) DEFAULT NULL,
  `total_bayar` int(10) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status_transaksi` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `deleted_by` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `no_faktur`, `tgl_order`, `id_pelanggan`, `nama_pelanggan`, `no_wa`, `tgl_deadline`, `kasir`, `pembayaran_jenis`, `pembayaran_nama_bank`, `pembayaran_norek`, `pembayaran_atas_nama`, `total_bayar`, `keterangan`, `status_transaksi`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, NULL, '2022-02-28 15:10:02', 1, 'Adi', '082281264609', '2022-03-01 15:10:02', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', '2022-02-28 15:10:02', '2022-02-28 02:26:56', NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', '2022-02-28 03:08:14', '2022-02-28 03:08:14', NULL, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_biaya_tambahan`
--

CREATE TABLE `tb_transaksi_biaya_tambahan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `nama_biaya` varchar(50) NOT NULL,
  `biaya_tambahan` int(10) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_item`
--

CREATE TABLE `tb_transaksi_item` (
  `id_transaksi_item` int(10) UNSIGNED NOT NULL,
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `no_spk` varchar(50) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `rangkuman` varchar(255) DEFAULT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `kuantiti` int(10) UNSIGNED DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `harga_satuan` int(10) DEFAULT NULL,
  `sub_total_harga` int(10) DEFAULT NULL,
  `file_gambar` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status_desain` varchar(50) DEFAULT NULL,
  `status_produksi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_item_barang`
--

CREATE TABLE `tb_transaksi_item_barang` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_transaksi_item` int(10) UNSIGNED NOT NULL,
  `id_barang` int(10) UNSIGNED DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `satuan_kecil` varchar(50) DEFAULT NULL,
  `panjang` decimal(6,2) UNSIGNED DEFAULT NULL,
  `lebar` decimal(6,2) UNSIGNED DEFAULT NULL,
  `luas` decimal(6,2) UNSIGNED NOT NULL DEFAULT 1.00,
  `jumlah` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_pembayaran`
--

CREATE TABLE `tb_transaksi_pembayaran` (
  `id_transaksi_pembayaran` int(10) UNSIGNED NOT NULL,
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `id_bank` int(10) UNSIGNED DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `norek` varchar(50) DEFAULT NULL,
  `atas_nama` varchar(50) DEFAULT NULL,
  `jumlah_dibayar` int(10) NOT NULL,
  `kasir` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` mediumint(8) UNSIGNED DEFAULT NULL,
  `updated_by` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$F0KfTQQA1V2dW1AdMHIiYeMtd43Pna56pnvN3bNwCv0x9NnZYtHVa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1646022268, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `tb_bahan_barang`
--
ALTER TABLE `tb_bahan_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_bahan_barang_id_bahan_foreign` (`id_bahan`),
  ADD KEY `tb_bahan_barang_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD KEY `tb_transaksi_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indexes for table `tb_transaksi_biaya_tambahan`
--
ALTER TABLE `tb_transaksi_biaya_tambahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_transaksi_biaya_tambahan_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `tb_transaksi_item`
--
ALTER TABLE `tb_transaksi_item`
  ADD PRIMARY KEY (`id_transaksi_item`),
  ADD UNIQUE KEY `no_spk` (`no_spk`),
  ADD KEY `tb_transaksi_item_id_transaksi_foreign` (`id_transaksi`);

--
-- Indexes for table `tb_transaksi_item_barang`
--
ALTER TABLE `tb_transaksi_item_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_transaksi_item_barang_id_transaksi_item_foreign` (`id_transaksi_item`),
  ADD KEY `tb_transaksi_item_barang_id_barang_foreign` (`id_barang`);

--
-- Indexes for table `tb_transaksi_pembayaran`
--
ALTER TABLE `tb_transaksi_pembayaran`
  ADD PRIMARY KEY (`id_transaksi_pembayaran`),
  ADD KEY `tb_transaksi_pembayaran_id_bank_foreign` (`id_bank`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_groups_user_id_foreign` (`user_id`),
  ADD KEY `users_groups_group_id_foreign` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_bahan`
--
ALTER TABLE `tb_bahan`
  MODIFY `id_bahan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_bahan_barang`
--
ALTER TABLE `tb_bahan_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `id_bank` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategori_barang`
--
ALTER TABLE `tb_kategori_barang`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_transaksi_biaya_tambahan`
--
ALTER TABLE `tb_transaksi_biaya_tambahan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi_item`
--
ALTER TABLE `tb_transaksi_item`
  MODIFY `id_transaksi_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi_item_barang`
--
ALTER TABLE `tb_transaksi_item_barang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi_pembayaran`
--
ALTER TABLE `tb_transaksi_pembayaran`
  MODIFY `id_transaksi_pembayaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_bahan_barang`
--
ALTER TABLE `tb_bahan_barang`
  ADD CONSTRAINT `tb_bahan_barang_id_bahan_foreign` FOREIGN KEY (`id_bahan`) REFERENCES `tb_bahan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_bahan_barang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_biaya_tambahan`
--
ALTER TABLE `tb_transaksi_biaya_tambahan`
  ADD CONSTRAINT `tb_transaksi_biaya_tambahan_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_item`
--
ALTER TABLE `tb_transaksi_item`
  ADD CONSTRAINT `tb_transaksi_item_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_item_barang`
--
ALTER TABLE `tb_transaksi_item_barang`
  ADD CONSTRAINT `tb_transaksi_item_barang_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`id_barang`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_item_barang_id_transaksi_item_foreign` FOREIGN KEY (`id_transaksi_item`) REFERENCES `tb_transaksi_item` (`id_transaksi_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi_pembayaran`
--
ALTER TABLE `tb_transaksi_pembayaran`
  ADD CONSTRAINT `tb_transaksi_pembayaran_id_bank_foreign` FOREIGN KEY (`id_bank`) REFERENCES `tb_bank` (`id_bank`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `users_groups_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_groups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
