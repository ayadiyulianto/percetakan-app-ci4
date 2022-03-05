<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TransaksiItemBarangModel;
use App\Models\TransaksiItemModel;

class TransaksiItemBarang extends BaseController
{

	protected $db;
	protected $transaksiItemModel;
	protected $transaksiItemBarangModel;
	protected $barangModel;
	protected $validation;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->transaksiItemModel = new TransaksiItemModel();
		$this->transaksiItemBarangModel = new TransaksiItemBarangModel();
		$this->barangModel = new BarangModel();
		$this->validation =  \Config\Services::validation();
	}

	// public function index()
	// {

	//     $data = [
	//             'menu'    		=> 'transaksiItemBarang',
	//             'title'     	=> 'Transaksi Item Barang'				
	// 		];

	// 	return view('transaksiItemBarang', $data);

	// }

	public function getAll($id_transaksi_item = null)
	{
		$response = array();

		$data['data'] = array();

		$builder = $this->transaksiItemBarangModel->select('id, id_barang, nama_barang, satuan_kecil, panjang, lebar, jumlah, harga, total_harga');
		if ($id_transaksi_item != null) {
			$builder->where(array('id_transaksi_item' => $id_transaksi_item));
		}
		$result = $builder->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="editItemBarang(' . $value->id . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="removeItemBarang(' . $value->id . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				// $value->id_barang,
				$value->nama_barang,
				$value->satuan_kecil,
				$value->panjang,
				$value->lebar,
				$value->jumlah,
				number_to_currency($value->harga, 'IDR', 'id_ID', 2),
				number_to_currency($value->total_harga, 'IDR', 'id_ID', 2),

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->getTransaksiItemBarangOr404($id);

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['id'] = $this->request->getPost('id');
		$fields['id_transaksi_item'] = $this->request->getPost('idTransaksiItem');
		$fields['id_barang'] = $this->request->getPost('idBarang');
		$fields['nama_barang'] = $this->request->getPost('namaBarang');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['panjang'] = $this->request->getPost('panjang');
		$fields['lebar'] = $this->request->getPost('lebar');
		$fields['luas'] = $this->request->getPost('luas');
		$fields['jumlah'] = $this->request->getPost('jumlah');
		$fields['harga'] = $this->request->getPost('harga');
		$fields['total_harga'] = $fields['luas'] * $fields['jumlah'] * $fields['harga'];

		$this->validation->setRules([
			'id_transaksi_item' => ['label' => 'Id transaksi item', 'rules' => 'required|numeric|max_length[10]'],
			'id_barang' => ['label' => 'Id barang', 'rules' => 'permit_empty|numeric|max_length[10]'],
			'nama_barang' => ['label' => 'Nama barang', 'rules' => 'permit_empty|max_length[255]'],
			'satuan_kecil' => ['label' => 'Satuan kecil', 'rules' => 'permit_empty|max_length[50]'],
			'panjang' => ['label' => 'Panjang', 'rules' => 'permit_empty'],
			'lebar' => ['label' => 'Lebar', 'rules' => 'permit_empty'],
			'jumlah' => ['label' => 'Jumlah', 'rules' => 'required|numeric|max_length[10]'],
			'harga' => ['label' => 'Harga', 'rules' => 'required|numeric|max_length[10]'],
			'total_harga' => ['label' => 'Total harga', 'rules' => 'required|numeric|max_length[10]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->transaksiItemBarangModel->insert($fields)) {

				$this->updateTransaksiItem($fields['id_transaksi_item']);

				$response['success'] = true;
				$response['messages'] = 'Data has been inserted successfully';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Insertion error!';
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{

		$response = array();

		$fields['id'] = $this->request->getPost('id');
		$fields['id_transaksi_item'] = $this->request->getPost('idTransaksiItem');
		$id_barang = $this->request->getPost('idBarang');
		if ($id_barang) $fields['id_barang'] = $id_barang;
		$fields['nama_barang'] = $this->request->getPost('namaBarang');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['panjang'] = $this->request->getPost('panjang');
		$fields['lebar'] = $this->request->getPost('lebar');
		$fields['luas'] = $this->request->getPost('luas');
		$fields['jumlah'] = $this->request->getPost('jumlah');
		$fields['harga'] = $this->request->getPost('harga');
		$fields['total_harga'] =  $fields['luas'] * $fields['jumlah'] * $fields['harga'];


		$this->validation->setRules([
			'id' => ['label' => 'ID', 'rules' => 'required|max_length[10]'],
			'id_transaksi_item' => ['label' => 'Id transaksi item', 'rules' => 'required|numeric|max_length[10]'],
			'id_barang' => ['label' => 'Id barang', 'rules' => 'permit_empty|numeric|max_length[10]'],
			'nama_barang' => ['label' => 'Nama barang', 'rules' => 'permit_empty|max_length[255]'],
			'satuan_kecil' => ['label' => 'Satuan kecil', 'rules' => 'permit_empty|max_length[50]'],
			'panjang' => ['label' => 'Panjang', 'rules' => 'permit_empty'],
			'lebar' => ['label' => 'Lebar', 'rules' => 'permit_empty'],
			'jumlah' => ['label' => 'Jumlah', 'rules' => 'required|numeric|max_length[10]'],
			'harga' => ['label' => 'Harga', 'rules' => 'required|numeric|max_length[10]'],
			'total_harga' => ['label' => 'Total harga', 'rules' => 'required|numeric|max_length[10]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->transaksiItemBarangModel->update($fields['id'], $fields)) {

				$this->updateTransaksiItem($fields['id_transaksi_item']);

				$response['success'] = true;
				$response['messages'] = 'Successfully updated';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}

		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('id');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			$id_transaksi_item = $this->getTransaksiItemBarangOr404($id)->id_transaksi_item;

			if ($this->transaksiItemBarangModel->where('id', $id)->delete()) {

				$this->updateTransaksiItem($id_transaksi_item);
				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}

		return $this->response->setJSON($response);
	}

	private function getTransaksiItemBarangOr404($id_transaksi_item_barang)
	{
		$transaksiItemBarang = $this->transaksiItemBarangModel->find($id_transaksi_item_barang);

		if ($transaksiItemBarang === null) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_transaksi_item_barang not found");
		}
		return $transaksiItemBarang;
	}

	private function updateTransaksiItem($id_transaksi_item)
	{
		$transaksiItem = $this->transaksiItemModel->find($id_transaksi_item);

		if ($transaksiItem === null) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_transaksi_item not found");
		}

		$harga_satuan = $this->db->table('tb_transaksi_item_barang')->select('SUM(total_harga) as harga_satuan')
			->where('id_transaksi_item', $id_transaksi_item)
			->groupBy('id_transaksi_item')
			->get()
			->getRow()
			->harga_satuan;
		$itemBarang = $this->transaksiItemBarangModel->select('nama_barang')->where('id_transaksi_item', $id_transaksi_item)->findAll();
		$output = array_map(function ($object) {
			return $object->nama_barang;
		}, $itemBarang);
		$rangkuman = join(", ", $output);

		$transaksiItem->rangkuman = $rangkuman;
		$transaksiItem->harga_satuan = $harga_satuan;
		$transaksiItem->sub_total_harga = $transaksiItem->harga_satuan * $transaksiItem->kuantiti;

		$this->transaksiItemModel->save($transaksiItem);
	}
}
