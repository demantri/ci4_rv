<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Form produksi</h4>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                    <form action="<?= base_url('produksi/save')?>" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="kode_produksi" class="col-sm-3 col-form-label">Kode Produksi</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="kode_produksi" name="kode_produksi" value="<?= $kode ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Produksi</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d')?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="produk" class="col-sm-3 col-form-label">Produk</label>
                                        <div class="col-sm-9">
                                            <select name="produk" id="produk" class="form-control" required>
                                                <option value="">Pilih Produk</option>
                                                <?php foreach ($produk as $key => $value) { ?>
                                                <option value="<?= $value->id?>"><?= $value->nama?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- <div class="table-responsive"> -->
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Detail Produksi</h3>
                                        <br>
                                        <table class="table table-bordered table-striped" style="overflow: scroll;" id="mytable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Bahan Baku</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">
                                                        Aksi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="bb[]" id="bahan_baku1" class="form-control" onchange="getBB(1)" required>
                                                            <?php foreach ($bb as $item) { ?>
                                                            <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" min="1" class="form-control" placeholder="Masukkan jumlah" id="jumlah1" name="jumlah[]">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-info add-row">Tambah row</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>
                    <hr>
                    <a href="<?= base_url('produksi')?>" class="btn btn-default">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    function getBB(id) {
        var value = $('#bahan_baku'+id).val();
        // console.log(value)
        $.ajax({
            url: "<?= base_url('produksi/listBB')?>",
            type: "post", 
            data: {
                bb : value,
            },
            success:function(response) {
                var obj = JSON.parse(response);
                console.log(obj)
            }
        });
    }
    $(document).ready(function (){
        var i = 2;
        $(".add-row").click(function() {
            var data = `<tr>
                            <td>
                                <select name="bb[]" id="bahan_baku${i}" class="form-control" onchange="getBB(${i})" required>
                                    <?php foreach ($bb as $item) { ?>
                                    <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" min="1" class="form-control" placeholder="Masukkan jumlah" id="jumlah${i}" name="jumlah[]">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-warning remove-row">Hapus row</button>
                            </td>
                        </tr>`;
            $('table').append(data);
            i++;
        });

        $("#mytable").on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });
    })
</script>
<?= $this->endSection()?>
