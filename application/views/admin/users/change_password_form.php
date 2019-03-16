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

				<?php // $this->load->view("admin/_partials/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); unset($_SESSION['success']); ?>
				</div>
				<?php endif; ?>
				<?php if ($this->session->flashdata('failed')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('failed'); unset($_SESSION['failed']); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					
					<div class="card-body">
						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label for="cur_pass">Password Saat Ini *</label>
                                <input type="password" name="cur_pass" placeholder="Password Saat Ini" class="form-control <?php echo form_error('cur_pass') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('cur_pass'); ?>
                                </div>
                            </div>

							<div class="form-group">
								<label for="new_pass">Password Baru *</label>
								<input class="form-control <?php echo form_error('new_pass') ? 'is-invalid':'' ?>"
								 type="password" name="new_pass" placeholder="Password Baru" />
								<div class="invalid-feedback">
									<?php echo form_error('new_pass') ?>
								</div>
                            </div>

                            <div class="form-group">
								<label for="new_pass_c">Konfirmasi Password Baru*</label>
								<input class="form-control <?php echo form_error('new_pass_c') ? 'is-invalid':'' ?>"
								 type="password" name="new_pass_c" placeholder="Konfirmasi Password Baru" />
								<div class="invalid-feedback">
									<?php echo form_error('new_pass_c') ?>
								</div>
                            </div>
                            
							<input class="btn btn-success" type="submit" name="btn" value="Update" />
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
		<?php $this->load->view("admin/_partials/modal"); ?>
		<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>
