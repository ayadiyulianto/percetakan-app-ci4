<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{

	protected $table = 'tb_transaksi_pembayaran';
	protected $primaryKey = 'id_transaksi_pembayaran';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = [
		'id_transaksi_pembayaran',
		'id_transaksi',
		'created_at',
		'kasir',
		'jenis_pembayaran',
		'nama_bank',
		'norek',
		'atas_nama',
		'jumlah_dibayar'
	];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function findAllPembayaran()
	{
		return $this->select('tb_transaksi_pembayaran.*')
			->where("jumlah_dibayar != 0")
			->findAll();
	}
	public function findHariIniPembayaran()
	{
		return $this->select('tb_transaksi_pembayaran.*')
			->where("CURRENT_DATE()")
			->findAll();
	}
}
