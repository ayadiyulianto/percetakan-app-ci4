<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HapusKolomDeskripsiDariTabelProduk extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('produk', 'deskripsi');
    }

    public function down()
    {
        $this->forge->addColumn('produk', [
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            ]);
    }
}
