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
                                <th class="text-center">Jumlah Produk</th>
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
                                <td class="text-center">
                                    <button class="btn btn-warning btn-edit"
                                    data-target="#edit"
                                    data-toggle="modal"
                                    data-id="<?= $item->id ?>"
                                    data-nama="<?= $item->nama ?>"
                                    data-harga_jual="<?= $item->harga_jual ?>"
                                    data-harga_modal="<?= $item->harga_modal ?>"
                                    data-stok="<?= $item->stok ?>"
                                    >Edit</button>
                                    <!-- <button class="btn btn-warning">Hapus</button> -->
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
<?= $this->include('produk/edit') ?>
<?= $this->endSection() ?>
<?= $this->Section('script');?>
<script>
    $(function() {
        $('.select2').select2()
    });

    $(document).on("click", ".btn-edit", function() {
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var harga_jual = $(this).data("harga_jual");
        var harga_modal = $(this).data("harga_modal");
        var stok = $(this).data("stok");

        $(".modal-body #id").val(id);
        $(".modal-body #nama").val(nama);
        $(".modal-body #harga_jual").val(harga_jual);
        $(".modal-body #harga_modal").val(harga_modal);
        $(".modal-body #stok").val(stok);
    });
</script>
<?= $this->endSection();?>