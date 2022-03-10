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
		'status_produksi'
	];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function getDaftarKerjaan()
	{
		$tgl_order = $this->db->table('tb_transaksi')
			->select('id_transaksi, tgl_order')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		$tgl_deadline = $this->db->table('tb_transaksi')
			->select('id_transaksi, tgl_deadline')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		$pelanggan = $this->db->table('tb_transaksi')
			->select('id_transaksi, nama_pelanggan')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		$perusahaan = $this->db->table('tb_pelanggan')
			->select('id_pelanggan, perusahaan')
			->groupBy('id_pelanggan')
			->getCompiledSelect();
		return $this->select('tb_transaksi.*, tgl_order.tgl_order, tgl_deadline.tgl_deadline, pelanggan.nama_pelanggan, perusahaan.perusahaan, id_transaksi_item, nama_item, rangkuman, ukuran, kuantiti, satuan, status_desain, file_gambar, tb_transaksi_item.keterangan, status_produksi')
			->join('tb_transaksi', 'tb_transaksi_item.id_transaksi=tb_transaksi.id_transaksi AND tb_transaksi.no_faktur IS NOT NULL AND tb_transaksi.deleted_at IS NULL')
			->join("($tgl_order) tgl_order", 'tgl_order.id_transaksi = tb_transaksi_item.id_transaksi')
			->join("($tgl_deadline) tgl_deadline", 'tgl_deadline.id_transaksi = tb_transaksi_item.id_transaksi')
			->join("($pelanggan) pelanggan", 'pelanggan.id_transaksi = tb_transaksi_item.id_transaksi')
			->join("($perusahaan) perusahaan", 'perusahaan.id_pelanggan = tb_transaksi.id_pelanggan')
			->where("status_produksi <> 'diambil' or status_produksi IS NULL")
			->findAll();
	}
}
