<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // menjalankan semua seeder
        $this->call('BarangSeeder');
        $this->call('SuplierSeeder');
        $this->call('TransaksiSeeder');
    }
}
