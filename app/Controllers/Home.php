<?php

namespace App\Controllers;

use App\Models\Stock;
use App\Models\Hutang;
use App\Models\Suplier;
use App\Models\HeaderBeli;

class Home extends BaseController
{
    public function index(): string
    {
        $stockModel = new Stock();
        $totalStock = $stockModel->countAll();
        $suplierModel = new Suplier();
        $totalSuplier = $suplierModel->countAll();
        $headerBeliModel = new HeaderBeli();
        $totalTransaksi = $headerBeliModel->countAll();
        $hutangModel = new Hutang();
        $totalHutang = $hutangModel->where('islunas', 'N')->countAll();


        $data = [
            'totalStock' => $totalStock,
            'totalSuplier' => $totalSuplier,
            'totalTransaksi' => $totalTransaksi,
            'totalHutang' => $totalHutang,
            'transaksi' => $headerBeliModel->orderBy('created_at', 'DESC')->findAll(5),
        ];
        return view('welcome_message', $data);
    }
}
