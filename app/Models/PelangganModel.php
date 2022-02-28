<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{

	protected $table = 'tb_pelanggan';
	protected $primaryKey = 'id_pelanggan';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = ['tipe_pelanggan', 'nama_pelanggan', 'no_wa', 'no_hp', 'alamat', 'perusahaan'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
