<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Penjualan</h4>
                        </div>
                        <div class="col-sm-1">
                            <a href="<?= base_url('penjualan/add')?>" class="btn btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Invoice</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Total Transaksi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->invoice ?></td>
                                <td><?= $value->tanggal ?></td>
                                <td><?= $value->nama_pelanggan ?></td>
                                <td><?= format_rupiah($value->total) ?></td>
                                <td class="text-center">
                                    <span class="badge badge-success"><?= ucwords($value->status) ?></span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-default detail"
                                    data-id="<?= $value->invoice ?>"
                                    data-toggle="modal"
                                    data-target="#detail"
                                    >Detail</button>
                                </td>
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
<?= $this->include('penjualan/detail');?>
<?= $this->Section('script')?>
<script>
    $(document).ready(function (){
        $("#t1").dataTable()
    })
</script>
<?= $this->endSection()?>