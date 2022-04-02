<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\TransaksiItemModel;
use Exception;

class DaftarKerjaan extends BaseController
{

    protected $TransaksiItemModel;
    protected $validation;

    public function __construct()
    {
        $this->TransaksiItemModel = new TransaksiItemModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        if (!has_akses('daftarKerjaan', 'r')) {

            return redirect()->to('piutang');
        }

        $data = [
            'menu'          => 'daftarKerjaan',
            'title'         => 'Daftar Kerjaan'
        ];

        return view('pekerjaan/daftar_kerjaan', $data);
    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->TransaksiItemModel->getDaftarKerjaan();

        foreach ($result as $value) {

            $ops = '<div class="btn-group">';
            if (has_akses('uploadGambar', 'u')) {
                $ops .= '	<button type="button" class="btn btn-sm btn-success" onclick="uploadGambar(' . $value->id_transaksi_item . ')"><i class="fa fa-upload"></i></button>';
            }
            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="itemBarang(' . $value->id_transaksi_item . ')"><i class="fa fa-list"></i></button>';
            if (has_akses('daftarKerjaan', 'u')) {
                $ops .= '	<button type="button" class="btn btn-sm btn-warning" onclick="statusProduksi(' . $value->id_transaksi_item . ')"><i class="fa fa-clipboard-check"></i></button>';
            }
            $ops .= '</div>';

            $desain = '<div class="btn-group">';
            $desain .= '	<button type="button" class="btn btn-sm btn-outline-secondary">' . $value->status_desain . '</button>';
            $tgl_order = $value->tgl_order;
            $tgl_deadline = $value->tgl_deadline;
            $pelanggan = $value->nama_pelanggan . ' - ' . $value->perusahaan;
            if ($value->file_gambar) {
                $desain .= '    <a class="btn btn-sm btn-outline-info" href="' . base_url($value->file_gambar) . '" data-toggle="lightbox" data-title="' . $value->nama_item . '" data-gallery="gallery">';
                $desain .= '        <i class="fa fa-image"></i>';
                $desain .= '    </a>';
            }
            $desain .= '</div>';

            $nama_item = $value->nama_item . '<br>(' . $value->rangkuman . ')';

            $data['data'][] = array(
                $tgl_order,
                $tgl_deadline,
                $pelanggan,
                $nama_item,
                $value->ukuran,
                $value->kuantiti,
                $value->satuan,
                $desain,
                $value->status_produksi,
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

            $data = $this->getTransaksiItemOr404($id);

            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
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
