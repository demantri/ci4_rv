<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="notif" style="width: 50%;">
        <?php if (session()->getFlashdata('msg')) : ?>
          <div class="alert alert-info" role="alert"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
    </div>
    <div class="img text-center">
        <h3 style="margin-bottom: 20px;">Aplikasi Manajemen Produksi</h3>
        <img src="<?= base_url('assets/home.svg') ?>" alt="" style="width:50%">
    </div>
</div>
<?= $this->endSection() ?>