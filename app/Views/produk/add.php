<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Masterdata/save_produk')?>" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Produk" required>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="bb" class="col-sm-3 col-form-label">Bahan Baku</label>
                        <div class="col-sm-9">
                        <select class="select2" multiple="multiple" style="width: 100%;" name="bb[]">
                            <?php foreach ($bb as $item) { ?>
                                <option value="<?= $item->nama?>"><?= $item->nama?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                        <div class="col-sm-9">
                        <input type="text" name="harga_jual" class="form-control" id="harga_jual" placeholder="Harga Jual" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_modal" class="col-sm-3 col-form-label">Harga Modal</label>
                        <div class="col-sm-9">
                        <input type="text" name="harga_modal" class="form-control" id="harga_modal" placeholder="Harga Modal" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-sm-3 col-form-label">Stok Akhir</label>
                        <div class="col-sm-9">
                        <input type="text" name="stok" class="form-control" id="stok" placeholder="Stok Akhir" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
