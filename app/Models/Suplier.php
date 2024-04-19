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

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

   
}
