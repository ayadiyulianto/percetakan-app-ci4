<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class BahanModel extends Model
{

	protected $table = 'tb_bahan';
	protected $primaryKey = 'id_bahan';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = ['nama_bahan', 'satuan_kecil', 'stok_satuan_kecil', 'satuan_besar', 'isi_satuan_besar', 'modal_bahan_satuan_kecil'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
