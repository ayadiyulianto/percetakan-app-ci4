<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahKolomHargaKeTabelProduk extends Migration
{
    public function up()
    {
        $this->forge->addColumn('produk', [
            'harga'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
            ]
            ]);
    }

    public function down()
    {
        $this->forge->dropColumn('produk', 'harga');
    }
}
