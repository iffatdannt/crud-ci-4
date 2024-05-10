<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCategory;

class Category extends BaseController
{
    public function __construct() 
    {
        $this->ModelCategory = new ModelCategory();
    }

    public function index()
    {
        $data=[
            'judul' => 'Master Data',
            'subjudul' => 'Category',
            'menu' => 'masterdata',
            'submenu' => 'category',
            'page' => 'v_category',
            'category' => $this->ModelCategory->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        $data = ['nama_category'=> $this->request->getPost('nama_category')];
        $this->ModelCategory->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan !!');
        return redirect()->to('Category');
    }

    public function UpdateData($id_category)
    {
        $data = [
        'id_category'=> $id_category,    
        'nama_category'=> $this->request->getPost('nama_category')];
        $this->ModelCategory->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil Diubah !!');
        return redirect()->to('Category');
    }

    public function DeleteData($id_category)
    {
        $data = [
        'id_category'=> $id_category,
        ]; 
        $this->ModelCategory->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!');
        return redirect()->to('Category');
    }
}
