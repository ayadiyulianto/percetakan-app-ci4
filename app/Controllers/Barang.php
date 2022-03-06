<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\BarangModel;
use App\Models\KategoriBarangModel;
use App\Models\SatuanModel;
use App\Models\TransaksiModel;

class Barang extends BaseController
{

	protected $barangModel;
	protected $validation;
	protected $satuanModel;
	protected $transaksiModel;

	public function __construct()
	{
		$this->kategoriBarangModel = new KategoriBarangModel();
		$this->satuanModel = new SatuanModel();
		$this->barangModel = new BarangModel();
		$this->transaksiModel = new TransaksiModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'menu' 				=> 'barang',
			'title'     		=> 'Daftar Barang',
			'kategoriBarang'	=> $this->kategoriBarangModel->select('id, nama_kategori')->findAll(),
			'satuan'			=> $this->satuanModel->select('id, nama_satuan')->findAll()
		];

		return view('barang/daftar_barang', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->barangModel->select('id_barang, kategori_barang, nama_barang, satuan_kecil, harga_jual_umum, harga_jual_reseller')->findAll();

		foreach ($result as $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id_barang . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_barang . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][] = array(
				$value->id_barang,
				$value->kategori_barang,
				$value->nama_barang,
				$value->satuan_kecil,
				$value->harga_jual_umum,
				$value->harga_jual_reseller,

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_barang');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->getBarangOr404($id);

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function getOneByTransaksi()
	{
		$response = array();

		$id_barang = $this->request->getPost('id_barang');
		$id_transaksi = $this->request->getPost('id_transaksi');

		if ($this->validation->check($id_barang, 'required|numeric') && $this->validation->check($id_transaksi, 'required|numeric')) {

			$data = $this->getBarangOr404($id_barang);

			$transaksi = $this->transaksiModel->find($id_transaksi);
			if ($transaksi->tipe_pelanggan == 'agent') {
				$data->harga_by_transaksi = $data->harga_jual_reseller;
			} else {
				$data->harga_by_transaksi = $data->harga_jual_umum;
			}
			$data->harga_terendah = $data->harga_jual_terendah;

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['kategori_barang'] = $this->request->getPost('kategoriBarang');
		$fields['nama_barang'] = $this->request->getPost('namaBarang');
		$fields['deskripsi'] = $this->request->getPost('deskripsi');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['harga_jual_umum'] = $this->request->getPost('hargaJualUmum');
		$fields['harga_jual_reseller'] = $this->request->getPost('hargaJualReseller');
		$fields['harga_jual_terendah'] = $this->request->getPost('hargaJualTerendah');


		$this->validation->setRules([
			'kategori_barang' => ['label' => 'Jenis barang', 'rules' => 'required|max_length[50]'],
			'nama_barang' => ['label' => 'Nama barang', 'rules' => 'required|max_length[255]'],
			'deskripsi' => ['label' => 'Deskripsi', 'rules' => 'permit_empty|max_length[255]'],
			'satuan_kecil' => ['label' => 'Satuan', 'rules' => 'required|max_length[50]'],
			'harga_jual_umum' => ['label' => 'Harga jual umum', 'rules' => 'required|numeric|max_length[10]'],
			'harga_jual_reseller' => ['label' => 'Harga jual reseller', 'rules' => 'required|numeric|max_length[10]'],
			'harga_jual_terendah' => ['label' => 'Harga jual terendah', 'rules' => 'required|numeric|max_length[10]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->barangModel->insert($fields)) {

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

		$fields['id_barang'] = $this->request->getPost('idBarang');
		$fields['kategori_barang'] = $this->request->getPost('kategoriBarang');
		$fields['nama_barang'] = $this->request->getPost('namaBarang');
		$fields['deskripsi'] = $this->request->getPost('deskripsi');
		$fields['satuan_kecil'] = $this->request->getPost('satuanKecil');
		$fields['harga_jual_umum'] = $this->request->getPost('hargaJualUmum');
		$fields['harga_jual_reseller'] = $this->request->getPost('hargaJualReseller');
		$fields['harga_jual_terendah'] = $this->request->getPost('hargaJualTerendah');


		$this->validation->setRules([
			'id_barang' => ['label' => 'ID Barang', 'rules' => 'required|max_length[10]'],
			'kategori_barang' => ['label' => 'Jenis barang', 'rules' => 'required|max_length[50]'],
			'nama_barang' => ['label' => 'Nama barang', 'rules' => 'required|max_length[255]'],
			'deskripsi' => ['label' => 'Deskripsi', 'rules' => 'permit_empty|max_length[255]'],
			'satuan_kecil' => ['label' => 'Satuan', 'rules' => 'required|max_length[50]'],
			'harga_jual_umum' => ['label' => 'Harga jual umum', 'rules' => 'required|numeric|max_length[10]'],
			'harga_jual_reseller' => ['label' => 'Harga jual reseller', 'rules' => 'required|numeric|max_length[10]'],
			'harga_jual_terendah' => ['label' => 'Harga jual terendah', 'rules' => 'required|numeric|max_length[10]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->barangModel->update($fields['id_barang'], $fields)) {

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

		$id = $this->request->getPost('id_barang');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->barangModel->where('id_barang', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletion succeeded';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Deletion error!';
			}
		}

		return $this->response->setJSON($response);
	}

	private function getBarangOr404($id_barang)
	{
		if ($id_barang === null) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Barang not found");
		}

		$barang = $this->barangModel->find($id_barang);

		if ($barang === null) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_barang not found");
		}
		return $barang;
	}
}
