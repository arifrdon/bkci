
<nav class="navbar navbar-expand navbar-dark bg-success static-top">

      <a class="navbar-brand mr-1" href="<?php echo site_url('admin'); ?>"><?php echo SITE_NAME; ?></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <!--
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
        -->
      </form>
      
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle dropdown-toggle-bell" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="badge badge-danger count"></span>
          </a>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle dropdown-toggle-clicker" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-notif dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Actionbbbbbb</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><strong>Guru: Akuad asdw</strong><br><small><strong>Mengomentari kejadian abdul rohman</strong></small><br><small><strong><u>Tidur Di Kelas</u></strong></small><br><small>16-09-000 29:22</small></a><div class="dropdown-divider"></div>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <?php if($this->session->userdata('level') == "guru_bk" || $this->session->userdata('level') == "admin"){ ?>
            <a class="dropdown-item" href="<?php echo site_url('admin/pengaturan_bk/edit') ?>">Setting</a>
          <?php } ?>
            <a class="dropdown-item" href="<?php echo site_url('admin/users/change_password') ?>">Ubah Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo site_url('admin/logout') ?>" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
    </nav>