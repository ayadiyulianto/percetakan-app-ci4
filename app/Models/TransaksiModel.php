<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
	protected $table = 'tb_transaksi';
	protected $primaryKey = 'id_transaksi';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = [
		'no_faktur',
		'tgl_order',
		'id_pelanggan',
		'nama_pelanggan',
		'tipe_pelanggan',
		'no_wa',
		'perusahaan',
		'tgl_deadline',
		'kasir',
		'total_bayar',
		'keterangan',
		'pembayaran_jenis',
		'pembayaran_id_bank',
		'pembayaran_nama_bank',
		'pembayaran_norek',
		'pembayaran_atas_nama',
		'status_transaksi',
		'created_by',
		'updated_by',
		'deleted_by'
	];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function findAllWithTotalHarga()
	{
		return $this->select('tb_transaksi.*, SUM(tb_transaksi_item.kuantiti*tb_transaksi_item.harga_satuan) as harus_bayar')
			->join('tb_transaksi_item', 'tb_transaksi_item.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->groupBy('id_transaksi')
			->findAll();
	}

	public function findWithTotalHarga($id_transaksi)
	{
		return $this->select('tb_transaksi.*, SUM(tb_transaksi_item.kuantiti*tb_transaksi_item.harga_satuan) as harus_bayar')
			->join('tb_transaksi_item', 'tb_transaksi_item.id_transaksi = tb_transaksi.id_transaksi AND tb_transaksi.id_transaksi = ' . esc($id_transaksi), 'left')
			->groupBy('id_transaksi')
			->find($id_transaksi);
	}

	public function findAllWithPiutang()
	{
		$item = $this->db->table('tb_transaksi_item')
			->select('id_transaksi, SUM(kuantiti*harga_satuan) as harus_bayar')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		$pembayaran = $this->db->table('tb_transaksi_pembayaran')
			->select('id_transaksi, SUM(jumlah_dibayar) as telah_bayar')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		return $this->select('tb_transaksi.*, tb_transaksi.nama_pelanggan, tb_pelanggan.perusahaan, item.harus_bayar, pembayaran.telah_bayar, (item.harus_bayar-pembayaran.telah_bayar) as kurang')
			->join("($item) item", 'item.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->join("($pembayaran) pembayaran", 'pembayaran.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->join("tb_pelanggan", 'tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan', 'left')
			->where("status_transaksi <> 'draft'")
			->findAll();
	}

	public function findAllKeranjang()
	{
		$item = $this->db->table('tb_transaksi_item')
			->select('id_transaksi, SUM(kuantiti*harga_satuan) as harus_bayar')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		$pembayaran = $this->db->table('tb_transaksi_pembayaran')
			->select('id_transaksi, SUM(jumlah_dibayar) as telah_bayar')
			->groupBy('id_transaksi')
			->getCompiledSelect();
		return $this->select('tb_transaksi.*, tb_transaksi.nama_pelanggan, tb_pelanggan.perusahaan, item.harus_bayar, pembayaran.telah_bayar, (item.harus_bayar-pembayaran.telah_bayar) as kurang')
			->join("($item) item", 'item.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->join("($pembayaran) pembayaran", 'pembayaran.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->join("tb_pelanggan", 'tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan', 'left')
			->where("status_transaksi = 'draft'")
			->findAll();
	}
	public function findWithPiutang($id_transaksi)
	{
		$item = $this->db->table('tb_transaksi_item')
			->select('id_transaksi, SUM(kuantiti*harga_satuan) as harus_bayar')
			->where('id_transaksi', $id_transaksi)
			->groupBy('id_transaksi')
			->getCompiledSelect();
		$pembayaran = $this->db->table('tb_transaksi_pembayaran')
			->select('id_transaksi, SUM(jumlah_dibayar) as telah_bayar')
			->where('id_transaksi', $id_transaksi)
			->groupBy('id_transaksi')
			->getCompiledSelect();
		return $this->select('tb_transaksi.*, item.harus_bayar, tb_pelanggan.perusahaan, tb_transaksi.nama_pelanggan, pembayaran.telah_bayar')
			->join("($item) item", 'item.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->join("tb_pelanggan", 'tb_pelanggan.id_pelanggan = tb_transaksi.id_pelanggan', 'left')
			->join("($pembayaran) pembayaran", 'pembayaran.id_transaksi = tb_transaksi.id_transaksi', 'left')
			->find($id_transaksi);
	}
}
