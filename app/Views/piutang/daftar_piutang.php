<?= $this->extend('templates/index.php') ?>

<!-- ADDITIONAL CSS -->
<?= $this->section('css') ?>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <h3 class="card-title">Transaksi</h3>
                            </div>
                            <div class="col-md-4">
                                <!-- <button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Transaksi Baru</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No faktur</th>
                                    <th>Tgl order</th>
                                    <th>Nama pelanggan</th>
                                    <th>Kasir</th>
                                    <th>Total bayar</th>
                                    <th>Telah bayar</th>
                                    <th>Kurang</th>
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

    <!-- bayar modal content -->
    <div id="bayar-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Bayar Sisa Piutang</h4>
                </div>
                <div class="modal-body">
                    <form id="bayar-form" class="pl-3 pr-3">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" id="idTransaksi" name="idTransaksi" class="form-control" placeholder="Id transaksi" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="noFaktur"> No faktur: </label>
                                    <input disabled type="text" id="noFaktur" name="noFaktur" class="form-control" placeholder="No faktur" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tglOrder"> Tgl order: </label>
                                    <input disabled type="date" id="tglOrder" name="tglOrder" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaPelanggan"> Nama pelanggan: </label>
                                    <input disabled type="text" id="namaPelanggan" name="namaPelanggan" class="form-control" placeholder="Nama pelanggan" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kasir"> Kasir: </label>
                                    <input disabled type="text" id="kasir" name="kasir" value="<?= current_user()->first_name ?>" class="form-control" placeholder="Kasir" maxlength="50" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sisaPiutangRupiah"> Sisa piutang: </label>
                                    <input type="hidden" id="sisaPiutang" name="sisaPiutang" maxlength="10" number="true">
                                    <input type="text" disabled id="sisaPiutangRupiah" name="sisaPiutangRupiah" class="form-control" placeholder="Sisa Piutang" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenisPembayaran"> Jenis Pembayaran: <span class="text-danger">*</span></label>
                                    <select id="jenisPembayaran" name="jenisPembayaran" class="form-control" style="width: 100%;" required>
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="pilihBank" style="display:none;">
                                    <label for="idBank"> Pilih Bank: </label>
                                    <select id="idBank" name="idBank" class="form-control select2" style="width: 100%;">
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
                                    <label for="dibayar"> DIBAYAR: <span class="text-danger">*</span></label>
                                    <input type="number" min="0" id="dibayar" name="dibayar" class="form-control" oninput="onDibayarInputChange()" placeholder="Dibayar" maxlength="10" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kembalian"> Kembalian: </label>
                                    <input type="text" disabled id="kembalian" name="kembalian" class="form-control" placeholder="Kembalian" maxlength="50">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="bayar-form-btn">Bayar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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

</div>

<?= $this->endSection() ?>

<!-- ADDITIONAL JS -->
<?= $this->section('javascript') ?>

<!-- jquery-validation -->
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url() ?>/admin-lte/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables -->
<script src="https://adminlte.io/themes/v3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/admin-lte/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>/admin-lte/plugins/select2/js/select2.full.min.js"></script>

<!-- page script -->
<script>
    // Select2
    $('.select2').select2();

    var currencyFormatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
    });

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
                "url": '<?php echo base_url('transaksiItem/getAll') ?>',
                "data": {
                    id_transaksi: id_transaksi
                },
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        })
    })

    function itemAllBarang(id_transaksi) {
        $('#modal-item-barang').modal('show');
        $('#modal-item-barang').val(id_transaksi);
        $.ajax({
            url: '<?php echo base_url('transaksiItem/getAll') ?>',
            type: 'post',
            data: {
                id_transaksi: id_transaksi
            },
            dataType: 'json',
            success: function(response) {
                var namaItem = "Nama item : " + response.no_faktur;
                $('#modal-item-barang #namaItemModalTitle').html(namaItem);
                $('#modal-item-barang #keteranganItem').html(response.keterangan);
            }
        })

        $('#table_item_barang').DataTable().ajax.url("<?= site_url('transaksiItemBarang/getAll/') ?>" + id_transaksi_item).load();
    }
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
                "url": '<?php echo base_url('piutang/getAll') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });
    });

    function bayar(id_transaksi) {
        $.ajax({
            url: '<?php echo base_url('piutang/getOne') ?>',
            type: 'post',
            data: {
                id_transaksi: id_transaksi
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#bayar-form")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#bayar-modal').modal('show');

                $("#bayar-form #idTransaksi").val(response.id_transaksi);
                $("#bayar-form #noFaktur").val(response.no_faktur);
                if (response.tgl_order) $('#tglOrder').val(response.tgl_order.substring(0, 10));
                $("#bayar-form #namaPelanggan").val(response.nama_pelanggan);
                $("#bayar-form #sisaPiutang").val(response.kurang);
                $("#bayar-form #sisaPiutangRupiah").val(currencyFormatter.format(response.kurang));

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
                        var form = $('#bayar-form');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url('piutang/bayar') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#bayar-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                        $('#bayar-modal').modal('hide');
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
                                $('#bayar-form-btn').html('Bayar');
                            }
                        });

                        return false;
                    }
                });
                $('#bayar-form').validate();

            }
        });
    }

    $('#jenisPembayaran').change(function() {
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
        var sisaPiutang = $('#sisaPiutang').val();
        var kembalian = dibayar - sisaPiutang;
        var kembalianRupiah
        if (kembalian > 0) {
            kembalianRupiah = currencyFormatter.format(kembalian);
        } else {
            kembalianRupiah = currencyFormatter.format(0);
        }
        $('#kembalian').val(kembalianRupiah);
    }
</script>

<?= $this->endSection() ?>