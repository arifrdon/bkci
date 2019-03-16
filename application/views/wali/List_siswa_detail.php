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
						<a href="<?php echo site_url('wali/list_siswa/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
					</div>
					<div class="card-header">
						NIS: <?php echo $siswa->no_induk; ?><br>
						Nama: <?php echo $siswa->nama_siswa; ?><br>
						Tempat, Tanggal Lahir:<?php echo $siswa->tempat.", ".$siswa->tanggal_lahir; ?><br>
						Jenis Kelamin: <?php echo $siswa->jenis_kelamin_siswa; ?><br>
					</div>
					<div class="card-header">
						Poin Awal: <?php echo $this->session->userdata('poin_awal'); ?>
					</div>
					<div class="card-body">
					
						<div class="table-responsive">
							
						
							<table id="dtserverside" class="table table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
                                        
										<th>Nama Kejadian</th>
										<th>Tanggal</th>
										<th>Tipe Kejadian</th>
										<th>Poin</th>
                                        <th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
					
								
							</table>
						</div>
					</div>
					<div class="card-header">
						Poin Akhir: <?php echo $singlescore->poin_akhir; ?>
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
				 "bFilter" : false,               
				 "bLengthChange": false,
				 "searching": false,
				"paging": false,
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
		
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('wali/list_siswa/ajax_list/'.$no_induk)?>",
					"type": "POST"
				},
		
				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
					"targets": [ 4 ], //first column / numbering column
					"orderable": true, //set not orderable
				},
				],
		
			});
		
		});
	</script>
</body>
</html>