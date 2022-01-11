<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>COA</h4>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No COA</th>
                                <th>Nama COA</th>
                                <th>Posisi Debit/Kredit</th>
                                <th>Header</th>
                                <th>Saldo Awal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no =1; 
                            foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value->no_coa?></td>
                                    <td><?= $value->nama_coa?></td>
                                    <td><?= $value->posisi_dr_cr == 'd' ? 'Debit' : 'Kredit' ?></td>
                                    <td><?= $value->header?></td>
                                    <td><?= format_rupiah($value->saldo_awal)?></td>
                                    <td>
                                        <a href="#edit_<?= $value->id?>" data-toggle="modal" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="<?= base_url('Masterdata/delete/'.$value->id.'/'."coa")?>" onclick="return confirm('anda yakin?')" class="btn btn-sm btn-danger">Hapus</a>
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
<?= $this->include('coa/add') ?>
<?= $this->include('coa/edit') ?>
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    $(function() {
        $("#t1").DataTable();
    })
</script>
<?= $this->endSection()?>