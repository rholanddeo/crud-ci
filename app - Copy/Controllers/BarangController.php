<?php

namespace App\Controllers;

use App\Models\Stock;
use App\Models\Barang;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BarangController extends BaseController
{
    public function index()
    {
        $barangModel = new Barang();
        
        $barangData = $barangModel->select('tbl_barang.*, tbl_stock.qtybeli')
                             ->join('tbl_stock', 'tbl_stock.kodebrg = tbl_barang.kodebrg', 'left')
                             ->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'barang' => $barangData,
        ];

        return view('barang/index', $data);
    }

    public function create()
    {
        return view('barang/form');
    }

    public function store()
    {
        //load helper form and URL
        helper(['form', 'url']);
         
        //define validation
        $validation = $this->validate([
            'kodebrg' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Kode Barang.'
                ]
            ],
            'namabrg'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Barang.'
                ]
            ],
            'satuan'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Satuan Barang.'
                ]
            ],
            'hargabeli'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Harga Beli Barang.'
                ]
            ],
        ]);

        if(!$validation) {

            //render view with error validation message
            return view('barang/form', [
                'validation' => $this->validator
            ]);

        } else {

             //model initialize
            $barangModel = new Barang();
    

            $barangModel->insert([
                'kodebrg' => $this->request->getPost('kodebrg'),
                'namabrg' => $this->request->getPost('namabrg'),
                'satuan' => $this->request->getPost('satuan'),
                'hargabeli' => $this->request->getPost('hargabeli'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Data Barang Berhasil Disimpan');

            return redirect()->to(base_url('barang'));
        }
    }

        public function edit($id)
        {
            $barangModel = new Barang();
            $barang = $barangModel->find($id);

            return view('barang/form', [
                'barang' => $barang
            ]);
        }

        public function update($id)
        {
            //load helper form and URL
            helper(['form', 'url']);
             
            //define validation
            $validation = $this->validate([
                'kodebrg' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Masukkan Kode Barang.'
                    ]
                ],
                'namabrg'    => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Masukkan Nama Barang.'
                    ]
                ],
                'satuan'    => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Masukkan Satuan Barang.'
                    ]
                ],
                'hargabeli'    => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Masukkan Harga Beli Barang.'
                    ]
                ],
            ]);

            if(!$validation) {

                //render view with error validation message
                return view('barang/form', [
                    'validation' => $this->validator
                ]);

            } else {

                //model initialize
                $barangModel = new Barang();
                
                //update data into database
                $barangModel->update($id, [
                    'kodebrg' => $this->request->getPost('kodebrg'),
                    'namabrg' => $this->request->getPost('namabrg'),
                    'satuan' => $this->request->getPost('satuan'),
                    'hargabeli' => $this->request->getPost('hargabeli'),
                ]);

                //flash message
                session()->setFlashdata('message', 'Data Barang Berhasil Diubah');

                return redirect()->to(base_url('barang'));
            }
        }

        public function delete($id)
        {
            $barangModel = new Barang();
            $stockModel = new Stock();

            $barang = $barangModel->find($id);
            
            $stockModel->where('kodebrg', $barang['kodebrg'])->delete();
            $barangModel->delete($id);

            //flash message
            session()->setFlashdata('message', 'Data Barang Berhasil Dihapus');

            return redirect()->to(base_url('barang'));
        }



}
