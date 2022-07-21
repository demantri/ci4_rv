<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Detail Pembelian <?= '# ' . $list[0]->invoice ?></h4>
                        </div>
                        <div class="col-sm-1">
                            <a href="<?= base_url('pembelian')?>" class="btn btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Bahan Baku</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->invoice ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->qty ?></td>
                                <td><?= format_rupiah($value->harga) ?></td>
                                <td><?= format_rupiah($value->subtotal) ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    $(document).ready(function (){
        $("#t1").dataTable()
    })
</script>
<?= $this->endSection()?>