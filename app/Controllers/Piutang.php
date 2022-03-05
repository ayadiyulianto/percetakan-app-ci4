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

        $data = [
            'menu'              => 'piutang',
            'title'             => 'Piutang Transaksi',
            'bank'              => $this->bankModel->findAll()
        ];

        return view('piutang/daftar_piutang', $data);
    }

    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->transaksiModel->findAllWithPiutang();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group">';
            $ops .= '	<button type="button" class="btn btn-sm btn-success" onclick="bayar(' . $value->id_transaksi . ')"><i class="fas fa-money-bill-wave"></i> Bayar</button>';
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
            if (!empty($value->telah_bayar)) {
                $telah_bayar = $value->telah_bayar;
            } else {
                $telah_bayar = 0;
            }
            if (!empty($value->kurang)) {
                $kurang = $value->kurang;
            } else {
                continue; // hiraukan dari tampilan jika kurang = 0
            }

            $data['data'][$key] = array(
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
        $response = array();

        $fields['id_transaksi'] = $this->request->getPost('idTransaksi');
        $fields['jenis_pembayaran'] = $this->request->getPost('jenisPembayaran');
        $fields['id_bank'] = $this->request->getPost('idBank');
        $fields['dibayar'] = $this->request->getPost('dibayar');

        $this->validation->setRules([
            'id_transaksi' => ['label' => 'ID Transaksi', 'rules' => 'required|max_length[10]'],
            'jenis_pembayaran' => ['label' => 'Jenis Pembayaran', 'rules' => 'required|max_length[50]'],
            'id_bank' => ['label' => 'Pilih Bank', 'rules' => 'permit_empty|numeric|max_length[10]'],
            'dibayar' => ['label' => 'DIBAYAR', 'rules' => 'required|numeric|max_length[10]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($fields['id_bank'] > 0) {
                $fields['id_bank'] = $fields['id_bank'];
                $bank = $this->bankModel->find($fields['id_bank']);
                if ($bank != null) {
                    $fields['nama_bank'] = $bank->nama_bank;
                    $fields['norek'] = $bank->norek;
                    $fields['atas_nama'] = $bank->atas_nama;
                }
            }

            $piutang = $this->getPiutangOr404($fields['id_transaksi']);

            if ($fields['dibayar'] > $piutang->kurang) {
                $fields['jumlah_dibayar'] = $piutang->kurang;
            } else {
                $fields['jumlah_dibayar'] = $fields['dibayar'];
            }
            $fields['kasir'] = current_user()->first_name;
            $fields['created_by'] = current_user()->id;
            $fields['updated_by'] = current_user()->id;

            if ($this->pembayaranModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = 'Paid successfully.';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Payment error!';
            }
        }

        return $this->response->setJSON($response);
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
