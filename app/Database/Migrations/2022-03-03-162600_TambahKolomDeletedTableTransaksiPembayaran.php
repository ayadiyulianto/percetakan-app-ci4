<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahKolomDeletedTableTransaksiPembayaran extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_transaksi_pembayaran', [
            'deleted_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ],
            'deleted_by' => [
                'type'          => 'MEDIUMINT',
                'constraint'    => '8',
                'unsigned'      => true,
                'null'          => true
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_transaksi_pembayaran', ['deleted_at', 'deleted_by']);
    }
}
