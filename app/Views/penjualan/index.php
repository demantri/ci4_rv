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
                                    type="button"
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
<?= $this->include('penjualan/detail');?>
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    function number_format(n) {
		return n.toLocaleString(
		undefined, // leave undefined to use the browser's locale,
					// or use a string like 'en-US' to override it.
		{ minimumFractionDigits: 0 }
		);
	}
    
    $(document).ready(function (){
        $("#t1").dataTable()
    });

    $(document).on("click", ".detail", function () {
        var invoice = $(this).data('id');
        $.ajax({
            url : "<?= base_url('Penjualan/list_detail_penjualan')?>",
            data : {
                invoice : invoice
            },
            type: "post",
            success:function(response) {
                // console.log(response);
                let obj = JSON.parse(response);
                if (obj.length > 0) {
                    $("#header-title").html(`<h5 class="modal-title" id="exampleModalLabel">Detail Penjualan #` + `${obj[0].invoice}</h5>`);
                    let table = `<thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Produk</th>
                                <th>Qty</th>
                                <th>Harga Produk</th>
                                <th>Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>`;
                        for (let index = 0; index < obj.length; index++) {
                            table += `
                            <tr>
                                <td>${ obj[index].invoice }</td>
                                <td>${ obj[index].nama }</td>
                                <td>${ obj[index].qty }</td>
                                <td>${ obj[index].harga }</td>
                                <td>${ obj[index].subtotal }</td>
                            </tr>
                            `;
                        }
                        table += '</tbody></table>';
                        $('#tb-detail').html(table);
                }
            }
        });
    });
</script>
<?= $this->endSection()?>