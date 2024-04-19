<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HutangSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $data = [
                'notransaksi' => 'TRX00' . $i,
                'kodespl'    => 'SPL00' . $i,
                'tglbeli'    => date('Y-m-d'),
                'totalhutang'    => 10000 * $i,
            ];

            // Using Query Builder
            $this->db->table('tbl_hutang')->insert($data);
        }
    }
}
