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

									<th></th>
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
	<!-- Tambah modal content -->
	<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="text-center bg-info p-3">
					<h4 class="modal-title text-white" id="info-header-modalLabel">Tambah</h4>
				</div>
				<div class="modal-body">
					<form id="add-form" class="pl-3 pr-3">
						<?= csrf_field(); ?>
						<div class="row">
							<input type="hidden" id="idTransaksiPembayaran" name="idTransaksiPembayaran" class="form-control" placeholder="Id transaksi pembayaran" maxlength="10">
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="createdAt"> Created at: </label>
									<input type="date" id="createdAt" name="createdAt" class="form-control" dateISO="true">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kasir"> Kasir: </label>
									<input type="text" id="kasir" name="kasir" class="form-control" placeholder="Kasir" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="jenisPembayaran"> Jenis pembayaran: </label>
									<input type="text" id="jenisPembayaran" name="jenisPembayaran" class="form-control" placeholder="Jenis pembayaran" maxlength="50">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="namaBank"> Nama bank: </label>
									<input type="text" id="namaBank" name="namaBank" class="form-control" placeholder="Nama bank" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="norek"> Norek: </label>
									<input type="text" id="norek" name="norek" class="form-control" placeholder="Norek" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="atasNama"> Atas nama: </label>
									<input type="text" id="atasNama" name="atasNama" class="form-control" placeholder="Atas nama" maxlength="50">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="jumlahDibayar"> Jumlah dibayar: </label>
									<input type="number" id="jumlahDibayar" name="jumlahDibayar" class="form-control" placeholder="Jumlah dibayar" maxlength="10" number="true">
								</div>
							</div>
						</div>

						<div class="form-group text-center">
							<div class="btn-group">
								<button type="submit" class="btn btn-success" id="add-form-btn">Tambah</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Edit modal content -->
	<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="text-center bg-info p-3">
					<h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
				</div>
				<div class="modal-body">
					<form id="edit-form" class="pl-3 pr-3">
						<?= csrf_field(); ?>
						<div class="row">
							<input type="hidden" id="idTransaksiPembayaran" name="idTransaksiPembayaran" class="form-control" placeholder="Id transaksi pembayaran" maxlength="10">
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="createdAt"> Created at: </label>
									<input type="date" id="createdAt" name="createdAt" class="form-control" dateISO="true">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kasir"> Kasir: </label>
									<input type="text" id="kasir" name="kasir" class="form-control" placeholder="Kasir" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="jenisPembayaran"> Jenis pembayaran: </label>
									<input type="text" id="jenisPembayaran" name="jenisPembayaran" class="form-control" placeholder="Jenis pembayaran" maxlength="50">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="namaBank"> Nama bank: </label>
									<input type="text" id="namaBank" name="namaBank" class="form-control" placeholder="Nama bank" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="norek"> Norek: </label>
									<input type="text" id="norek" name="norek" class="form-control" placeholder="Norek" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="atasNama"> Atas nama: </label>
									<input type="text" id="atasNama" name="atasNama" class="form-control" placeholder="Atas nama" maxlength="50">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="jumlahDibayar"> Jumlah dibayar: </label>
									<input type="number" id="jumlahDibayar" name="jumlahDibayar" class="form-control" placeholder="Jumlah dibayar" maxlength="10" number="true">
								</div>
							</div>
						</div>

						<div class="form-group text-center">
							<div class="btn-group">
								<button type="submit" class="btn btn-success" id="edit-form-btn">Update</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							</div>
						</div>
					</form>

				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
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
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url('pembayaran/getAll') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true"
			}
		});

		//Initialize Select2 Elements
		$('.select2').select2();
	});

	function add() {
		// reset the form 
		$("#add-form")[0].reset();
		$(".form-control").removeClass('is-invalid').removeClass('is-valid');
		$('#add-modal').modal('show');
		// submit the add from 
		$.validator.setDefaults({
			highlight: function(element) {
				$(element).addClass('is-invalid').removeClass('is-valid');
			},
			unhighlight: function(element) {
				$(element).removeClass('is-invalid').addClass('is-valid');
			},
			errorElement: 'div ',
			errorClass: 'invalid-feedback',
			errorPlacement: function(error, element) {
				if (element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				} else if ($(element).is('.select')) {
					element.next().after(error);
				} else if (element.hasClass('select2')) {
					//error.insertAfter(element);
					error.insertAfter(element.next());
				} else if (element.hasClass('selectpicker')) {
					error.insertAfter(element.next());
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function(form) {

				var form = $('#add-form');
				// remove the text-danger
				$(".text-danger").remove();

				$.ajax({
					url: '<?php echo base_url('pembayaran/add') ?>',
					type: 'post',
					data: form.serialize(), // /converting the form data into array and sending it to server
					dataType: 'json',
					beforeSend: function() {
						$('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
					},
					success: function(response) {

						if (response.success === true) {

							Swal.fire({
								position: 'bottom-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_table').DataTable().ajax.reload(null, false).draw(false);
								$('#add-modal').modal('hide');
							})

						} else {

							if (response.messages instanceof Object) {
								$.each(response.messages, function(index, value) {
									var id = $("#" + index);

									id.closest('.form-control')
										.removeClass('is-invalid')
										.removeClass('is-valid')
										.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

									id.after(value);

								});
							} else {
								Swal.fire({
									position: 'bottom-end',
									icon: 'error',
									title: response.messages,
									showConfirmButton: false,
									timer: 1500
								})

							}
						}
						$('#add-form-btn').html('Tambah');
					}
				});

				return false;
			}
		});
		$('#add-form').validate();
	}

	function edit(id_transaksi_pembayaran) {
		$.ajax({
			url: '<?php echo base_url('pembayaran/getOne') ?>',
			type: 'post',
			data: {
				id_transaksi_pembayaran: id_transaksi_pembayaran
			},
			dataType: 'json',
			success: function(response) {
				// reset the form 
				$("#edit-form")[0].reset();
				$(".form-control").removeClass('is-invalid').removeClass('is-valid');
				$('#edit-modal').modal('show');

				$("#edit-form #idTransaksiPembayaran").val(response.id_transaksi_pembayaran);
				$("#edit-form #createdAt").val(response.created_at);
				$("#edit-form #kasir").val(response.kasir);
				$("#edit-form #jenisPembayaran").val(response.jenis_pembayaran);
				$("#edit-form #namaBank").val(response.nama_bank);
				$("#edit-form #norek").val(response.norek);
				$("#edit-form #atasNama").val(response.atas_nama);
				$("#edit-form #jumlahDibayar").val(response.jumlah_dibayar);

				// submit the edit from 
				$.validator.setDefaults({
					highlight: function(element) {
						$(element).addClass('is-invalid').removeClass('is-valid');
					},
					unhighlight: function(element) {
						$(element).removeClass('is-invalid').addClass('is-valid');
					},
					errorElement: 'div ',
					errorClass: 'invalid-feedback',
					errorPlacement: function(error, element) {
						if (element.parent('.input-group').length) {
							error.insertAfter(element.parent());
						} else if ($(element).is('.select')) {
							element.next().after(error);
						} else if (element.hasClass('select2')) {
							//error.insertAfter(element);
							error.insertAfter(element.next());
						} else if (element.hasClass('selectpicker')) {
							error.insertAfter(element.next());
						} else {
							error.insertAfter(element);
						}
					},

					submitHandler: function(form) {
						var form = $('#edit-form');
						$(".text-danger").remove();
						$.ajax({
							url: '<?php echo base_url('pembayaran/edit') ?>',
							type: 'post',
							data: form.serialize(),
							dataType: 'json',
							beforeSend: function() {
								$('#edit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
							},
							success: function(response) {

								if (response.success === true) {

									Swal.fire({
										position: 'bottom-end',
										icon: 'success',
										title: response.messages,
										showConfirmButton: false,
										timer: 1500
									}).then(function() {
										$('#data_table').DataTable().ajax.reload(null, false).draw(false);
										$('#edit-modal').modal('hide');
									})

								} else {

									if (response.messages instanceof Object) {
										$.each(response.messages, function(index, value) {
											var id = $("#" + index);

											id.closest('.form-control')
												.removeClass('is-invalid')
												.removeClass('is-valid')
												.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

											id.after(value);

										});
									} else {
										Swal.fire({
											position: 'bottom-end',
											icon: 'error',
											title: response.messages,
											showConfirmButton: false,
											timer: 1500
										})

									}
								}
								$('#edit-form-btn').html('Update');
							}
						});

						return false;
					}
				});
				$('#edit-form').validate();

			}
		});
	}

	function remove(id_transaksi_pembayaran) {
		Swal.fire({
			title: 'Are you sure of the deleting process?',
			text: "You cannot back after confirmation",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Confirm',
			cancelButtonText: 'Batal'
		}).then((result) => {

			if (result.value) {
				$.ajax({
					url: '<?php echo base_url('pembayaran/remove') ?>',
					type: 'post',
					data: {
						id_transaksi_pembayaran: id_transaksi_pembayaran
					},
					dataType: 'json',
					success: function(response) {

						if (response.success === true) {
							Swal.fire({
								position: 'bottom-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_table').DataTable().ajax.reload(null, false).draw(false);
							})
						} else {
							Swal.fire({
								position: 'bottom-end',
								icon: 'error',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							})


						}
					}
				});
			}
		})
	}
</script>

<?= $this->endSection() ?>