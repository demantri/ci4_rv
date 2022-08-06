<?php

use CodeIgniter\Model;

class JurnalModel extends Model
{
    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function generateJurnal($kode, $tgl_jurnal, $no_coa, $posisi, $nominal)
    {
        $data = [
            'id_jurnal' => $kode,
            'tgl_jurnal' => $tgl_jurnal,
            'no_coa' => $no_coa,
            'posisi_dr_cr' => $posisi,
            'nominal' => $nominal,
        ];
        return $this->db->table('jurnal')->insert($data);
    }
}
?>