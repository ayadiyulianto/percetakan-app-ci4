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
                'unsigned'          => true,
                'auto_increment'  => true,
            ],
            'id_transaksi_item' => [
                'type'          => 'INT',
                'constraint'            => '10'
            ],
           'id_barang' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true
           ],
           'jumlah' => [
               'type'           => 'INT',
               'constraint'     => '10'
           ],
           'harga'  => [
               'type'               =>
           ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_transaksi_item', 'tb_transaksi_item', 'id_transaksi_item', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_transaksi_item_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_item_barang');
    }
}
