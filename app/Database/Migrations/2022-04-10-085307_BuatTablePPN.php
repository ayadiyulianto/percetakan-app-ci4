<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTablePPN extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ppn' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kode_pajak_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'jenis_ppn' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ]
        ]);
        $this->forge->addKey('id_ppn', true);
        $this->forge->createTable('tb_ppn');
    }

    public function down()
    {
        $this->forge->dropTable('tb_ppn');
    }
}
