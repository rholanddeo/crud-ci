<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BarangController extends BaseController
{
    public function index()
    {
        $barangModel = new Barang();
        // $pager = \Config\Services::pager();

        $data = [
            'barang' => $barangModel->paginate(10),
            'pager' => $barangModel->pager,
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
            
            //insert data into database
            // $barangModel->insert([
            //     'codebrg' => $this->request->getPost('kodebrg'),
            //     'namabrg' => $this->request->getPost('namabrg'),
            //     'satuan' => $this->request->getPost('satuan'),
            //     'hargabeli' => $this->request->getPost('hargabeli'),
            // ]);

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
            $barangModel->delete($id);

            //flash message
            session()->setFlashdata('message', 'Data Barang Berhasil Dihapus');

            return redirect()->to(base_url('barang'));
        }



}
