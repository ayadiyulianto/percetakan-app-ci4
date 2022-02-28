<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTablePelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'tipe_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'nama_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'no_hp' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'no_wa' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'alamat' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'perusahaan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
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
        $this->forge->addKey('id_pelanggan', true);
        $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan');
    }
}
