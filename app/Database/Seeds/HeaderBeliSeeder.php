<?php

namespace App\Database\Seeds;

use App\Models\Suplier;
use CodeIgniter\Database\Seeder;

class HeaderBeliSeeder extends Seeder
{
    public function run()
    {

        $suplierModel = new Suplier();
        $allKodespl = $suplierModel->findAll();

        for ($i = 1; $i <= 5; $i++) {

            $randomIndex = rand(0, count($allKodespl) - 1);
            $kodespl = $allKodespl[$randomIndex]['kodespl'];

            $data = [
                'notransaksi' => 'B' . date('Ymd') . $i,
                'tglbeli'    => date('Y-m-d'),
                'kodespl'    => $kodespl,
            ];

            // Using Query Builder
            $this->db->table('tbl_hbeli')->insert($data);
        }
    }
}
