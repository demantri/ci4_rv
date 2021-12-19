<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pembelian extends BaseController
{
    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index()
    {
        $list = $this->db->query("SELECT a.*, nama 
        FROM pembelian a
        JOIN supplier b ON a.id_supplier = b.id
        ORDER BY invoice DESC  
        ")->getResult();
        $data = [
            'list' => $list,
        ];
        return view('pembelian/index', $data);
    }

    public function add()
    {
        $kode = $this->kode();
        $bb = $this->db->table('bahan_baku')->get()->getResult();
        $detail = $this->db->query("SELECT a.*, d.nama 
        from detail_pembelian a 
        join pembelian b on a.invoice = b.invoice
        join bahan_baku d on d.id = a.id_barang
        where b.status = 'proses'
        ")->getResult();
        $total = $this->db->query("SELECT SUM(subtotal) AS total FROM detail_pembelian WHERE invoice = '$kode'")->getRow()->total;
        $cek_detil = $this->db->query("SELECT * from detail_pembelian where invoice = '$kode' ");
        $id_brg = $this->db->query("SELECT id_barang from detail_pembelian where invoice = '$kode' ")->getresult();
        // print_r($id_brg);exit;
        $supplier = $this->db->table('supplier')->get()->getResult();
        $data = [
            'kode' => $kode,
            'bb' => $bb,
            'detail' => $detail,
            'total1' => $total,
            'detil' => $cek_detil,
            'supplier' => $supplier,
            'id_brg' => $id_brg,
        ];
        return view('pembelian/add', $data);
    }

    public function detail_pmb()
    {
        $kode = $this->kode();
        $invoice = $this->request->getPost('invoice');
        $tanggal = $this->request->getPost('tanggal');
        $bb = $this->request->getPost('bb');
        $qty = $this->request->getPost('qty');
        
        $cek_pmb = $this->db->query("SELECT * FROM pembelian WHERE status = 'proses' AND invoice = '$invoice'");

        $cek_bahan_baku = $this->db->query("SELECT * FROM bahan_baku WHERE id = '$bb'")->getRow();
        $harga_satuan = $cek_bahan_baku->harga;
        // print_r($produk);exit;
        $subtotal = $cek_bahan_baku->harga * $qty;
        // print_r($subtotal);exit;

        $cek_detil = $this->db->query("SELECT * from detail_pembelian where id_barang ='$bb' AND invoice = '$invoice' ")->getRow();
        // print_r($cek_bahan_baku);exit;
        if ($cek_pmb->getNumRows() == 0) {
            # code...
            $pmb = [
                'invoice' => $invoice,
                'tanggal' => $tanggal,
            ];
            $this->db->table('pembelian')->insert($pmb);

            $detail = [
                'invoice' => $invoice,
                'id_barang' => $bb,
                'qty' => $qty,
                'harga' => $harga_satuan,
                'subtotal' => $subtotal,
            ];
            $this->db->table('detail_pembelian')->insert($detail);
        } 
        else {
            if (empty($cek_detil->id_barang)) {
                $detail = [
                    'invoice' => $invoice,
                    'id_barang' => $bb,
                    'qty' => $qty,
                    'harga' => $harga_satuan,
                    'subtotal' => $subtotal,
                ];
                $this->db->table('detail_pembelian')->insert($detail);
            } 
            else {
                # code...
                $hasil = $cek_detil->qty + $qty;
                $update_harga = $hasil * $cek_detil->harga;
                $this->db->query("UPDATE detail_pembelian SET qty = '$hasil' , subtotal = '$update_harga' WHERE invoice = '$invoice' AND id_barang = '$bb'");
            }
            
        }
        return redirect()->to(base_url('pembelian/add'));
    }

    public function save_pmb()
    {
        $id = $this->request->getPost('id');
        $total = $this->request->getPost('total');
        $id_supplier = $this->request->getPost('supplier');
        $id_bb = $this->request->getPost('id_bb');
        $cek_inv = $this->db->table('detail_pembelian')->where('invoice', $id)->get()->getResult();

        $data = [
            'id_supplier' => $id_supplier,
            'total' => $total,
            'status' => 'selesai',
        ];
        $this->db->table('pembelian')
        ->where('invoice', $id)
        ->update($data);

        $where = [];
        $bb = [];
        foreach ($id_bb as $key => $value) {
            $where = array(
                'id' => $value
            );

            // ambil stok akhir
            $jumlah = $this->db->table('bahan_baku')->where(['id' => $value])->get()->getRow()->jumlah;

            $bb = array(
                'jumlah' => $jumlah + $cek_inv[$key]->qty,
                'status' => '1',
            );
            
            $this->db->table('bahan_baku')->where($where)->update($bb);
        }
        return redirect()->to(base_url('pembelian'));
    }

    public function laporan_pembelian()
    {
        return view('pembelian/laporan_pembelian');
    }

    // membuat id otomatis pada pembelian
    public function kode()
    {
        $builder = $this->db->table('pembelian')
        ->select('MAX(RIGHT(pembelian.invoice,3)) as kode')
        ->where('status', 'selesai')
        ->limit(1)
        ->get();
        if ($builder->getNumRows() <> 0 ) {
            $data = $builder->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = '001';
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "INVPMB".date('Ymd').$kodemax;
        // print_r($kd);exit;
        return $kd;
    }
}
