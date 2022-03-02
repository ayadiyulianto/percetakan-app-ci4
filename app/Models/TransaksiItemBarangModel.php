<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class TransaksiItemBarangModel extends Model
{

	protected $table = 'tb_transaksi_item_barang';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['id_transaksi_item', 'id_barang', 'nama_barang', 'satuan_kecil', 'panjang', 'lebar', 'luas', 'jumlah', 'harga', 'total_harga'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
