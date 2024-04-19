<?php

namespace App\Models;

use CodeIgniter\Model;

class Suplier extends Model
{
    protected $table            = 'tbl_suplier';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'kodespl',
        'namaspl',
    ];

   
}
