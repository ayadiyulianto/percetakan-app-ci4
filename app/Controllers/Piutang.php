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

class Piutang extends BaseController
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
        if (!has_akses('piutang', 'r')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
        $data = [
            'menu'              => 'piutang',
            'title'             => 'Piutang Transaksi',
            'bank'              => $this->bankModel->findAll()
        ];

        return view('piutang/daftar_piutang', $data);
    }

    public function getAll()
    {
        if (!has_akses('piutang', 'r')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
        $response = array();
        $id_transaksi = $this->request->getPost('id_transaksi');
        $transaksi = $this->transaksiModel->findWithPiutang($id_transaksi);

        $pelanggan = $this->pelangganModel->findAll();

        $data['data'] = array();

        $result = $this->transaksiModel->findAllWithPiutang();

        foreach ($result as $value) {

            $ops = '<div class=" btn-group">';
            $ops .= '	<button type="button" class="btn btn-sm btn-info" onclick="itemAll(' . $value->id_transaksi . ')"><i class="fa fa-list"> Detail</i></button>';
            $ops .= '	<button type="button" class="btn btn-sm btn-success" onclick="bayar(' . $value->id_transaksi . ')"><i class="fas fa-money-bill-wave"></i> Bayar</button>';
            $ops .= '   <form method="post" action="' . site_url('transaksi/nota') . '" > ';
            $ops .= '       <input type="hidden" value = "' . $value->id_transaksi . '" name="id_transaksi"><button type="submit" value="submit" name="_method" class="btn btn-sm btn-primary"><i class="fas fa-book"></i> Invoice</button>';
            $ops .= '   </form>';
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
            if (!empty($value->telah_bayar)) {
                $telah_bayar = $value->telah_bayar;
            } else {
                $telah_bayar = 0;
            }
            if ($harus_bayar - $telah_bayar != 0) {
                $kurang = $harus_bayar - $telah_bayar;
            } else {
                continue; // hiraukan dari tampilan jika kurang = 0
            }

            $data['data'][] = array(
                $no_faktur,
                $value->tgl_order,
                $pelanggan,
                $value->kasir,
                number_to_currency($harus_bayar, 'IDR', 'id_ID', 2),
                number_to_currency($telah_bayar, 'IDR', 'id_ID', 2),
                number_to_currency($kurang, 'IDR', 'id_ID', 2),
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

            $data = $this->getPiutangOr404($id);

            $data->success = true;
            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function bayar()
    {
        if (!has_akses('pembayaran', 'c')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kamu tidak memiliki akses untuk membuka halaman ini");
        }
        $response = array();

        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['jenis_pembayaran'] = $this->request->getPost('jenisPembayaran');
        $fields['id_bank'] = $this->request->getPost('idBank');
        $fields['dibayar'] = $this->request->getPost('dibayar');
        $fields['bukti'] = $this->request->getPost('bukti');
        $fields['no_faktur'] = $this->request->getPost('noFaktur');
        $fields['nama_pelanggan'] = $this->request->getPost('namaPelanggan');
        $fields['perusahaan'] = $this->request->getPost('perusahaan');


        $this->validation->setRules([
            'id_transaksi' => ['label' => 'ID Transaksi', 'rules' => 'required|max_length[10]'],
            'jenis_pembayaran' => ['label' => 'Jenis Pembayaran', 'rules' => 'required|max_length[50]'],
            'id_bank' => ['label' => 'Pilih Bank', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'dibayar' => ['label' => 'DIBAYAR', 'rules' => 'required|numeric|max_length[10]'],
            'bukti' => [
                'label' => 'bukti',
                'rules' => [
                    'mime_in[bukti,image/jpg,image/jpeg,image/png,image/gif]',
                ]
            ],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($fields['id_bank'] > 0) {
                $bank = $this->bankModel->find($fields['id_bank']);
                if ($bank != null) {
                    $fields['nama_bank'] = $bank->nama_bank;
                    $fields['norek'] = $bank->norek;
                    $fields['atas_nama'] = $bank->atas_nama;
                }
            } else {
                $fields['id_bank'] = NULL;
            }

            $piutang = $this->getPiutangOr404($fields['id_transaksi']);
            if (!empty($piutang->harus_bayar)) {
                $harus_bayar = $piutang->harus_bayar;
            } else {
                $harus_bayar = 0;
            }
            if (!empty($piutang->telah_bayar)) {
                $telah_bayar = $piutang->telah_bayar;
            } else {
                $telah_bayar = 0;
            }
            if ($fields['dibayar'] > $harus_bayar - $telah_bayar) {
                $fields['jumlah_dibayar'] = $harus_bayar - $telah_bayar;
            } else {
                $fields['jumlah_dibayar'] = $fields['dibayar'];
            }
            $fields['kasir'] = current_user()->first_name;
            $fields['created_by'] = current_user()->id;
            $fields['updated_by'] = current_user()->id;

            if ($fields['jenis_pembayaran'] == 'cash') {
                $fields['bukti'] = null;
            }
            $filePath = $this->uploadFile($this->request->getFile('bukti'));
            if (!empty($filePath)) {
                $fields['bukti'] = $filePath;
            }



            if ($this->pembayaranModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = 'Paid successfully.';
                $response['id_transaksi'] = $fields['id_transaksi'];
                if ($harus_bayar - $telah_bayar - $fields['jumlah_dibayar'] == 0) {
                    $response['lunas'] = true;
                } else {
                    $response['lunas'] = false;
                }
            } else {

                $response['success'] = false;
                $response['messages'] = 'Payment error!';
            }
        }

        return $this->response->setJSON($response);
    }

    private function uploadFile($file, $buktiLama = null)
    {
        if (!$file->isValid()) return;

        $folder = 'file-bukti';

        $file->move($folder, $file->getRandomName());

        if (!empty($buktiLama)) {
            $path = FCPATH . $buktiLama;
            if (is_file($path)) {
                unlink($path);
            }
        }

        return $folder . '/' . $file->getName();
    }
    private function getPiutangOr404($id_transaksi)
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
