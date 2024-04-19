<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container container-fluid mt-5 ">

  <!-- Page Header -->
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col">
        <h1 class="page-header-title">Data Transaksi</h1>
      </div>
      <!-- End Col -->

      <div class="col-auto">
        <a class="btn btn-primary" href="<?php echo base_url('transaksi-create') ?>">
          <i class="bi-plus-lg me-1"></i> Tambah Transaksi
        </a>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
  <!-- End Page Header -->


  <?php if (!empty(session()->getFlashdata('message'))) : ?>



    <!-- Toast -->


    <div id="toast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position:fixed; top: 20px; right: 20px; z-index: 1000;">
      <div class="d-flex">
        <div class="toast-body">
          <?php echo session()->getFlashdata('message'); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>

    <script>
      // Ambil elemen toast menggunakan id
      var toast = document.getElementById('toast');

      // Setelah 3 detik, tutup toast
      setTimeout(function() {
        toast.classList.remove('show');
        toast.classList.add('hide');
      }, 5000);
    </script>

    <!-- End Toast -->

  <?php endif ?>

  <div class="table-responsive">

    <table class="table">
      <thead class="thead-light">
        <tr>
          <th>KODE TRANSAKSI</th>
          <th>KODE SUPLIER</th>
          <th>TANGGAL BELI</th>
          <th>AKSI</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($transaksi as $key => $item) : ?>
  
          <tr>
            <td><?php echo $item['notransaksi'] ?></td>
            <td><?php echo $item['kodespl'] ?></td>
            <td><?php echo $item['tglbeli'] ?></td>
            <td class="d-flex flex-wrap gap-2">
              <a href="<?php echo base_url('transaksi-edit-' . $item['id']) ?>" class="btn btn-sm btn-warning w-100 w-sm-auto">
                <i class="bi-pencil mr-1"></i> EDIT
            </a>
              <a href="<?php echo base_url('transaksi/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger w-100 w-sm-auto">
                <i class="bi-trash mr-1"></i> DELETE
            </a>
            </td>
          </tr>
  
        <?php endforeach ?>
      </tbody>
    </table>
  </div>



</div>

<?= $this->endSection() ?>