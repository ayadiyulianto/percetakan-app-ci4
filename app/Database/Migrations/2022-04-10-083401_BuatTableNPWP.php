<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTableNPWP extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_npwp' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'no_npwp' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'bendahara' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ]
        ]);
        $this->forge->addKey('id_npwp', true);
        $this->forge->createTable('tb_npwp');
    }

    public function down()
    {
        $this->forge->dropTable('tb_npwp');
    }
}
