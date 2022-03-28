<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahKolomPerusahaanKeTabelTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_transaksi_pembayaran', [
            'bukti' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
                'after'         => 'kasir'
            ]
        ]);

        $this->forge->addColumn('tb_transaksi_pembayaran', [
            'no_faktur' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
                'after'         => 'kasir'
            ]
        ]);
        $this->forge->addColumn('tb_transaksi_pembayaran', [
            'nama_pelanggan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
                'after'         => 'kasir'
            ]
        ]);
        $this->forge->addColumn('tb_transaksi_pembayaran', [
            'perusahaan' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
                'after'         => 'kasir'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_transaksi_pembayaran', ['bukti,no_faktur,nama_pelanggan,perusahaan']);
    }
}
