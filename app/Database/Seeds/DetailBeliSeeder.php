<?php

namespace App\Database\Seeds;

use App\Models\Stock;
use App\Models\Barang;
use App\Models\DetailBeli;
use App\Models\HeaderBeli;
use CodeIgniter\Database\Seeder;

class DetailBeliSeeder extends Seeder
{
    public function run()
    {

        $barangModel = new Barang();
        $headerBeliModel = new HeaderBeli();
        $stockModel = new Stock(); // Tambahkan model untuk tbl_stock
        $allKodebrg = $barangModel->findAll();
        $allNotransaksi = $headerBeliModel->findAll();

        for ($i = 1; $i <= 5; $i++) {
            $randomKodebrg = rand(0, count($allKodebrg) - 1);
            $kodebrg = $allKodebrg[$randomKodebrg]['kodebrg'];

            $randomNotransaksi = rand(0, count($allNotransaksi) - 1);
            $notransaksi = $allNotransaksi[$randomNotransaksi]['notransaksi'];

            $hargabeli = 10000 * rand(1, 10);
            $qty = rand(1, 10);
            $diskon = rand(10, 100);

            $data = [
                'notransaksi' => $notransaksi,
                'kodebrg'     => $kodebrg,
                'hargabeli'   => $hargabeli,
                'qty'         => $qty,
                'diskon'      => $diskon,
                'diskonrp'    => $diskon * $hargabeli / 100,
                'totalrp'     => $qty * $hargabeli,

            ];

            // Using Query Builder
            $this->db->table('tbl_dbeli')->insert($data);
        }

        $detailBeliModel = new DetailBeli();
        $allDetailBeli = $detailBeliModel->findAll();
        $stockModel = new Stock();

        foreach ($allDetailBeli as $data) {
            $kodebrg = $data['kodebrg'];
            $qty = $data['qty'];
        
            // Periksa apakah ada stok untuk barang dengan kodebrg yang sama
            $existingStock = $stockModel->where('kodebrg', $kodebrg)->first();
        
            if (!$existingStock) {
                // Jika tidak ada stok, insert data baru
                $stockModel->insert([
                    'kodebrg' => $kodebrg,
                    'qtybeli'     => $qty,
                ]);
            } else {
                // Jika ada stok, update jumlahnya
                $newQty = $existingStock['qtybeli'] += $qty;
                $stockModel->updateBatch([['kodebrg' => $kodebrg, 'qtybeli' => $newQty]], 'kodebrg');
            }
        }
        
          
        
    }
}
