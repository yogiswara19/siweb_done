<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleDetailModel extends Model
{
    protected $table            = 'sale_detail';
    protected $allowedFields    = ['sale_id', 'book_id', 'amount', 'price', 'discount', 'total_price'];

    public function getInvoice($sale_id)
    {
        return $this->select('sale_detail.sale_id, sale_detail.amount qty, sale_detail.price price, sale_detail.total_price total, b.title name, s.created_at tgl_transaksi')
            ->join('book b', 'book_id')
            ->join('sale s', 'sale_id')
            ->where('sale_id', $sale_id)
            ->findAll();
    }
}
