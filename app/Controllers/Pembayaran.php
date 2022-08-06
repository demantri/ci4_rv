<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pembayaran extends BaseController
{
    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index()
    {
        $kode_pembayaran = $this->kodePembayaran();
        $list = $this->db->query("select * from pembelian where status ='menunggu pembayaran'")->getResult();
        $data = [
            'kode_pembayaran' => $kode_pembayaran,
            'list' => $list
        ];
        return view('pembayaran/index', $data);
    }

    public function bayar()
    {
        $invoice = $this->request->getVar('invoice');
        $tgl_pmb = $this->request->getVar('tgl_pmb');
        $kode_pembayaran = $this->request->getVar('kode_pembayaran');
        $tgl_pembayaran = $this->request->getVar('tgl_pembayaran');
        $nominal = $this->request->getVar('nominal');
        $kembalian = $this->request->getVar('kembalian');
        $total_transaksi = $this->request->getVar('total_transaksi');

        $data = [
            'kode_pembayaran' => $kode_pembayaran,
            'invoice' => $invoice,
            'tgl_pembayaran' => $tgl_pembayaran,
            'tgl_pembelian' => $tgl_pmb,
            'jenis_pembayaran' => 'Tunai',
            'nominal' => $nominal,
            'kembalian' => $kembalian,
            'total_pembayaran' => $total_transaksi,
        ];
        $this->db->table('pembayaran')->insert($data);

        /** update status ke pembelian */
        $update = [
            'status' => 'selesai'
        ];
        $this->db->table('pembelian')
        ->where('invoice', $invoice)
        ->update($update);

        /** dibawah ini di uncomend aja, tinggal di sesuaikan jurnal nya apa */
        // $kas = [
        //     'id_jurnal' => $id, 
        //     'tgl_jurnal' => date('Y-m-d'), 
        //     'no_coa' => 111, 
        //     'posisi_dr_cr' => 'd', 
        //     'nominal' => $total, 
        // ];
        // $this->db->table('jurnal')->insert($kas);

        // $penjualan = [
        //     'id_jurnal' => $id, 
        //     'tgl_jurnal' => date('Y-m-d'), 
        //     'no_coa' => 400, 
        //     'posisi_dr_cr' => 'k', 
        //     'nominal' => $total, 
        // ];
        // $this->db->table('jurnal')->insert($penjualan);

        return redirect()->to(base_url('pembayaran'));
    }

    public function laporan_pembayaran()
    {
        $tgl_awal = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        
        $sql = "SELECT * FROM pembayaran ";
        if (isset($tgl_awal, $tgl_akhir)) {
            # code...
            $sql .= "WHERE tgl_pembayaran BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            $list = $this->db->query($sql)->getResult();
            $data = [
                'list' => $list
            ];
        } else {
            $list = $this->db->query($sql)->getResult();
            $data = [
                'list' => $list,
            ];
        }
        return view('pembayaran/laporan_pembayaran', $data);
    }

    // membuat id otomatis
    public function kodePembayaran()
    {
        $builder = $this->db->table('pembayaran')
        ->select('MAX(RIGHT(pembayaran.kode_pembayaran,3)) as kode')
        // ->where('status', 'menunggu pembayaran')
        ->limit(1)
        ->get();
        if ($builder->getNumRows() <> 0 ) {
            $data = $builder->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = '001';
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "TRX-BYR".date('Ymd').$kodemax;
        // print_r($kd);exit;
        return $kd;
    }
}
?>