<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'no_faktur' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'unique'        => true,
                'null'          => true
            ],
            'tgl_order' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'id_pelanggan' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'null'          => true
            ],
            'tipe_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'nama_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'no_wa' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'tgl_deadline' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'kasir' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'pembayaran_jenis' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'pembayaran_nama_bank' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'pembayaran_norek' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'pembayaran_atas_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'total_bayar' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'null'          => true
            ],
            'keterangan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'status_transaksi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
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
        $this->forge->createTable('tb_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi');
    }
}
