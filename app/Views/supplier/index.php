<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Supplier</h4>
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
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->alamat ?></td>
                                <td><?= $value->no_telp ?></td>
                                <td class="text-center">
                                    <a href="#edit_<?= $value->id?>" data-toggle="modal" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= base_url('Masterdata/delete/'.$value->id.'/'."supplier")?>" class="btn btn-danger btn-sm" onclick="return confirm('anda yakin?')">Hapus</a>
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
<?= $this->include('supplier/add') ?>
<?= $this->include('supplier/edit') ?>
<?= $this->endSection() ?>