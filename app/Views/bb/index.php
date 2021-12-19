<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Bahan Baku</h4>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bahan Baku</th>
                                <th>Harga</th>
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no =1; 
                            foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value->nama ?></td>
                                    <td class="text-right"><?= format_rupiah($value->harga) ?></td>
                                    <td><?= $value->satuan ?></td>
                                    <td><?= $value->jumlah ?></td>
                                    <td class="text-center" style="width:15%;">
                                        <?= $value->status == 0 ? '<button class="btn btn-sm btn-warning">Belum melakukan pembelian</button>' : '<button class="btn btn-sm btn-success">Sudah melakukan pembelian</button>'; ?>
                                    </td>
                                    <td class="text-center" style="width:15%;">
                                        <a href="" class="btn btn-sm btn-primary">Pembelian Bahan Baku</a>
                                        <!-- <a href="" class="btn btn-sm btn-primary">Detail</a> -->
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
<?= $this->include('bb/add') ?>
<?= $this->endSection() ?>