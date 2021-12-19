<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tgl_awal" name="tgl_awal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tgl_akhir" name="tgl_akhir">
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-default">Filter</button>
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
                                <th>Supplier</th>
                                <th>Total Transaksi</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

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
            onSelect: function(selected) {
            $("#tgl_akhir").datepicker("option","minDate", selected)
            }
        });
        $("#tgl_akhir").datepicker({ 
            onSelect: function(selected) {
            $("#tgl_awal").datepicker("option","maxDate", selected)
            }
        });  
    })
</script>
<?= $this->endSection()?>