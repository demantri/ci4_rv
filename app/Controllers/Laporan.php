<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function __construct() {
		$this->db = db_connect();
	}

    public function jurnal_umum()
    {
        $list = $this->db->query("SELECT a.*, b.nama_coa, b.saldo_awal
        FROM jurnal a 
        JOIN coa b ON a.no_coa = b.no_coa")->getResult();
        $data = [
            'list' => $list,
        ];
        return view('jurnal', $data);
    }
}
