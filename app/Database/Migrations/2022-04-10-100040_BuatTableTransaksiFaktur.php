<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableTransaksiFaktur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_faktur' => [
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
            'no_faktur' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'file_faktur' => [
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
        $this->forge->addKey('id_transaksi_faktur', true);
        $this->forge->addForeignKey('id_perpajakan', 'tb_perpajakan', 'id_perpajakan', 'CASCADE');
        $this->forge->createTable('tb_transaksi_faktur');
    }

    public function down()
    {
        $this->forge->dropTable('tb_transaksi_faktur');
    }
}
