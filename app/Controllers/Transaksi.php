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
use App\Models\TransaksiItemModel;

class Transaksi extends BaseController
{
    protected $auth;
    protected $transaksiModel;
    protected $transaksiItemModel;
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
        $this->transaksiItemModel = new TransaksiItemModel();
        $this->satuanModel = new SatuanModel();
        $this->barangModel = new BarangModel();
        $this->bankModel = new BankModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        if (!has_akses('transaksi', 'r')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Daftar Transaksi',
        ];

        return view('transaksi/daftar_transaksi', $data);
    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->transaksiModel->findAllWithPiutang();

        foreach ($result as $value) {

            $ops = '<div class="btn-group">';
            if (!empty($value->no_faktur)) {
                $ops .= '	<form method="post" action="' . site_url('transaksi/nota') . '" > ';
                $ops .= '       <input type="hidden" value = "' . $value->id_transaksi . '" name="id_transaksi"><button type="submit" value="submit" name="_method" class="btn btn-sm btn-success"><i">Invoice</i></button>';
                $ops .= '   </form>';
            }
            if (has_akses('transaksi', 'u')) {
                $ops .= '	<form method="post" action="' . site_url('transaksi/detail') . '" > ';
                $ops .= '       <input type="hidden" value = "' . $value->id_transaksi . '" name="id_transaksi"><button type="submit" value="submit" name="_method" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>';
                $ops .= '   </form>';
            }
            if (has_akses('transaksi', 'd')) {
                $ops .= '	<button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_transaksi . ')"><i class="fa fa-trash"></i></button>';
            }
            $ops .= '</div>';

            $no_faktur = '<i>' . $value->status_transaksi . '</i>';
            if (!empty($value->no_faktur)) {
                $no_faktur = $value->no_faktur;
            }

            $pelanggan = $value->nama_pelanggan . ' - ' . $value->perusahaan . ' (' . $value->no_wa . ')';

            if (!empty($value->harus_bayar)) {
                $harus_bayar = $value->harus_bayar;
            } else {
                $harus_bayar = 0;
            }

            if ($value->telah_bayar >= $value->harus_bayar && $value->harus_bayar > 0) {
                $telah_bayar = '<strong class="text-success">LUNAS</strong>';
            } else if (!empty($value->telah_bayar)) {
                $telah_bayar = number_to_currency($value->telah_bayar, 'IDR', 'id_ID', 2);
            } else {
                $telah_bayar = number_to_currency(0, 'IDR', 'id_ID', 2);
            }

            $data['data'][] = array(
                $value->tgl_order,
                $no_faktur,
                $pelanggan,
                $value->tgl_deadline,
                $value->kasir,
                number_to_currency($harus_bayar, 'IDR', 'id_ID', 2),
                $telah_bayar,
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
        if (!has_akses('transaksi', 'c')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
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

    public function baru()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');

        $transaksi = $this->getTransaksiOr404($id_transaksi);
        $pelanggan = $this->pelangganModel->findAll();

        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Transaksi Baru',
            'pelanggan'         => $pelanggan,
            'transaksi'         => $transaksi,
            'satuan'            => $this->satuanModel->select('id, nama_satuan')->findAll(),
            'barang'            => $this->barangModel->select('id_barang, kategori_barang, nama_barang')->findAll(),
            'bank'              => $this->bankModel->findAll()
        ];
        if (!has_akses('transaksiBaru', 'c')) {

            return view('transaksi/buatKeranjang', $data);
        }
        return view('transaksi/baru', $data);
    }

    public function detail()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');

        $transaksi = $this->getTransaksiOr404($id_transaksi);
        $pelanggan = $this->pelangganModel->findAll();
        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Transaksi',
            'pelanggan'         => $pelanggan,
            'transaksi'         => $transaksi,
            'satuan'            => $this->satuanModel->select('id, nama_satuan')->findAll(),
            'barang'            => $this->barangModel->select('id_barang, kategori_barang, nama_barang')->findAll(),
            'bank'              => $this->bankModel->findAll()
        ];
        return view('transaksi/detail', $data);
    }

    public function nota()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');

        $transaksi = $this->getTransaksiOr404($id_transaksi);
        $transaksiItem = $this->transaksiItemModel->findAllByIdTransaksi($id_transaksi);
        $data = [
            'menu'              => 'transaksi',
            'title'             => 'Nota Transaksi',
            'transaksi'         => $transaksi,
            'transaksiItem'     => $transaksiItem,
        ];
        return view('transaksi/nota', $data);
    }

    public function save()
    {
        if (!has_akses('transaksi', 'u')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
        $response = array();

        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['tgl_deadline'] = $this->request->getPost('tglDeadline');
        $fields['keterangan'] = $this->request->getPost('keterangan');
        // $fields['nama_pelanggan'] = $this->request->getPost('namaPelanggan');
        // $fields['perusahaan'] = $this->request->getPost('perusahaan');
        $fields['pembayaran_jenis'] = $this->request->getPost('pembayaranJenis');
        $fields['pembayaran_id_bank'] = $this->request->getPost('pembayaranIdBank');
        $fields['dibayar'] = $this->request->getPost('dibayar');

        $this->validation->setRules([
            'id_transaksi' => ['label' => 'ID Transaksi', 'rules' => 'required|max_length[10]'],
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
            $fields['status_produksi'] = 'dipesan';

            $bank = $this->bankModel->find($fields['pembayaran_id_bank']);
            if ($bank != null) {
                $fields['pembayaran_nama_bank'] = $bank->nama_bank;
                $fields['pembayaran_norek'] = $bank->norek;
                $fields['pembayaran_atas_nama'] = $bank->atas_nama;
            }

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

    public function update()
    {
        if (!has_akses('transaksi', 'u')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
        $response = array();

        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['tgl_deadline'] = $this->request->getPost('tglDeadline');
        $fields['keterangan'] = $this->request->getPost('keterangan');


        $this->validation->setRules([
            'id_transaksi' => ['label' => 'ID Transaksi', 'rules' => 'required|max_length[10]'],
            'tgl_deadline' => ['label' => 'Tgl deadline', 'rules' => 'required|valid_date'],
            'keterangan' => ['label' => 'Keterangan', 'rules' => 'permit_empty|max_length[255]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            $transaksi = $this->getTransaksiOr404($fields['id_transaksi']);

            if (empty($transaksi->no_faktur)) {
                $fields['no_faktur'] = $this->createNoFaktur();
                $fields['status_transaksi'] = 'dipesan';
            }
            $fields['tgl_order'] = date('Y-m-d H:i:s');
            $fields['tgl_deadline'] = date('Y-m-d H:i:s', strtotime($fields['tgl_deadline']));
            $fields['status_produksi'] = 'dipesan';

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
        $no_urut = $this->transaksiModel->select('(COUNT(id_transaksi)+1) as no_urut')
            ->where('MONTH(tgl_order) = MONTH(CURRENT_DATE()) AND no_faktur IS NOT NULL')
            ->get()
            ->getRow()
            ->no_urut;
        return sprintf('%03d', $no_urut) . '/KaBer/' . number_to_roman(date('n')) . '/' . date('Y');
    }

    private function bayar($transaksi, $fields)
    {
        // tidak perlu input ke tb pembayaran jika dibayar 0
        if (empty($fields['dibayar'])) {
            return true;
        }

        $data['id_transaksi'] = $fields['id_transaksi'];
        $data['nama_pelanggan'] =  $transaksi->nama_pelanggan;
        $data['perusahaan'] =  $transaksi->perusahaan;
        $data['no_faktur'] =  $fields['no_faktur'];
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

    public function remove()
    {
        if (!has_akses('transaksi', 'd')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
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
            $pelanggan->perusahaan = null;
        }

        $transaksi->id_pelanggan = $pelanggan->id_pelanggan;
        $transaksi->tipe_pelanggan = $pelanggan->tipe_pelanggan;
        $transaksi->nama_pelanggan = $pelanggan->nama_pelanggan;
        $transaksi->no_wa = $pelanggan->no_wa;
        $transaksi->perusahaan = $pelanggan->perusahaan;

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

        $transaksi = $this->transaksiModel->findWithPiutang($id_transaksi);

        if ($transaksi === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Transaksi with id $id_transaksi not found");
        }
        return $transaksi;
    }
}
