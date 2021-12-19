<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Form Penjualan</h4>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?= base_url('penjualan/detail_pmb')?>" method="POST">
                                        <div class="form-group row">
                                            <label for="invoice" class="col-sm-2 col-form-label">Invoice</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="invoice" name="invoice" value="<?= $kode ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d')?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="produk" class="col-sm-2 col-form-label">Produk</label>
                                            <div class="col-sm-8">
                                                <select name="produk" id="produk" class="form-control" required>
                                                    <option value="">-</option>
                                                    <?php foreach ($produk as $key => $value) { ?>
                                                    <option value="<?= $value->id?>"><?= $value->nama?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control" name="qty" id="" min="1" value="1">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- <div class="table-responsive"> -->
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Detail Penjualan</h3>
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga Satuan</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            $no = 1;
                                            $grandtot = 0;
                                            $total = 0;
                                            $subtotal = 0;
                                            foreach ($detail as $value) { ?>
                                                <?php $subtotal += $value->harga * $value->qty; 
                                                $grandtot = $subtotal + $total?>
                                                <tr>
                                                    <td><?= $no++?></td>
                                                    <td><?= $value->nama?></td>
                                                    <td class="text-right"><?= format_rupiah($value->harga)?></td>
                                                    <td><?= $value->qty?></td>
                                                    <td class="text-right"><?= format_rupiah($value->harga * $value->qty)?></td>
                                                    <td></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <th colspan="4" class="text-center">Grand Total</th>
                                                <th colspan="2" class="text-right"><?= format_rupiah($grandtot)?></th>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <?php if ($detil->getNumRows() != 0) { ?>
                                            <form action="<?= base_url('penjualan/save_pnj')?>" method="POST">
                                            <input type="hidden" name="id" value="<?= $kode ?>">
                                            <input type="hidden" name="total" value="<?= $total1 ?>">

                                            <?php foreach ($id_brg as $key => $value) { ?>
                                                <input type="hidden" name="id_bb[]" value="<?= $value->id_barang?>">
                                            <?php } ?>
                                            <!-- supplier -->
                                            <div class="form-group row">
                                            <label for="nama_pelanggan" class="col-sm-2 col-form-label">Nama Customer</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama_pelanggan" placeholder="Nama Customer" required>
                                            </div>
                                        </div>
                                            <!-- <a href="" class="btn btn-success">Selesai</a> -->
                                            <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                            </form>
                                        <?php }?>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <hr>
                    <a href="<?= base_url('penjualan')?>" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
