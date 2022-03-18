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
<!-- Ekko Lightbox Modal Image-->
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
                                <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?= $transaksi->id_transaksi ?>" class="form-control" placeholder="Id transaksi" maxlength="10" required>
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
                                            <!-- <option value="guest">Guest</option> -->
                                            <?php foreach ($pelanggan as $plg) : ?>
                                                <option value="<?= $plg->id_pelanggan ?>">
                                                    <?= $plg->nama_pelanggan . ' - ' . $plg->perusahaan  ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="namaPelanggan"> Nama pelanggan: </label>
                                        <input type="text" disabled id="namaPelanggan" name="namaPelanggan" class="form-control" required placeholder="Nama pelanggan" maxlength="255">
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
                                        <th>Harga Satuan</th>
                                        <th>Sub Total</th>
                                        <th>Desain</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-body pl-3 pr-3">
                            <form id="form-transaksi" method="post" class="pl-3 pr-3">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?= $transaksi->id_transaksi ?>" class="form-control" placeholder="Id transaksi" maxlength="10" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tglDeadline"> Tgl deadline: <span class="text-danger">*</span></label>
                                            <input type="datetime-local" id="tglDeadline" name="tglDeadline" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan"> Keterangan tambahan: </label>
                                            <textarea cols="40" rows="5" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="255"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pembayaranJenis"> Jenis Pembayaran: <span class="text-danger">*</span></label>
                                            <select id="pembayaranJenis" name="pembayaranJenis" class="form-control" style="width: 100%;" required>
                                                <option value="cash">Cash</option>
                                                <option value="transfer">Transfer</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="pilihBank" style="display:none;">
                                            <label for="pembayaranIdBank"> Pilih Bank: </label>
                                            <select id="pembayaranIdBank" name="pembayaranIdBank" class="form-control select2" style="width: 100%;">
                                                <option></option>
                                                <?php foreach ($bank as $bnk) : ?>
                                                    <option value="<?= $bnk->id_bank ?>">
                                                        <?= $bnk->nama_bank . ' - ' . $bnk->atas_nama . ' (' . $bnk->norek . ')' ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="totalBayarRupiah"> Total bayar: </label>
                                            <input type="hidden" id="totalBayar" name="totalBayar" maxlength="10" number="true">
                                            <input type="text" disabled id="totalBayarRupiah" name="totalBayarRupiah" class="form-control" placeholder="Total bayar" maxlength="50">
                                        </div>
                                        <div class="form-group">
                                            <label for="dibayar"> DIBAYAR: <span class="text-danger">*</span></label>
                                            <input type="number" min="0" id="dibayar" name="dibayar" class="form-control" oninput="onDibayarInputChange()" placeholder="Dibayar" maxlength="10" number="true" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kembalian"> Kembalian: </label>
                                            <input type="text" disabled id="kembalian" name="kembalian" class="form-control" placeholder="Kembalian" maxlength="50">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-lg btn-success" id="form-transaksi-save-button" onclick="saveTransaksi()"><i class="fas fa-save"></i> Simpan</button>
                                        <button type="button" class="btn btn-lg btn-danger" onclick="removeTransaksi()"><i class="fas fa-times"></i> Batalkan</button>
                                        <a href="<?= site_url('transaksi') ?>" class="btn btn-lg btn-secondary"><i class="fas fa-arrow-up"></i> Kembali</a>
                                    </div>
                                </div>
                            </form>
                            <form id="notaTransaksi" method="post" action="<?= site_url('transaksi/nota') ?>">
                                <?= csrf_field() ?>
                                <input id="id_transaksi" type="hidden" name="id_transaksi" value="<?= $transaksi->id_transaksi ?>">
                            </form>
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

    <!-- Include modal for Item CRUD -->
    <?= $this->include('transaksi/modal_item') ?>
    <!-- Include modal for Item Barang CRUD -->
    <?= $this->include('transaksi/modal_item_barang') ?>

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

    var currencyFormatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });

    $(function() {
        refreshDataTransaksi();

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
    });

    function refreshDataTransaksi() {
        $.ajax({
            url: "<?= site_url('transaksi/getOne') ?>",
            data: {
                id_transaksi: $("#idTransaksi").val()
            },
            dataType: "json",
            type: "post",
            success: function(response) {
                if (response.success === true) {

                    $('#noFaktur').val(response.no_faktur);
                    if (response.tgl_order) $('#tglOrder').val(response.tgl_order.substring(0, 10));
                    $('#idPelanggan').val(response.id_pelanggan);
                    $('#namaPelanggan').val(response.nama_pelanggan);
                    $('#noWa').val(response.no_wa);
                    if (response.tgl_deadline) $('#tglDeadline').val(response.tgl_deadline.replace(/\s+/g, 'T'));
                    $('#kasir').val(response.kasir);
                    $('#keterangan').val(response.keterangan);
                    $('#pembayaranJenis').val(response.pembayaran_jenis);
                    $('#pembayaranIdBank').val(response.pembayaran_id_bank).trigger('change');
                    if (response.pembayaran_jenis == 'transfer') {
                        $('#pilihBank').show();
                    } else {
                        $('#pilihBank').hide();
                    }
                    $('#totalBayar').val(response.harus_bayar);
                    $('#totalBayarRupiah').val(currencyFormatter.format(response.harus_bayar));

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
        var idPelanggan = $(this).val();
        $.ajax({
            url: "<?= site_url('transaksi/pilihPelanggan') ?>",
            data: {
                idTransaksi: $("#idTransaksi").val(),
                idPelanggan: idPelanggan
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

    $('#pembayaranJenis').change(function() {
        if ($(this).val() == 'transfer') {
            $('#pilihBank').show();
            $('#namaBank').show();
        } else {
            $('#pilihBank').hide();
            $('#namaBank').hide();
        }
    })

    function onDibayarInputChange() {
        var dibayar = $('#dibayar').val();
        var totalBayar = $('#totalBayar').val();
        var kembalian = dibayar - totalBayar;
        var kembalianRupiah
        if (kembalian > 0) {
            kembalianRupiah = currencyFormatter.format(kembalian);
        } else {
            kembalianRupiah = currencyFormatter.format(0);
        }
        $('#kembalian').val(kembalianRupiah);
    }

    function saveTransaksi() {
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

                var form = $('#form-transaksi').serialize();
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url('transaksi/save') ?>',
                    type: 'post',
                    data: form, // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-transaksi-save-button').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                // go to print invoice
                                $('#notaTransaksi').submit();
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
                        $('#form-transaksi-save-button').html('Simpan');
                    }
                });

                return false;
            }
        });
        $('#form-transaksi').validate();
    }

    function removeTransaksi() {
        var id_transaksi = $("#idTransaksi").val();
        Swal.fire({
            title: 'Yakin ingin membatalkan transaksi?',
            text: "Transaksi ini dan itemnya akan dihapus.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url('transaksi/remove') ?>',
                    type: 'post',
                    data: {
                        id_transaksi: id_transaksi
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
                                location.href = "<?= site_url('transaksi') ?>"
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

    function updateTotalBayar() {
        $.ajax({
            url: "<?= site_url('transaksi/getOne') ?>",
            data: {
                id_transaksi: "<?= $transaksi->id_transaksi ?>"
            },
            dataType: "json",
            type: "post",
            success: function(response) {
                if (response.success === true) {

                    $('#totalBayar').val(response.harus_bayar);
                    $('#totalBayarRupiah').val(currencyFormatter.format(response.harus_bayar));

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

    // ITEM

    $(function() {
        var table_item = $('#table_item').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url('transaksiItem/getAllForTransaksiBaru') ?>',
                "data": {
                    "id_transaksi": "<?= $transaksi->id_transaksi ?>"
                },
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        })
    })

    // END ITEM

    // ITEM BARANG

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
            }
        })

        $('#table_item_barang').DataTable().ajax.url("<?= site_url('transaksiItemBarang/getAllForTransaksiBaru/') ?>" + id_transaksi_item).load();
    }
</script>

<!-- Include modal for Item CRUD -->
<?= $this->include('transaksi/js_modal_item') ?>

<!-- Include modal for Item Barang CRUD -->
<?= $this->include('transaksi/js_modal_item_barang') ?>

<?= $this->endSection() ?>