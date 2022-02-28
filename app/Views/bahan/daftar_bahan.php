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
                    <h1>Bahan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bahan</li>
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h3 class="card-title">Bahan</h3>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-block btn-success" onclick="add()" title="Tambah"> <i class="fa fa-plus"></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id bahan</th>
                                    <th>Nama bahan</th>
                                    <th>Satuan kecil</th>
                                    <th>Stok satuan kecil</th>
                                    <th>Satuan besar</th>
                                    <th>Modal bahan</th>

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
                            <input type="hidden" id="idBahan" name="idBahan" class="form-control" placeholder="Id bahan" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaBahan"> Nama bahan: <span class="text-danger">*</span> </label>
                                    <input type="text" id="namaBahan" name="namaBahan" class="form-control" placeholder="Nama bahan" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuanKecill"> Satuan kecil: <span class="text-danger">*</span> </label>
                                    <select id="satuanKecill" name="satuanKecil" class="form-control select2" style="width: 100%;" required>
                                        <?php foreach ($satuan as $stn) : ?>
                                            <option value="<?= $stn->nama_satuan ?>"><?= $stn->nama_satuan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stokSatuanKecil"> Stok satuan kecil: <span class="text-danger">*</span> </label>
                                    <input type="number" id="stokSatuanKecil" name="stokSatuanKecil" class="form-control" placeholder="Stok satuan kecil" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuanBesarr"> Satuan besar: </label>
                                    <select id="satuanBesarr" name="satuanBesar" class="form-control select2" style="width: 100%;" required>
                                        <?php foreach ($satuan as $stn) : ?>
                                            <option value="<?= $stn->nama_satuan ?>"><?= $stn->nama_satuan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="isiSatuanBesar"> Isi satuan besar: </label>
                                    <input type="number" id="isiSatuanBesar" name="isiSatuanBesar" class="form-control" placeholder="Isi satuan besar" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="modalBahanSatuanKecil"> Modal bahan satuan kecil: <span class="text-danger">*</span> </label>
                                    <input type="number" id="modalBahanSatuanKecil" name="modalBahanSatuanKecil" class="form-control" placeholder="Modal bahan satuan kecil" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                            <input type="hidden" id="idBahan" name="idBahan" class="form-control" placeholder="Id bahan" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaBahan"> Nama bahan: <span class="text-danger">*</span> </label>
                                    <input type="text" id="namaBahan" name="namaBahan" class="form-control" placeholder="Nama bahan" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuanKecil"> Satuan kecil: <span class="text-danger">*</span> </label>
                                    <select id="satuanKecil" name="satuanKecil" class="form-control select2" style="width: 100%;" required>
                                        <?php foreach ($satuan as $stn) : ?>
                                            <option value="<?= $stn->nama_satuan ?>"><?= $stn->nama_satuan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stokSatuanKecil"> Stok satuan kecil: <span class="text-danger">*</span> </label>
                                    <input type="number" id="stokSatuanKecil" name="stokSatuanKecil" class="form-control" placeholder="Stok satuan kecil" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuanBesar"> Satuan besar: </label>
                                    <select id="satuanBesar" name="satuanBesar" class="form-control select2" style="width: 100%;" required>
                                        <?php foreach ($satuan as $stn) : ?>
                                            <option value="<?= $stn->nama_satuan ?>"><?= $stn->nama_satuan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="isiSatuanBesar"> Isi satuan besar: </label>
                                    <input type="number" id="isiSatuanBesar" name="isiSatuanBesar" class="form-control" placeholder="Isi satuan besar" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="modalBahanSatuanKecil"> Modal bahan satuan kecil: <span class="text-danger">*</span> </label>
                                    <input type="number" id="modalBahanSatuanKecil" name="modalBahanSatuanKecil" class="form-control" placeholder="Modal bahan satuan kecil" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                "url": '<?php echo base_url('bahan/getAll') ?>',
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
                    url: '<?php echo base_url('bahan/add') ?>',
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

    function edit(id_bahan) {
        $.ajax({
            url: '<?php echo base_url('bahan/getOne') ?>',
            type: 'post',
            data: {
                id_bahan: id_bahan
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal').modal('show');

                $("#edit-form #idBahan").val(response.id_bahan);
                $("#edit-form #namaBahan").val(response.nama_bahan);
                $("#edit-form #satuanKecil").val(response.satuan_kecil);
                $("#edit-form #stokSatuanKecil").val(response.stok_satuan_kecil);
                $("#edit-form #satuanBesar").val(response.satuan_besar);
                $("#edit-form #isiSatuanBesar").val(response.isi_satuan_besar);
                $("#edit-form #modalBahanSatuanKecil").val(response.modal_bahan_satuan_kecil);

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
                            url: '<?php echo base_url('bahan/edit') ?>',
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

    function remove(id_bahan) {
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
                    url: '<?php echo base_url('bahan/remove') ?>',
                    type: 'post',
                    data: {
                        id_bahan: id_bahan
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
