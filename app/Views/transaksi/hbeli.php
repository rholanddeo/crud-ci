<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container container-fluid mt-5">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title"><?= isset($transaksi) ? 'Edit Data' : 'Tambah Transaksi Baru'; ?></h1>
            </div>
            <!-- End Col -->

            <div class="col-auto">
                <a class="btn btn-outline-primary" href="<?php echo base_url('transaksi') ?>">
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
            <form action="<?= isset($transaksi) ? base_url('transaksi-update-' . $transaksi['id']) : base_url('transaksi-store'); ?>" method="POST">
                <!-- csrf -->
                <?= csrf_field() ?>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">KODE SUPLIER</label>
                    <!-- Select -->
                    <div class="tom-select-custom">
                        <select class="js-select form-select" name="kodespl" autocomplete="off" data-hs-tom-select-options='{
            "searchInDropdown": false,
            "hidePlaceholderOnSearch": true,
            "placeholder": "Cari Suplier..."
          }'>
                            <option value="" disabled selected>Pilih Supplier</option>
                            <?php foreach ($suplier as $row) : ?>
                                <option value="<?= $row['kodespl'] ?>" <?php if (isset($transaksi) && $transaksi['kodespl'] == $row['kodespl']) echo 'selected'; ?>>
                                    <?= $row['kodespl'] ?> - <?= $row['namaspl'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- End Select -->
                </div>

                <!-- Form Group -->
                <div class="form-group mb-3">
                    <label for="projectDeadlineFlatpickrNewProjectLabel" class="form-label fw-bold ">TANGGAL BELI</label>

                    <div id="projectDeadlineNewProjectFlatpickr" class="js-flatpickr flatpickr-custom input-group" data-hs-flatpickr-options='{
        "appendTo": "#projectDeadlineNewProjectFlatpickr",
        "dateFormat": "d-m-Y",
        "wrap": true
      }'>
                        <div class="input-group-prepend input-group-text" data-bs-toggle>
                            <i class="bi-calendar-week"></i>
                        </div>

                        <input type="text" name="tglbeli" class="flatpickr-custom-form-control form-control" id="projectDeadlineFlatpickrNewProjectLabel" placeholder="Select dates" data-input value="<?= isset($transaksi['tglbeli']) ? date('d-m-Y', strtotime($transaksi['tglbeli'])) : "" ?>">

                    </div>
                </div>



                <button type="submit" class="btn btn-primary float-end">SIMPAN</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>