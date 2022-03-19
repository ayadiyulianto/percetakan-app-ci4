<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PembayaranModel;

class Pembayaran extends BaseController
{

	protected $pembayaranModel;
	protected $validation;

	public function __construct()
	{
		$this->pembayaranModel = new PembayaranModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		if (!has_akses('pembayaran', 'r')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}
		$data = [
			'menu'    		=> 'pembayaran',
			'title'     	=> 'Pembayaran'
		];

		return view('pembayaran', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->pembayaranModel->select('id_transaksi_pembayaran, id_transaksi, jenis_pembayaran, nama_bank, norek, atas_nama, jumlah_dibayar, kasir')->findAll();

		foreach ($result as $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id_transaksi_pembayaran . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_transaksi_pembayaran . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][] = array(
				$value->id_transaksi_pembayaran,
				$value->id_transaksi,
				$value->jenis_pembayaran,
				$value->nama_bank,
				$value->norek,
				$value->atas_nama,
				$value->jumlah_dibayar,
				$value->kasir,

				$ops,
			);
		}

		$data['token'] = csrf_hash();
		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_transaksi_pembayaran');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->pembayaranModel->where('id_transaksi_pembayaran', $id)->first();

			$data->token = csrf_hash();
			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		if (!has_akses('pembayaran', 'c')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}

		$response = array();

		$fields['id_transaksi_pembayaran'] = $this->request->getPost('idTransaksiPembayaran');
		$fields['id_transaksi'] = $this->request->getPost('idTransaksi');
		$fields['jenis_pembayaran'] = $this->request->getPost('jenisPembayaran');
		$fields['id_bank'] = $this->request->getPost('idBank');
		$fields['nama_bank'] = $this->request->getPost('namaBank');
		$fields['norek'] = $this->request->getPost('norek');
		$fields['atas_nama'] = $this->request->getPost('atasNama');
		$fields['jumlah_dibayar'] = $this->request->getPost('jumlahDibayar');
		$fields['kasir'] = $this->request->getPost('kasir');


		$this->validation->setRules([
			'id_transaksi' => ['label' => 'Id transaksi', 'rules' => 'required|numeric|max_length[10]'],
			'jenis_pembayaran' => ['label' => 'Jenis pembayaran', 'rules' => 'required|max_length[50]'],
			'id_bank' => ['label' => 'Id bank', 'rules' => 'permit_empty|numeric|max_length[10]'],
			'nama_bank' => ['label' => 'Nama bank', 'rules' => 'permit_empty|max_length[50]'],
			'norek' => ['label' => 'Norek', 'rules' => 'permit_empty|max_length[50]'],
			'atas_nama' => ['label' => 'Atas nama', 'rules' => 'permit_empty|max_length[50]'],
			'jumlah_dibayar' => ['label' => 'Jumlah dibayar', 'rules' => 'required|numeric|max_length[10]'],
			'kasir' => ['label' => 'Kasir', 'rules' => 'permit_empty|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->pembayaranModel->insert($fields)) {

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
		if (!has_akses('pembayaran', 'u')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}

		$response = array();

		$fields['id_transaksi_pembayaran'] = $this->request->getPost('idTransaksiPembayaran');
		$fields['id_transaksi'] = $this->request->getPost('idTransaksi');
		$fields['jenis_pembayaran'] = $this->request->getPost('jenisPembayaran');
		$fields['id_bank'] = $this->request->getPost('idBank');
		$fields['nama_bank'] = $this->request->getPost('namaBank');
		$fields['norek'] = $this->request->getPost('norek');
		$fields['atas_nama'] = $this->request->getPost('atasNama');
		$fields['jumlah_dibayar'] = $this->request->getPost('jumlahDibayar');
		$fields['kasir'] = $this->request->getPost('kasir');


		$this->validation->setRules([
			'id_transaksi_pembayaran' => ['label' => 'ID Transaksi Pembayaran', 'rules' => 'required|max_length[10]'],
			'id_transaksi' => ['label' => 'Id transaksi', 'rules' => 'required|numeric|max_length[10]'],
			'jenis_pembayaran' => ['label' => 'Jenis pembayaran', 'rules' => 'required|max_length[50]'],
			'id_bank' => ['label' => 'Id bank', 'rules' => 'permit_empty|numeric|max_length[10]'],
			'nama_bank' => ['label' => 'Nama bank', 'rules' => 'permit_empty|max_length[50]'],
			'norek' => ['label' => 'Norek', 'rules' => 'permit_empty|max_length[50]'],
			'atas_nama' => ['label' => 'Atas nama', 'rules' => 'permit_empty|max_length[50]'],
			'jumlah_dibayar' => ['label' => 'Jumlah dibayar', 'rules' => 'required|numeric|max_length[10]'],
			'kasir' => ['label' => 'Kasir', 'rules' => 'permit_empty|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->pembayaranModel->update($fields['id_transaksi_pembayaran'], $fields)) {

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
		if (!has_akses('pembayaran', 'd')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}

		$response = array();

		$id = $this->request->getPost('id_transaksi_pembayaran');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->pembayaranModel->where('id_transaksi_pembayaran', $id)->delete()) {

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
