<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $data = [
                'kodebrg' => 'BRG00' . $i,
                'namabrg'    => 'Barang ' . $i,
                'satuan'    => 'pcs',
                'hargabeli'    => 1000 * $i,
            ];

            // Using Query Builder
            $this->db->table('tbl_barang')->insert($data);
        }
    }
}
