<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class TransaksiItemModel extends Model
{
	protected $table = 'tb_transaksi_item';
	protected $primaryKey = 'id_transaksi_item';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = [
		'id_transaksi',
		'no_spk',
		'nama_item',
		'rangkuman',
		'ukuran',
		'kuantiti',
		'satuan',
		'harga_satuan',
		'sub_total_harga',
		'status_desain',
		'file_gambar',
		'keterangan',
		'status_produksi',
		'nama_pelanggan',
		'tgl_order'
	];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function findAllByIdTransaksi($id_transaksi)
	{
		return $this->select('id_transaksi_item, nama_item, rangkuman, ukuran, kuantiti, satuan, harga_satuan, sub_total_harga, status_desain, file_gambar, keterangan')
			->where(array('id_transaksi' => $id_transaksi))
			->findAll();
	}

	public function getDaftarKerjaan()
	{
		return $this->select('tb_transaksi.*, tb_pelanggan.perusahaan, id_transaksi_item, nama_item, rangkuman, ukuran, kuantiti, satuan, status_desain, file_gambar, tb_transaksi_item.keterangan, status_produksi')
			->join('tb_transaksi', 'tb_transaksi_item.id_transaksi=tb_transaksi.id_transaksi AND tb_transaksi.no_faktur IS NOT NULL AND tb_transaksi.deleted_at IS NULL')
			->join("tb_pelanggan", 'tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan', 'left')
			->where("status_produksi <> 'diambil' or status_produksi IS NULL")
			->findAll();
	}
}
