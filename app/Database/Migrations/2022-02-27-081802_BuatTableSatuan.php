<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableSatuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => '2',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_satuan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tb_satuan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_satuan');
    }
}
