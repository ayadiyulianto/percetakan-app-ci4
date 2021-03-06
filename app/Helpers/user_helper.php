<?php

if (!function_exists('current_user')) {

    function current_user()
    {
        $auth = service('auth');

        return $auth->user()->row();
    }
}

if (!function_exists('in_group')) {

    function in_group($group_name)
    {
        $auth = service('auth');

        return $auth->inGroup($group_name, current_user()->id);
    }
}

if (!function_exists('current_group')) {

    function current_group()
    {
        $auth = service('auth');

        return $auth->getUsersGroups()->getRow();
    }
}

if (!function_exists('has_akses')) {

    function has_akses($controller, $crud)
    {
        $hakAkses = array(
            'admin' => array(
                'bahan'             => ['c', 'r', 'u', 'd'],
                'bank'              => ['c', 'r', 'u', 'd'],
                'barang'            => ['c', 'r', 'u', 'd'],
                'daftarKerjaan'     => ['c', 'r', 'u', 'd'],
                'uploadGambar'      => ['u'],
                'dashboard'         => ['c', 'r', 'u', 'd'],
                'kategoriBarang'    => ['c', 'r', 'u', 'd'],
                'pelanggan'         => ['c', 'r', 'u', 'd'],
                'pembayaran'        => ['c', 'r', 'u', 'd'],
                'piutang'           => ['c', 'r', 'u', 'd'],
                'satuan'            => ['c', 'r', 'u', 'd'],
                'transaksi'         => ['c', 'r', 'u', 'd'],
                'transaksiItem'     => ['c', 'r', 'u', 'd'],
                'transaksiItemBarang' => ['c', 'r', 'u', 'd'],
                'keranjang' => ['c', 'r', 'u', 'd'],
                'transaksiBaru' => ['c', 'r', 'u', 'd']
            ),

            'cs' => array(
                'bahan'             => [],
                'bank'              => ['r'],
                'barang'            => [],
                'daftarKerjaan'     => ['c', 'r', 'u'],
                'uploadGambar'      => ['u'],
                'dashboard'         => ['c', 'r', 'u'],
                'kategoriBarang'    => ['c', 'r', 'u'],
                'pelanggan'         => ['c', 'r', 'u'],
                'pembayaran'        => ['r'],
                'piutang'           => ['r'],
                'satuan'            => [],
                'transaksi'         => ['c', 'r', 'u'],
                'transaksiItem'     => ['c', 'r', 'u'],
                'transaksiItemBarang' => ['c', 'r', 'u'],
                'keranjang' => ['c', 'r', 'u'],
                'transaksiBaru' => ['c', 'r', 'u', 'd']
            ),
            'kasir' => array(
                'bahan'             => [],
                'bank'              => [],
                'barang'            => [],
                'daftarKerjaan'     => ['r', 'u',],
                'uploadGambar'      => ['u',],
                'dashboard'         => ['r', 'u',],
                'kategoriBarang'    => [],
                'pelanggan'         => ['c', 'r', 'u'],
                'pembayaran'        => ['c', 'r'],
                'piutang'           => ['c', 'r'],
                'satuan'            => [],
                'transaksi'         => ['r'],
                'transaksiItem'     => ['r'],
                'transaksiItemBarang' => [],
                'keranjang' => [],
                'transaksiBaru'  => []

            ),

            'desainer' => array(
                'bahan'             => [],
                'bank'              => [],
                'barang'            => [],
                'daftarKerjaan'     => ['r',],
                'uploadGambar'      => ['u'],
                'dashboard'         => ['r', 'u',],
                'kategoriBarang'    => [],
                'pelanggan'         => [],
                'pembayaran'        => [],
                'piutang'           => [],
                'satuan'            => [],
                'transaksi'         => ['c', 'u'],
                'transaksiItem'     => ['c', 'r', 'u'],
                'transaksiItemBarang' => ['c', 'r', 'u'],
                'keranjang' => ['c', 'r'],
                'transaksiBaru'  => []

            ),
            'operator' => array(
                'bahan'             => [],
                'bank'              => [],
                'barang'            => [],
                'daftarKerjaan'     => ['r', 'u',],
                'uploadGambar'      => [],
                'dashboard'         => [],
                'kategoriBarang'    => [],
                'pelanggan'         => [],
                'pembayaran'        => [],
                'piutang'           => [],
                'satuan'            => [],
                'transaksi'         => [],
                'transaksiItem'     => [],
                'transaksiItemBarang' => ['r'],
                'keranjang' => [],
                'transaksiBaru'  => []
            ),
        );

        if (in_group('admin')) $userGroup = 'admin';
        else if (in_group('cs')) $userGroup = 'cs';
        else if (in_group('kasir')) $userGroup = 'kasir';
        else if (in_group('desainer')) $userGroup = 'desainer';
        else $userGroup = 'operator';

        return in_array($crud, $hakAkses[$userGroup][$controller]);
    }
}
