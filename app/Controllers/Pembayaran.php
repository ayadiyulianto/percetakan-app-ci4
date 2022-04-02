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
			'menu'    		=> 'Pembayaran',
			'title'     	=> 'Daftar Pembayaran'
		];

		return view('pembayaran/pembayaran', $data);
	}
	public function bayarHariIni()
	{
		if (!has_akses('pembayaran', 'r')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
		}
		$data = [
			'menu'    		=> 'Pembayaran',
			'title'     	=> 'Pembayaran Hari Ini'
		];

		return view('pembayaran/hari_ini', $data);
	}
	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->pembayaranModel->findAllPembayaran();

		foreach ($result as $key => $value) {
			$bukti = '<div class="btn-group">';
			$bukti .= '	<button type="button" class="btn btn-sm btn-outline-secondary">' . $value->jenis_pembayaran . '</button>';

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="detailPembayaran(' . $value->id_transaksi . ')"><i class="fa fa-list"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_transaksi_pembayaran . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_transaksi_pembayaran . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';


			if ($value->bukti) {
				$bukti .= '    <a class="btn btn-sm btn-outline-info" href="' . base_url($value->bukti) . '" data-toggle="lightbox" data-title="' . $value->nama_bank . '" data-gallery="gallery">';
				$bukti .= '        <i class="fa fa-image"></i>';
				$bukti .= '    </a>';
			}
			$bukti .= '</div>';

			$bank = $value->nama_bank . ' An. ' . $value->atas_nama;
			if ($value->jenis_pembayaran != 'transfer') {

				$bank = $value->nama_bank;
			}
			$pelanggan = $value->nama_pelanggan . ' (' . $value->perusahaan . ') ';
			$data['data'][$key] = array(
				$value->created_at,
				$value->no_faktur,
				$pelanggan,
				$bukti,
				$bank,
				$value->kasir,
				number_to_currency($value->jumlah_dibayar, 'IDR', 'id_ID', 2),
				$ops,
			);
		}

		$data['token'] = csrf_hash();
		return $this->response->setJSON($data);
	}

	public function hariIni()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->pembayaranModel->findHariIniPembayaran();

		foreach ($result as $key => $value) {
			$bukti = '<div class="btn-group">';
			$bukti .= '	<button type="button" class="btn btn-sm btn-outline-secondary">' . $value->jenis_pembayaran . '</button>';

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="detailPembayaran(' . $value->id_transaksi . ')"><i class="fa fa-list"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_transaksi_pembayaran . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_transaksi_pembayaran . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';


			if ($value->bukti) {
				$bukti .= '    <a class="btn btn-sm btn-outline-info" href="' . base_url($value->bukti) . '" data-toggle="lightbox" data-title="' . $value->nama_bank . '" data-gallery="gallery">';
				$bukti .= '        <i class="fa fa-image"></i>';
				$bukti .= '    </a>';
			}
			$bukti .= '</div>';

			$bank = $value->nama_bank . ' An. ' . $value->atas_nama;
			if ($value->jenis_pembayaran != 'transfer') {

				$bank = $value->nama_bank;
			}
			$pelanggan = $value->nama_pelanggan . ' (' . $value->perusahaan . ') ';
			$data['data'][$key] = array(
				$value->created_at,
				$value->no_faktur,
				$pelanggan,
				$bukti,
				$bank,
				$value->kasir,
				number_to_currency($value->jumlah_dibayar, 'IDR', 'id_ID', 2),
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
		$fields['created_at'] = $this->request->getPost('createdAt');
		$fields['kasir'] = $this->request->getPost('kasir');
		$fields['jenis_pembayaran'] = $this->request->getPost('jenisPembayaran');
		$fields['nama_bank'] = $this->request->getPost('namaBank');
		$fields['norek'] = $this->request->getPost('norek');
		$fields['atas_nama'] = $this->request->getPost('atasNama');
		$fields['jumlah_dibayar'] = $this->request->getPost('jumlahDibayar');


		$this->validation->setRules([
			'created_at' => ['label' => 'Created at', 'rules' => 'permit_empty|valid_date'],
			'kasir' => ['label' => 'Kasir', 'rules' => 'permit_empty|max_length[50]'],
			'jenis_pembayaran' => ['label' => 'Jenis pembayaran', 'rules' => 'permit_empty|max_length[50]'],
			'nama_bank' => ['label' => 'Nama bank', 'rules' => 'permit_empty|max_length[50]'],
			'norek' => ['label' => 'Norek', 'rules' => 'permit_empty|max_length[50]'],
			'atas_nama' => ['label' => 'Atas nama', 'rules' => 'permit_empty|max_length[50]'],
			'jumlah_dibayar' => ['label' => 'Jumlah dibayar', 'rules' => 'permit_empty|numeric|max_length[10]'],

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
		$fields['created_at'] = $this->request->getPost('createdAt');
		$fields['kasir'] = $this->request->getPost('kasir');
		$fields['jenis_pembayaran'] = $this->request->getPost('jenisPembayaran');
		$fields['nama_bank'] = $this->request->getPost('namaBank');
		$fields['norek'] = $this->request->getPost('norek');
		$fields['atas_nama'] = $this->request->getPost('atasNama');
		$fields['jumlah_dibayar'] = $this->request->getPost('jumlahDibayar');


		$this->validation->setRules([
			'created_at' => ['label' => 'Created at', 'rules' => 'permit_empty|valid_date'],
			'kasir' => ['label' => 'Kasir', 'rules' => 'permit_empty|max_length[50]'],
			'jenis_pembayaran' => ['label' => 'Jenis pembayaran', 'rules' => 'permit_empty|max_length[50]'],
			'nama_bank' => ['label' => 'Nama bank', 'rules' => 'permit_empty|max_length[50]'],
			'norek' => ['label' => 'Norek', 'rules' => 'permit_empty|max_length[50]'],
			'atas_nama' => ['label' => 'Atas nama', 'rules' => 'permit_empty|max_length[50]'],
			'jumlah_dibayar' => ['label' => 'Jumlah dibayar', 'rules' => 'permit_empty|numeric|max_length[10]'],

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
