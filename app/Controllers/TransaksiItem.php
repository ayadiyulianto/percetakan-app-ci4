<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\TransaksiItemModel;
use Exception;

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

        $id_transaksi = $this->request->getPost('id_transaksi');

        $data['data'] = array();

        $result = $this->transaksiItemModel->select('id_transaksi_item, nama_item, rangkuman, ukuran, kuantiti, satuan, harga_satuan, sub_total_harga, status_desain, file_gambar, keterangan')
            ->where(array('id_transaksi' => $id_transaksi))
            ->findAll();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<button type="button" class="btn btn-sm btn-success" onclick="itemBarang(' . $value->id_transaksi_item . ')"><i class="fa fa-list"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="editItem(' . $value->id_transaksi_item . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="removeItem(' . $value->id_transaksi_item . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $desain = $value->status_desain;
            if ($value->file_gambar) {
                $desain .= ' <a class="btn btn-sm btn-outline-info" href="' . base_url($value->file_gambar) . '" data-toggle="lightbox" data-title="Title" data-gallery="gallery">';
                $desain .= '  <i class="fa fa-image"></i>';
                $desain .= '</a>';
            }

            $nama_item = $value->nama_item . '<br>(' . $value->rangkuman . ')';

            $data['data'][$key] = array(
                $nama_item,
                $value->ukuran,
                $value->kuantiti,
                $value->satuan,
                number_to_currency($value->harga_satuan, 'IDR', 'id_ID', 2),
                number_to_currency($value->sub_total_harga, 'IDR', 'id_ID', 2),
                $desain,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('id_transaksi_item');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->transaksiItemModel->where('id_transaksi_item', $id)->first();

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
        $fields['status_desain'] = $this->request->getPost('statusDesain');
        $fields['keterangan'] = $this->request->getPost('keterangan');

        $this->validation->setRules([
            'namaItem' => ['label' => 'Nama item', 'rules' => 'required|max_length[255]'],
            'ukuran' => ['label' => 'Ukuran', 'rules' => 'permit_empty|max_length[50]'],
            'kuantiti' => ['label' => 'Kuantiti', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'satuan' => ['label' => 'Satuan', 'rules' => 'permit_empty|max_length[50]'],
            'statusDesain' => ['label' => 'Status desain', 'rules' => 'permit_empty|max_length[50]'],
            'fileGambar' => [
                'label' => 'File Gambar',
                'rules' => [
                    'uploaded[fileGambar]',
                    'mime_in[fileGambar,image/jpg,image/jpeg,image/png,image/gif]',
                ]
            ],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        ]);

        if ($this->validation->withRequest($this->request)->run() == FALSE) { //->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            $filePath = $this->uploadFile($this->request->getFile('fileGambar'));
            if (!empty($filePath)) {
                $fields['file_gambar'] = $filePath;
            }

            if ($this->transaksiItemModel->insert($fields)) {

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

        $fields['id_transaksi_item'] = $this->request->getPost('idTransaksiItem');
        $fields['nama_item'] = $this->request->getPost('namaItem');
        $fields['ukuran'] = $this->request->getPost('ukuran');
        $fields['kuantiti'] = $this->request->getPost('kuantiti');
        $fields['satuan'] = $this->request->getPost('satuan');
        $fields['status_desain'] = $this->request->getPost('statusDesain');
        $fields['keterangan'] = $this->request->getPost('keterangan');

        $this->validation->setRules([
            'namaItem' => ['label' => 'Nama item', 'rules' => 'required|max_length[255]'],
            'ukuran' => ['label' => 'Ukuran', 'rules' => 'permit_empty|max_length[50]'],
            'kuantiti' => ['label' => 'Kuantiti', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'satuan' => ['label' => 'Satuan', 'rules' => 'permit_empty|max_length[50]'],
            'statusDesain' => ['label' => 'Status desain', 'rules' => 'permit_empty|max_length[50]'],
            'fileGambar' => [
                'label' => 'File Gambar',
                'rules' => [
                    'uploaded[fileGambar]',
                    'mime_in[fileGambar,image/jpg,image/jpeg,image/png,image/gif]',
                ]
            ],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        ]);

        if ($this->validation->withRequest($this->request)->run() == FALSE) { //->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            $transaksiItem = $this->getTransaksiItemOr404($fields['id_transaksi_item']);
            $fields['sub_total_harga'] = $transaksiItem->harga_satuan * $fields['kuantiti'];

            $filePath = $this->uploadFile($this->request->getFile('fileGambar'), $transaksiItem->file_gambar);
            if (!empty($filePath)) {
                $fields['file_gambar'] = $filePath;
            }

            if ($this->transaksiItemModel->update($fields['id_transaksi_item'], $fields)) {

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

        return $this->response->setJSON($response);
    }

    private function uploadFile($file, $fileGambarLama = null)
    {
        if (!$file->isValid()) return;

        $folder = 'file-gambar';

        $file->move($folder, $file->getRandomName());

        if (!empty($fileGambarLama)) {
            $path = FCPATH . $fileGambarLama;
            if (is_file($path)) {
                unlink($path);
            }
        }

        return $folder . '/' . $file->getName();

        // try {
        // $path = $file->store('file-gambar', $file->getRandomName());
        // $writablePath = WRITEPATH . 'uploads/' . $path;
        // $saveTo = FCPATH . 'images/' . $file->getName();
        // $image = \Config\Services::image()
        //     ->withFile($writablePath)
        //     ->resize(1024, 1024, true, 'auto')
        //     ->save($writablePath);
        // return $writablePath;
        // } catch (CodeIgniter\Images\ImageException $e) {
        //     return "default.jpg";
        // }
    }

    private function getTransaksiItemOr404($id_transaksi_item)
    {
        $transaksiItem = $this->transaksiItemModel->find($id_transaksi_item);

        if ($transaksiItem === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_transaksi_item not found");
        }
        return $transaksiItem;
    }
}
