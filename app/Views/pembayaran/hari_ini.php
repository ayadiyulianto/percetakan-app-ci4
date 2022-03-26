<?= $this->extend('templates/index.php') ?>

<!-- ADDITIONAL CSS -->
<?= $this->section('css') ?>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/select2/css/select2.min.css">

<?= $this->endSection() ?>

<!-- PAGE-CONTENT -->
<?= $this->section('page-content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $title ?></h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active"><?= $title ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
						<table id="data_table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Tgl Bayar</th>
									<th>Kasir</th>
									<th>Cara Bayar</th>
									<th>Nama bank</th>
									<th>Norek</th>
									<th>Atas nama</th>
									<th>Jumlah dibayar</th>
								</tr>
							</thead>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>

	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<!-- jquery-validation -->
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/admin-lte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>/admin-lte/plugins/select2/js/select2.full.min.js"></script>

<!-- page script -->
<script>
	$(function() {
		$('#data_table').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url('Pembayaran/hariIni') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true"
			}
		});

		//Initialize Select2 Elements
		$('.select2').select2();
	});
</script>

<?= $this->endSection() ?>