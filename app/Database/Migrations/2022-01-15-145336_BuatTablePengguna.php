<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTablePengguna extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengguna'          => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pengguna'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pengguna', true);
        $this->forge->createTable('pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
