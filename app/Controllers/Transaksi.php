<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\BarangModel;
use App\Models\PelangganModel;
use App\Models\SatuanModel;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    protected $auth;
    protected $transaksiModel;
    protected $validation;
    protected $pelangganModel;
    protected $satuanModel;
    protected $barangModel;
    protected $bankModel;

    public function __construct()
    {
        $this->auth = service('auth');
        $this->pelangganModel = new PelangganModel();
        $this->transaksiModel = new TransaksiModel();
        $this->satuanModel = new SatuanModel();
        $this->barangModel = new BarangModel();
        $this->bankModel = new BankModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Transaksi',
        ];

        return view('transaksi/daftar_transaksi', $data);
    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->transaksiModel->select('id_transaksi, no_faktur, tgl_order, id_pelanggan, nama_pelanggan, no_wa, tgl_deadline, kasir, total_bayar, status_transaksi')->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<a class="btn btn-sm btn-info" href="' . site_url('transaksi/detail/' . $value->id_transaksi) . '"><i class="fa fa-edit"></i></a>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_transaksi . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $no_faktur = '<i>' . $value->status_transaksi . '</i>';
            if (!empty($value->no_faktur)) {
                $no_faktur = $value->no_faktur;
            }
            $pelanggan = $value->nama_pelanggan . ' (' . $value->no_wa . ')';

            $data['data'][$key] = array(
                $value->id_transaksi,
                $no_faktur,
                $value->tgl_order,
                $pelanggan,
                $value->tgl_deadline,
                $value->kasir,
                $value->total_bayar,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('id_transaksi');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->getTransaksiOr404($id);

            $data->success = true;
            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {
        $response = array();

        // $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        // $fields['no_faktur'] = $this->request->getPost('noFaktur');
        // $fields['tgl_order'] = $this->request->getPost('tglOrder');
        // $fields['id_pelanggan'] = $this->request->getPost('idPelanggan');
        // $fields['nama_pelanggan'] = $this->request->getPost('namaPelanggan');
        // $fields['no_wa'] = $this->request->getPost('noWa');
        // $fields['tgl_deadline'] = $this->request->getPost('tglDeadline');
        $fields['kasir'] = current_user()->first_name;
        $fields['status_transaksi'] = 'draft';
        $fields['created_by'] = current_user()->id;
        $fields['updated_by'] = current_user()->id;
        // $fields['total_bayar'] = $this->request->getPost('totalBayar');
        // $fields['keterangan'] = $this->request->getPost('keterangan');


        // $this->validation->setRules([
        //     'no_faktur' => ['label' => 'No faktur', 'rules' => 'permit_empty|max_length[50]'],
        //     'tgl_order' => ['label' => 'Tgl order', 'rules' => 'permit_empty|valid_date'],
        //     'id_pelanggan' => ['label' => 'Id pelanggan', 'rules' => 'permit_empty|numeric|max_length[10]'],
        //     'nama_pelanggan' => ['label' => 'Nama pelanggan', 'rules' => 'permit_empty|max_length[255]'],
        //     'no_wa' => ['label' => 'No wa', 'rules' => 'permit_empty|max_length[50]'],
        //     'tgl_deadline' => ['label' => 'Tgl deadline', 'rules' => 'permit_empty|valid_date'],
        //     'kasir' => ['label' => 'Kasir', 'rules' => 'required|max_length[50]'],
        //     'total_bayar' => ['label' => 'Total bayar', 'rules' => 'permit_empty|numeric|max_length[10]'],
        //     'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        // ]);

        // if ($this->validation->run($fields) == FALSE) {

        //     $response['success'] = false;
        //     $response['messages'] = $this->validation->listErrors();
        // } else {

        if ($this->transaksiModel->insert($fields)) {

            $response['success'] = true;
            $response['messages'] = 'Data has been inserted successfully';
        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';
        }
        // }

        return $this->response->setJSON($response);
    }

    public function edit()
    {

        $response = array();

        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['no_faktur'] = $this->request->getPost('noFaktur');
        $fields['tgl_order'] = $this->request->getPost('tglOrder');
        $fields['id_pelanggan'] = $this->request->getPost('idPelanggan');
        $fields['nama_pelanggan'] = $this->request->getPost('namaPelanggan');
        $fields['no_wa'] = $this->request->getPost('noWa');
        $fields['tgl_deadline'] = $this->request->getPost('tglDeadline');
        $fields['kasir'] = $this->request->getPost('kasir');
        $fields['total_bayar'] = $this->request->getPost('totalBayar');
        $fields['keterangan'] = $this->request->getPost('keterangan');


        $this->validation->setRules([
            'no_faktur' => ['label' => 'No faktur', 'rules' => 'permit_empty|max_length[50]'],
            'tgl_order' => ['label' => 'Tgl order', 'rules' => 'permit_empty|valid_date'],
            'id_pelanggan' => ['label' => 'Id pelanggan', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'nama_pelanggan' => ['label' => 'Nama pelanggan', 'rules' => 'permit_empty|max_length[255]'],
            'no_wa' => ['label' => 'No wa', 'rules' => 'permit_empty|max_length[50]'],
            'tgl_deadline' => ['label' => 'Tgl deadline', 'rules' => 'permit_empty|valid_date'],
            'kasir' => ['label' => 'Kasir', 'rules' => 'required|max_length[50]'],
            'total_bayar' => ['label' => 'Total bayar', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->transaksiModel->update($fields['id_transaksi'], $fields)) {

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

        $id = $this->request->getPost('id_transaksi');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {

            if ($this->transaksiModel->where('id_transaksi', $id)->delete()) {

                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Deletion error!';
            }
        }

        return $this->response->setJSON($response);
    }

    // public function baru()
    // {

    // }

    public function detail($id_transaksi)
    {

        $transaksi = $this->getTransaksiOr404($id_transaksi);

        $pelanggan = $this->pelangganModel->select('id_pelanggan, tipe_pelanggan, nama_pelanggan')->findAll();

        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Transaksi Baru',
            'pelanggan'         => $pelanggan,
            'transaksi'         => $transaksi,
            'satuan'            => $this->satuanModel->select('id, nama_satuan')->findAll(),
            'barang'            => $this->barangModel->select('id_barang, kategori_barang, nama_barang')->findAll(),
            'bank'              => $this->bankModel->findAll()
        ];
        return view('transaksi/detail', $data);
    }

    public function pilihPelanggan()
    {
        $response = array();

        $id_transaksi = $this->request->getPost('idTransaksi');
        $transaksi = $this->getTransaksiOr404($id_transaksi);

        $id_pelanggan = $this->request->getPost('idPelanggan');
        if ($this->validation->check($id_pelanggan, 'required|numeric')) {
            $pelanggan = $this->pelangganModel->find($id_pelanggan);
        } else {
            $pelanggan = new \App\Entities\Pelanggan();
            $pelanggan->id_pelanggan = null;
            $pelanggan->tipe_pelanggan = null;
            $pelanggan->nama_pelanggan = $id_pelanggan;
            $pelanggan->no_wa = null;
        }

        $transaksi->id_pelanggan = $pelanggan->id_pelanggan;
        $transaksi->tipe_pelanggan = $pelanggan->tipe_pelanggan;
        $transaksi->nama_pelanggan = $pelanggan->nama_pelanggan;
        $transaksi->no_wa = $pelanggan->no_wa;

        if ($this->transaksiModel->save($transaksi)) {

            $response['success'] = true;
            $response['messages'] = 'Berhasil memilih pelanggan';
        } else {

            $response['success'] = false;
            $response['messages'] = 'Pilih pelanggan gagal!';
        }

        return $this->response->setJSON($response);
    }

    private function getTransaksiOr404($id_transaksi)
    {
        $transaksi = $this->transaksiModel->find($id_transaksi);

        if ($transaksi === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_transaksi not found");
        }
        return $transaksi;
    }
}
