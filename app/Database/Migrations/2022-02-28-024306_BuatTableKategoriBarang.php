<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableKategoriBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '5',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_kategori' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_kategori_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_kategori_barang');
    }
}
