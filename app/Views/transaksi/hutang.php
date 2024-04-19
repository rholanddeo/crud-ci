<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container container-fluid mt-5 ">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Data Hutang</h1>
            </div>
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

    <div class="card">
    <!-- Header -->
    <div class="card-header">
      <div class="row justify-content-between align-items-center flex-grow-1-reverse">
        <div class="col-12 col-md">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header-title">Transaksi</h5>
          </div>
        </div>
        <div class="col-auto">
          <!-- Filter -->
          <form>
            <!-- Search -->
            <div class="input-group input-group-merge input-group-flush">
              <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
              </div>
              <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Cari transaksi..." aria-label="Search users">
            </div>
            <!-- End Search -->
          </form>
          <!-- End Filter -->
        </div>


      </div>
    </div>
    <!-- End Header -->

    <!-- Table -->
    <div class="table-responsive datatable-custom">
      <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "order": [],
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "entries": "#datatableEntries",
                   "search": "#datatableWithSearchInput",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableEntriesPagination"
                 }'>
        <thead class="thead-light">
          <tr>
            <th>NOMOR TRANSAKSI</th>
            <th>KODE SUPLIER</th>
            <th>TANGGAL BELI</th>
            <th>TOTAL HUTANG</th>
            <th>AKSI</th>
          </tr>
        </thead>

        <tbody>
          <!-- perulangan data barang -->

          <?php foreach ($hutang as $key => $item) : ?>

            <tr>
              <td><?php echo $item['notransaksi'] ?></td>
              <td><?php echo $item['kodespl'] ?></td>
              <td><?php echo $item['tglbeli'] ?></td>
                <td><?php echo $item['totalhutang'] ?></td>
              <td class="d-flex flew-wrap gap-2">

<?php
?>
                <a href="<?php echo base_url('transaksi-detail-' . $item['id_headerbeli']) ?>" class="btn btn-sm btn-success w-100 w-sm-auto">
                  <i class="bi-eye me-2"></i>DETAIL
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <!-- End Table -->

    <div class="card-footer">
      <!-- Pagination -->
      <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
        <div class="col-sm mb-2 mb-sm-0">
          <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
            <span class="me-2">Showing:</span>

            <!-- Select -->
            <div class="tom-select-custom">
              <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                "searchInDropdown": false,
                "hideSearch": true
              }'>
                <option value="4">4</option>
                <option value="6">6</option>
                <option value="8" selected>8</option>
                <option value="12">12</option>
              </select>
            </div>
            <!-- End Select -->

            <span class="text-secondary me-2">of</span>

            <!-- Pagination Quantity -->
            <span id="datatableEntriesInfoTotalQty"></span>
          </div>
        </div>

       



        <div class="col-sm-auto">
          <div class="d-flex justify-content-center justify-content-sm-end">
            <!-- Pagination -->
            <nav id="datatableEntriesPagination" aria-label="Activity pagination"></nav>
          </div>
        </div>
      </div>
      <!-- End Pagination -->
    </div>
    <!-- End Footer -->
  </div>



</div>

<?= $this->endSection() ?>