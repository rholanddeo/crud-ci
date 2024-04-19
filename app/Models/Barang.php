<?php

namespace App\Models;

use App\Models\User;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

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

    // get stock
    public function getStock()
    {
        return $this->stock()->findAll();
    }

    // relationship
    public function stock()
    {
        return $this->hasOne('App\Models\Stock', 'kodebrg');
    }

}
