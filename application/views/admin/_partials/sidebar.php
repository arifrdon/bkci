
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
          <a class="nav-link" href="<?php echo $this->session->level == 'orang_tua' ? site_url('wali') : site_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <!-- <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Products</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/products/add') ?>">New Product</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">List Product</a>
          </div>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengaturan Tampilan</span></a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Master</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/siswa') ?>">Data Siswa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/guru') ?>">Data Guru</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/wali_kelas') ?>">Data Wali Kelas</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/kelas') ?>">Data Kelas</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/tahun_ajaran') ?>">Data Tahun Ajaran</a>
          </div>
        </li>
        
        
        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'daftar_kejadian' ? 'active show': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="<?php echo $this->uri->segment(2) == 'daftar_kejadian' ? 'true': 'false' ?>">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kejadian Sekolah</span>
          </a>
          <div class="dropdown-menu <?php echo $this->uri->segment(2) == 'daftar_kejadian' ? 'show': '' ?>" aria-labelledby="pagesDropdown">
            <a class="dropdown-item <?php echo ($this->uri->segment(2) == 'daftar_kejadian' && $this->uri->segment(3) == 'add') ? 'active': '' ?>" href="<?php echo site_url('admin/daftar_kejadian/add') ?>">Tambah Kejadian Sekolah</a>
            <a class="dropdown-item <?php echo ($this->uri->segment(2) == 'daftar_kejadian' && $this->uri->segment(3) == null) ? 'active': '' ?>" href="<?php echo site_url('admin/daftar_kejadian') ?>">List Kejadian Sekolah</a>
          </div>
        </li>

        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kejadian_siswa' ? 'active show': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="<?php echo $this->uri->segment(2) == 'kejadian_siswa' ? 'true': 'false' ?>">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kejadian Siswa</span>
          </a>
          <div class="dropdown-menu <?php echo $this->uri->segment(2) == 'kejadian_siswa' ? 'show': '' ?>" aria-labelledby="pagesDropdown">
            <a class="dropdown-item <?php echo ($this->uri->segment(2) == 'kejadian_siswa' && $this->uri->segment(3) == 'add') ? 'active': '' ?>" href="<?php echo site_url('admin/kejadian_siswa/add') ?>">Tambah Kejadian Siswa</a>
            <a class="dropdown-item <?php echo ($this->uri->segment(2) == 'kejadian_siswa' && $this->uri->segment(3) == null) ? 'active': '' ?>" href="<?php echo site_url('admin/kejadian_siswa') ?>" href="<?php echo site_url('admin/kejadian_siswa') ?>">List Kejadian Siswa</a>
            <a class="dropdown-item <?php echo ($this->uri->segment(2) == 'kejadian_siswa' && $this->uri->segment(3) == 'score_list') ? 'active': '' ?>" href="<?php echo site_url('admin/kejadian_siswa/score_list') ?>">Skor Kejadian Siswa</a>
            <a class="dropdown-item <?php echo ($this->uri->segment(2) == 'kejadian_siswa' && $this->uri->segment(3) == 'laporan_bk') ? 'active': '' ?>" href="<?php echo site_url('admin/kejadian_siswa/laporan_bk') ?>">Laporan Kejadian Siswa</a>
          </div>
        </li>
        <li class="nav-item <?php echo $this->uri->segment(2) == 'pengaturan_bk' ? 'active': '' ?>">
          <a class="nav-link" href="<?php echo site_url('admin/pengaturan_bk/edit') ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan BK</span></a>
        </li>
      </ul>

      