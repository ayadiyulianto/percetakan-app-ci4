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
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/ekko-lightbox/ekko-lightbox.css">

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
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8 mt-2">
                                    <h3 class="card-title">Transaksi Detail</h3>
                                </div>
                                <div class="col-md-4">
                                    <!-- <button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Transaksi Baru</button> -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pl-3 pr-3">
                            <div class="row">
                                <input type="hidden" id="idTransaksi" name="idTransaksi" class="form-control" placeholder="Id transaksi" maxlength="10" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="noFaktur"> No faktur: </label>
                                        <input type="text" disabled id="noFaktur" name="noFaktur" class="form-control" placeholder="No faktur" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tglOrder"> Tgl order: </label>
                                        <input type="date" disabled id="tglOrder" name="tglOrder" value="<?= date('Y-m-d') ?>" class="form-control" dateISO="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kasir"> Kasir: </label>
                                        <input type="text" disabled id="kasir" name="kasir" class="form-control" placeholder="Kasir" maxlength="50" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="idPelanggan"> Pelanggan: </label>
                                        <select id="idPelanggan" name="idPelanggan" class="form-control select2pelanggan" style="width: 100%;" required>
                                            <option value=""></option>
                                            <?php foreach ($pelanggan as $plg) : ?>
                                                <option value="<?= $plg->id_pelanggan ?>">
                                                    <?= $plg->nama_pelanggan . ' (' . $plg->tipe_pelanggan . ')' ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="namaPelanggan"> Nama pelanggan: </label>
                                        <input type="text" disabled id="namaPelanggan" name="namaPelanggan" class="form-control" placeholder="Nama pelanggan" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="noWa"> No WA: </label>
                                        <input type="text" disabled id="noWa" name="noWa" class="form-control" placeholder="No wa" maxlength="50">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row pb-3">
                                <div class="col-md-8 mt-2">
                                    <h3 class="card-title">Item Penjualan</h3>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-block btn-outline-success" onclick="addItem()" title="Add Item"> <i class="fa fa-plus"></i> Tambah Item</button>
                                </div>
                            </div>
                            <table id="table_item" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Item</th>
                                        <th>Ukuran</th>
                                        <th>Qty</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                        <th>Desain</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-body pl-3 pr-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tglDeadline"> Tgl deadline: <span class="text-danger">*</span></label>
                                        <input type="date" id="tglDeadline" name="tglDeadline" class="form-control" dateISO="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="keterangan"> Keterangan tambahan: </label>
                                        <textarea cols="40" rows="5" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="255"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="totalBayar"> Total bayar: <span class="text-danger">*</span> </label>
                                        <input type="number" id="totalBayar" name="totalBayar" class="form-control" placeholder="Total bayar" maxlength="10" number="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>

                            <div class="form-group text-center">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success" id="add-form-btn">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <?= $this->include('transaksi/modal_item') ?>

</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>

<!-- ADDITIONAL JS -->
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
<!-- Ekko Lightbox -->
<script src="<?= base_url(); ?>/admin-lte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
    // Select2
    $('.select2').select2();
    $('.select2pelanggan').select2({
        tags: true
    });

    $(function() {
        refreshDataTransaksi();

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });

    function refreshDataTransaksi() {
        $.ajax({
            url: "<?= site_url('transaksi/getOne') ?>",
            data: {
                id_transaksi: "<?= $transaksi->id_transaksi ?>"
            },
            dataType: "json",
            type: "post",
            success: function(response) {
                if (response.success === true) {

                    $('#idTransaksi').val(response.id_transaksi);
                    $('#noFaktur').val(response.no_faktur);
                    if (response.tgl_order) $('#tglOrder').val(response.tgl_order.substring(0, 10));
                    $('#idPelanggan').val(response.id_pelanggan);
                    $('#namaPelanggan').val(response.nama_pelanggan);
                    $('#noWa').val(response.no_wa);
                    if (response.tgl_deadline) $('#tglDeadline').val(response.tgl_deadline.substring(0, 10));
                    $('#kasir').val(response.kasir);
                    $('#keterangan').val(response.keterangan);

                } else {

                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: "Terjadi kesalahan saat mengambil data.",
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            }
        });
    }

    $('#idPelanggan').change(function() {
        $.ajax({
            url: "<?= site_url('transaksi/pilihPelanggan') ?>",
            data: {
                idTransaksi: $("#idTransaksi").val(),
                idPelanggan: $("#idPelanggan").val()
            },
            dataType: "json",
            type: "post",
            success: function(response) {
                if (response.success === true) {

                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: response.messages,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {

                        refreshDataTransaksi();

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
    });

    $(function() {
        $('#table_item').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url('transaksiItem/getAll') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });
    })

    function addItem() {
        // reset the form 
        $("#add-form-item")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal-item').modal('show');
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

                var form = $('#add-form-item');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url('transaksiItem/add') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add-form-item-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                $('#table_item').DataTable().ajax.reload(null, false).draw(false);
                                $('#add-modal-item').modal('hide');
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
                        $('#add-form-item-btn').html('Tambah');
                    }
                });

                return false;
            }
        });
        $('#add-form-item').validate();
    }

    function editItem(id_transaksi_item) {
        $.ajax({
            url: '<?php echo base_url('transaksiItem/getOne') ?>',
            type: 'post',
            data: {
                id_transaksi_item: id_transaksi_item
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-form-item")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal-item').modal('show');

                $("#edit-form-item #idTransaksiItem").val(response.id_transaksi_item);
                $("#edit-form-item #namaItem").val(response.nama_item);
                $("#edit-form-item #ukuran").val(response.ukuran);
                $("#edit-form-item #kuantiti").val(response.kuantiti);
                $("#edit-form-item #satuan").val(response.satuan).trigger('change');
                $("#edit-form-item #hargaSatuan").val(response.harga_satuan);
                $("#edit-form-item #subTotalHarga").val(response.sub_total_harga);
                $("#edit-form-item #statusDesain").val(response.status_desain);
                $("#edit-form-item #fileGambar").val(response.file_gambar);
                $("#edit-form-item #keterangan").val(response.keterangan);

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
                        var form = $('#edit-form-item');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url('transaksiItem/edit') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#edit-form-item-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                        $('#edit-modal-item').modal('hide');
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
                                $('#edit-form-item-btn').html('Update');
                            }
                        });

                        return false;
                    }
                });
                $('#edit-form-item').validate();

            }
        });
    }

    function removeItem(id_transaksi_item) {
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
                    url: '<?php echo base_url('transaksiItem/remove') ?>',
                    type: 'post',
                    data: {
                        id_transaksi_item: id_transaksi_item
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
