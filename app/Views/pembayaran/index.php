<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Pembayaran Bahan Baku</h4>
                        </div>
                        <!-- <div class="col-sm-1">
                            <a href="<?= base_url('pembelian/add')?>" class="btn btn-primary">Tambah</a>
                        </div> -->
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Invoice</th>
                                <th class="text-center">Tanggal Pembelian</th>
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
                                <td><?= 'Rp ' . number_format($value->total) ?></td>
                                <td>
                                    <span class="badge badge-warning">
                                    <?= ucwords($value->status) ?>
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning btn-byr" 
                                    data-target="#add" 
                                    data-toggle="modal"
                                    data-invoice="<?= $value->invoice ?>"
                                    data-tgl="<?= $value->tanggal ?>"
                                    data-total="<?= $value->total ?>"
                                    >
                                        <i class="fas fa-dollar-sign"></i>
                                    </button>
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
<?= $this->include('pembayaran/add');?>
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    $(document).ready(function (){
        $("#t1").dataTable();
        var info = '';
        $(".info").hide();
        $("#kembalian").val('0');
        $(".btn-simpan").prop("disabled", true);

        $('#nominal').on("cut copy paste", function(e) {
            e.preventDefault();
        });

        // $("#form-pembayaran")[0].reset();

        $(document).on("click", ".btn-byr", function () {
            var invoice = $(this).data('invoice');
            var tgl = $(this).data('tgl');
            var total = $(this).data('total');
            $(".modal-body #invoice").val(invoice);
            $(".modal-body #tgl_pmb").val(tgl);
            $(".modal-body #total_transaksi").val(total);
        });

        $(document).on("input", '#nominal', function() {
            this.value = this.value.replace(/\D/g, '');

            var nominal = $(this).val();
            if (nominal == '') {
                $("#kembalian").val('0');
            }
            var total_transaksi = $("#total_transaksi").val();

            var kembalian = parseInt(nominal) - parseInt(total_transaksi);

            
            info = `<i style="color:red; font-size:small;">Nominal harus sama dengan atau lebih dari ${total_transaksi} </i>`;
            
            if (parseInt(nominal) >= parseInt(total_transaksi)) {
                $("#info").hide();
                $(".btn-simpan").prop("disabled", false);
            } else if (parseInt(nominal) < parseInt(total_transaksi)) {
                $("#info").show();
                $("#info").html(info);
                $(".btn-simpan").prop("disabled", true);
            }

            $("#kembalian").val(kembalian);
        });
    })
</script>
<?= $this->endSection()?>