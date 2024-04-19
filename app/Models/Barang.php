<?php

namespace App\Models;

use CodeIgniter\Model;

class Barang extends Model
{
    protected $table            = 'tbl_barang';
    protected $primaryKey       = 'id';

    protected $allowedFields    = [
        'kodebrg',
        'namabrg',
        'satuan',
        'hargabeli',
        // 'gambar',
    ];

}
