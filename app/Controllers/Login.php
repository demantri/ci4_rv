<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        return view('layout/login');
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $model->where('username', $username)->first();
        // print_r($data);exit;
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'role_id'     => $data['role_id'],
                    'username'     => $data['username'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                $session->setFlashdata('msg', 'Berhasil login. Selamat datang, ' . ucwords(session('username')));
                return redirect()->to(base_url('dashboard'));
            }else{
                $session->setFlashdata('msg', 'Password salah. Silahkan ulangi kembali.');
                return redirect()->to(base_url('login'));
            }
        }else{
            $session->setFlashdata('msg', 'Username tidak ditemukan.');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
}
