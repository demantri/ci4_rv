<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Penjualan extends BaseController
{
    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index()
    {
        $list = $this->db->table('penjualan')
        ->orderby('invoice', 'desc')->get()->getResult();
        $data = [
            'list' => $list,
        ];
        return view('penjualan/index', $data);
    }

    public function add()
    {
        $kode = $this->kode();
        $produk = $this->db->table('produk')->where('stok >', 0)->get()->getResult();
        $detail = $this->db->query("SELECT a.*, d.nama 
        from detail_penjualan a 
        join penjualan b on a.invoice = b.invoice
        join produk d on d.id = a.id_barang
        where b.status = 'proses'
        ")->getResult();

        $total = $this->db->query("SELECT SUM(subtotal) AS total FROM detail_penjualan WHERE invoice = '$kode'")->getRow()->total;

        $cek_detil = $this->db->query("SELECT * from detail_penjualan where invoice = '$kode' ");

        $id_brg = $this->db->query("SELECT id_barang from detail_penjualan where invoice = '$kode' ")->getresult();
        // print_r($id_brg);exit;
        $supplier = $this->db->table('supplier')->get()->getResult();
        $data = [
            'kode' => $kode,
            'produk' => $produk,
            'detail' => $detail,
            'total1' => $total,
            'detil' => $cek_detil,
            'supplier' => $supplier,
            'id_brg' => $id_brg,
        ];
        return view('penjualan/add', $data);
    }

    public function detail_pmb()
    {
        $kode = $this->kode();
        $invoice = $this->request->getPost('invoice');
        $tanggal = $this->request->getPost('tanggal');
        $produk = $this->request->getPost('produk');
        $qty = $this->request->getPost('qty');
        
        $cek_pnj = $this->db->query("SELECT * FROM penjualan WHERE status = 'proses' AND invoice = '$invoice'");

        $cek_produk = $this->db->query("SELECT * FROM produk WHERE id = '$produk'")->getRow();

        $harga_satuan = $cek_produk->harga_jual;
        // print_r($produk);exit;
        $subtotal = $cek_produk->harga_jual * $qty;
        // print_r($subtotal);exit;

        $cek_detil = $this->db->query("SELECT * from detail_penjualan where id_barang ='$produk' AND invoice = '$invoice' ")->getRow();
        // print_r($cek_bahan_baku);exit;
        if ($cek_pnj->getNumRows() == 0) {
            # code...
            $pnj = [
                'invoice' => $invoice,
                'tanggal' => $tanggal,
            ];
            $this->db->table('penjualan')->insert($pnj);

            $detail = [
                'invoice' => $invoice,
                'id_barang' => $produk,
                'qty' => $qty,
                'harga' => $harga_satuan,
                'subtotal' => $subtotal,
            ];
            $this->db->table('detail_penjualan')->insert($detail);
        } 
        else {
            if (empty($cek_detil->id_barang)) {
                $detail = [
                    'invoice' => $invoice,
                    'id_barang' => $produk,
                    'qty' => $qty,
                    'harga' => $harga_satuan,
                    'subtotal' => $subtotal,
                ];
                $this->db->table('detail_penjualan')->insert($detail);
            } 
            else {
                # code...
                $hasil = $cek_detil->qty + $qty;
                $update_harga = $hasil * $cek_detil->harga;
                $this->db->query("UPDATE detail_penjualan SET qty = '$hasil' , subtotal = '$update_harga' WHERE invoice = '$invoice' AND id_barang = '$produk'");
            }
            
        }
        return redirect()->to(base_url('penjualan/add'));
    }

    public function save_pnj()
    {
        $id = $this->request->getPost('id');
        $total = $this->request->getPost('total');
        $nama_pelanggan = $this->request->getPost('nama_pelanggan');
        $id_bb = $this->request->getPost('id_bb');
        $cek_inv = $this->db->table('detail_penjualan')->where('invoice', $id)->get()->getResult();

        $data = [
            'nama_pelanggan' => $nama_pelanggan,
            'total' => $total,
            'status' => 'selesai',
        ];
        $this->db->table('penjualan')
        ->where('invoice', $id)
        ->update($data);

        $where = [];
        $bb = [];
        foreach ($id_bb as $key => $value) {
            $where = array(
                'id' => $value
            );

            // ambil stok akhir
            $jumlah = $this->db->table('produk')->where(['id' => $value])->get()->getRow()->stok;

            $bb = array(
                'stok' => $jumlah - $cek_inv[$key]->qty,
            );
            
            $this->db->table('produk')->where($where)->update($bb);
        }
        return redirect()->to(base_url('penjualan'));
    }

    public function kode()
    {
        $builder = $this->db->table('penjualan')
        ->select('MAX(RIGHT(penjualan.invoice,3)) as kode')
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
        $kd = "INVPNJ".date('Ymd').$kodemax;
        // print_r($kd);exit;
        return $kd;
    }
}
