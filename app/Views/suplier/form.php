<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container container-fluid mt-5">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title"><?= isset($suplier) ? 'Edit Data' : 'Tambah Data'; ?></h1>
            </div>
            <!-- End Col -->

            <div class="col-auto">
                <a class="btn btn-outline-primary" href="<?php echo base_url('suplier') ?>">
                    <i class="bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Page Header -->
    <?php if (isset($validation)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $validation->listErrors() ?>
        </div>
    <?php } ?>
    <div class="card">
        <div class="card-body">
            <form action="<?= isset($suplier) ? base_url('suplier/update/' . $suplier['id']) : base_url('suplier/store'); ?>" method="POST">
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">KODE SUPLIER</label>
                    <input type="text" class="form-control" name="kodespl" value="<?= isset($suplier) ? $suplier['kodespl'] : ''; ?>" placeholder="Masukkan Kode">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">NAMA SUPLIER</label>
                    <input class="form-control" name="namaspl" value="<?= isset($suplier) ? $suplier['namaspl'] : ''; ?>" placeholder="Masukkan Nama">
                </div>
                <button type="submit" class="btn btn-primary float-end">SIMPAN</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>