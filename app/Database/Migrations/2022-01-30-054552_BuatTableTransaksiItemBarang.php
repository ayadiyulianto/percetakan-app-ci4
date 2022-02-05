<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiItemBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'id_transaksi_item' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'id_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
            ],
            'nama_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'jumlah' => [
                'type'           => 'INT',
                'constraint'     => '10'
            ],
            'harga'  => [
                'type'          => 'INT',
                'constraint'    => '10',
            ],
            'total_harga'  => [
                'type'          => 'INT',
                'constraint'    => '10',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_transaksi_item', 'tb_transaksi_item', 'id_transaksi_item', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'tb_barang', 'id_barang', 'CASCADE', 'SET NULL');
        $this->forge->createTable('tb_transaksi_item_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_item_barang');
    }
}
