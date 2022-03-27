<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahKolomPerusahaanKeTabelTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_transaksi', [
            'perusahaan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
                'after'         => 'no_wa'
            ]
        ]);
        $this->forge->addColumn('tb_transaksi_pembayaran', [
            'bukti' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
                'after'         => 'kasir'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_transaksi', ['perusahaan']);
    }
}
