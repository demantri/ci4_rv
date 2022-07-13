<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produksi extends BaseController
{
    public function __construct() {
		$this->db = \Config\Database::connect();
	}

    public function index()
    {
        $list = $this->db->query("select a.*, b.kode_produksi, b.waktu_produksi from produk a join produksi b on a.id = b.id_produk")->getResult();
        $data = [
            'list' => $list,
        ];
        return view('produksi/index', $data);
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

        $bb = $this->db->query("select * from bahan_baku where jumlah > 0 and status = 1")->getResult();

        $data = [
            'kode' => $kode,
            'produk' => $produk,
            'detail' => $detail,
            'total1' => $total,
            'detil' => $cek_detil,
            'supplier' => $supplier,
            'id_brg' => $id_brg,
            'bb' => $bb,
        ];
        return view('produksi/add', $data);
    }

    public function listBB()
    {
        $kode_bb = $this->request->getVar('bb');
        $data = $this->db->query("select * from bahan_baku where jumlah > 0 and status = 1 and id = '$kode_bb'")->getResult();
        echo json_encode($data);
    }

    public function save()
    {
        $kode_produksi = $this->request->getVar('kode_produksi');
        $tanggal = $this->request->getVar('tanggal');
        $produk = $this->request->getVar('produk');
        $bahan_baku = $this->request->getVar('bb');
        $qty = $this->request->getVar('jumlah');

        /** update stok */
        $this->updateStokBB($bahan_baku, $qty, 'produksi');

        $tb_produksi = [
            'tgl_produksi' => $tanggal,
            'kode_produksi' => $kode_produksi,
            'id_produk' => $produk,
        ];
        $this->db->table('produksi')->insert($tb_produksi);

        // $tb_detail = [];
        foreach ($bahan_baku as $key => $row) {
            $tb_detail = [
                'kode_produksi' => $kode_produksi,
                'id_bb' => $row,
                'qty' => $qty[$key],
            ];
            $this->db->table('detail_produksi')->insert($tb_detail);
        }

        return redirect()->to(base_url('produksi'));
    }

    public function detail($kode)
    {
        $query = $this->db->query("SELECT a.*, b.nama, b.stok AS stok_produk_akhir, z.qty AS jml_dipakai, x.nama
        FROM produksi a
        JOIN produk b ON a.id_produk = b.id
        JOIN detail_produksi z ON a.kode_produksi = z.kode_produksi
        JOIN bahan_baku x ON z.id_bb = x.id
        WHERE z.kode_produksi = '$kode'")->getResult();

        $data = [
            'list' => $query,
        ];
        return view('produksi/detail', $data);
    }

    private function updateStokBB($bb, $qty, $jenis)
    {
        if ($jenis == 'produksi') {
            foreach ($bb as $key => $value) {
                $last_stok = $this->db->query("select * from bahan_baku where id ='$value'")->getRow()->jumlah;
                $data = [
                    'jumlah' => $last_stok - $qty[$key],
                ];
        
                $this->db->table('bahan_baku')
                ->where('id', $value)
                ->update($data);
            }
        }
    }

    public function kode()
    {
        $builder = $this->db->table('produksi')
        ->select('MAX(RIGHT(produksi.kode_produksi,3)) as kode')
        ->limit(1)
        ->get();
        if ($builder->getNumRows() <> 0 ) {
            $data = $builder->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = '001';
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kd = "TRXPRD".date('Ymd').$kodemax;
        return $kd;
    }
}
