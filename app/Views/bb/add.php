<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Masterdata/save_bb')?>" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Bahan</label>
                        <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Bahan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-sm-3 col-form-label">Harga Satuan</label>
                        <div class="col-sm-9">
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Satuan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9">
                        <select name="satuan" id="satuan" class="form-control" required>
                            <option value="">-</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Kilo">Kilo</option>
                            <option value="Pasang">Pasang</option>
                        </select>
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