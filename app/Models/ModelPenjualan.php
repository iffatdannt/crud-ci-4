<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenjualan extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_jual')
        ->join('tbl_product','tbl_product.id_product=tbl_jual.id_product')
        ->join('tbl_category','tbl_category.id_category=tbl_jual.id_category')
        ->join('tbl_satuan','tbl_satuan.id_satuan=tbl_jual.id_satuan')
        ->get()
        ->getResultArray();
    }

    public function NoFaktur()
    {
        $tgl = date('Ymd');
        $query = $this->db->query("SELECT MAX(RIGHT(no_faktur,4)) as no_urut from tbl_jual where DATE(tgl_jual)='$tgl'");
        $hasil = $query->getRowArray();
        if ($hasil['no_urut'] > 0) {
            $tmp = $hasil['no_urut'] +1 ;
            $kd = sprintf("%04s",$tmp);
        }else {
            $kd="0001"; 
        }
        $no_faktur = date('Ymd') . $kd;
        return $no_faktur;
    }

    public function InsertData($data) 
    {
    $this->db->table('tbl_jual')->insert($data);           
    }
}