<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("admin/_partials/head.php"); ?>
</head>
<body id="page-top">

	<?php $this->load->view("admin/_partials/navbar.php") ?>
	<div id="wrapper">

		<?php $this->load->view("admin/_partials/sidebar.php") ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<!-- DataTables -->
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/kejadian_siswa/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					
					<?php if ($this->session->flashdata('delete_fail')): ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $this->session->flashdata('delete_fail'); ?>
						</div>
					<?php endif; ?>

					<?php if ($this->session->flashdata('delete_success')): ?>
						<div class="alert alert-success" role="alert">
							<?php echo $this->session->flashdata('delete_success'); ?>
						</div>
					<?php endif; ?>
					
					<div class="card-body">

						<div class="table-responsive">
							
						
							<table id="dtserverside" class="table table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
                                        <th>No</th>
										<th>No Induk</th>
										<th>Nama Siswa</th>
										<th>Nama Kejadian</th>
                                        <th>Poin</th>
                                        <th>Tanggal Kejadian</th>
                                        <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "guru" || $this->session->userdata('level') == "guru_bk" || $this->session->userdata('level') == "orang_tua"){ ?>
                                        <th>Aksi</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody style="cursor:pointer">

								</tbody>
					
								<tfoot>
									<tr>
                                        <th>No</th>
										<th>No Induk</th>
										<th>Nama Siswa</th>
										<th>Nama Kejadian</th>
                                        <th>Poin</th>
                                        <th>Tanggal Kejadian</th>
                                        <?php if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "guru" || $this->session->userdata('level') == "guru_bk" || $this->session->userdata('level') == "orang_tua"){ ?>
                                        <th>Aksi</th>
										<?php } ?>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
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
	<?php $this->load->view("admin/_partials/modal.php") ?>

	<?php $this->load->view("admin/_partials/js.php") ?>
	<script>
		function deleteConfirm(url){
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();
		}

		var table;
 
		$(document).ready(function() {
		
			//datatables
			table = $('#dtserverside').DataTable({ 
		
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
		
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('admin/kejadian_siswa/ajax_list')?>",
					"type": "POST"
				},
		
				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ 0 ], //first column / numbering column
					"orderable": false, //set not orderable
				},
				],
		
			});

			// $('#dtserverside tbody').on( 'click', 'tr', function () {
			// 	if ( $(this).hasClass('selected') ) {
			// 		$(this).removeClass('selected');
			// 	}
			// 	else {
			// 		unitNo = $(this).find("td:nth-child(3)").html();

    		// 		alert(unitNo);
			// 	}
			// } );
		
		});
	</script>
</body>
</html>