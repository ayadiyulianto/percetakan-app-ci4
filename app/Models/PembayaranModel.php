<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{

	protected $table = 'tb_transaksi_pembayaran';
	protected $primaryKey = 'id_transaksi_pembayaran';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = [
		'id_transaksi', 'jenis_pembayaran', 'id_bank', 'nama_bank', 'norek', 'atas_nama',
		'jumlah_dibayar',
		'kasir',
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
}
