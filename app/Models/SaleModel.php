<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table            = 'sale';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['sale_id', 'user_id', 'customer_id'];

    public function getReport($tgl_awal, $tgl_akhir)
    {
        return $this->db->table('sale_detail as sd')
            ->select('s.sale_id, s.created_at tgl_transaksi, us.id user_id, us.firstname, us.lastname, , us.user_name, c.customer_id, c.name name_cust, c.no_customer, SUM(sd.total_price) total')
            ->join('sale s', 'sale_id')
            ->join('pengguna us', 'us.id = s.user_id')
            ->join('customer c', 'customer_id', 'left')
            ->where('date(s.created_at) >=', $tgl_awal)
            ->where('date(s.created_at) <=', $tgl_akhir)
            ->groupBy('s.sale_id')
            ->get()->getResultArray();
    }
}
