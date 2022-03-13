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
}
