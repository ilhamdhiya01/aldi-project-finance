<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Konfigurasi User</h1>
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
                <div class="d-flex justify-content-end mb-3">
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddUser">Tambah User</button>
                </div>
                <div id="listUser">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php require('components/formAddUser.php'); ?>
<?php require('components/formUpdateUser.php'); ?>
<?php require('js/userConfiguration.php'); ?>