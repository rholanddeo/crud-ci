<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuplierSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'kodespl' => 'SPL00' . $i,
                'namaspl'    => 'Suplier ' . $i,
            ];

            // Using Query Builder
            $this->db->table('tbl_suplier')->insert($data);
        }
    }
}
