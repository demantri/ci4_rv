<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('bukubesar')?>" method="post">
                        <div class="form-group row">
                            <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                            <div class="col-sm-2">
                                <select class="custom-select mr-sm-2" name="bulan">
                                    <option class="text-center" value="" disabled selected>Pilih Bulan</option>
                                    <option class="text-center" value="01">Januari</option>
                                    <option class="text-center" value="02">Februari</option>
                                    <option class="text-center" value="03">Maret</option>
                                    <option class="text-center" value="04">April</option>
                                    <option class="text-center" value="05">Mei</option>
                                    <option class="text-center" value="06">Juni</option>
                                    <option class="text-center" value="07">Juli</option>
                                    <option class="text-center" value="08">Agustus</option>
                                    <option class="text-center" value="09">September</option>
                                    <option class="text-center" value="10">Oktober</option>
                                    <option class="text-center" value="11">November</option>
                                    <option class="text-center" value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="custom-select mr-sm-2" name="tahun" required>
                                    <option class="text-center" value="">Pilih Tahun</option>
                                    <?php for ($i=2020; $i <= 2025 ; $i++) { 
                                        echo '<option class="text-center" value="'.$i.'">'.$i.'</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="coa" class="col-sm-2 col-form-label">Nama CoA</label>
                            <div class="col-sm-4">
                                <select class="custom-select mr-sm-2" name="coa">
                                    <option class="text-center" value="">Pilih COA</option>
                                    <?php foreach ($coa as $key => $value) {
                                        echo '<option class="text-center" value="'.$value->no_coa.'">'.$value->nama_coa.'</option>';
                                    }?>
                                </select>
                            </div>
                        </div>
                        
                        <hr>
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        <h4>Buku Besar</h4>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="t1">
                        <thead>
                            <tr>
                                <th rowspan="2">Tanggal</th>
                                <th rowspan="2">Nama Akun</th>
                                <th rowspan="2">Reff</th>
                                <th rowspan="2" class="text-center">Debet</th>
                                <th rowspan="2" class="text-center">Kredit</th>
                                <th rowspan="2" class="text-center">Saldo </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0000-00-00</td>
                                <td>Saldo Awal</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><?= 'Rp ' . number_format($saldo_awal) ?></td>
                            </tr>
                            <?php foreach ($list as $item) { ?>
                                <tr>
                                    <td><?= $item->tgl_jurnal ?></td>
                                    <td><?= $item->nama_coa ?></td>
                                    <td><?= $item->no_coa ?></td>
                                    <?php if ($item->posisi_dr_cr =='d') { ?>
                                        <?php if ($item->header == 1 OR $item->header == 5 OR $item->header == 6 ) { ?>
                                            <?php $saldo_awal = $saldo_awal + $item->nominal; ?>
                                        <?php } else { ?>
                                            <?php $saldo_awal = $saldo_awal - $item->nominal; ?>
                                        <?php } ?>
                                        <td class="text-right"><?= 'Rp ' . number_format($item->nominal)?></td>
                                        <td></td>
                                    <?php } else { ?>
                                        <?php if ($item->header == 1 OR $item->header == 5 OR $item->header == 6 ) { ?>
                                            <?php $saldo_awal = $saldo_awal - $item->nominal; ?>
                                        <?php } else { ?>
                                            <?php $saldo_awal = $saldo_awal + $item->nominal; ?>
                                    <?php } ?>
                                    <td></td>
                                    <td class="text-right"><?= 'Rp ' . number_format($item->nominal)?></td>
                                    <?php }?>
                                    <td class="text-right"><?= 'Rp ' . number_format($saldo_awal)?></td>
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
<?= $this->endSection() ?>
<?= $this->Section('script')?>
<script>
    $(function() {
        $("#tgl_awal").datepicker({
            dateFormat: 'yy/mm/dd',
            onSelect: function(selected) {
            $("#tgl_akhir").datepicker("option","minDate", selected)
            }
        });
        $("#tgl_akhir").datepicker({ 
            dateFormat: 'yy/mm/dd',
            onSelect: function(selected) {
            $("#tgl_awal").datepicker("option","maxDate", selected)
            }
        });
    })
</script>
<?= $this->endSection()?>