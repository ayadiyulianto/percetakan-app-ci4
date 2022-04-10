<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTablePPh extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pph' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'kode_pajak_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ],
            'jenis_pph' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
            ]
        ]);
        $this->forge->addKey('id_pph', true);
        $this->forge->createTable('tb_pph');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pph');
    }
}
