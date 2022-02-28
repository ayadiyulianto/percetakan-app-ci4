<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{

	protected $table = 'tb_barang';
	protected $primaryKey = 'id_barang';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = ['kategori_barang', 'nama_barang', 'deskripsi', 'satuan_kecil', 'harga_jual_umum', 'harga_jual_reseller', 'harga_jual_terendah'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
