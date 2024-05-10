<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        $data=[
            'judul' => 'Master Data',
            'subjudul' => 'Laporan',
            'menu' => 'masterdata',
            'submenu' => 'laporan',
            'page' => 'v_laporan'
        ];
        return view('v_template', $data);
    }
}
