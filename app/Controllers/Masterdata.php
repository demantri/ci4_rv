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
            'validation' => \Config\Services::validation()
        ];
        return view('bb/index', $data);
    }

    public function save_bb()
    {
        $valid = $this->validate([
            'nama' => [
                'label' => 'Nama bahan baku',
                'rules' => 'required|is_unique[bahan_baku.nama]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'is_unique' => '{field} sudah terdaftar didatabase.',
                ]
            ],
            'harga' => [
                'label' => 'Harga bahan baku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'satuan' => [
                'label' => 'Satuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
        ]);
        
        if (!$valid) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } 
        else {
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

            session()->setFlashdata("success", "Data berhasil disimpan.");
    
            return redirect()->to(base_url('bahan-baku'));
        }
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
        $list = $this->db->table('supplier')->where('deleted', 0)->get()->getResult();
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

    public function update_supplier()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $no_telp = $this->request->getPost('no_telp');
        $data = [
            'nama' => $nama, 
            'alamat' => $alamat, 
            'no_telp' => $no_telp,
        ];
        $this->db->table('supplier')
        ->where('id', $id)
        ->update($data);
        return redirect()->to(base_url('supplier'));

    }

    public function role()
    {
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

    public function coa()
    {
        $list = $this->db->table('coa')->where('deleted', 0)->get()->getResult();
        $data = [
            'list' => $list,
        ];
        return view('coa/index', $data);
    }

    public function save_coa()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_coa' => [
                'label'  => 'Rules.no_coa',
                'rules'  => 'is_unique[coa.no_coa]',
                'errors' => [
                    'is_unique' => 'Rules.no_coa.is_unique',
                ],
            ],
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $no_coa = $this->request->getPost('no_coa');
            $header = substr($no_coa, 0, 1);
            $nama_coa = $this->request->getPost('nama_coa');
            $posisi_dr_cr = $this->request->getPost('posisi_dr_cr');
            $saldo_awal = $this->request->getPost('saldo_awal');
    
            $data = [
                'no_coa' => $no_coa, 
                'nama_coa' => ucwords($nama_coa), 
                'header' => $header, 
                'posisi_dr_cr' => $posisi_dr_cr, 
                'saldo_awal' => $saldo_awal, 
            ];
            $this->db->table('coa')
            ->insert($data);
        }
        return redirect()->to(base_url('coa'));
    }

    public function update_coa()
    {
        $id = $this->request->getPost('id');
        $no_coa = $this->request->getPost('no_coa');
        $nama_coa = $this->request->getPost('nama_coa');
        $posisi_dr_cr = $this->request->getPost('posisi_dr_cr');
        $saldo_awal = $this->request->getPost('saldo_awal');

        $data = [
            'posisi_dr_cr' => $posisi_dr_cr, 
            'saldo_awal' => $saldo_awal, 
        ];
        $this->db->table('coa')->where('id', $id)->update($data);
        return redirect()->to(base_url('coa'));

    }

    public function delete($id, $jenis)
    {
        $data = [
            'deleted' => 1,
        ];
        if ($jenis == 'coa') {
            $this->db->table('coa')
            ->where('id', $id)
            ->update($data);
            return redirect()->to(base_url('coa'));
        } else if ($jenis == 'supplier') {
            $this->db->table('supplier')
            ->where('id', $id)
            ->update($data);
            return redirect()->to(base_url('supplier'));
        }
    }
}
