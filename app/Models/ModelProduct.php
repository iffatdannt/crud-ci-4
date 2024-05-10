<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduct extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_product')
        ->join('tbl_category','tbl_category.id_category=tbl_product.id_category')
        ->join('tbl_satuan','tbl_satuan.id_satuan=tbl_product.id_satuan')
        ->orderBy('id_product','ASC')
        ->get()
        ->getResultArray();
    }

    public function InsertData($data) 
    {
    $this->db->table('tbl_product')->insert($data);           
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_product')
        ->where('id_product',$data['id_product'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_product')
        ->where('id_product',$data['id_product'])
        ->delete($data);
    }
}
