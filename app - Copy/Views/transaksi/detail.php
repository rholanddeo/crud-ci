<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container container-fluid mt-5 ">

  <!-- Page Header -->
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col">
        <h1 class="page-header-title">Detail Transaksi</h1>
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

  <?php if (isset($validation)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $validation->listErrors() ?>
    </div>
  <?php } ?>

  <div class="card mb-4">
    <div class="card-body">
      <form action="<?= base_url('transaksi-update-' . $transaksi['id']) ?>" method="POST">
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



  <!-- table detail beli -->
  <div class="card mb-4">
    <!-- Header -->
    <div class="card-header">
      <div class="row justify-content-between align-items-center flex-grow-1-reverse">
        <div class="col-auto">
          <!-- Filter -->
          <form>
            <!-- Search -->
            <div class="input-group input-group-merge input-group-flush">
              <div class="input-group-prepend input-group-text">
                <i class="bi-search"></i>
              </div>
              <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Cari Barang" aria-label="Search users">
            </div>
            <!-- End Search -->
          </form>
          <!-- End Filter -->
        </div>

        <div class="col-auto">
          <div class="d-flex justify-content-between align-items-center">
            <!-- tambah barang -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
              <i class="bi-plus-lg me-2"></i>Tambah Barang
            </button>
            <!-- End Button trigger modal -->

            <!-- Modal -->
            <div id="exampleModalCenter" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <form action="<?= base_url('transaksi-detail-store-' . $transaksi['id']) ?>" method="POST">
                    <!-- csrf -->
                    <?= csrf_field() ?>
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Item Transaksi</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php if (isset($validation)) { ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $validation->listErrors() ?>
                        </div>
                      <?php } ?>



                      <label class="form-label fw-semibold">KODE SUPLIER</label>
                      <!-- Select -->
                      <div class="tom-select-custom">
                        <select class="js-select form-select" name="kodebrg" autocomplete="off" data-hs-tom-select-options='{
            "searchInDropdown": false,
            "hidePlaceholderOnSearch": true,
            "placeholder": "Cari barang..."
          }'>
                          <option value="" disabled selected>Pilih Supplier</option>
                          <?php foreach ($barang as $row) : ?>
                            <option value="<?= $row['kodebrg'] ?>">
                              <?= $row['kodebrg'] ?> - <?= $row['namabrg'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <!-- End Select -->
                      <div class="form-grup mb-3">
                        <label class="form-label" for="qty">Qty</label>
                        <input type="number" id="qty" name="qty" class="form-control" placeholder="00">
                      </div>

                      <div class="form-grup mb-3">
                        <label class="form-label" for="diskon">Diskon (%)</label>
                        <input type="number" id="diskon" name="diskon" class="form-control" placeholder="00">
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" onclick="$this.closest('form').submit()">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Modal -->
          </div>

        </div>
      </div>
    </div>
    <!-- End Header -->



    <!-- Table -->
    <div class="table-responsive datatable-custom p-4">
      <table class="js-datatable table table-nowrap table-align-middle card-table" data-hs-datatables-options='{
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
            <th>KODE BARANG</th>
            <th>HARGA BELI</th>
            <th>QTY</th>
            <th>DISKON</th>
            <th>DISKON RP</th>
            <th>TOTAL RP</th>
            <th>AKSI</th>
          </tr>
        </thead>

        <tbody>
          <!-- perulangan detail transaksi -->

          <?php foreach ($detail as $key => $item) : ?>

            <tr>
              <td><?php echo $item['kodebrg'] ?></td>
              <td><?php echo $item['hargabeli'] ?></td>
              <td><?php echo $item['qty'] ?></td>
              <td><?php echo $item['diskon'] ?></td>
              <td><?php echo $item['diskonrp'] ?></td>
              <td><?php echo $item['totalrp'] ?></td>

              <td class="d-flex flew-wrap gap-2">
                <a href="<?php echo base_url('transaksi-detail-delete-' . $item['id']) ?>" class="btn btn-sm btn-danger w-100 w-sm-auto">
                  <i class="bi-trash me-2"></i>DELETE
                </a>
              </td>
            </tr>
          <?php endforeach ?>



        </tbody>
      </table>
    </div>
    <!-- End Table -->

    <div class="card-footer">
      <!-- menampilkan total hutang dan switch ishutang -->
      <div class="row justify-content-center justify-content-sm-between align-items-sm-center">



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

  <?php if (isset($hutang)) : ?>
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <div class="form-check form-switch">
            <form id="statusForm">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="<?= $hutang['id'] ?>">
              <input type="hidden" name="islunas_default" value="<?= $hutang['islunas'] ?>">
              <input type="checkbox" name="islunas" value="Y" class="form-check-input is-valid" id="islunas" <?= $hutang['islunas'] == 'Y' ? 'checked' : '' ?>>
            </form>

          </div>
          <div id="statusContainer" class="d-flex align-items-center">
            <?php if ($hutang['islunas'] == 'Y') : ?>
              <span class="me-2">Total Hutang:</span><span class="text-success"><span class="badge bg-soft-success text-success">Lunas</span></span>
            <?php else : ?>
              <span class="me-2">Total Hutang:</span>
              <span id="totalHutang" class="text-danger">Rp. <?= number_format($hutang['totalhutang'], 0, ',', '.') ?></span>
            <?php endif; ?>
          </div>

          <script>
            const isLunasCheckbox = document.getElementById('islunas');

            isLunasCheckbox.addEventListener('change', function() {
              const form = new FormData(document.getElementById('statusForm'));
              updateStatus(form);
            });

            function updateStatus(formData) {
              fetch('<?= base_url('hutang/islunas') ?>', {
                  method: 'POST',
                  body: formData
                })
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    // Perbarui tampilan status
                    const statusContainer = document.getElementById('statusContainer');
                    if (data.isLunas) {
                      statusContainer.innerHTML = '<span class="me-2">Total Hutang:</span><span class="text-success"><span class="badge bg-soft-success text-success">Lunas</span></span>';
                    } else {
                      statusContainer.innerHTML = '<span class="me-2">Total Hutang:</span><span class="text-danger">Rp. ' + data.totalHutangFormatted + '</span>';
                    }
                  } else {
                    console.error('Gagal memperbarui status.');
                  }
                })
                .catch(error => {
                  console.error('Terjadi kesalahan:', error);
                });
            }
          </script>


        </div>
      </div>
    </div>
  <?php endif; ?>

  <?= $this->endSection('content') ?>