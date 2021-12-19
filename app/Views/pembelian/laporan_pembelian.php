<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('pembelian/laporan-pembelian')?>" method="post">
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tgl_awal" name="tgl_awal" placeholder="Tanggal Awal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tgl_akhir" name="tgl_akhir" placeholder="Tanggal Akhir" required>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary">Filter</button>
                        <!-- <a href="<?= base_url('pembelian/show_all')?>" class="btn btn-default">Show All</a> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Laporan Pembelian</h4>
                        </div>
                        <div class="col-sm-1">
                            <!-- <a href="<?= base_url('pembelian/add')?>" class="btn btn-primary">Tambah</a> -->
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
                                <th>Tanggal</th>
                                <th>Bahan Baku</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
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
                                <td><?= $value->nama ?></td>
                                <td><?= $value->qty ?></td>
                                <td><?= $value->subtotal ?></td>
                                <td><?= $value->invoice ?></td>
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
    $(function() {
        $("#tgl_awal").datepicker({
            dateFormat: 'yy/mm/dd',
            onSelect: function(selected) {
            $("#tgl_akhir").datepicker("option","minDate", selected)
            }
        });
        $("#tgl_akhir").datepicker({ 
            dateFormat: 'yy/mm/dd',
            onSelect: function(selected) {
            $("#tgl_awal").datepicker("option","maxDate", selected)
            }
        });
        
        $("#t1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "buttons": [
            "copy", 
            "csv", 
            "excel", 
            "pdf", 
            "print", 
            "colvis"
            ]
        }).buttons().container().appendTo('#t1_wrapper .col-md-6:eq(0)');
    })
</script>
<?= $this->endSection()?>