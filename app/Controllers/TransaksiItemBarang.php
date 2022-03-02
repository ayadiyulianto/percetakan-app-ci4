<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TransaksiItemBarangModel;

class TransaksiItemBarang extends BaseController
{

	protected $transaksiItemBarangModel;
	protected $validation;
	protected $barangModel;

	public function __construct()
	{
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

		$result = $this->transaksiItemBarangModel->select('id, id_barang, nama_barang, satuan_kecil, panjang, lebar, jumlah, harga, total_harga');
		if ($id_transaksi_item != null) {
			$result = $result->where(array('id_transaksi_item' => $id_transaksi_item));
		}
		$result = $result->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="editItemBarang(' . $value->id . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="removeItemBarang(' . $value->id . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->id_barang,
				$value->nama_barang,
				$value->satuan_kecil,
				$value->panjang,
				$value->lebar,
				$value->jumlah,
				$value->harga,
				$value->total_harga,

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

			$data = $this->transaksiItemBarangModel->where('id', $id)->first();

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
		$fields['total_harga'] = $this->request->getPost('totalHarga');

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
		$fields['id_barang'] = $this->request->getPost('idBarang');
		$fields['nama_barang'] = $this->request->getPost('namaBarang');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['panjang'] = $this->request->getPost('panjang');
		$fields['lebar'] = $this->request->getPost('lebar');
		$fields['jumlah'] = $this->request->getPost('jumlah');
		$fields['harga'] = $this->request->getPost('harga');
		$fields['total_harga'] = $this->request->getPost('totalHarga');


		$this->validation->setRules([
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

			if ($this->transaksiItemBarangModel->where('id', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}

		return $this->response->setJSON($response);
	}
}
