<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableBahanBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_bahan' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
            ],
            'id_barang' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_bahan', 'tb_bahan', 'id_bahan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_bahan_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bahan_barang');
    }
}
