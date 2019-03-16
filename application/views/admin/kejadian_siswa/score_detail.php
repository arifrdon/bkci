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

				

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/kejadian_siswa/score_list') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label >Detail Siswa</label>
                                
                            </div>
                            <div class="form-group">
                                <label>No Induk: <?php echo $siswa->no_induk; ?></label><br>
                                <label>Nama: <?php echo $siswa->nama_siswa; ?></label><br>
                            </div>

							<hr>
                            <div class="form-group">
                            <?php 
                                //foreach($forum_kejadian as $fk){
                            ?>
                                <table class="table-bordered table">
                                <thead>
                                <tr bgcolor="#CCCCCC">
                                	<th>Nama Kejadian</th>
                                    <th>Tanggal</th>
                                    <th>Tipe Kejadian</th>
                                    <th>Poin</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($score_det as $sd){ ?>
                                <tr>
                                
                                	<th><?php echo $sd->NAMA_KEJADIAN; ?></th>
                                    <th><?php echo $sd->TANGGAL_KEJADIAN; ?></th>
                                    <th><?php echo $sd->TIPE_KEJADIAN; ?></th>
                                    <th><?php echo $sd->POIN_KEJADIAN; ?></th>
                               
                                </tr>
                                <?php } ?>
                                </tbody>
                                <!-- <tfoot>
                                <tr bgcolor="#CCCCCC">
                                	<th>Nama Kejadian</th>
                                    <th>Tanggal</th>
                                    <th>Tipe Kejadian</th>
                                    <th>Poin</th>
                                </tr>
                                </tfoot> -->
                                </table>
                                <br>
                            <?php
                                //}
                            ?>
                            </div>
                            <hr>
                            
						</form>

					</div>

					<div class="card-footer large ">
						<strong>Skor Akhir: <?php echo $na; ?></strong>
					</div>

				</div>
				<!-- /.container-fluid -->

				<!-- Sticky Footer -->
				<?php $this->load->view("admin/_partials/footer.php") ?>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<?php $this->load->view("admin/_partials/scrolltop.php") ?>
		<?php $this->load->view("admin/_partials/modal"); ?>							
		<?php $this->load->view("admin/_partials/js.php") ?>

		<script>
		$(document).ready(function(){
			$( "#datepicker" ).datepicker();
			$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
			$('#datepicker').datepicker("setDate", new Date(<?php echo date('Y'); ?>,<?php echo date('m'); ?>-1,<?php echo date('d'); ?>) );

    		$('#no_induk').select2();
			$('#id_daftar_kejadian').select2();

		});
		</script>
		<script type="text/javascript">
			$('.clockpicker').clockpicker()
			.find('input').change(function(){
				console.log(this.value);
			});
			var input = $('#single-input').clockpicker({
			placement: 'bottom',
			align: 'left',
			autoclose: true,
			default: 'now'
		});
		</script>

</body>

</html>
