<?php

namespace App\Controllers;

use App\Models\Hutang;
use App\Models\Suplier;
use App\Models\DetailBeli;
use App\Models\HeaderBeli;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    public function index()
    {
        $headerBeliModel = new HeaderBeli();
        $headerBeliModel->orderBy('created_at', 'DESC');
        $data = [
            'transaksi' => $headerBeliModel->findAll(),
            'pager' => $headerBeliModel->pager,
        ];
        return view('transaksi/index', $data);
    }

    public function hutang()
    {
        $hutangModel = new Hutang();

        $data = [
            'hutang' => $hutangModel->findAll(),
            'pager' => $hutangModel->pager,
        ];

        return view('transaksi/hutang', $data);
    }

    public function create()
    {
        $suplierModel = new Suplier();
        $data = [
            'suplier' => $suplierModel->findAll(),
        ];
        return view('transaksi/hbeli', $data);
    }

    public function store()
    {

        //load helper form and URL
        helper(['form', 'url']);

        $suplierModel = new Suplier();

        //define validation
        $validation = $this->validate([
            'kodespl' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Kode Suplier.'
                ]
            ],
            'tglbeli'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Tanggal Beli.'
                ]
            ],
        ]);

        if (!$validation) {

            //render view with error validation message
            return view('transaksi/form', [
                'validation' => $this->validator,
                'suplier' => $suplierModel->findAll(),
            ]);
        } else {

            //model initialize
            $headerBeliModel = new HeaderBeli();

            //notransaksi dengan format 'B'+tahun+bulan+nomor urut
            $notransaksi = 'B' . date('ym') . sprintf('%04s', $headerBeliModel->countAll() + 1);

            // Ambil nilai tglbeli dari permintaan
            $tglbeli = $this->request->getPost('tglbeli');

            // Ubah tglbeli dari string ke objek DateTime
            $tglbeliObj = \DateTime::createFromFormat('d-m-Y', $tglbeli);

            // Ubah tglbeli menjadi format yang diinginkan (misalnya 'Y-m-d')
            $tglbeliFormatted = $tglbeliObj->format('Y-m-d');

            // Simpan data ke dalam database
            $headerBeliModel->save([
                'notransaksi' => $notransaksi,
                'kodespl' => $this->request->getPost('kodespl'),
                'tglbeli' => $tglbeliFormatted,
            ]);


            //flash message
            session()->setFlashdata('message', 'Data Barang Berhasil Disimpan');

            return redirect()->to(base_url('transaksi-detail-' . $notransaksi));
        }
    }

    public function edit($id)
    {
        $headerBeliModel = new HeaderBeli();
        $suplierModel = new Suplier();

        $data = [
            'transaksi' => $headerBeliModel->find($id),
            'suplier' => $suplierModel->findAll(),
        ];

        // dd($data['transaksi']);

        return view('transaksi/hbeli', $data);
    }

    public function update($id)
    {
        //load helper form and URL
        helper(['form', 'url']);

        $suplierModel = new Suplier();

        //define validation
        $validation = $this->validate([
            'kodespl' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Kode Suplier.'
                ]
            ],
            'tglbeli'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Tanggal Beli.'
                ]
            ],
        ]);

        if (!$validation) {

            //render view with error validation message
            return view('transaksi/form', [
                'validation' => $this->validator,
                'suplier' => $suplierModel->findAll(),
            ]);
        } else {

            //model initialize
            $headerBeliModel = new HeaderBeli();

            // Ambil nilai tglbeli dari permintaan
            $tglbeli = $this->request->getPost('tglbeli');

            // Ubah tglbeli dari string ke objek DateTime
            $tglbeliObj = \DateTime::createFromFormat('d-m-Y', $tglbeli);

            // Ubah tglbeli menjadi format yang diinginkan (misalnya 'Y-m-d')
            $tglbeliFormatted = $tglbeliObj->format('Y-m-d');

            // Simpan data ke dalam database
            $headerBeliModel->save([
                'id' => $id,
                'kodespl' => $this->request->getPost('kodespl'),
                'tglbeli' => $tglbeliFormatted,
            ]);

            //flash message
            session()->setFlashdata('message', 'Data Barang Berhasil Diubah');

            return redirect()->to(base_url('transaksi'));

        }
    }

    public function delete($id)
    {
        $headerBeliModel = new HeaderBeli();
        $headerBeliModel->delete($id);

        //flash message
        session()->setFlashdata('message', 'Data Barang Berhasil Dihapus');

        return redirect()->to(base_url('transaksi'));
    }

    public function detail($id)
    {
        $headerBeliModel = new HeaderBeli();
        $detailBeliModel = new DetailBeli();
        $suplierModel = new Suplier();

        $data = [
            'transaksi' => $headerBeliModel->find($id),
            'detail' => $detailBeliModel->where('notransaksi', $id)->findAll(),
            'suplier' => $suplierModel->findAll(),
        ];

        return view('transaksi/detail', $data);
    }

    public function detailStore($id)
    {
        //load helper form and URL
        helper(['form', 'url']);

        //define validation
        $validation = $this->validate([
            'kodebrg' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Pilih Kode Barang.'
                ]
            ],
            'qty'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Jumlah Barang.'
                ]
            ],
            'hargabeli'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Harga Beli.'
                ]
            ],
        ]);

        if (!$validation) {

            //render view with error validation message
            return view('transaksi/detail', [
                'validation' => $this->validator,
                'transaksi' => $id,
            ]);
        } else {

            //model initialize
            $detailBeliModel = new DetailBeli();

            // Simpan data ke dalam database
            $detailBeliModel->save([
                'notransaksi' => $id,
                'kodebrg' => $this->request->getPost('kodebrg'),
                'qty' => $this->request->getPost('qty'),
                'hargabeli' => $this->request->getPost('hargabeli'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Data Barang Berhasil Disimpan');

            return redirect()->to(base_url('transaksi-detail-' . $id));
        }
    }
}
