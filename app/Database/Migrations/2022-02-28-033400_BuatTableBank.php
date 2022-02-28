<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableBank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bank' => [
                'type'              => 'INT',
                'constraint'        => '5',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_bank' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'norek' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ],
            'atas_nama' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50'
            ]
        ]);
        $this->forge->addKey('id_bank', true);
        $this->forge->createTable('tb_bank');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bank');
    }
}
