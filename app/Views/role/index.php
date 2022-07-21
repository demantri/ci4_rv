<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4>Role</h4>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah</button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deskripsi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($list as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value->desc ?></td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#edit" 
                                    data-id="<?= $value->id ?>"
                                    data-desc="<?= $value->desc ?>">Edit</button>
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
<?= $this->include('role/add') ?>
<?= $this->include('role/edit') ?>
<?= $this->endSection() ?>
<?= $this->section('script'); ?>
<script>
    $(document).on("click", ".btn-edit", function() {
        var id = $(this).data("id");
        var desc = $(this).data("desc");

        $(".modal-body #id").val(id);
        $(".modal-body #desc").val(desc);
    })
</script>
<?= $this->endSection(); ?>