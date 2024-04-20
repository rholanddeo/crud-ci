<?php

namespace App\Controllers;

use App\Models\Suplier;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuplierController extends BaseController
{
    public function index()
    {
        $suplierModel = new Suplier();
        $pager = \Config\Services::pager();

        $data = [
            'suplier' => $suplierModel->findAll(),
            'pager' => $suplierModel->pager,
        ];

        return view('suplier/index', $data);
    }

    public function create()
    {
        return view('suplier/form');
    }

    public function store()
    {
        //load helper form and URL
        helper(['form', 'url']);
         
        //define validation
        $validation = $this->validate([
            'kodespl' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Kode Suplier.'
                ]
            ],
            'namaspl'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Nama Suplier.'
                ]
            ],
        ]);

        if(!$validation) {

            //render view with error validation message
            return view('suplier/form', [
                'validation' => $this->validator
            ]);

        } else {

             //model initialize
            $suplierModel = new Suplier();

            $suplierModel->insert([
                'kodespl' => $this->request->getPost('kodespl'),
                'namaspl' => $this->request->getPost('namaspl'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Data Suplier Berhasil Disimpan');

            return redirect()->to(base_url('suplier'));
        }
    }

        public function edit($id)
        {
            $suplierModel = new Suplier();
            $suplier = $suplierModel->find($id);

            return view('suplier/form', [
                'suplier' => $suplier
            ]);
        }

        public function update($id)
        {
            //load helper form and URL
            helper(['form', 'url']);
             
            //define validation
            $validation = $this->validate([
                'kodespl' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Masukkan Kode Suplier.'
                    ]
                ],
                'namaspl'    => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Masukkan Nama Suplier.'
                    ]
                ],
            ]);

            if(!$validation) {

                //render view with error validation message
                return view('suplier/form', [
                    'validation' => $this->validator
                ]);

            } else {

                //model initialize
                $suplierModel = new Suplier();
                
                //update data into database
                $suplierModel->update($id, [
                    'kodespl' => $this->request->getPost('kodespl'),
                    'namaspl' => $this->request->getPost('namaspl'),
                ]);

                //flash message
                session()->setFlashdata('message', 'Data Suplier Berhasil Diubah');

                return redirect()->to(base_url('suplier'));
            }
        }

        public function delete($id)
        {
            $suplierModel = new Suplier();
            $suplierModel->delete($id);

            //flash message
            session()->setFlashdata('message', 'Data Suplier Berhasil Dihapus');

            return redirect()->to(base_url('suplier'));
        }



}
