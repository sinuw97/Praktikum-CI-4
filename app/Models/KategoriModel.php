<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'kategori', 'keterangan'];

    public function get_excel() {
        $query = $this->db->table('kategori')->get();
        return $query;
    }
}
