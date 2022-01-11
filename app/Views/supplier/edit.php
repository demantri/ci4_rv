<?php foreach ($list as $key => $value) { ?>
    <div class="modal fade" id="edit_<?= $value->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Masterdata/update_supplier')?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" value="<?= $value->id?>" name="id">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Supplier</label>
                            <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Supplier" value="<?= $value->nama?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                            <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control" placeholder="Alamat Supplier" required><?= htmlspecialchars($value->alamat)?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telp" class="col-sm-3 col-form-label">No Telp</label>
                            <div class="col-sm-9">
                            <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No Telp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="<?= $value->no_telp?>" required>
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
<?php } ?>