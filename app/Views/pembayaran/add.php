<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pembayaran/bayar')?>" method="POST" id="form-pembayaran">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="invoice" class="col-sm-4 col-form-label">Invoice Pembelian</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="invoice" name="invoice" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pmb" class="col-sm-4 col-form-label">Tgl. Pembelian</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tgl_pmb" name="tgl_pmb" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="kode_pembayaran" class="col-sm-4 col-form-label">Kode Pembayaran</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kode_pembayaran" name="kode_pembayaran" value="<?= $kode_pembayaran ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pembayaran" class="col-sm-4 col-form-label">Tgl. Pembayaran</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tgl_pembayaran" name="tgl_pembayaran" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="nominal" class="col-sm-4 col-form-label">Nominal Transaksi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nominal" name="nominal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kembalian" class="col-sm-4 col-form-label">Kembalian</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="kembalian" name="kembalian" readonly>
                            <div id="info"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_transaksi" class="col-sm-4 col-form-label">Total Transaksi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="total_transaksi" name="total_transaksi" readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>