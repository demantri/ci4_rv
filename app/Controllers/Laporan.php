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

    public function buku_besar()
    {
        $coa = $this->db->query("select * from coa where deleted = 0")->getResult();
        
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $periode = $tahun .'-'. $bulan;
        $no_coa = $this->request->getVar('coa');
        if (isset($periode, $no_coa)) {
            $cek = date('m-Y', strtotime("-1 months", strtotime($periode)));
            $bulan1 = substr($cek, 0, 2);
            $tahun1 = substr($cek, 3, 7);
            $query = $this->db->query("SELECT 
            SUM(nominal) AS debit, 
            (
                SELECT sum(nominal) 
                FROM jurnal 
                WHERE no_coa = '$no_coa' 
                AND MONTH(tgl_jurnal) <= '$bulan1' 
                AND YEAR(tgl_jurnal) <= '$tahun1' 
                and posisi_dr_cr = 'k' 
            ) AS kredit
            FROM jurnal
            WHERE no_coa = '$no_coa'
            AND MONTH(tgl_jurnal) <= '$bulan1'
            AND YEAR(tgl_jurnal) <= '$tahun1'
            AND posisi_dr_cr = 'd'");
            
            $debit = $query->getRow()->debit;
            $kredit = $query->getRow()->kredit;
            $pengurangan = $debit - $kredit;
    
            /** cek saldo awal berdasarkan no coa */
            $saldoByCoa = $this->db->query("SELECT * FROM coa WHERE no_coa = '$no_coa'")->getRow()->saldo_awal;
            $saldo_awal = $saldoByCoa + $pengurangan;
    
            $query2 = $this->db->query("SELECT 
            a.*, b.nama_coa, b.saldo_awal, b.header
            FROM jurnal a
            JOIN coa b ON a.no_coa = b.no_coa
            WHERE b.no_coa = '$no_coa' 
            AND LEFT(a.tgl_jurnal, 7) = '$periode'
            ORDER BY tgl_jurnal ASC");
    
            $listBB = $query2->getResult();
            $getSaldo = $query2->getRow()->saldo_awal ?? 0 ;

            $data = [
                'coa' => $coa,
                'saldo_awal' => $saldo_awal,
                'per' => $periode,
                'list' => $listBB,
            ];
            return view('bukubesar', $data);
        } else {
            $cek = date('m-Y', strtotime("-1 months", strtotime($periode)));
            $bulan1 = substr($cek, 0, 2);
            $tahun1 = substr($cek, 3, 7);
            $query = $this->db->query("SELECT 
            SUM(nominal) AS debit, 
            (
                SELECT sum(nominal) 
                FROM jurnal 
                WHERE no_coa = '$no_coa' 
                AND MONTH(tgl_jurnal) <= '$bulan1' 
                AND YEAR(tgl_jurnal) <= '$tahun1' 
                and posisi_dr_cr = 'k' 
            ) AS kredit
            FROM jurnal
            WHERE no_coa = '$no_coa'
            AND MONTH(tgl_jurnal) <= '$bulan1'
            AND YEAR(tgl_jurnal) <= '$tahun1'
            AND posisi_dr_cr = 'd'");
            
            $debit = $query->getRow()->debit;
            $kredit = $query->getRow()->kredit;
            $pengurangan = $debit - $kredit;
    
            /** cek saldo awal berdasarkan no coa */
            $saldoByCoa = $this->db->query("SELECT * FROM coa WHERE no_coa = '$no_coa'")->getRow()->saldo_awal ?? 0;
            // print_r($saldoByCoa);exit;
            $saldo_awal = $saldoByCoa + $pengurangan;
    
            $query2 = $this->db->query("SELECT 
            a.*, b.nama_coa, b.saldo_awal, b.header
            FROM jurnal a
            JOIN coa b ON a.no_coa = b.no_coa
            WHERE b.no_coa = '$no_coa' 
            AND LEFT(a.tgl_jurnal, 7) = '$periode'
            ORDER BY tgl_jurnal ASC");
            // print_r($query2);exit;
    
            $listBB = $query2->getResult();
            $getSaldo = $query2->getRow()->saldo_awal ?? 0 ;

            $data = [
                'coa' => $coa,
                'saldo_awal' => $saldo_awal,
                'per' => '',
                'list' => $listBB,
            ];
            return view('bukubesar', $data);
        }
    }
}
