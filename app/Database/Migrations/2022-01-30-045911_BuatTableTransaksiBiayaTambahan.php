<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiBiayaTambahan extends Migration
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
            'id_transaksi' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
            ],
            'nama_biaya' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'biaya_tambahan' => [
                'type'          => 'INT',
                'constraint'    => '10'
            ],
            'keterangan' => [
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
            'created_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_transaksi', 'tb_transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_transaksi_biaya_tambahan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_biaya_tambahan');
    }
}
