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
					<div class="card-header">
						<a href="<?php echo site_url('admin/kejadian_siswa/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label for="no_induk">Nama Siswa / NIS*</label>
                                <select placeholder="Pilih Siswa" class="form-control <?php echo form_error('no_induk') ? 'is-invalid':'' ?>" name="no_induk" id="no_induk" >
                                    <?php foreach($siswa as $sw){ ?>
                                        <option value = "<?php echo $sw->no_induk; ?>"><?php echo $sw->nama_siswa; ?></option>
                                    <?php } ?>
								</select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('no_induk'); ?>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="id_daftar_kejadian">Nama Kejadian*</label>
                                <select placeholder="Pilih Kejadian" class="form-control <?php echo form_error('id_daftar_kejadian') ? 'is-invalid':'' ?>" name="id_daftar_kejadian" id="id_daftar_kejadian" >
                                    <?php foreach($daftar_kejadian as $dk){ ?>
                                        <option value = "<?php echo $dk->ID_DAFTAR_KEJADIAN; ?>"><?php echo $dk->NAMA_KEJADIAN; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('id_daftar_kejadian'); ?>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="tanggalkejadian">Tanggal Kejadian*</label>
                                <input type="text" id="datepicker" name="tanggalkejadian" placeholder="Tanggal" class="form-control <?php echo form_error('tanggalkejadian') ? 'is-invalid':'' ?>">
                                <input type="text" id="single-input" name="jam" placeholder="Waktu" class="form-control <?php echo form_error('jam') ? 'is-invalid':'' ?>">
								<div class="invalid-feedback">
                                    <?php echo form_error('tanggalkejadian'); ?>
                                    <?php echo form_error('jam'); ?>
                                </div>
                            </div>
							
							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>

					</div>

					<div class="card-footer small text-muted">
						* required fields
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
