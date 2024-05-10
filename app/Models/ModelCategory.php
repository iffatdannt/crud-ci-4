<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCategory extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_category')->get()->getResultArray();
    }

    public function InsertData($data) 
    {
    $this->db->table('tbl_category')->insert($data);           
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_category')
        ->where('id_category',$data['id_category'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_category')
        ->where('id_category',$data['id_category'])
        ->delete($data);
    }
}
