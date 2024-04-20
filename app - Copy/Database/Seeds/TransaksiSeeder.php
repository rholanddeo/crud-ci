<?php

namespace App\Database\Seeds;

use App\Models\Stock;
use App\Models\Barang;
use App\Models\Hutang;
use App\Models\Suplier;
use App\Models\DetailBeli;
use App\Models\HeaderBeli;
use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $suplierModel = new Suplier();
        $allKodespl = $suplierModel->findAll();
        $headerBeliModel = new HeaderBeli();
        $countHeaderBeli = $headerBeliModel->countAll();

        for ($i = 1; $i <= 10; $i++) {

            $randomIndex = rand(0, count($allKodespl) - 1);
            $kodespl = $allKodespl[$randomIndex]['kodespl'];
            $notransaksi = 'B' . date('Ym') . $countHeaderBeli++;

            //memeriksa apakah ada notransaksi yang sama
            $existingHeaderBeli = $headerBeliModel->where('notransaksi', $notransaksi)->first();
            if (!$existingHeaderBeli) {
                $data = [
                    'notransaksi' => $notransaksi,
                    'tglbeli'    => date('Y-m-d'),
                    'kodespl'    => $kodespl,
                ];
    
                // Using Query Builder
                $this->db->table('tbl_hbeli')->insert($data);
            }

            
        }

        $barangModel = new Barang();
        $headerBeliModel = new HeaderBeli();
        $stockModel = new Stock(); // Tambahkan model untuk tbl_stock
        $allKodebrg = $barangModel->findAll();
        $allNotransaksi = $headerBeliModel->findAll();

        for ($i = 1; $i <= 100; $i++) {
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
        $headerBeliModel = new HeaderBeli();
        $hutangModel = new Hutang();
        $stockModel = new Stock();
        $stockModel->truncate();

        foreach ($allDetailBeli as $data) {
            $kodebrg = $data['kodebrg'];
            $qty = $data['qty'];
            $notransaksi = $data['notransaksi'];

            $headerBeli = $headerBeliModel->where('notransaksi', $notransaksi)->first();

            if ($headerBeli) {
                $kodespl = $headerBeli['kodespl'];
                $tglbeli = $headerBeli['tglbeli'];

                // Periksa apakah kode transaksi sudah ada di tabel hutang
                $existingHutang = $hutangModel->where('notransaksi', $notransaksi)->first();

                if (!$existingHutang) {
                    // Pastikan detail beli ada sebelum menghitung total
                    $detailBeli = $detailBeliModel->where('notransaksi', $notransaksi)->first();

                    if ($detailBeli) {
                        // Menghitung totalrp dari detail beli yang memiliki notransaksi yang sama dan isLunas = 'N'
                        // $totalrp = $detailBeliModel->selectSum('totalrp')->where('notransaksi', $notransaksi)->where('islunas', 'N')->first();
                        $totalrp = $detailBeliModel->selectSum('totalrp')->where('notransaksi', $notransaksi)->first();

                        $hutangModel->insert([
                            'notransaksi' => $notransaksi,
                            'kodespl' => $kodespl,
                            'tglbeli' => $tglbeli,
                            'totalhutang' => $totalrp['totalrp'],
                            'islunas' => rand(0, 1) ? 'Y' : 'N',
                        ]);
                    } else {
                        // Handle jika tidak ada detail beli yang sesuai
                        log_message('error', 'No detailBeli found with notransaksi: ' . $notransaksi);
                    }
                } else {
                    // Kode transaksi sudah ada di tabel hutang, tidak perlu dihitung ulang
                    log_message('info', 'Kode transaksi already exists in tbl_hutang: ' . $notransaksi);
                }
            } else {
                // Handle jika tidak ada header beli yang sesuai
                log_message('error', 'No headerBeli found for notransaksi: ' . $notransaksi);
            }

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

        // jika detail beli tidak lunas maka menambahkan data di tbl_hutang


    }
}
