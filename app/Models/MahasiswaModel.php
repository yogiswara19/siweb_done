<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa_1087';
    protected $primaryKey = 'id_mahasiswa';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'tempat_lahir', 'jenis_kelamin', 'hobi', 'kategori_favorit'];
    protected $useSoftDeletes = true;
}
