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
                'transaksiItemBarang' => ['c', 'r', 'u', 'd']
            ),
            'desainer' => array(
                'bahan'             => [],
                'bank'              => [],
                'barang'            => [],
                'daftarKerjaan'     => ['r'],
                'uploadGambar'      => ['u'],
                'dashboard'         => [],
                'kategoriBarang'    => [],
                'pelanggan'         => [],
                'pembayaran'        => [],
                'piutang'           => [],
                'satuan'            => [],
                'transaksi'         => [],
                'transaksiItem'     => [],
                'transaksiItemBarang' => ['r']
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
                'transaksiItemBarang' => ['r']
<<<<<<< HEAD
=======
            ),
            'kasir' => array(
                'bahan'             => [],
                'bank'              => [],
                'barang'            => [],
                'daftarKerjaan'     => [],
                'uploadGambar'      => [],
                'dashboard'         => [],
                'kategoriBarang'    => [],
                'pelanggan'         => ['r', 'u',],
                'pembayaran'        => ['r', 'u',],
                'piutang'           => ['r', 'u',],
                'satuan'            => [],
                'transaksi'         => [],
                'transaksiItem'     => [],
                'transaksiItemBarang' => []
>>>>>>> 0266492d8f03aab7758e1e2e0900fdb0b2b06a4a
            ),
        );

        if (in_group('admin')) $userGroup = 'admin';
        else if (in_group('desainer')) $userGroup = 'desainer';
        else if (in_group('kasir')) $userGroup = 'kasir';
        else $userGroup = 'operator';

        return in_array($crud, $hakAkses[$userGroup][$controller]);
    }
}
