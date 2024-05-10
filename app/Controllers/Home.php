<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index(): string
    {
        if (session()->get('logged_in')) {
            // Jika pengguna sudah login, arahkan ke halaman Dashboard atau halaman lain yang sesuai dengan level pengguna
            if (session()->get('level') == 1) {
                return redirect()->to(base_url('Admin'));
            } else {
                return redirect()->to(base_url('Penjualan'));
            }
        } else {
            $data = [
                'judul' => 'Login'
            ];
            return view('v_login', $data);
        }
    }
    
    public function checkLoginMiddleware($request, $response, $next)
    {
        // Periksa apakah pengguna sudah login
        if (session()->get('logged_in')) {
            // Jika sudah login, lanjutkan ke controller/method berikutnya
            return $next($request, $response);
        } else {
            // Jika belum login, redirect ke halaman login
            return redirect()->to(base_url('Home'));
        }
    }
    
    public function CekLogin()
    {
        if ($this->validate([
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Diisi',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum Diisi !!',
                ]
            ],
        ])) {
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password'));
            $cek_login = $this->ModelUser->LoginUser($email, $password);
            if ($cek_login) {
                //login berhasil
                session()->set('id_user', $cek_login['id_user']);
                session()->set('nama_user', $cek_login['nama_user']);
                session()->set('level', $cek_login['level']);
                if ($cek_login['level'] == 1) {
                    return redirect()->to(base_url('Admin'));
                } else {
                    return redirect()->to(base_url('Penjualan'));
                }
            } else {
                //gagal login
                session()->setFlashdata('gagal', 'Email atau Password Salah');
                return redirect()->to(base_url('Home'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Home'))->withInput('validation', \Config\Services::validation());
        }
    }

    public function Logout()
    {
        session()->remove('id_user');
        session()->remove('nama_user');
        session()->remove('level');
        session()->setFlashdata('pesan', 'Logout Berhasil');
        return redirect()->to(base_url('Home'));
    }
}
