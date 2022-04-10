<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiPPN extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_ppn' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_perpajakan' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'id_ppn' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'kode_pajak_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'jenis_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'nominal_ppn' => [
                'type'          => 'INT',
                'constraint'    => '10',
            ],
            'ssp_biling_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'file_biling_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'ntpn_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'file_bukti_bayar_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'no_bukti_potong_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'file_bukti_potong_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ]
        ]);
        $this->forge->addKey('id_transaksi_ppn', true);
        $this->forge->addForeignKey('id_perpajakan', 'tb_perpajakan', 'id_perpajakan', 'CASCADE');
        $this->forge->addForeignKey('id_ppn', 'tb_ppn', 'id_ppn', 'CASCADE');
        $this->forge->createTable('tb_transaksi_ppn');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_ppn');
    }
}
