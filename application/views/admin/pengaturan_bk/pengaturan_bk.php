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

				<?php if ($this->session->flashdata('update_fail')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('update_fail'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('update_success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('update_success'); ?>
                    </div>
                <?php endif; ?>

				<div class="card mb-3">
					
					<div class="card-body">
						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label for="poin_awal">Poin Awal Siswa*</label>
                                <input type="text" value="<?php echo $poin_awal->NILAI_PENGATURAN; ?>" id="poin_awal" name="poin_awal" placeholder="Poin Awal" class="form-control <?php echo form_error('poin_awal') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('poin_awal'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fitur_reward">Fitur Reward*</label>
                                <select placeholder="Pilih Siswa" class="form-control <?php echo form_error('fitur_reward') ? 'is-invalid':'' ?>" name="fitur_reward" id="fitur_reward" >
                                        <option <?php if($fitur_reward->STATUS_PENGATURAN == "1"){echo "selected";} ?> value = "1">Ada</option>
                                        <option <?php if($fitur_reward->STATUS_PENGATURAN == "0"){echo "selected";} ?> value = "0">Tidak Ada</option>
								</select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('fitur_reward'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="operator_bk">Jika Terjadi Pelanggaran, Maka*</label>
                                <select placeholder="Pilih Operator BK" class="form-control <?php echo form_error('operator_bk') ? 'is-invalid':'' ?>" name="operator_bk" id="operator_bk" >
                                        <option <?php if($operator_bk->NILAI_PENGATURAN == "kurang"){echo "selected";} ?> value = "kurang">Poin Dikurangi</option>
                                        <option <?php if($operator_bk->NILAI_PENGATURAN == "tambah"){echo "selected";} ?> value = "tambah">Poin Ditambah</option>
								</select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('operator_bk'); ?>
                                </div>
                            </div>
                            <br>
                            <hr >
                            <br>
                            <label>Label Surat</label> <span style="float: right;"> <a data-toggle="modal"  href="#myModalpetunjuk" class="btn btn-primary  btn-xs">Petunjuk</a> </span>
							<div class="form-group">
                                <label for="tekskop1">Teks Kop Surat 1*</label>
                                <input type="text" value="<?php echo $tekskop1->NILAI_PENGATURAN; ?>" id="tekskop1" name="tekskop1" placeholder="Teks Kop 1" class="form-control <?php echo form_error('tekskop1') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('tekskop1'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tekskop2">Teks Kop Surat 2*</label>
                                <input type="text" value="<?php echo $tekskop2->NILAI_PENGATURAN; ?>" id="tekskop2" name="tekskop2" placeholder="Teks Kop 2" class="form-control <?php echo form_error('tekskop2') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('tekskop2'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="tekskop3">Teks Kop Surat 3*</label>
                                <input type="text" value="<?php echo $tekskop3->NILAI_PENGATURAN; ?>" id="tekskop3" name="tekskop3" placeholder="Teks Kop 3" class="form-control <?php echo form_error('tekskop3') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('tekskop3'); ?>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label for="tekskop4">Teks Kop Surat 4*</label>
                                <input type="text" value="<?php echo $tekskop4->NILAI_PENGATURAN; ?>" id="tekskop4" name="tekskop4" placeholder="Teks Kop 4" class="form-control <?php echo form_error('tekskop4') ? 'is-invalid':'' ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('tekskop4'); ?>
                                </div>
                            </div>
							
                            <br>
                            
                            <div class="form-group">
                                <label for="nip">Nama Paraf*</label>
                                <select placeholder="Pilih Guru" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" name="nip" id="nip" >
                                    <?php foreach($guru as $gu){ ?>
                                        <option <?php if($nip->NILAI_PENGATURAN == $gu->nip){echo "selected";} ?> value = "<?php echo $gu->nip; ?>"><?php echo $gu->nama_guru; ?></option>
                                    <?php } ?>
								</select>
                                <div class="invalid-feedback">
                                    <?php echo form_error('nip'); ?>
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
        <?php $this->load->view("admin/_partials/modal"); ?>
		<?php $this->load->view("admin/_partials/js.php") ?>

		

</body>

</html>
