<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BankModel;
use App\Models\BarangModel;
use App\Models\PelangganModel;
use App\Models\PembayaranModel;
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
    protected $pembayaranModel;
    protected $db;

    public function __construct()
    {
        $this->auth = service('auth');
        $this->db = \Config\Database::connect();
        $this->pelangganModel = new PelangganModel();
        $this->transaksiModel = new TransaksiModel();
        $this->satuanModel = new SatuanModel();
        $this->barangModel = new BarangModel();
        $this->bankModel = new BankModel();
        $this->pembayaranModel = new PembayaranModel();
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

        $result = $this->transaksiModel->findAllWithTotalHarga();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<form method="post" action="' . site_url('transaksi/baru') . '" > ';
            $ops .= '       <input type="hidden" value = "' . $value->id_transaksi . '" name="id_transaksi"><button type="submit" value="submit" name="_method" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></form>';
            $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_transaksi . ')"><i class="fa fa-trash"></i></button>';
            $ops .= '</div>';

            $no_faktur = '<i>' . $value->status_transaksi . '</i>';
            if (!empty($value->no_faktur)) {
                $no_faktur = $value->no_faktur;
            }
            $pelanggan = $value->nama_pelanggan . ' (' . $value->no_wa . ')';
            if (!empty($value->harus_bayar)) {
                $harus_bayar = $value->harus_bayar;
            } else {
                $harus_bayar = 0;
            }

            $data['data'][$key] = array(
                $no_faktur,
                $value->tgl_order,
                $pelanggan,
                $value->tgl_deadline,
                $value->kasir,
                number_to_currency($harus_bayar, 'IDR', 'id_ID', 2),
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

        $fields['kasir'] = current_user()->first_name;
        $fields['status_transaksi'] = 'draft';
        $fields['created_by'] = current_user()->id;
        $fields['updated_by'] = current_user()->id;

        if ($this->transaksiModel->insert($fields)) {

            $response['id_transaksi'] = $this->transaksiModel->getInsertID();
            $response['success'] = true;
            $response['messages'] = 'Data has been inserted successfully';
        } else {

            $response['success'] = false;
            $response['messages'] = 'Insertion error!';
        }

        return $this->response->setJSON($response);
    }

    public function save()
    {
        $response = array();

        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['tgl_deadline'] = $this->request->getPost('tglDeadline');
        $fields['keterangan'] = $this->request->getPost('keterangan');
        $fields['pembayaran_jenis'] = $this->request->getPost('pembayaranJenis');
        $fields['pembayaran_id_bank'] = $this->request->getPost('pembayaranIdBank');
        $fields['dibayar'] = $this->request->getPost('dibayar');

        $this->validation->setRules([
            'tgl_deadline' => ['label' => 'Tgl deadline', 'rules' => 'required|valid_date'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],
            'pembayaran_jenis' => ['label' => 'Jenis Pembayaran', 'rules' => 'required|max_length[50]'],
            'pembayaran_id_bank' => ['label' => 'Pilih Bank', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'dibayar' => ['label' => 'DIBAYAR', 'rules' => 'required|numeric|max_length[10]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            $transaksi = $this->getTransaksiOr404($fields['id_transaksi']);

            if (empty($transaksi->no_faktur)) {
                $fields['no_faktur'] = $this->createNoFaktur();
                $fields['status_transaksi'] = 'dipesan';
                $bayar = $this->bayar($transaksi, $fields);
                if (!$bayar) {

                    $response['success'] = false;
                    $response['messages'] = 'Pembayaran Gagal.';

                    return $this->response->setJSON($response);
                }
            }
            $fields['tgl_order'] = date('Y-m-d H:i:s');
            $fields['tgl_deadline'] = date('Y-m-d H:i:s', strtotime($fields['tgl_deadline']));

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

    private function createNoFaktur()
    {
        $no_urut = $this->db->table('tb_transaksi')->select('(COUNT(id_transaksi)+1) as no_urut')
            ->where('MONTH(tgl_order) = MONTH(CURRENT_DATE()) AND no_faktur IS NOT NULL')
            ->get()
            ->getRow()
            ->no_urut;
        return sprintf('%03d', $no_urut) . '/KaBer/' . number_to_roman(date('n')) . '/' . date('Y');
    }

    private function bayar($transaksi, $fields)
    {
        $data['id_transaksi'] = $fields['id_transaksi'];
        $data['jenis_pembayaran'] = $fields['pembayaran_jenis'];
        if ($fields['pembayaran_id_bank'] > 0) {
            $data['id_bank'] = $fields['pembayaran_id_bank'];
            $bank = $this->bankModel->find($data['id_bank']);
            if ($bank != null) {
                $data['nama_bank'] = $bank->nama_bank;
                $data['norek'] = $bank->norek;
                $data['atas_nama'] = $bank->atas_nama;
            }
        }
        if ($fields['dibayar'] > $transaksi->harus_bayar) {
            $data['jumlah_dibayar'] = $transaksi->harus_bayar;
        } else {
            $data['jumlah_dibayar'] = $fields['dibayar'];
        }
        $data['kasir'] = current_user()->first_name;
        $data['created_by'] = current_user()->id;
        $data['updated_by'] = current_user()->id;

        if ($this->pembayaranModel->insert($data)) {
            return true;
        } else {
            return false;
        }
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
    //     $transaksiBaru = $this->transaksiModel->select('id_transaksi')
    //         ->where('no_faktur IS NULL')
    //         ->where('created_by', current_user()->id)
    //         ->orderBy('id_transaksi', 'desc')
    //         ->first();

    //     if (!empty($transaksiBaru)) {
    //         return redirect()->to('transaksi/detail/' . $transaksiBaru->id_transaksi);
    //     } else {
    //         $fields['kasir'] = current_user()->first_name;
    //         $fields['status_transaksi'] = 'draft';
    //         $fields['created_by'] = current_user()->id;
    //         $fields['updated_by'] = current_user()->id;

    //         if ($this->transaksiModel->insert($fields)) {
    //             $newId = $this->transaksiModel->getInsertID();
    //             return redirect()->to('transaksi/detail/' . $newId);
    //         }
    //     }
    // }

    public function baru()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
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
        if ($id_transaksi === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi not found");
        }

        $transaksi = $this->transaksiModel->findWithTotalHarga($id_transaksi);

        if ($transaksi === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_transaksi not found");
        }
        return $transaksi;
    }
}
