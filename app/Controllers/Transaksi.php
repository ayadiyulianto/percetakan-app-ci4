<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    protected $auth;
    protected $transaksiModel;
    protected $validation;

    public function __construct()
    {
        $this->auth = service('auth');
        $this->transaksiModel = new TransaksiModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Transaksi'
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
            // $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="edit(' . $value->id_transaksi . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '	<a class="btn btn-sm btn-info" href="' . site_url('transaksi/' . $value->id_transaksi) . '"><i class="fa fa-edit"></i></a>';
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

        $data['token'] = csrf_hash();
        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('id_transaksi');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->transaksiModel->where('id_transaksi', $id)->first();

            $data->token = csrf_hash();
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

        $response['token'] = csrf_hash();
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

        $response['token'] = csrf_hash();
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

        $response['token'] = csrf_hash();
        return $this->response->setJSON($response);
    }

    // public function baru()
    // {

    // }

    public function detail($id_transaksi)
    {
        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Transaksi'
        ];
        return view('transaksi/detail');
    }
}
