<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Masterdata/save_coa')?>" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="no_coa" class="col-sm-3 col-form-label">No COA</label>
                        <div class="col-sm-9">
                        <input type="text" name="no_coa" class="form-control" id="no_coa" placeholder="No COA" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_coa" class="col-sm-3 col-form-label">Nama COA</label>
                        <div class="col-sm-9">
                        <input type="text" name="nama_coa" class="form-control" id="nama_coa" placeholder="Nama COA" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="posisi_dr_cr" class="col-sm-3 col-form-label">Posisi Debit/Kredit</label>
                        <div class="col-sm-9">
                        <select name="posisi_dr_cr" id="posisi_dr_cr" class="form-control" required>
                            <option value="">-</option>
                            <option value="d">Debit</option>
                            <option value="k">Kredit</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="saldo_awal" class="col-sm-3 col-form-label">Saldo Awal</label>
                        <div class="col-sm-9">
                        <input type="text" name="saldo_awal" class="form-control" id="saldo_awal" placeholder="Saldo Awal" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
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