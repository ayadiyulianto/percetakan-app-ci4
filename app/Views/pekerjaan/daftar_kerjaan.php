<?= $this->extend('templates/index.php') ?>

<!-- ADDITIONAL CSS -->
<?= $this->section('css') ?>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h3 class="card-title">Transaksi</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tgl Order</th>
                                    <th>Tgl Deadline</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Item</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th>Satuan</th>
                                    <th>Desain</th>
                                    <th>Status</th>
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

    <div id="modal-item-barang" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-success p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Item Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 id="namaItemModalTitle"></h5>
                        </div>
                    </div>
                    <table id="table_item_barang" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama barang</th>
                                <th>Satuan</th>
                                <th>Panjang</th>
                                <th>Lebar</th>
                                <th>Jumlah</th>
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

    <!-- upload modal content -->
    <div id="upload-modal-item" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="upload-form-item" enctype="multipart/form-data" class="pl-3 pr-3">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" id="idTransaksiItem" name="idTransaksiItem" class="form-control" placeholder="Id transaksi item" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaItem"> Nama item: <span class="text-danger">*</span> </label>
                                    <input disabled type="text" id="namaItem" name="namaItem" class="form-control" placeholder="Nama item" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statusDesain"> Status desain: </label>
                                    <select id="statusDesain" name="statusDesain" class="form-control" placeholder="Status desain">
                                        <option value="belum">Belum</option>
                                        <option value="acc">Acc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fileGambar"> File gambar: </label>
                                    <div class="custom-file">
                                        <input type="file" name="fileGambar" accept="image/*" class="custom-file-input" id="fileGambar">
                                        <label class="custom-file-label" for="fileGambar">Pilih file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="fileGambar"> File terupload: </label><br> -->
                                    <a id="uploadedFileGambar" style="display: none;" class="btn btn-sm btn-info" href="#" data-toggle="lightbox" data-title="Title" data-gallery="gallery">
                                        <i class="fa fa-image"></i> Lihat
                                    </a>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                            </div> -->
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="upload-form-item-btn">Upload</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- status modal content -->
    <div id="status-modal-item" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Update Status Produksi</h4>
                </div>
                <div class="modal-body">
                    <form id="status-form-item" class="pl-3 pr-3">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="10" required>
                            <input type="hidden" id="idTransaksiItem" name="idTransaksiItem" class="form-control" placeholder="Id" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaItem"> Nama item: <span class="text-danger">*</span> </label>
                                    <input disabled type="text" id="namaItem" name="namaItem" class="form-control" placeholder="Nama item" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statusSaatIni"> Status: <span class="text-danger">*</span> </label>
                                    <input disabled type="text" id="statusSaatIni" name="statusSaatIni" class="form-control" placeholder="Status Produksi" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statusProduksi"> Perbarui status: </label>
                                    <select id="statusProduksi" name="statusProduksi" class="form-control select2" style="width: 100%;">
                                        <option></option>
                                        <option value="dipesan">Dipesan</option>
                                        <option value="spk">SPK</option>
                                        <option value="cetak">Cetak</option>
                                        <option value="finishing">Finishing</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="diambil">Diambil</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="status-form-item-btn">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>

<?= $this->endSection() ?>

<!-- ADDITIONAL JS -->
<?= $this->section('javascript') ?>

<!-- jquery-validation -->
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/admin-lte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?= base_url(); ?>/admin-lte/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- page script -->
<script>
    $(function() {

        // init button file upload
        bsCustomFileInput.init();

        // init lightbox modal file gambar
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true,
                showArrows: false
            });
        });

        $('#data_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url('DaftarKerjaan/getAll') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });

        $('#table_item_barang').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function itemBarang(id_transaksi_item) {
        $('#modal-item-barang').modal('show');
        $('#modal-item-barang #idTransaksiItem').val(id_transaksi_item);
        $.ajax({
            url: '<?php echo base_url('transaksiItem/getOne') ?>',
            type: 'post',
            data: {
                id_transaksi_item: id_transaksi_item
            },
            dataType: 'json',
            success: function(response) {
                var namaItem = "Nama item : " + response.nama_item;
                $('#modal-item-barang #namaItemModalTitle').html(namaItem);
                $('#modal-item-barang #keteranganItem').html(response.keterangan);
            }
        })

        $('#table_item_barang').DataTable().ajax.url("<?= site_url('transaksiItemBarang/getAll/') ?>" + id_transaksi_item).load();
    }

    function uploadGambar(id_transaksi_item) {
        $.ajax({
            url: '<?php echo base_url('transaksiItem/getOne') ?>',
            type: 'post',
            data: {
                id_transaksi_item: id_transaksi_item
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#upload-form-item")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#upload-modal-item').modal('show');

                $("#upload-form-item #idTransaksiItem").val(response.id_transaksi_item);
                $("#upload-form-item #namaItem").val(response.nama_item);
                $("#upload-form-item #statusDesain").val(response.status_desain);
                if (response.file_gambar) {
                    $("#upload-form-item #uploadedFileGambar").show();
                    $("#upload-form-item #uploadedFileGambar").attr('href', "<?= base_url() ?>/" + response.file_gambar);
                    $("#upload-form-item #uploadedFileGambar").data('title', response.nama_item).attr('data-title', response.nama_item);
                } else {
                    $("#upload-form-item #uploadedFileGambar").hide();
                    $("#upload-form-item #uploadedFileGambar").data('title', "").attr('data-title', response.nama_item);
                }
                // submit the upload from 
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
                        var form = new FormData($('#upload-form-item')[0]);
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url('transaksiItem/uploadGambar') ?>',
                            type: 'post',
                            data: form, //.serialize(),
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            beforeSend: function() {
                                $('#upload-form-item-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                        $('#upload-modal-item').modal('hide');
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
                                $('#upload-form-item-btn').html('Upload');
                            }
                        });

                        return false;
                    }
                });
                $('#upload-form-item').validate();

            }
        });
    }

    function statusProduksi(id_transaksi_item) {
        $.ajax({
            url: '<?php echo base_url('transaksiItem/getOne') ?>',
            type: 'post',
            data: {
                id_transaksi_item: id_transaksi_item
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#status-form-item")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#status-modal-item').modal('show');

                $("#status-form-item #idTransaksiItem").val(response.id_transaksi_item);
                $("#status-form-item #namaItem").val(response.nama_item);
                $("#status-form-item #statusSaatIni").val(response.status_produksi);

                // submit the status form 
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
                        var form = $('#status-form-item');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url('transaksiItem/updateStatus') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#status-form-item-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                        $('#status-modal-item').modal('hide');
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
                                $('#status-form-item-btn').html('Update');
                            }
                        });

                        return false;
                    }
                });
                $('#status-form-item').validate();

            }
        });
    }
</script>

<?= $this->endSection() ?>