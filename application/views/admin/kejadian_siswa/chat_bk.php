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
                <?php if ($this->session->flashdata('delete_success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('delete_success'); ?>
				</div>
				<?php endif; ?>
                <?php if ($this->session->flashdata('delete_fail')): ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $this->session->flashdata('delete_fail'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/kejadian_siswa/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-body">

						<form action="<?php //base_url('admin/product/add') ?>" method="post" enctype="multipart/form-data" >
							<div class="form-group">
                                <label >Detail Siswa</label>
                                
                            </div>
                            <div class="form-group">
                                <label>No Induk: <?php echo $kejadiansw->NO_INDUK; ?></label><br>
                                <label>Nama: <?php echo $kejadiansw->nama_siswa; ?></label><br>
                                <label>Kejadian: <?php echo $kejadiansw->nama_kejadian; ?></label><br>
                                <label>Poin: <?php echo $kejadiansw->poin_kejadian; ?></label><br>
                                <label>Tanggal Kejadian: <?php echo $kejadiansw->TANGGAL_KEJADIAN; ?></label><br>
                            </div>

							<hr>
                            <div class="form-group">
                            <?php 
                                foreach($forum_kejadian as $fk){
                            ?>
                                <table class="table-bordered table">
                                
                                    <tr><td bgcolor="#CCCCCC">
                                    <span style="float: left;">
                                    <?php 
                                        if($fk->level != "orang_tua"){
                                            echo ucwords($fk->admname)." "."(".ucwords(str_replace('_', ' ', $fk->level)).")";
                                        } else {
                                            echo ucwords($fk->ortname)." "."(".ucwords(str_replace('_', ' ', $fk->level)).")";
                                        }
                                    ?> 
                                    </span>
                                    <span style="float: right;">
                                    <?php 
                                        echo $fk->tanggal_chat;
                                    ?> 
                                    <?php 
                                        if($this->session->userdata('user_id') == $fk->user_id){
                                    ?>
                                    <a href="<?php echo site_url('admin/kejadian_siswa/deletechat/'.$fk->id_forum.'/'.$idchatbk)  ?>"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus?');" > 
                                        <div class="btn btn-danger btn-xs"><i class="fa fa-times"></i></div>
                                    </a>
                                    <?php 
                                        }
                                    ?>
                                    </span> 
                                    </td></tr>
                                    <tr><td><?php echo $fk->komentar; ?></td></tr>
                                
                                </table>
                                <br>
                            <?php
                                }
                            ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="komentar">Komentar*</label><br>
                                
                                <label><?php echo ucwords($this->session->userdata('user_nama')); ?> (<?php echo ucwords(str_replace('_', ' ', $this->session->userdata('level'))); ?>)</label>
                                <input type="hidden" id="id_kejadian_siswa"  class="form-control" name="id_kejadian_siswa" value="<?php echo $kejadiansw->ID_KEJADIAN_SISWA; ?>"> 
                                <input  type="hidden" name="user_id" class="form-control" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>"> 
                                <input  type="hidden" name="level" class="form-control" id="level" value="<?php echo $_SESSION['level']; ?>"> 
                                <textarea name="komentar" id="komentar" class="form-control <?php echo form_error('komentar') ? 'is-invalid':'' ?>" cols="20" rows="5"></textarea>
								<div class="invalid-feedback">
                                    <?php echo form_error('komentar'); ?>
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
