<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableBahanBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bahan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'id_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ]
        ]);
        $this->forge->addKey('id_bahan', true);
        $this->forge->addKey('id_barang', true);
        $this->forge->createTable('tb_bahan_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bahan_barang');
    }
}
