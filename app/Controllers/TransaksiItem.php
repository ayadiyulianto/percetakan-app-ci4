<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\TransaksiItemModel;

class TransaksiItem extends BaseController
{

    protected $transaksiItemModel;
    protected $validation;

    public function __construct()
    {
        $this->transaksiItemModel = new TransaksiItemModel();
        $this->validation =  \Config\Services::validation();
    }

    // public function index()
    // {

    //     $data = [
    //             'menu'    		=> 'transaksiItem',
    //             'title'     	=> 'Item Transaksi'				
    // 		];

    // 	return view('transaksiItem', $data);

    // }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->transaksiItemModel->select('id_transaksi_item, nama_item, ukuran, kuantiti, satuan, harga_satuan, sub_total_harga, status_desain, file_gambar, keterangan')->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="editItem(' . $value->id_transaksi_item . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="removeItem(' . $value->id_transaksi_item . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $desain = $value->status_desain;
            if ($value->file_gambar) {
                $desain .= ' <a class="btn btn-sm btn-info" href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="Title" data-gallery="gallery">';
                $desain .= '  <i class="fa fa-image"></i>';
                $desain .= '</a>';
            }
            //'<button type="button" class="btn btn-sm btn-info" onclick="editItem(' . $value->id_transaksi_item . ')"><i class="fa fa-edit"></i></button>';

            $data['data'][$key] = array(
                $value->nama_item,
                $value->ukuran,
                $value->kuantiti,
                $value->satuan,
                $value->harga_satuan,
                $value->sub_total_harga,
                $desain,
                $ops,
            );
        }

        $data['token'] = csrf_hash();
        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('id_transaksi_item');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->transaksiItemModel->where('id_transaksi_item', $id)->first();

            $data->token = csrf_hash();
            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {

        $response = array();

        $fields['id_transaksi_item'] = $this->request->getPost('idTransaksiItem');
        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['nama_item'] = $this->request->getPost('namaItem');
        $fields['ukuran'] = $this->request->getPost('ukuran');
        $fields['kuantiti'] = $this->request->getPost('kuantiti');
        $fields['satuan'] = $this->request->getPost('satuan');
        $fields['harga_satuan'] = $this->request->getPost('hargaSatuan');
        $fields['sub_total_harga'] = $this->request->getPost('subTotalHarga');
        $fields['status_desain'] = $this->request->getPost('statusDesain');
        $fields['file_gambar'] = $this->request->getPost('fileGambar');
        $fields['keterangan'] = $this->request->getPost('keterangan');


        $this->validation->setRules([
            'nama_item' => ['label' => 'Nama item', 'rules' => 'required|max_length[255]'],
            'ukuran' => ['label' => 'Ukuran', 'rules' => 'permit_empty|max_length[50]'],
            'kuantiti' => ['label' => 'Kuantiti', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'satuan' => ['label' => 'Satuan', 'rules' => 'permit_empty|max_length[50]'],
            'harga_satuan' => ['label' => 'Harga satuan', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'sub_total_harga' => ['label' => 'Sub total harga', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'status_desain' => ['label' => 'Status desain', 'rules' => 'permit_empty|max_length[50]'],
            'file_gambar' => ['label' => 'File gambar', 'rules' => 'permit_empty|max_length[255]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->transaksiItemModel->insert($fields)) {

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

        $fields['id_transaksi_item'] = $this->request->getPost('idTransaksiItem');
        $fields['nama_item'] = $this->request->getPost('namaItem');
        $fields['ukuran'] = $this->request->getPost('ukuran');
        $fields['kuantiti'] = $this->request->getPost('kuantiti');
        $fields['satuan'] = $this->request->getPost('satuan');
        $fields['harga_satuan'] = $this->request->getPost('hargaSatuan');
        $fields['sub_total_harga'] = $this->request->getPost('subTotalHarga');
        $fields['status_desain'] = $this->request->getPost('statusDesain');
        $fields['file_gambar'] = $this->request->getPost('fileGambar');
        $fields['keterangan'] = $this->request->getPost('keterangan');


        $this->validation->setRules([
            'nama_item' => ['label' => 'Nama item', 'rules' => 'required|max_length[255]'],
            'ukuran' => ['label' => 'Ukuran', 'rules' => 'permit_empty|max_length[50]'],
            'kuantiti' => ['label' => 'Kuantiti', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'satuan' => ['label' => 'Satuan', 'rules' => 'permit_empty|max_length[50]'],
            'harga_satuan' => ['label' => 'Harga satuan', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'sub_total_harga' => ['label' => 'Sub total harga', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'status_desain' => ['label' => 'Status desain', 'rules' => 'permit_empty|max_length[50]'],
            'file_gambar' => ['label' => 'File gambar', 'rules' => 'permit_empty|max_length[255]'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->transaksiItemModel->update($fields['id_transaksi_item'], $fields)) {

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

        $id = $this->request->getPost('id_transaksi_item');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {

            if ($this->transaksiItemModel->where('id_transaksi_item', $id)->delete()) {

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
