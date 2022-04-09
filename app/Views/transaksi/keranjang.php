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
                                        <input type="date" disabled id="tglOrder" name="tglOrder" value="<?= date('Y-m-d', strtotime($transaksi->tgl_order)) ?>" class="form-control" dateISO="true">
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
                                <div class="form-group text-center">
                                    <div class="btn-group">

                                        <a href="<?= site_url('transaksi') ?>" class="btn btn-lg btn-success"><i class="fas fa-arrow-up"></i> Simpan</a>


                                    </div>
                                </div>
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
    <!-- Tambah modal content -->
    <div id="add-modal-item" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Tambah</h4>
                </div>
                <div class="modal-body">
                    <form id="add-form-item" enctype="multipart/form-data" class="pl-3 pr-3">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" id="idTransaksiItem" name="idTransaksiItem" class="form-control" placeholder="Id transaksi item" maxlength="10" required>
                            <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?= $transaksi->id_transaksi ?>" class="form-control" placeholder="Id transaksi" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaItem"> Nama item: <span class="text-danger">*</span> </label>
                                    <input type="text" id="namaItem" name="namaItem" class="form-control" placeholder="Nama item" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ukuran"> Ukuran: </label>
                                    <input type="text" id="ukuran" name="ukuran" class="form-control" placeholder="Ukuran" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kuantiti"> Kuantiti: <span class="text-danger">*</span> </label>
                                    <input type="number" min="0" id="kuantiti" name="kuantiti" class="form-control" placeholder="Kuantiti" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuann"> Satuan: <span class="text-danger">*</span> </label>
                                    <select id="satuann" name="satuan" class="form-control select2" style="width: 100%;" required>
                                        <option></option>
                                        <?php foreach ($satuan as $stn) : ?>
                                            <option value="<?= $stn->nama_satuan ?>"><?= $stn->nama_satuan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="statusDesain"> Status desain: <span class="text-danger">*</span></label>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="keterangan"> Keterangan: </label>
                                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="255"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="add-form-item-btn">Tambah</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit modal content -->
    <div id="edit-modal-item" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="text-center bg-info p-3">
                    <h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
                </div>
                <div class="modal-body">
                    <form id="edit-form-item" enctype="multipart/form-data" class="pl-3 pr-3">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <input type="hidden" id="idTransaksiItem" name="idTransaksiItem" class="form-control" placeholder="Id transaksi item" maxlength="10" required>
                            <input type="hidden" id="idTransaksi" name="idTransaksi" value="<?= $transaksi->id_transaksi ?>" class="form-control" placeholder="Id transaksi" maxlength="10" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="namaItem"> Nama item: <span class="text-danger">*</span> </label>
                                    <input type="text" id="namaItem" name="namaItem" class="form-control" placeholder="Nama item" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ukuran"> Ukuran: </label>
                                    <input type="text" id="ukuran" name="ukuran" class="form-control" placeholder="Ukuran" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kuantiti"> Kuantiti: </label>
                                    <input type="number" min="0" id="kuantiti" name="kuantiti" class="form-control" placeholder="Kuantiti" maxlength="10" number="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuan"> Satuan: </label>
                                    <select id="satuan" name="satuan" class="form-control select2" style="width: 100%;" required>
                                        <option></option>
                                        <?php foreach ($satuan as $stn) : ?>
                                            <option value="<?= $stn->nama_satuan ?>"><?= $stn->nama_satuan ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                                    <a id="uploadedFileGambar" style="display: none;" class="btn btn-sm btn-info" href="#" data-toggle="lightbox" data-title="Title" data-gallery="gallery">
                                        <i class="fa fa-image"></i> Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="keterangan"> Keterangan: </label>
                                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" maxlength="255"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" type="number" min="0" disabled id="hargaSatuan" name="hargaSatuan" class="form-control" placeholder="Harga satuan" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" type="number" min="0" disabled id="subTotalHarga" name="subTotalHarga" class="form-control" placeholder="Sub total harga" maxlength="10" number="true">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success" id="edit-form-item-btn">Update</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Include modal for Item Barang CRUD -->
    <!-- Modal Item Barang content -->
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
                        <div class="col-md-4">
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-success" onclick="addItemBarang()" title="Tambah"> <i class="fa fa-plus"></i> Tambah Barang</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            </div>
                        </div>
                    </div>
                    <table id="table_item_barang" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama barang</th>
                                <th>Satuan</th>
                                <th>Panjang</th>
                                <th>Lebar</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

        <!-- Tambah modal content -->
        <div id="add-modal-item-barang" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="text-center bg-info p-3">
                        <h4 class="modal-title text-white" id="info-header-modalLabel">Tambah</h4>
                    </div>
                    <div class="modal-body">
                        <form id="add-form-item-barang" class="pl-3 pr-3">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="10" required>
                                <input type="hidden" id="idTransaksiItem" name="idTransaksiItem" class="form-control" placeholder="Id" maxlength="10" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="idBarang"> Id barang: </label>
                                        <select id="idBarang" name="idBarang" class="form-control select2" style="width: 100%;" required>
                                            <option></option>
                                            <?php foreach ($barang as $brg) : ?>
                                                <option value="<?= $brg->id_barang ?>"><?= $brg->nama_barang ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="namaBarang"> Nama barang: <span class="text-danger">*</span> </label>
                                        <input readonly type="text" id="namaBarang" name="namaBarang" class="form-control" placeholder="Nama barang" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="satuanKecil"> Satuan kecil: <span class="text-danger">*</span> </label>
                                        <input readonly type="text" id="satuanKecil" name="satuanKecil" class="form-control" placeholder="Satuan kecil" maxlength="50" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="formInputPanjang" style="display: none;">
                                    <div class="form-group">
                                        <label for="panjang"> Panjang: </label>
                                        <input type="number" min="0" id="panjang" name="panjang" class="form-control" placeholder="Panjang" maxlength="10" number="true">
                                    </div>
                                </div>
                                <div class="col-md-4" id="formInputLebar" style="display: none;">
                                    <div class="form-group">
                                        <label for="lebar"> Lebar: </label>
                                        <input type="number" min="0" id="lebar" name="lebar" class="form-control" placeholder="Lebar" maxlength="10" number="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah"> Jumlah: <span class="text-danger">*</span> </label>
                                        <input type="hidden" id="luas" name="luas" class="form-control" placeholder="Luas" maxlength="10" number="true" required>
                                        <input type="number" min="0" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" maxlength="10" number="true" required>
                                    </div>
                                </div>
                            </div>
                            <div type="hidden" class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" type="number" min="0" id="harga" name="harga" class="form-control" placeholder="Harga" maxlength="10" number="true" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" readonly type="number" id="totalHarga" name="totalHarga" class="form-control" placeholder="Total harga" maxlength="10" number="true" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success" id="add-form-item-barang-btn">Tambah</button>
                                    <button type="button" class="btn btn-danger" onclick="dismissAddFormItemBarang()">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Edit modal content -->
        <div id="edit-modal-item-barang" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="text-center bg-info p-3">
                        <h4 class="modal-title text-white" id="info-header-modalLabel">Update</h4>
                    </div>
                    <div class="modal-body">
                        <form id="edit-form-item-barang" class="pl-3 pr-3">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <input type="hidden" id="id" name="id" class="form-control" placeholder="Id" maxlength="10" required>
                                <input type="hidden" id="idTransaksiItem" name="idTransaksiItem" class="form-control" placeholder="Id" maxlength="10" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="idBarangg"> Id barang: </label>
                                        <select id="idBarangg" name="idBarang" class="form-control select2" style="width: 100%;">
                                            <option></option>
                                            <?php foreach ($barang as $brg) : ?>
                                                <option value="<?= $brg->id_barang ?>"><?= $brg->nama_barang ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="namaBarang"> Nama barang: <span class="text-danger">*</span> </label>
                                        <input readonly type="text" id="namaBarang" name="namaBarang" class="form-control" placeholder="Nama barang" maxlength="255" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="satuanKecil"> Satuan kecil: <span class="text-danger">*</span> </label>
                                        <input readonly type="text" id="satuanKecil" name="satuanKecil" class="form-control" placeholder="Satuan kecil" maxlength="50" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" id="formInputPanjang" style="display: none;">
                                    <div class="form-group">
                                        <label for="panjang"> Panjang: </label>
                                        <input type="number" min="0" id="panjang" name="panjang" class="form-control" placeholder="Panjang" maxlength="10" number="true">
                                    </div>
                                </div>
                                <div class="col-md-4" id="formInputLebar" style="display: none;">
                                    <div class="form-group">
                                        <label for="lebar"> Lebar: </label>
                                        <input type="number" min="0" id="lebar" name="lebar" class="form-control" placeholder="Lebar" maxlength="10" number="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jumlah"> Jumlah: <span class="text-danger">*</span> </label>
                                        <input type="hidden" id="luas" name="luas" class="form-control" placeholder="Luas" maxlength="10" number="true" required>
                                        <input type="number" min="0" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" maxlength="10" number="true" required>
                                    </div>
                                </div>
                            </div>
                            <div type="hidden" class="row">
                                <div type="hidden" class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" type="number" min="0" id="harga" name="harga" class="form-control" placeholder="Harga" maxlength="10" number="true" required>
                                    </div>
                                </div>
                                <div type="hidden" class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" readonly type="number" id="totalHarga" name="totalHarga" class="form-control" placeholder="Total harga" maxlength="10" number="true" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success" id="edit-form-item-barang-btn">Update</button>
                                    <button type="button" class="btn btn-danger" onclick="dismissEditFormItemBarang()">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div><!-- /.modal -->

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
                    $('#perusahaan').val(response.perusahaan);
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
                "url": '<?php echo base_url('transaksiItem/getAllForTransaksiKeranjang') ?>',
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

        $('#table_item_barang').DataTable().ajax.url("<?= site_url('transaksiItemBarang/getAllForTransaksiBaruKeranjang/') ?>" + id_transaksi_item).load();
    }
</script>

<!-- Include modal for Item CRUD -->
<script>
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

                var form = new FormData($('#add-form-item')[0]);
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url('transaksiItem/add') ?>',
                    type: 'post',
                    data: form, //.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    processData: false,
                    contentType: false,
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
                                updateTableItem()
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
                if (response.file_gambar) {
                    $("#edit-form-item #uploadedFileGambar").show();
                    $("#edit-form-item #uploadedFileGambar").attr('href', "<?= base_url() ?>/" + response.file_gambar);
                    $("#edit-form-item #uploadedFileGambar").data('title', response.nama_item).attr('data-title', response.nama_item);
                } else {
                    $("#edit-form-item #uploadedFileGambar").hide();
                    $("#edit-form-item #uploadedFileGambar").data('title', "").attr('data-title', response.nama_item);
                }
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
                        var form = new FormData($('#edit-form-item')[0]);
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url('transaksiItem/edit') ?>',
                            type: 'post',
                            data: form, //.serialize(),
                            processData: false,
                            contentType: false,
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
                                        updateTableItem()
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
                                updateTableItem();
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

    $('#edit-modal-item #kuantiti').change(function() {
        var kuantiti = $(this).val();
        var hargaSatuan = $('#edit-modal-item #hargaSatuan').val();
        $('#edit-modal-item #subTotalHarga').val(kuantiti * hargaSatuan);
    })

    function updateTableItem() {
        $('#table_item').DataTable().ajax.reload(null, false).draw(false);
        updateTotalBayar();
    }
</script>

<!-- Include modal for Item Barang CRUD -->
<script>
    $(function() {
        $('#table_item_barang').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    })

    function addItemBarang() {
        // reset the form 
        $("#add-form-item-barang")[0].reset();
        $("#add-form-item-barang #idBarang").val("").trigger('change');
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        $('#add-modal-item-barang').modal('show');
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

                var form = $('#add-form-item-barang');
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: '<?php echo base_url('transaksiItemBarang/add') ?>',
                    type: 'post',
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add-form-item-barang-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                updateTableItem()
                                $('#table_item_barang').DataTable().ajax.reload(null, false).draw(false);
                                $('#add-modal-item-barang').modal('hide');
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
                        $('#add-form-item-barang-btn').html('Tambah');
                    }
                });

                return false;
            }
        });
        $('#add-form-item-barang').validate();
    }

    function editItemBarang(id) {
        $.ajax({
            url: '<?php echo base_url('transaksiItemBarang/getOne') ?>',
            type: 'post',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // reset the form 
                $("#edit-form-item-barang")[0].reset();
                $(".form-control").removeClass('is-invalid').removeClass('is-valid');
                $('#edit-modal-item-barang').modal('show');

                $("#edit-form-item-barang #id").val(response.id);
                $("#edit-form-item-barang #idBarangg").val("").trigger('change');
                $("#edit-form-item-barang #idBarangg").val(response.id_barang);
                $("#edit-form-item-barang #namaBarang").val(response.nama_barang);
                $("#edit-form-item-barang #satuanKecil").val(response.satuan_kecil);
                $("#edit-form-item-barang #panjang").val(response.panjang);
                $("#edit-form-item-barang #lebar").val(response.lebar);
                $("#edit-form-item-barang #luas").val(response.luas);
                if (response.satuan_kecil == "m2" ||
                    response.satuan_kecil == "cm2") {
                    $('#modal-item-barang #formInputPanjang').show();
                    $('#modal-item-barang #formInputLebar').show();
                } else {
                    $('#modal-item-barang #formInputPanjang').hide();
                    $('#modal-item-barang #formInputLebar').hide();
                }
                $("#edit-form-item-barang #jumlah").val(response.jumlah);
                $("#edit-form-item-barang #harga").val(response.harga);
                $("#edit-form-item-barang #totalHarga").val(response.total_harga);

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
                        var form = $('#edit-form-item-barang');
                        $(".text-danger").remove();
                        $.ajax({
                            url: '<?php echo base_url('transaksiItemBarang/edit') ?>',
                            type: 'post',
                            data: form.serialize(),
                            dataType: 'json',
                            beforeSend: function() {
                                $('#edit-form-item-barang-btn').html('<i class="fa fa-spinner fa-spin"></i>');
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
                                        updateTableItem();
                                        $('#table_item_barang').DataTable().ajax.reload(null, false).draw(false);
                                        $('#edit-modal-item-barang').modal('hide');
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
                                $('#edit-form-item-barang-btn').html('Update');
                            }
                        });

                        return false;
                    }
                });
                $('#edit-form-item-barang').validate();

            }
        });
    }

    function removeItemBarang(id) {
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
                    url: '<?php echo base_url('transaksiItemBarang/remove') ?>',
                    type: 'post',
                    data: {
                        id: id
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
                                updateTableItem();
                                $('#table_item_barang').DataTable().ajax.reload(null, false).draw(false);
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

    function dismissAddFormItemBarang() {
        $('#add-modal-item-barang').modal('hide');
    }

    function dismissEditFormItemBarang() {
        $('#edit-modal-item-barang').modal('hide');
    }

    $('#add-modal-item-barang #idBarang').change(function() {
        var id_barang = $(this).val();
        idBarangOnChange(id_barang);
    })

    $('#edit-modal-item-barang #idBarangg').change(function() {
        var id_barang = $(this).val();
        idBarangOnChange(id_barang);
    })

    function idBarangOnChange(id_barang) {
        // jika id_barang kosong tidak perlu menjalankan fungsi dibawahnya
        if (!id_barang) return;
        $.ajax({
            url: "<?= site_url('barang/getOneByTransaksi') ?>",
            data: {
                id_barang: id_barang,
                id_transaksi: "<?= $transaksi->id_transaksi ?>"
            },
            dataType: "json",
            type: "post",
            success: function(response) {

                $('#modal-item-barang #namaBarang').val(response.nama_barang);
                $('#modal-item-barang #satuanKecil').val(response.satuan_kecil);
                $('#modal-item-barang #harga').val(response.harga_by_transaksi);
                $('#modal-item-barang #harga').attr('min', response.harga_terendah);
                $('#modal-item-barang #panjang').val(undefined);
                $('#modal-item-barang #lebar').val(undefined);
                $('#modal-item-barang #luas').val(1).trigger('change');
                if (response.satuan_kecil == "m2" ||
                    response.satuan_kecil == "cm2") {
                    $('#modal-item-barang #formInputPanjang').show();
                    $('#modal-item-barang #formInputLebar').show();
                } else {
                    $('#modal-item-barang #formInputPanjang').hide();
                    $('#modal-item-barang #formInputLebar').hide();
                }
            },
            error: function(jqXHR, exception) {
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'error',
                    title: 'Terjadi kesalahan saat mengambil data barang',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    };

    $('#add-modal-item-barang #panjang').change(function() {
        calculateLuas("add-modal-item-barang")
    })

    $('#add-modal-item-barang #lebar').change(function() {
        calculateLuas("add-modal-item-barang")
    })

    $('#edit-modal-item-barang #panjang').change(function() {
        calculateLuas("edit-modal-item-barang")
    })

    $('#edit-modal-item-barang #lebar').change(function() {
        calculateLuas("edit-modal-item-barang")
    })

    function calculateLuas(modalId) {
        var p = $('#' + modalId + ' #panjang').val();
        var l = $('#' + modalId + ' #lebar').val()
        if (p && l) {
            $('#' + modalId + ' #luas').val(p * l).trigger('change');
        } else {
            $('#' + modalId + ' #luas').val(1).trigger('change');
        }
    }

    $('#add-modal-item-barang #luas').change(function() {
        calculateTotalHarga("add-modal-item-barang")
    })

    $('#add-modal-item-barang #jumlah').change(function() {
        calculateTotalHarga("add-modal-item-barang")
    })

    $('#add-modal-item-barang #harga').change(function() {
        calculateTotalHarga("add-modal-item-barang")
    })

    $('#edit-modal-item-barang #luas').change(function() {
        calculateTotalHarga("edit-modal-item-barang")
    })

    $('#edit-modal-item-barang #jumlah').change(function() {
        calculateTotalHarga("edit-modal-item-barang")
    })

    $('#edit-modal-item-barang #harga').change(function() {
        calculateTotalHarga("edit-modal-item-barang")
    })

    function calculateTotalHarga(modalId) {
        var luas = $('#' + modalId + ' #luas').val();
        var jumlah = $('#' + modalId + ' #jumlah').val();
        var harga = $('#' + modalId + ' #harga').val();
        if (luas && jumlah) {
            var totalHarga = Math.ceil(luas * jumlah * harga);
            $('#' + modalId + ' #totalHarga').val(totalHarga);
        } else {
            $('#' + modalId + ' #totalHarga').val(0);
        }
    }
</script>

<?= $this->endSection() ?>