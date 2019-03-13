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

                <!-- Card  -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/daftar_kejadian/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php base_url('admin/daftar_kejadian/edit') ?>" method="post" enctype="multipart/form-data" >

                        <input type="hidden" name="id_daftar_kejadian" value="<?php echo $kejadian->ID_DAFTAR_KEJADIAN?>" />

							<div class="form-group">
                                <label for="nama_kejadian">Nama Kejadian*</label>
                                <input type="text" name="nama_kejadian" placeholder="Nama Kejadian" value="<?php echo $kejadian->NAMA_KEJADIAN ?>" class="form-control <?php echo form_error('nama_kejadian') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('nama_kejadian'); ?>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="poin_kejadian">Poin Kejadian*</label>
                                <input type="text" name="poin_kejadian" placeholder="Poin Kejadian" value="<?php echo $kejadian->POIN_KEJADIAN ?>" class="form-control <?php echo form_error('poin_kejadian') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('poin_kejadian'); ?>
                                </div>
                            </div>

							<div class="form-group">
                                <label for="tipe_kejadian">Tipe Kejadian*</label>
                                <select class="form-control <?php echo form_error('tipe_kejadian') ? 'is-invalid':'' ?>" name="tipe_kejadian" id="tipe_kejadian" >
									<option value = "pelanggaran" <?php if ($kejadian->TIPE_KEJADIAN == 'pelanggaran') echo ' selected="selected"'; ?>>Pelanggaran</option>
									<option value = "reward" <?php if ($kejadian->TIPE_KEJADIAN == 'reward') echo ' selected="selected"'; ?> <?php if ($this->session->userdata('fitur_reward') == 0) echo 'style="display:none"'; ?>>Reward</option>
								</select>
								<div class="invalid-feedback">
                                    <?php echo form_error('tipe_kejadian'); ?>
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

</body>

</html>
