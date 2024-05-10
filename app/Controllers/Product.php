<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduct;
use App\Models\ModelCategory;
use App\Models\ModelSatuan;

class Product extends BaseController
{
    public function __construct() 
    {
        $this->ModelProduct = new ModelProduct();
        $this->ModelCategory = new ModelCategory();
        $this->ModelSatuan = new ModelSatuan();
    }

    public function index()
    {
        $data=[
            'judul' => 'Master Data',
            'subjudul' => 'Product',
            'menu' => 'masterdata',
            'submenu' => 'product',
            'page' => 'v_product',
            'product' =>  $this->ModelProduct->AllData(),
            'category' => $this->ModelCategory->AllData(),
            'satuan' =>  $this->ModelSatuan->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'kode_product' => [
                'label' => 'Product Code',
                'rules' => 'is_unique[tbl_product.kode_product]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukkan Kode Lain !!',
                    ]
            ],
            'id_satuan' => [
                'label' => 'Satuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !!',
                ]
            ],
            'id_category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !!',
                ]
            ]
        ])) {
            $hargabeli = str_replace(',','', $this->request->getPost('harga_beli'));
            $hargajual = str_replace(',','', $this->request->getPost('harga_jual'));
            $data = [
                'kode_product' => $this->request->getPost('kode_product'),
                'nama_product' => $this->request->getPost('nama_product'),
                'id_category' => $this->request->getPost('id_category'),
                'id_satuan' => $this->request->getPost('id_satuan'),
                'harga_beli' => $hargabeli,
                'harga_jual' => $hargajual,
                'stok' => $this->request->getPost('stok'),
            ];
            $this->ModelProduct->InsertData($data);
            session()->setFlashdata('pesan','Data Berhasil Ditambahkan !!');
            return redirect()->to(base_url('Product'));
        }else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Product'))->withInput('validation', \Config\Services::validation());
        }
    }
    
    public function UpdateData($id_product)
    {
        if ($this->validate([

            'id_satuan' => [
                'label' => 'Satuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !!',
                ]
            ],
            'id_category' => [
                'label' => 'Category',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !!',
                ]
            ]
        ])) {
            $hargabeli = str_replace(',','', $this->request->getPost('harga_beli'));
            $hargajual = str_replace(',','', $this->request->getPost('harga_jual'));
            $data = [
                'id_product' => $id_product,
                'nama_product' => $this->request->getPost('nama_product'),
                'id_category' => $this->request->getPost('id_category'),
                'id_satuan' => $this->request->getPost('id_satuan'),
                'harga_beli' => $hargabeli,
                'harga_jual' => $hargajual,
                'stok' => $this->request->getPost('stok'),
            ];
            $this->ModelProduct->UpdateData($data);
            session()->setFlashdata('pesan','Data Berhasil Diubah !!');
            return redirect()->to(base_url('Product'));
        }else{
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Product'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function DeleteData($id_product)
    {
        $data = [
        'id_product'=> $id_product,
        ];
        $this->ModelProduct->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!');
        return redirect()->to('Product');
    }
}

