<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\SatuanModel;

class Satuan extends BaseController
{

	protected $satuanModel;
	protected $validation;

	public function __construct()
	{
		$this->satuanModel = new SatuanModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		if (!has_akses('satuan', 'r')) {
			return redirect()->to('dashboard');
		}
		$data = [
			'menu' 				=> 'satuan',
			'title'     		=> 'Satuan'
		];

		return view('satuan/daftar_satuan', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->satuanModel->select('id, nama_satuan')->findAll();

		foreach ($result as $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][] = array(
				$value->id,
				$value->nama_satuan,

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

			$data = $this->satuanModel->where('id', $id)->first();

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		if (!has_akses('satuan', 'c')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}

		$response = array();

		$fields['nama_satuan'] = $this->request->getPost('namaSatuan');

		$this->validation->setRules([
			'nama_satuan' => ['label' => 'Nama satuan', 'rules' => 'required|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->satuanModel->insert($fields)) {

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
		if (!has_akses('satuan', 'u')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}
		$response = array();

		$fields['id'] = $this->request->getPost('id');
		$fields['nama_satuan'] = $this->request->getPost('namaSatuan');


		$this->validation->setRules([
			'id' => ['label' => 'ID', 'rules' => 'required|max_length[10]'],
			'nama_satuan' => ['label' => 'Nama satuan', 'rules' => 'required|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->satuanModel->update($fields['id'], $fields)) {

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
		if (!has_akses('satuan', 'd')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}

		$response = array();

		$id = $this->request->getPost('id');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->satuanModel->where('id', $id)->delete()) {

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
