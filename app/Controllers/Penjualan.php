<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPenjualan;
use App\Models\ModelCategory;
use App\Models\ModelProduct;
use App\Models\ModelSatuan;


class Penjualan extends BaseController
{
    public function __construct() {
        $this->ModelProduct = new ModelProduct();
        $this->ModelPenjualan = new ModelPenjualan();
        $this->ModelCategory = new ModelCategory();
        $this->ModelSatuan = new ModelSatuan();
    }
    public function index()
    {
        $data=[
            'judul' => 'Penjualan',
            'no_faktur' => $this->ModelPenjualan->NoFaktur(),
            'penjualan' => $this->ModelPenjualan->AllData(),
            'category' => $this->ModelCategory->AllData(),
            'product' => $this->ModelProduct->AllData(),
            'satuan' =>  $this->ModelSatuan->AllData(),

        ];
        return view('v_penjualan', $data);
    }

    public function InsertData()
    {
        // if ($this->validate([
        //     'kode_product' => [
        //         'label' => 'Product Code',
        //         'rules' => 'is_unique[tbl_product.kode_product]',
        //         'errors' => [
        //             'is_unique' => '{field} Sudah Ada, Masukkan Kode Lain !!',
        //             ]
        //     ],
        //     'id_satuan' => [
        //         'label' => 'Satuan',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} Belum Dipilih !!',
        //         ]
        //     ],
        //     'id_category' => [
        //         'label' => 'Category',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} Belum Dipilih !!',
        //         ]
        //     ]
        // ])) {
            $hargajual = str_replace(',','', $this->request->getPost('harga_jual'));
            $data = [
                'kode_product' => $this->request->getPost('kode_product'),
                'nama_product' => $this->request->getPost('nama_product'),
                'id_category' => $this->request->getPost('id_category'),
                'id_satuan' => $this->request->getPost('id_satuan'),
                'harga_jual' => $hargajual,
                'qty' => $this->request->getPost('qty'),
            ];

            $this->ModelPenjualan->InsertData($data);
            session()->setFlashdata('pesan','Data Berhasil Ditambahkan !!');
            return redirect()->to(base_url('Penjualan'));
        // }else{
        //     session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
        //     return redirect()->to(base_url('Penjualan'))->withInput('validation', \Config\Services::validation());
        // }
    }

}