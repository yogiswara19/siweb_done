<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'no_supplier', 'gender', 'address', 'email', 'phone', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes = true;
}
