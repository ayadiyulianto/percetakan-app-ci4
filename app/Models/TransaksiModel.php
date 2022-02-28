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
		'no_wa', 'tgl_deadline',
		'kasir', 'total_bayar',
		'keterangan',
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
}
