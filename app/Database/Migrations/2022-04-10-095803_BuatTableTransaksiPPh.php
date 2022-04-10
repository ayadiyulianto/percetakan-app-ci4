<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiPPh extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_pph' => [
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
            'id_pph' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'kode_pajak_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'jenis_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'nominal_pph' => [
                'type'          => 'INT',
                'constraint'    => '10',
            ],
            'ssp_biling_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'file_biling_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'ntpn_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'file_bukti_bayar_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'no_bukti_potong_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'file_bukti_potong_pph' => [
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
        $this->forge->addKey('id_transaksi_pph', true);
        $this->forge->addForeignKey('id_perpajakan', 'tb_perpajakan', 'id_perpajakan', 'CASCADE');
        $this->forge->addForeignKey('id_pph', 'tb_pph', 'id_pph', 'CASCADE');
        $this->forge->createTable('tb_transaksi_pph');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_pph');
    }
}
