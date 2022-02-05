<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'tgl_order' => [
                'type'          => 'DATETIME'
            ],
            'id_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'nama_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'no_wa' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'tgl_deadline' => [
                'type'          => 'DATETIME',
            ],
            'keterangan' => [
                'type'          => 'TEXT',
                'null'          => true
            ],
            'upah_design' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'default'       => '0'
            ],
            'upah_finishing' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'default'       => '0'
            ],
            'total_bayar' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'tgl_diambil' => [
                'type'          => 'DATETIME',
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
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addForeignKey('id_pelanggan', 'tb_pelanggan', 'id_pelanggan', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('tb_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi');
    }
}
