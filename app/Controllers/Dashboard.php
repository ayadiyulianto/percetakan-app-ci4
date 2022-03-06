<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!has_akses('dashboard', 'r')) {
            return redirect()->to('daftarKerjaan');
        }

        $data = [
            'menu'              => 'dashboard',
            'controller'        => 'dashboard',
            'title'             => 'Dashboard'
        ];

        return view('dashboard/starter', $data);
    }
}
