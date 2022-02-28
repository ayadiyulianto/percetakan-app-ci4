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
}
