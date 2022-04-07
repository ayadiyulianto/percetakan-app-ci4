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
									<th>No Faktur</th>
									<th>Nama Pelanggan</th>
									<th>Cara Bayar</th>
									<th>Nama bank</th>
									<th>Kasir</th>
									<th>Jumlah dibayar</th>
									<th></th>
									<th id="jumlah2">Jumlah dibayar</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th>Total : </th>
									<th id="total"></th>
									<th></th>
									<th></th>
								</tr>
							</tfoot>
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
									<input disabled type="date" id="createdAt" name="createdAt" class="form-control" dateISO="true">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="kasir"> Kasir: </label>
									<input disabled type="text" id="kasir" name="kasir" class="form-control" placeholder="Kasir" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="jenisPembayaran"> Jenis pembayaran: </label>
									<input disabled type="text" id="jenisPembayaran" name="jenisPembayaran" class="form-control" placeholder="Jenis pembayaran" maxlength="50">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="namaBank"> Nama bank: </label>
									<input disabled type="text" id="namaBank" name="namaBank" class="form-control" placeholder="Nama bank" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="norek"> Norek: </label>
									<input disabled type="text" id="norek" name="norek" class="form-control" placeholder="Norek" maxlength="50">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="atasNama"> Atas nama: </label>
									<input disabled type="text" id="atasNama" name="atasNama" class="form-control" placeholder="Atas nama" maxlength="50">
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


<div id="modal-detail-pembayaran" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="text-center bg-success p-3">
				<h4 class="modal-title text-white" id="info-header-modalLabel">Detail Pembayaran</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-8">
						<h5 id="noFakturModalTitle"></h5>
					</div>
				</div>
				<table id="table_pembayaran" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nama Item</th>
							<th>Ukuran</th>
							<th>Qty</th>
							<th>Satuan</th>
						</tr>
					</thead>
				</table>
				<div class="row">
					<div class="col-md-12">
						<h5>Keterangan :</h5>
						<p class="ml-3" id="keteranganItem"></p>
					</div>
					<div class="col-md-12">
						<!-- <div class="btn-group"> -->
						<button type="button" class="btn btn-danger float-right" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<!-- jquery-validation -->
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables-->
<script src="<?= base_url() ?>/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/admin-lte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>/admin-lte/plugins/select2/js/select2.full.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?= base_url(); ?>/admin-lte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- sum () coloum  -->
<script src="<?= base_url(); ?>/Plugins-master/api/sum().js"></script>

<!-- page script -->
<script>
	$(function() {
		var currencyFormatter = new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR',
		});
		// init lightbox modal file gambar
		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			event.preventDefault();
			$(this).ekkoLightbox({
				alwaysShowClose: true,
				showArrows: false
			});
		});

		$('#data_table').DataTable({
			"retrieve": true,
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
				async: "true",

			},
			"columnDefs": [{
					"targets": [8],
					"visible": false,

				},

			],
			"drawCallback": function() {
				var api = this.api();
				$(api.column(6).footer()).html(
					api.column(8, {
						/*page:'current' atau */
						filter: 'applied'
					}).data().sum()
				)
			},
		});


		$('#table_pembayaran').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
		});

		//Initialize Select2 Elements
		$('.select2').select2();
	});

	function detailPembayaran(id_transaksi) {
		$('#modal-detail-pembayaran').modal('show');
		$('#modal-detail-pembayaran').val(id_transaksi);
		$.ajax({
			url: '<?php echo base_url('transaksi/getOne') ?>',
			type: 'post',
			data: {
				id_transaksi: id_transaksi
			},
			dataType: 'json',
			success: function(response) {
				var noFaktur = "No. Faktur: " + response.no_faktur;
				$('#modal-detail-pembayaran #noFakturModalTitle').html(noFaktur);
				$('#modal-detail-pembayaran #keteranganItem').html(response.keterangan);
			}
		})

		$('#table_pembayaran').DataTable().ajax.url("<?= site_url('transaksiItem/getAll/') ?>" + id_transaksi).load();
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
				if (response.created_at) $("#edit-form #createdAt").val(response.created_at.substring(0, 10));
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