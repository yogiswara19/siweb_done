<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'no_customer', 'gender', 'address', 'email', 'phone', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes = true;
}
