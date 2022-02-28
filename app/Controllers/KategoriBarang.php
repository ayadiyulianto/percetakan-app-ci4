<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\KategoriBarangModel;

class KategoriBarang extends BaseController
{

	protected $kategoriBarangModel;
	protected $validation;

	public function __construct()
	{
		$this->kategoriBarangModel = new KategoriBarangModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'menu' 				=> 'barang',
			'title'     		=> 'Kategori Barang'
		];

		return view('barang/daftar_kategori', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->kategoriBarangModel->select('id, nama_kategori')->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->id,
				$value->nama_kategori,

				$ops,
			);
		}

		$data['token'] = csrf_hash();
		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->kategoriBarangModel->where('id', $id)->first();

			$data->token = csrf_hash();
			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['id'] = $this->request->getPost('id');
		$fields['nama_kategori'] = $this->request->getPost('namaKategori');


		$this->validation->setRules([
			'nama_kategori' => ['label' => 'Nama kategori', 'rules' => 'required|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->kategoriBarangModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = 'Data has been inserted successfully';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Insertion error!';
			}
		}

		$response['token'] = csrf_hash();
		return $this->response->setJSON($response);
	}

	public function edit()
	{

		$response = array();

		$fields['id'] = $this->request->getPost('id');
		$fields['nama_kategori'] = $this->request->getPost('namaKategori');


		$this->validation->setRules([
			'nama_kategori' => ['label' => 'Nama kategori', 'rules' => 'required|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->kategoriBarangModel->update($fields['id'], $fields)) {

				$response['success'] = true;
				$response['messages'] = 'Successfully updated';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Update error!';
			}
		}

		$response['token'] = csrf_hash();
		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('id');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->kategoriBarangModel->where('id', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}

		$response['token'] = csrf_hash();
		return $this->response->setJSON($response);
	}
}
