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
          <?php // $this->load->view("admin/_partials/breadcrumb"); ?>
          <ol class="breadcrumb alert-success">
              Selamat datang Bapak/Ibu &nbsp;<b><?php echo $this->session->userdata('user_nama'); ?></b> . Anda login dengan sebagai : <?php echo ucwords(str_replace('_', ' ', $this->session->userdata('level'))); ?> 
          </ol>
          <!-- Icon Cards-->

          <div class="card mb-3">
            <div class="card-header">
              Pilih dan Klik Nama Siswa Untuk Menampilkan Kejadian Siswa</div>
            <div class="card-body">
                <?php foreach ($siswa as $sw) { ?>
                <div class="form-group">
                <a href="<?php echo site_url('wali/list_siswa/detail/'.$sw->no_induk) ?>">
                    <div class="col-xl-12 col-sm-12 mb-12">
                        <div class="card text-white bg-primary o-hidden h-100">
                            <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-user-edit"></i>
                            </div>
                            <div class="mr-5"><?php echo $sw->nama_siswa; ?></div>
                            </div>
                            <div class="card-footer text-white clearfix small z-1" >
                            <span class="float-left"><?php echo $sw->no_induk; ?></span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                <?php } ?>
                
            </div>
            
          </div>


          

         
          

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
