<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableBahan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bahan' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_bahan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'satuan_kecil' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'stok_satuan_kecil' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'default'       => '0'
            ],
            'satuan_besar' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'isi_satuan_besar' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => true
            ],
            'modal_bahan_satuan_kecil' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'default'       => '0'
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
        $this->forge->addKey('id_bahan', true);
        $this->forge->createTable('tb_bahan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bahan');
    }
}
