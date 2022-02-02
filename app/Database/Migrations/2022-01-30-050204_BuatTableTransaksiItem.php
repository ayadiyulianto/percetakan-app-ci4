<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_item' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_transaksi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'kuantiti' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'satuan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10'
            ],
            'nama_item' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'total_harga' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'keterangan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'status' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'default'       => 'dipesan'
            ]
        ]);
        $this->forge->addKey('id_transaksi_item', true);
        $this->forge->addForeignKey('id_transaksi', 'tb_transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_transaksi_item');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_item');
    }
}
