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
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					
					<div class="card-body">

						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label for="user_name">Password Saat Ini *</label>
                                <input type="text" name="user_name" placeholder="User Name" class="form-control <?php echo form_error('user_name') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('user_name'); ?>
                                </div>
                            </div>

							<div class="form-group">
								<label for="user_password">Password Baru *</label>
								<input class="form-control <?php echo form_error('user_password') ? 'is-invalid':'' ?>"
								 type="text" name="user_password" placeholder="Password" />
								<div class="invalid-feedback">
									<?php echo form_error('user_password') ?>
								</div>
                            </div>

                            <div class="form-group">
								<label for="user_password">Konfirmasi Password Baru*</label>
								<input class="form-control <?php echo form_error('user_password') ? 'is-invalid':'' ?>"
								 type="text" name="user_password" placeholder="Password" />
								<div class="invalid-feedback">
									<?php echo form_error('user_password') ?>
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
