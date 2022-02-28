<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'menu'              => 'dashboard',
            'controller'        => 'dashboard',
            'title'             => 'Dashboard'
        ];

        return view('dashboard/starter', $data);
    }
}
