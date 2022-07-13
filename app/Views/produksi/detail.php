<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Detail Produksi</h4>
                        </div>
                        <div class="col-sm-1">
                            <!-- <a href="<?= base_url('produksi/add')?>" class="btn btn-primary">Tambah</a> -->
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <a href="<?= base_url('produksi')?>" class="btn btn-default" style="margin-bottom:1rem">Kembali</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Produksi</th>
                                <th>Waktu Produksi</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Dipakai</th>
                                <th>Bahan Baku</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($list as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->kode_produksi?></td>
                                <td><?= $value->waktu_produksi?></td>
                                <td><?= $value->nama?></td>
                                <td><?= $value->jml_dipakai?></td>
                                <td><?= $value->nama?></td>
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
        $("#table").dataTable()
    })
</script>
<?= $this->endSection()?>