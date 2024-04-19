<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HeaderBeli;
use CodeIgniter\HTTP\ResponseInterface;

class TransaksiController extends BaseController
{
    public function index()
    {
        $headerBeliModel = new HeaderBeli();
        $data = [
            'transaksi' => $headerBeliModel->paginate(10),
            'pager' => $headerBeliModel->pager,
        ];
        return view('transaksi/index', $data);
    }

    public function create()
    {
        return view('transaksi/form');
    }
    
}
