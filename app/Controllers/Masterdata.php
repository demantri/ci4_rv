<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Masterdata extends BaseController
{
    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function bahan_baku()
    {
        $list = $this->db->table('bahan_baku')->get()->getResult();
        $data = [
            'list' => $list,
        ];
        return view('bb/index', $data);
    }

    public function save_bb()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => [
                'label'  => 'Rules.nama',
                'rules'  => 'is_unique[bahan_baku.nama]',
                'errors' => [
                    'is_unique' => 'Rules.nama.is_unique',
                ],
            ],
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $nama = $this->request->getPost('nama');
            $harga = $this->request->getPost('harga');
            $satuan = $this->request->getPost('satuan');
    
            $data = [
                'nama' => $nama, 
                'harga' => $harga, 
                'satuan' => $satuan,
            ];
            $this->db->table('bahan_baku')
            ->insert($data);
        }

        return redirect()->to(base_url('bahan-baku'));
    }

    public function produk()
    {
        $list = $this->db->table('produk')->get()->getResult();
        $bb = $this->db->table('bahan_baku')->get()->getResult();
        $data = [
            'list' => $list,
            'bb' => $bb,
        ];
        // print_r($bb);exit;
        return view('produk/index', $data);
    }

    public function save_produk()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => [
                'label'  => 'Rules.nama',
                'rules'  => 'is_unique[produk.nama]',
                'errors' => [
                    'is_unique' => 'Rules.nama.is_unique',
                ],
            ],
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $nama = $this->request->getPost('nama');
            // $bb = $this->request->getPost('bb[]');
            $harga_jual = $this->request->getPost('harga_jual');
            $harga_modal = $this->request->getPost('harga_modal');
            $stok = $this->request->getPost('stok');
    
            $data = [
                'nama' => $nama, 
                // 'bahan_baku' => $bb, 
                'harga_jual' => $harga_jual,
                'harga_modal' => $harga_modal,
                'stok' => $stok,
            ];
            // print_r($data);exit;
            $this->db->table('produk')
            ->insert($data);
        }

        return redirect()->to(base_url('produk'));
    }

    public function supplier()
    {
        $list = $this->db->table('supplier')->get()->getResult();
        $data = [
            'list' => $list,
        ];
        return view('supplier/index', $data);
    }

    public function save_supplier()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => [
                'label'  => 'Rules.nama',
                'rules'  => 'is_unique[supplier.nama]',
                'errors' => [
                    'is_unique' => 'Rules.nama.is_unique',
                ],
            ],
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $nama = $this->request->getPost('nama');
            $alamat = $this->request->getPost('alamat');
            $no_telp = $this->request->getPost('no_telp');
    
            $data = [
                'nama' => $nama, 
                'alamat' => $alamat, 
                'no_telp' => $no_telp,
            ];
            $this->db->table('supplier')
            ->insert($data);
        }

        return redirect()->to(base_url('supplier'));
    }

    public function role()
    {
        // print_r($sess);exit;
        $list = $this->db->table('role')->get()->getResult();
        $data = [
            'list' => $list,
        ];
        return view('role/index', $data);
    }

    public function save_role()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'desc' => [
                'label'  => 'Rules.desc',
                'rules'  => 'is_unique[role.desc]',
                'errors' => [
                    'is_unique' => 'Rules.desc.is_unique',
                ],
            ],
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $desc = $this->request->getPost('desc');
    
            $data = [
                'desc' => $desc,
            ];
            $this->db->table('role')
            ->insert($data);
        }

        return redirect()->to(base_url('role'));
    }

    public function user()
    {
        $list = $this->db->table('user')->get()->getResult();
        $role = $this->db->table('role')->get()->getResult();
        $data = [
            'list' => $list,
            'role' => $role,
        ];
        return view('user/index', $data);
    }

    public function save_user()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'label'  => 'Rules.username',
                'rules'  => 'is_unique[user.username]',
                'errors' => [
                    'is_unique' => 'Rules.username.is_unique',
                ],
            ],
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $role_id = $this->request->getPost('role');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
    
            $data = [
                'role_id' => $role_id,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'status' => 1,
            ];
            $this->db->table('user')
            ->insert($data);
        }

        return redirect()->to(base_url('user'));
    }
}