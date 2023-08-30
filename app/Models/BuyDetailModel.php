<?php

namespace App\Models;

use CodeIgniter\Model;

class BuyDetailModel extends Model
{
    protected $table            = 'buy_detail';
    protected $allowedFields    = ['buy_id', 'komik_id', 'amount', 'price', 'total_price'];

    public function getInvoice($buy_id)
    {
        return $this->select('buy_detail.buy_id, buy_detail.amount qty, buy_detail.price price, buy_detail.total_price total, b.title name, s.created_at tgl_transaksi')
            ->join('komik b', 'komik_id')
            ->join('buy s', 'buy_id')
            ->where('buy_id', $buy_id)
            ->findAll();
    }
}
