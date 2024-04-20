<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container container-fluid mt-5">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title"><?= isset($barang) ? 'Edit Data' : 'Tambah Data'; ?></h1>
            </div>
            <!-- End Col -->

            <div class="col-auto">
                <a class="btn btn-outline-primary" href="<?php echo base_url('barang') ?>">
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
            <form action="<?= isset($barang) ? base_url('barang-update-' . $barang['id']) : base_url('barang-store'); ?>" method="POST">
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">KODE BARANG</label>
                    <input type="text" class="form-control" name="kodebrg" value="<?= isset($barang) ? $barang['kodebrg'] : ''; ?>" placeholder="Masukkan Kode">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">NAMA BARANG</label>
                    <input class="form-control" name="namabrg" value="<?= isset($barang) ? $barang['namabrg'] : ''; ?>" placeholder="Masukkan Nama">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">SATUAN</label>
                    <input class="form-control" name="satuan" value="<?= isset($barang) ? $barang['satuan'] : ''; ?>" placeholder="Satuan Barang">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">HARGA BELI</label>
                    <input class="form-control" name="hargabeli" value="<?= isset($barang) ? $barang['hargabeli'] : ''; ?>" placeholder="Masukkan Harga Beli">
                </div>
                <button type="submit" class="btn btn-primary float-end">SIMPAN</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>