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

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert"><?= $validation->listErrors()?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

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
                                        <?= $value->status == 0 ? '<span class="badge badge-warning">Belum melakukan pembelian</span>' : '<span class="badge badge-success">Sudah melakukan pembelian</span>'; ?>
                                    </td>
                                    <td class="text-center" style="width:15%;">
                                        <a href="<?= base_url('pembelian')?>" class="btn btn-sm btn-default">Pembelian Bahan Baku</a>
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