<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PelangganModel;

class Pelanggan extends BaseController
{

	protected $pelangganModel;
	protected $validation;

	public function __construct()
	{
		$this->pelangganModel = new PelangganModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'menu' 				=> 'pelanggan',
			'title'     		=> 'Pelanggan'
		];

		return view('pelanggan/daftar_pelanggan', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->pelangganModel->select('id_pelanggan, tipe_pelanggan, nama_pelanggan, no_wa')->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id_pelanggan . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_pelanggan . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->id_pelanggan,
				$value->tipe_pelanggan,
				$value->nama_pelanggan,
				$value->no_wa,

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_pelanggan');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->pelangganModel->where('id_pelanggan', $id)->first();

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['id_pelanggan'] = $this->request->getPost('idPelanggan');
		$fields['tipe_pelanggan'] = $this->request->getPost('tipePelanggan');
		$fields['nama_pelanggan'] = $this->request->getPost('namaPelanggan');
		$fields['no_wa'] = $this->request->getPost('noWa');
		$fields['no_hp'] = $this->request->getPost('noHp');
		$fields['alamat'] = $this->request->getPost('alamat');
		$fields['perusahaan'] = $this->request->getPost('perusahaan');


		$this->validation->setRules([
			'tipe_pelanggan' => ['label' => 'Tipe pelanggan', 'rules' => 'required|max_length[50]'],
			'nama_pelanggan' => ['label' => 'Nama pelanggan', 'rules' => 'required|max_length[255]'],
			'no_wa' => ['label' => 'No WA', 'rules' => 'permit_empty|max_length[50]'],
			'no_hp' => ['label' => 'No hp', 'rules' => 'permit_empty|max_length[50]'],
			'alamat' => ['label' => 'Alamat', 'rules' => 'permit_empty|max_length[255]'],
			'perusahaan' => ['label' => 'Perusahaan', 'rules' => 'permit_empty|max_length[255]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->pelangganModel->insert($fields)) {

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

		$fields['id_pelanggan'] = $this->request->getPost('idPelanggan');
		$fields['tipe_pelanggan'] = $this->request->getPost('tipePelanggan');
		$fields['nama_pelanggan'] = $this->request->getPost('namaPelanggan');
		$fields['no_wa'] = $this->request->getPost('noWa');
		$fields['no_hp'] = $this->request->getPost('noHp');
		$fields['alamat'] = $this->request->getPost('alamat');
		$fields['perusahaan'] = $this->request->getPost('perusahaan');


		$this->validation->setRules([
			'tipe_pelanggan' => ['label' => 'Tipe pelanggan', 'rules' => 'required|max_length[50]'],
			'nama_pelanggan' => ['label' => 'Nama pelanggan', 'rules' => 'required|max_length[255]'],
			'no_wa' => ['label' => 'No WA', 'rules' => 'permit_empty|max_length[50]'],
			'no_hp' => ['label' => 'No hp', 'rules' => 'permit_empty|max_length[50]'],
			'alamat' => ['label' => 'Alamat', 'rules' => 'permit_empty|max_length[255]'],
			'perusahaan' => ['label' => 'Perusahaan', 'rules' => 'permit_empty|max_length[255]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->pelangganModel->update($fields['id_pelanggan'], $fields)) {

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

		$id = $this->request->getPost('id_pelanggan');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->pelangganModel->where('id_pelanggan', $id)->delete()) {

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
