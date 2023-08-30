<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table = 'komik';
    protected $primaryKey = 'komik_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['title', 'slug', 'author', 'release_year', 'price', 'stock', 'discount', 'komik_category_id', 'cover'];
    protected $useSoftDeletes = true;

    public function getBook($slug = null)
    {
        if ($slug === null) {
            $this->join('komik_category', 'komik.komik_category_id = komik_category.komik_category_id')->where(['deleted_at' => null]);
            return $this->get()->getResultArray();
        } else {
            $this->join('komik_category', 'komik.komik_category_id = komik_category.komik_category_id');
            $this->where(['slug' => $slug]);
            return $this->first();
        }
    }
}
