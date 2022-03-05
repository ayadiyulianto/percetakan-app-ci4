<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\BahanModel;
use App\Models\SatuanModel;

class Bahan extends BaseController
{

	protected $bahanModel;
	protected $validation;

	public function __construct()
	{
		$this->satuanModel = new SatuanModel();
		$this->bahanModel = new BahanModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'menu' 				=> 'bahan',
			'title'     		=> 'Bahan',
			'satuan'			=> $this->satuanModel->select('id, nama_satuan')->findAll()
		];

		return view('bahan/daftar_bahan', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->bahanModel->select('id_bahan, nama_bahan, satuan_kecil, stok_satuan_kecil, satuan_besar, isi_satuan_besar, modal_bahan_satuan_kecil')->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id_bahan . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_bahan . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			$satuan_besar = $value->satuan_besar . ' (' . $value->isi_satuan_besar . ' ' . $value->satuan_kecil . ')';
			$modal_bahan = $value->modal_bahan_satuan_kecil . '/' . $value->satuan_kecil;

			$data['data'][$key] = array(
				$value->id_bahan,
				$value->nama_bahan,
				$value->satuan_kecil,
				$value->stok_satuan_kecil,
				$satuan_besar,
				$modal_bahan,

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_bahan');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->bahanModel->where('id_bahan', $id)->first();

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['nama_bahan'] = $this->request->getPost('namaBahan');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['stok_satuan_kecil'] = $this->request->getPost('stokSatuanKecil');
		$fields['satuan_besar'] = $this->request->getPost('satuanBesar');
		$fields['isi_satuan_besar'] = $this->request->getPost('isiSatuanBesar');
		$fields['modal_bahan_satuan_kecil'] = $this->request->getPost('modalBahanSatuanKecil');


		$this->validation->setRules([
			'nama_bahan' => ['label' => 'Nama bahan', 'rules' => 'required|max_length[255]'],
			'satuan_kecil' => ['label' => 'Satuan kecil', 'rules' => 'required|max_length[50]'],
			'stok_satuan_kecil' => ['label' => 'Stok satuan kecil', 'rules' => 'required|numeric|max_length[10]'],
			'satuan_besar' => ['label' => 'Satuan besar', 'rules' => 'permit_empty|max_length[50]'],
			'isi_satuan_besar' => ['label' => 'Isi satuan besar', 'rules' => 'permit_empty|numeric|max_length[10]'],
			'modal_bahan_satuan_kecil' => ['label' => 'Modal bahan satuan kecil', 'rules' => 'required|numeric|max_length[10]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->bahanModel->insert($fields)) {

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

		$fields['id_bahan'] = $this->request->getPost('idBahan');
		$fields['nama_bahan'] = $this->request->getPost('namaBahan');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['stok_satuan_kecil'] = $this->request->getPost('stokSatuanKecil');
		$fields['satuan_besar'] = $this->request->getPost('satuanBesar');
		$fields['isi_satuan_besar'] = $this->request->getPost('isiSatuanBesar');
		$fields['modal_bahan_satuan_kecil'] = $this->request->getPost('modalBahanSatuanKecil');


		$this->validation->setRules([
			'id_bahan' => ['label' => 'ID Bahan', 'rules' => 'required|max_length[10]'],
			'nama_bahan' => ['label' => 'Nama bahan', 'rules' => 'required|max_length[255]'],
			'satuan_kecil' => ['label' => 'Satuan kecil', 'rules' => 'required|max_length[50]'],
			'stok_satuan_kecil' => ['label' => 'Stok satuan kecil', 'rules' => 'required|numeric|max_length[10]'],
			'satuan_besar' => ['label' => 'Satuan besar', 'rules' => 'permit_empty|max_length[50]'],
			'isi_satuan_besar' => ['label' => 'Isi satuan besar', 'rules' => 'permit_empty|numeric|max_length[10]'],
			'modal_bahan_satuan_kecil' => ['label' => 'Modal bahan satuan kecil', 'rules' => 'required|numeric|max_length[10]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->bahanModel->update($fields['id_bahan'], $fields)) {

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

		$id = $this->request->getPost('id_bahan');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->bahanModel->where('id_bahan', $id)->delete()) {

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
