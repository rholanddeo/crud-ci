<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailBeli extends Model
{
    protected $table            = 'tbl_dbeli';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'notransaksi',
        'kodebrg',
        'hargabeli',
        'qty',
        'diskon',
        'diskonrp',
        'totalrp',
        'islunas',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Relationships

    public function headerBeli()
    {
        return $this->belongsTo(HeaderBeli::class, 'notransaksi', 'notransaksi');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kodebrg', 'kodebrg');
    }

    // Custom Methods
    
            // menghitung totalrp pada detail beli yang memiliki notransaksi yang sama
    // public function getTotalRpByNotransaksi(string $notransaksi)
    // {
    //     return $this->where('notransaksi', $notransaksi)->selectSum('totalrp')->first();
    // }


}
