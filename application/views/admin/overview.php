<!DOCTYPE html>
<html lang="en">

  <head>

   <?php $this->load->view("admin/_partials/head"); ?>

  </head>

  <body id="page-top">

    <?php $this->load->view("admin/_partials/navbar"); ?>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php $this->load->view("admin/_partials/sidebar"); ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <?php $this->load->view("admin/_partials/breadcrumb"); ?>
          <ol class="breadcrumb alert-success">
              Selamat datang Bapak/Ibu &nbsp;<b><?php echo $this->session->userdata('user_nama'); ?></b> . Anda login dengan sebagai : <?php echo ucwords(str_replace('_', ' ', $this->session->userdata('level'))); ?> 
          </ol>
          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5"><?php echo $kejadianskcount; ?> Kejadian Sekolah</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/daftar_kejadian') ?>">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5"><?php echo $kejadianswcount; ?> Kejadian Dilakukan Oleh Siswa!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/kejadian_siswa') ?>">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>
                  </div>
                  <div class="mr-5"><?php echo $interaksiortucount; ?> Interaksi Orang Tua</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo site_url('admin/kejadian_siswa') ?>">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            
          </div>

          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Area Chart Example</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          
          <div id="container">aaaaaaaaaa</div>
          <script type="text/javascript"><?php echo $chart->printScripts(); ?></script>
          

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php $this->load->view("admin/_partials/footer"); ?>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <?php $this->load->view("admin/_partials/scrolltop"); ?>

    <!-- Logout Modal-->
    <?php $this->load->view("admin/_partials/modal"); ?>
    <?php $this->load->view("admin/_partials/js"); ?>
    
    
  </body>

</html>
