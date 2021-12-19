<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Produk</h4>
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
                                <th>Produk</th>
                                <!-- <th>Bahan Baku</th> -->
                                <th>Harga Jual</th>
                                <th>Harga Modal</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($list as $item) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $item->nama ?></td>
                                <td><?= format_rupiah($item->harga_jual) ?></td>
                                <td><?= format_rupiah($item->harga_modal) ?></td>
                                <td><?= $item->stok ?></td>
                                <td style="width: 13%;" class="text-center">
                                    <button class="btn btn-warning">Ubah</button>
                                    <button class="btn btn-warning">Hapus</button>
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
<?= $this->include('produk/add') ?>
<?= $this->endSection() ?>
<?= $this->Section('script');?>
<script>
    $(function() {
        $('.select2').select2()
    })
</script>
<?= $this->endSection();?>