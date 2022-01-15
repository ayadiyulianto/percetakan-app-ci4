<?php

namespace App\Controllers;

class Migrate extends \CodeIgniter\Controller
{
    public function index()
    {
        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
            echo "Berhasil";
        } catch (\Throwable $e) {
            echo "Error";
        }
    }

    public function down()
    {
        
    }
}