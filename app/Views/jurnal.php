<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11 text-center">
                            <h4>Jurnal Umum</h4>
                        </div>
                        <div class="col-sm-1">
                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah</button> -->
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Kode COA</th>
                                <th>Ref</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no =1;
                            $debit = 0;
                            $kredit = 0;
                            foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <?php if ($value->posisi_dr_cr == 'd') { ?>
                                        <?php $debit += $value->nominal ?>
                                        <td><?= $value->tgl_jurnal ?></td>
                                        <td><?= $value->nama_coa ?></td>
                                        <td><?= $value->no_coa ?></td>
                                        <td><?= $value->id_jurnal ?></td>
                                        <td class="text-right"><?= format_rupiah($value->nominal) ?></td>
                                        <td></td>
                                    <?php } else { ?>
                                        <?php $kredit += $value->nominal ?>
                                        <td></td>
                                        <td><?= $value->nama_coa ?></td>
                                        <td><?= $value->no_coa ?></td>
                                        <td><?= $value->id_jurnal ?></td>
                                        <td></td>
                                        <td class="text-right"><?= format_rupiah($value->nominal) ?></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-center">Total</th>
                                <th class="text-right"><?= format_rupiah($debit) ?></th>
                                <th class="text-right"><?= format_rupiah($kredit) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('coa/add') ?>
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    $(function() {
        $("#t1").DataTable();
    })
</script>
<?= $this->endSection()?>