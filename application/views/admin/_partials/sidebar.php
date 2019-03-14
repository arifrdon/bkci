
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
          <a class="nav-link" href="<?php echo site_url('admin') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Products</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/products/add') ?>">New Product</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">List Product</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Siswa</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Guru</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Pengaturan Tampilan</span></a>
        </li>
        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kelas' ? 'active': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kelas Siswa</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/products/add') ?>">Data Wali Kelas</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Data Kelas</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Data Tahun Ajaran</a>
          </div>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Data User</span></a>
        </li>
        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kelas' ? 'active': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Bim. Konseling</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/products/add') ?>">Data Kejadian Sekolah</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Data Kejadian Siswa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Skor Siswa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Pengaturan BK</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/products') ?>">Laporan Kejadian</a>
          </div>
        </li>
        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kelas' ? 'active': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kejadian Sekolah</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/daftar_kejadian/add') ?>">Tambah Kejadian Sekolah</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/daftar_kejadian') ?>">List Kejadian Sekolah</a>
          </div>
        </li>

        <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'kelas' ? 'active': '' ?>">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kejadian Siswa</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/kejadian_siswa/add') ?>">Tambah Kejadian Siswa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/kejadian_siswa') ?>">List Kejadian Siswa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/kejadian_siswa/score_list') ?>">Skor Kejadian Siswa</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/kejadian_siswa/laporan_bk') ?>">Laporan Kejadian Siswa</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('admin/pengaturan_bk/edit') ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan BK</span></a>
        </li>
      </ul>

      