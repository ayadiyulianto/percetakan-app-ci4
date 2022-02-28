<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kategori_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'nama_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'deskripsi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'  => true
            ],
            'satuan_kecil' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'harga_jual_umum' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'harga_jual_reseller' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'harga_jual_terendah' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'deleted_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'created_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ],
            'updated_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ],
            'deleted_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ]
        ]);
        $this->forge->addKey('id_barang', true);
        $this->forge->createTable('tb_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_barang');
    }
}
