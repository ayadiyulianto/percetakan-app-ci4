<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableBahan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bahan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'nama_bahan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'satuan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'modal_bahan' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'stok' => [
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
        $this->forge->addKey('id_bahan', true);
        $this->forge->createTable('tb_bahan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bahan');
    }
}
