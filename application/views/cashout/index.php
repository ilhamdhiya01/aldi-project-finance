<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Pengeluaran</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body p-0">
              <div class="table-responsive p-3">
                <div class="d-flex justify-content-between mb-3">
                  <h2 id="total-pengeluaran"></h2>
                  <button class="btn btn-primary btn-sm <?= $this->session->userdata('roleUser') == 'Admin' ? 'd-none' : '' ?>" onclick="generateReferenceNumber()" data-toggle="modal" data-target="#modalAddCashOut">Tambah Pengeluaran</button>
                </div>
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Informasi</th>
                      <th>Tanggal Pencatatan</th>
                      <th>Pengeluaran</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="listCashOut">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php require('modals/formAddCashOut.php'); ?>
<?php require('modals/formUpdateCashOut.php'); ?>
<?php require('js/cashout.php'); ?>