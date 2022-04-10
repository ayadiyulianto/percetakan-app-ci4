<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTablePerpajakan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_perpajakan' => [
                'type'              => 'INT',
                'constraint'        => '10',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'perusahaan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'kode_bayar' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'masa' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],

            'tahun' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'id_png' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'null'          => true

            ],
            'nama_png' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],

            'instansi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'id_npwp' => [
                'type'          => 'INT',
                'constraint'    => '10',
                'unsigned'      => true,
                'null'          => true

            ],
            'npwp' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'bendahara' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'nominal' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],

            'file_kegiatan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true
            ],
            'status' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
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
            'deleted_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'created_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ],
            'updated_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ],
            'deleted_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ]
        ]);
        $this->forge->addKey('id_perpajakan', true);
        $this->forge->addForeignKey('id_png', 'tb_png', 'id_png', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('id_npwp', 'tb_npwp', 'id_npwp', 'CASCADE');
        $this->forge->createTable('tb_perpajakan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_perpajakan');
    }
}
