<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiPembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_pembayaran' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_transaksi' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'jenis_pembayaran' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'id_bank' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'null'          => true
            ],
            'nama_bank' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'norek' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'atas_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'jumlah_dibayar' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'default'       => '0'
            ],
            'kasir' => [
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
            ]
        ]);
        $this->forge->addKey('id_transaksi_pembayaran', true);
        $this->forge->addForeignKey('id_bank', 'tb_bank', 'id_bank', 'CASCADE', 'SET NULL');
        $this->forge->createTable('tb_transaksi_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_pembayaran');
    }
}
