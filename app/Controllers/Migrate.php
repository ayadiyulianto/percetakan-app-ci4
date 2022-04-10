<?php

namespace App\Controllers;

class Migrate extends \CodeIgniter\Controller
{
    public function index()
    {
        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
            echo "Berhasil migrate";
        } catch (\Throwable $e) {
            echo "Error";
        }
    }

    public function updateKolomPerusahaan()
    {
        $db = \Config\Database::connect();

        $query = $db->query("UPDATE tb_transaksi
        INNER JOIN tb_pelanggan ON tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan
        SET tb_transaksi.perusahaan = tb_pelanggan.perusahaan");

        if ($query) {
            echo "Berhasil updateKolomPerusahaan";
        } else {
            echo "Error";
        }
    }
    public function updatePembayaranPerusahaan()
    {
        $db = \Config\Database::connect();

        $query = $db->query("UPDATE tb_transaksi_pembayaran
        INNER JOIN tb_transaksi ON tb_transaksi.id_transaksi = tb_transaksi_pembayaran.id_transaksi
        SET tb_transaksi_pembayaran.perusahaan = tb_transaksi.perusahaan");

        if ($query) {
            echo "Berhasil updatePembayaranPerusahaan";
        } else {
            echo "Error";
        }
    }
    public function updatePembayaranPelanggan()
    {
        $db = \Config\Database::connect();

        $query = $db->query("UPDATE tb_transaksi_pembayaran
        INNER JOIN tb_transaksi ON tb_transaksi.id_transaksi = tb_transaksi_pembayaran.id_transaksi
        SET tb_transaksi_pembayaran.nama_pelanggan = tb_transaksi.nama_pelanggan");

        if ($query) {
            echo "Berhasil updatePembayaranPelanggan";
        } else {
            echo "Error";
        }
    }
    public function updatePembayaranNoFaktur()
    {
        $db = \Config\Database::connect();

        $query = $db->query("UPDATE tb_transaksi_pembayaran
        INNER JOIN tb_transaksi ON tb_transaksi.id_transaksi = tb_transaksi_pembayaran.id_transaksi
        SET tb_transaksi_pembayaran.no_faktur = tb_transaksi.no_faktur");

        if ($query) {
            echo "Berhasil updatePembayaranNoFaktur";
        } else {
            echo "Error";
        }
    }
}
