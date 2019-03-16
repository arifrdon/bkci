<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					
					<div class="card-body">

						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label for="dtpstart">Mulai Dari Tanggal *</label>
                                <input type="text" value="<?php if(isset($dtpstart_b) && !empty($dtpstart_b)) { echo $dtpstart_b; }?>" id="dtpstart" name="dtpstart" placeholder="Tanggal Mulai" class="form-control <?php echo form_error('dtpstart') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('dtpstart'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dtpend">Sampai Dengan Tanggal *</label>
                                <input type="text" value="<?php if(isset($dtpend_b) && !empty($dtpend_b)) { echo $dtpend_b; }?>" id="dtpend" name="dtpend" placeholder="Tanggal Akhir" class="form-control <?php echo form_error('dtpend') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('dtpend'); ?>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="id_kelas">Kelas *</label>
                                <select placeholder="Pilih Kelas" class="form-control <?php echo form_error('id_kelas') ? 'is-invalid':'' ?>" name="id_kelas" id="id_kelas" >
                                    <option 
                                    <?php if(isset($id_kelas_b) && !empty($id_kelas_b)) { 
                                        if($id_kelas_b == "semua"){
                                            echo "selected";
                                        }
                                    } ?> 
                                    value = "semua">Semua Kelas</option>
                                    <?php foreach($kelas as $kl){ ?>
                                        <option 
                                        <?php if(isset($id_kelas_b) && !empty($id_kelas_b)) { 
                                        if($id_kelas_b == $kl->id_kelas){
                                            echo "selected";
                                        }
                                        } ?> 
                                        value = "<?php echo $kl->id_kelas; ?>"><?php echo $kl->nama_kelas; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('id_kelas'); ?>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="tipe_kejadian">Tipe *</label>
                                <select placeholder="Pilih Tipe Kejadian" class="form-control <?php echo form_error('tipe_kejadian') ? 'is-invalid':'' ?>" name="tipe_kejadian" id="tipe_kejadian" >
                                    <?php if($this->session->userdata('fitur_reward') == 1){ ?>
                                        <option 
                                        <?php if(isset($tipe_kejadian_b) && !empty($tipe_kejadian_b)) { 
                                            if($tipe_kejadian_b == "semua"){
                                                echo "selected";
                                            }
                                        } ?> 
                                        value = "semua">Pelanggaran dan Reward</option>
                                        <option 
                                        <?php if(isset($tipe_kejadian_b) && !empty($tipe_kejadian_b)) { 
                                            if($tipe_kejadian_b == "reward"){
                                                echo "selected";
                                            }
                                        } ?> 
                                        value = "reward">Reward</option>
                                    <?php } ?>
                                    <option 
                                    <?php if(isset($tipe_kejadian_b) && !empty($tipe_kejadian_b)) { 
                                        if($tipe_kejadian_b == "pelanggaran"){
                                            echo "selected";
                                        }
                                    } ?> 
                                    value = "pelanggaran">Pelanggaran</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('tipe_kejadian'); ?>
                                </div>
                            </div>
							
							<input class="btn btn-success" type="submit" name="btn" value="Submit" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>

				</div>
				<!-- /.container-fluid -->
                
                <hr>
                <?php if(isset($laporan) && !empty($laporan)) { ?>                       
                <div class="card mb-3">
					
					<div class="card-body">
                    
							<div class="form-group">
                            <p style="text-align: right">
				                <a href="<?php echo site_url('admin/kejadian_siswa/printexcel?dtpstart='.$dtpstart_b.'&dtpend='.$dtpend_b.'&id_kelas='.$id_kelas_b.'&tipe_kejadian='.$tipe_kejadian_b) ?>" target="_blank"><button type="button" class="btn btn-success"><i class="fa fa-download"></i> Excel</button></i> </a>
			                </p>
                            <table border='1' width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center"> No</th>
                                    <th class="text-center"> No Induk</th>
                                    <th  class="text-center"> Nama</th>
                                    <th  class="text-center"> Nama Kejadian</th>
                                    <th  class="text-center"> Poin</th>
                                    <th class="text-center"> Tanggal Kejadian</th>
                                    <th class="text-center"> Kelas</th>
                                    <th class="text-center"> Tipe Kejadian</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach($laporan as $lap){
                                ?>
                                <tr class="">
                                    <td><?php  echo $i ?></td>
                                    <td><?php  echo $lap->NO_INDUK ?></td>
                                    <td><?php  echo $lap->nama_siswa ?></td>
                                    <td><?php  echo $lap->NAMA_KEJADIAN ?></td>
                                    <td><?php  echo $lap->POIN_KEJADIAN ?></td>
                                    <td><?php  echo $lap->TANGGAL_KEJADIAN ?></td>
                                    <td><?php  echo $lap->nama_kelas ?></td>
                                    <td><?php  echo $lap->TIPE_KEJADIAN ?></td>

                                </tr>
                                
                                <?php 
                                $i++; 
                                } 
                                ?>
                                </tbody>
                            </table>
                            </div>

					</div>

					

				</div>
				<!-- /.container-fluid -->
                <?php } ?>
				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<?php $this->load->view("admin/_partials/scrolltop.php") ?>
        <?php $this->load->view("admin/_partials/modal"); ?>                        
		<?php $this->load->view("admin/_partials/js.php") ?>
        <?php 
        if(isset($dtpstart_b) && !empty($dtpstart_b) && isset($dtpend_b) && !empty($dtpend_b)) { 
            $dtpstartjs = strtotime($dtpstart_b);
            $dtpendjs = strtotime($dtpend_b);
        }
        ?>
		<script>
		$(document).ready(function(){
            $( "#dtpstart" ).datepicker();
            $( "#dtpstart" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            <?php if(isset($dtpstart_b) && !empty($dtpstart_b)) {?>
                $('#dtpstart').datepicker("setDate", new Date(<?php echo date('Y', $dtpstartjs); ?>,<?php echo date('m', $dtpstartjs); ?>-1,<?php echo date('d', $dtpstartjs); ?>) );
            <?php } ?>

            $( "#dtpend" ).datepicker();
            $( "#dtpend" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
            <?php if(isset($dtpendjs) && !empty($dtpendjs)) {?>
                $('#dtpend').datepicker("setDate", new Date(<?php echo date('Y', $dtpendjs); ?>,<?php echo date('m', $dtpendjs); ?>-1,<?php echo date('d', $dtpendjs); ?>) );
            <?php } ?>

        });
		</script>
		

</body>

</html>
