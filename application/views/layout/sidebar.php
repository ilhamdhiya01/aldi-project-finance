<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link d-flex justify-content-center">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-bold">Finance Management</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('name'); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <!-- <li class="nav-item menu-open"> -->
        <li class="nav-item">
          <a href="<?= base_url()?>/dashboard" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <li class="nav-header">FINANCE</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-money-check"></i>
            <p>
              Keuangan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('cashin')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemasukan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('cashout')?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengeluaran</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('utang')?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
              Pencatatan Utang
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('piutang')?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
              Pencatatan Piutang
            </p>
          </a>
        </li>
        <li class="nav-header">MASTER</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              Master Data
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('vendorManagement') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Management Vendor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('vehicleManagement') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Management Kendaraan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">SETTINGS</li>
        <li class="nav-item">
          <a href="<?= base_url('userconfiguration')?>" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>
              Konfigurasi User
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('logout')?>" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Log Out
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>