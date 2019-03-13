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
						<a href="<?php echo site_url('admin/users/add') ?>"><i class="fas fa-plus"></i> Add New</a>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-hover" id="dtserverside" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Id</th>
										<th>Name</th>
										<th>Password</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    <?php foreach($users as $user):
                                    ?>
                                    <tr>
                                        <td width = "150">
                                            <?php echo $user->user_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $user->user_username; ?>
                                        </td>
                                        <td>
                                            <?php echo base64_decode($user->user_password); ?>
                                        </td>
                                        <td width="250">
                                            <a href="<?php echo site_url('admin/users/edit/'.$user->user_id); ?>" class="btn btn-small"><i class="fas fa-edit"></i>Edit</a>
                                            <a onclick="deleteConfirm('<?php echo site_url('admin/users/delete/'.$user->user_id); ?>')" href="#!"  class="btn btn-small text-danger"><i class="fas fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
							</table>
							<?php echo site_url('admin/customers/ajax_list')?>
							<table id="tableku" class="table table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No</th>
										<th>User ID</th>
										<th>Name</th>
										<th>Password</th>
										
									</tr>
								</thead>
								<tbody>
								</tbody>
					
								<tfoot>
									<tr>
										<th>No</th>
										<th>User ID</th>
										<th>Name</th>
										<th>Password</th>
										
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
		$(document).ready( function () {
			table = $('#dtserverside').DataTable({ 
				
			});
		} );

		var table;
 
		$(document).ready(function() {
		
			//datatables
			table = $('#tableku').DataTable({ 
		
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
		
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('admin/users/ajax_list')?>",
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
		
		});
	</script>
</body>
</html>