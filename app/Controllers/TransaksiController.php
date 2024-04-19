<?php

namespace App\Controllers;

use App\Models\Stock;
use App\Models\Barang;
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
            'hutang' => $hutangModel->where('islunas', 'N')
            ->join('tbl_hbeli', 'tbl_hbeli.notransaksi = tbl_hutang.notransaksi')
            ->select('tbl_hutang.*, tbl_hbeli.id as id_headerbeli')
            ->orderBy('created_at', 'DESC')->findAll(),
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
            session()->setFlashdata('message', 'Data Transaksi Berhasil Disimpan');

            return redirect()->to(base_url('transaksi-detail-' . $headerBeliModel->insertID()));
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
            session()->setFlashdata('message', 'Data Transaksi Berhasil Diubah');

            return redirect()->to(base_url('transaksi'));
        }
    }

    public function delete($id)
    {
        $headerBeliModel = new HeaderBeli();
        $headerBeliModel->delete($id);

        //flash message
        session()->setFlashdata('message', 'Data Transaksi Berhasil Dihapus');

        return redirect()->to(base_url('transaksi'));
    }

    public function detail($id)
    {
        $headerBeliModel = new HeaderBeli();
        $headerBeli = $headerBeliModel->find($id);
        $detailBeliModel = new DetailBeli();
        $suplierModel = new Suplier();
        $hutangModel = new Hutang();
        $barangModel = new Barang();

        $data = [
            'transaksi' => $headerBeliModel->find($id),
            'detail' => $detailBeliModel->where('notransaksi', $headerBeli['notransaksi'])->findAll(),
            'suplier' => $suplierModel->findAll(),
            'hutang' => $hutangModel->where('notransaksi', $headerBeli['notransaksi'])->first(),
            'barang' => $barangModel->findAll(),
        ];

        //dd($data['barang']);


        return view('transaksi/detail', $data);
    }

    public function storeDetail($id)
    {
        $headerBeliModel = new HeaderBeli();
        $headerBeli = $headerBeliModel->find($id);
        $suplierModel = new Suplier();
        $barangModel = new Barang();
        $detailBeliModel = new DetailBeli();
        $barang = $barangModel->where('kodebrg', $this->request->getPost('kodebrg'))->first();


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
        ]);


        if (!$validation) {

            //render view with error validation message
            return view('transaksi/detail', [
                'validation' => $this->validator,
                'transaksi' => $headerBeli,
                'suplier' => $suplierModel->findAll(),
                'barang' => $barangModel->findAll(),
                'detail' => $detailBeliModel->where('notransaksi', $headerBeli['notransaksi'])->findAll()
            ]);
        } else {

            //model initialize
            $detailBeliModel = new DetailBeli();

            $totalrp = $this->request->getPost('qty') * $barang['hargabeli'];
            $diskonrp = $this->request->getPost('diskon') * $totalrp / 100;

            // Simpan data ke dalam database
            $detailBeliModel->save([
                'notransaksi' => $headerBeli['notransaksi'],
                'kodebrg' => $this->request->getPost('kodebrg'),
                'hargabeli' => $barang['hargabeli'],
                'qty' => $this->request->getPost('qty'),
                'diskon' => $this->request->getPost('diskon'),
                'diskonrp' => $diskonrp,
                'totalrp' => $totalrp,
            ]);

            //menambahkan stok barang
            $stockModel = new Stock();
            $existingStock = $stockModel->where('kodebrg', $this->request->getPost('kodebrg'))->first();

            if (!$existingStock) {
                $stockModel->save([
                    'kodebrg' => $this->request->getPost('kodebrg'),
                    'qtybeli' => $this->request->getPost('qty'),
                ]);
            } else {
                $stockModel->save([
                    'id' => $existingStock['id'],
                    'kodebrg' => $this->request->getPost('kodebrg'),
                    'qtybeli' => $existingStock['qtybeli'] + $this->request->getPost('qty'),
                ]);
            }

            //menambahkan hutang
            $hutangModel = new Hutang();
            $existingHutang = $hutangModel->where('notransaksi', $headerBeli['notransaksi'])->first();

            if (!$existingHutang) {
                $hutangModel->save([
                    'notransaksi' => $headerBeli['notransaksi'],
                    'kodespl' => $headerBeli['kodespl'],
                    'tglbeli' => $headerBeli['tglbeli'],
                    'totalhutang' => $totalrp,
                ]);
            } else {
                $hutangModel->save([
                    'id' => $existingHutang['id'],
                    'notransaksi' => $headerBeli['notransaksi'],
                    'kodespl' => $headerBeli['kodespl'],
                    'tglbeli' => $headerBeli['tglbeli'],
                    'totalhutang' => $existingHutang['totalhutang'] + $totalrp,
                ]);
            }


            //flash message
            session()->setFlashdata('message', 'Detail Transaksi Berhasil Ditambahkan');

            return redirect()->to(base_url('transaksi-detail-' . $id));
        }
    }

    public function deleteDetail($id)
    {
        $detailBeliModel = new DetailBeli();
        $detailBeli = $detailBeliModel->find($id);
        $headerBeliModel = new HeaderBeli();
        $headerBeli = $headerBeliModel->where('notransaksi', $detailBeli['notransaksi'])->first();
        $detailBeliModel->delete($id);

        //flash message
        session()->setFlashdata('message', 'Detail Transaksi Berhasil Dihapus');

        return redirect()->to(base_url('transaksi-detail-' . $headerBeli['id']));
    }

    public function islunas()
    {
        $hutangModel = new Hutang();
        $id = $this->request->getPost('id');
        $hutang = $hutangModel->find($id);
        $headerBeliModel = new HeaderBeli();
        $headerBeli = $headerBeliModel->where('notransaksi', $hutang['notransaksi'])->first();

        $newStatus = $this->request->getPost('islunas') === 'Y' ? 'Y' : 'N';

        $hutangModel->save([
            'id' => $id,
            'islunas' => $newStatus,
        ]);

        $response = [
            'success' => true,
            'isLunas' => $newStatus === 'Y',
            'totalHutangFormatted' => number_format($hutang['totalhutang'], 0, ',', '.')
        ];

        return $this->response->setJSON($response);
    }
}
