<?= $this->extend('templates/index.php') ?>

<!-- ADDITIONAL CSS -->
<?= $this->section('css') ?>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
                                    <button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Transaksi Baru</button>
                                </div>
                            </div>
                        </div>
                        <form id="add-form">
                            <!-- /.card-header -->
                            <div class="card-body pl-3 pr-3">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <input type="hidden" id="idTransaksi" name="idTransaksi" class="form-control" placeholder="Id transaksi" maxlength="10" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="noFaktur"> No faktur: </label>
                                            <input type="text" readonly id="noFaktur" name="noFaktur" class="form-control" placeholder="No faktur" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tglOrder"> Tgl order: </label>
                                            <input type="date" readonly id="tglOrder" name="tglOrder" value="<?= date('Y-m-d') ?>" class="form-control" dateISO="true">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="idPelanggan"> Pelanggan: </label>
                                            <select id="idPelanggan" name="idPelanggan" class="form-control select2" style="width: 100%;" required>
                                                <option value=""></option>
                                                <?php foreach ($pelanggan as $plg) : ?>
                                                    <option value="<?= $plg->id_pelanggan ?>">
                                                        <?= $plg->tipe_pelanggan . ' - ' . $plg->nama_pelanggan ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="namaPelanggan"> Nama pelanggan: </label>
                                            <input type="text" readonly id="namaPelanggan" name="namaPelanggan" class="form-control" placeholder="Nama pelanggan" maxlength="255">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="noWa"> No WA: </label>
                                            <input type="text" readonly id="noWa" name="noWa" class="form-control" placeholder="No wa" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tglDeadline"> Tgl deadline: </label>
                                            <input type="date" id="tglDeadline" name="tglDeadline" class="form-control" dateISO="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kasir"> Kasir: <span class="text-danger">*</span> </label>
                                            <input type="text" readonly id="kasir" name="kasir" value="<?= current_user()->username ?>" class="form-control" placeholder="Kasir" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="data_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id Item</th>
                                            <th>Nama Item</th>
                                            <th>Rangkuman</th>
                                            <th>Ukuran</th>
                                            <th>Nama pelanggan</th>
                                            <th>No wa</th>
                                            <th>Tgl deadline</th>
                                            <th>Kasir</th>
                                            <th>Total bayar</th>
                                            <th>Keterangan</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="row">
                                <div class="col"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="totalBayar"> Total bayar: </label>
                                        <input type="number" id="totalBayar" name="totalBayar" class="form-control" placeholder="Total bayar" maxlength="10" number="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="keterangan"> Keterangan: </label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="255">
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
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>

<!-- ADDITIONAL JS -->
<?= $this->section('javascript') ?>

<!-- Select2 -->
<script src="<?= base_url(); ?>/admin-lte/plugins/select2/js/select2.full.min.js"></script>

<script>
    // Select2
    $('.select2').select2();

    $('#idPelanggan').change(function() {
        $.ajax({
            url: "<?= site_url('transaksi/pilihPelanggan') ?>",
            data: {
                "idPelanggan": $("#idPelanggan").val()
            },
            dataType: "json",
            type: "post",
            success: function(data) {
                $('#namaPelanggan').val(data.nama_pelanggan);
                $('#noWa').val(data.no_wa);
            }
        });
    });
</script>

<?= $this->endSection() ?>