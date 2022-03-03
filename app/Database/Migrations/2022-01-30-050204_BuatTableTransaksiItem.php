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
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'no_spk' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'unique'        => true,
                'null'          => true
            ],
            'nama_item' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'rangkuman' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'ukuran' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'kuantiti' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'default'       => '0'
            ],
            'satuan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'harga_satuan' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'default'       => '0'
            ],
            'sub_total_harga' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'default'       => '0'
            ],
            'file_gambar' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'keterangan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'status_desain' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'status_produksi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
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
