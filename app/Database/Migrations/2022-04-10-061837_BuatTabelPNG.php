<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelPNG extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_png' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nama_png' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'no_hp' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'no_wa' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'alamat' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'instansi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],

        ]);
        $this->forge->addKey('id_png', true);
        $this->forge->createTable('tb_png');
    }

    public function down()
    {
        $this->forge->dropTable('tb_png');
    }
}
