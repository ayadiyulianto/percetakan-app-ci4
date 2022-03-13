<?= $this->extend('templates/index.php') ?>

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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-md-6">
                <img src="<?= base_url(); ?>/img/Kaber.png" alt="Logo Kaber" style="height:80px;">
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <h1>INVOICE</h1>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info mt-3">
              <div class="col-md-6 invoice-col">
                Kepada Yth:
                <address>
                  <strong><?= $transaksi->nama_pelanggan ?></strong><br>
                  <?= $transaksi->perusahaan ?> <br>
                  <?= $transaksi->no_wa ?>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-md-6 invoice-col">
                <table class="table table-sm">
                  <tr>
                    <td><b>No. Faktur</b></td>
                    <td><b><?= $transaksi->no_faktur ?></b></td>
                  </tr>
                  <tr>
                    <td><b>Tanggal Order</b></td>
                    <td><?= date('j F Y', strtotime($transaksi->tgl_order)) ?></td>
                  </tr>
                  <tr>
                    <td><b>Tanggal Deadline</b></td>
                    <td><?= date('j F Y', strtotime($transaksi->tgl_deadline)) ?></td>
                  </tr>
                  <tr>
                    <td><b>Pembayaran</b></td>
                    <td><?= $transaksi->pembayaran_jenis ?></td>
                  </tr>
                  <tr>
                    <td><b>Kasir</b></td>
                    <td><?= $transaksi->kasir ?></td>
                  </tr>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row mt-3">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Item</th>
                      <th>Ukuran</th>
                      <th>Qty</th>
                      <th>Satuan</th>
                      <th>Harga Satuan</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach ($transaksiItem as $itm) : ?>
                      <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $itm->nama_item . '<br>(' . $itm->rangkuman . ')' ?></td>
                        <td><?= $itm->ukuran ?></td>
                        <td><?= $itm->kuantiti ?></td>
                        <td><?= $itm->satuan ?></td>
                        <td><?= number_to_currency($itm->harga_satuan, 'IDR', 'id_ID', 2) ?></td>
                        <td><?= number_to_currency($itm->sub_total_harga, 'IDR', 'id_ID', 2) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-md-6">
                <p><b>Keterangan tambahan :</b> <?= $transaksi->keterangan ?></p>
              </div>
            </div>

            <div class="row mt-3">
              <!-- accepted payments column -->
              <div class="col-md-6">
                <?php if ($transaksi->pembayaran_jenis == 'transfer') : ?>
                  <b>NB:</b>
                  <p class="text-muted well well-sm shadow-none">
                    Pembayaran dapat dilakukan melalui : <br>
                    <?= $transaksi->pembayaran_nama_bank . ' - ' . $transaksi->pembayaran_atas_nama . ' No. Rek : ' . $transaksi->pembayaran_norek ?>
                  </p>
                <?php endif; ?>

                <table class="table">
                  <tr>
                    <th style="width:50%">Total bayar :</th>
                    <td><?= number_to_currency($transaksi->harus_bayar, 'IDR', 'id_ID', 2) ?></td>
                  </tr>
                  <tr>
                    <th style="width:50%">Panjar :</th>
                    <td><?= number_to_currency($transaksi->telah_bayar, 'IDR', 'id_ID', 2) ?></td>
                  </tr>
                  <tr>
                    <th style="width:50%">Sisa bayar :</th>
                    <td>
                      <?php if ($transaksi->telah_bayar >= $transaksi->harus_bayar) {
                        echo '<strong class="text-success">LUNAS</strong>';
                      } else {
                        echo number_to_currency($transaksi->kurang, 'IDR', 'id_ID', 2);
                      } ?>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- /.col -->
              <div class="col-md-3 text-center">
                <!-- <div class="row">
                  <div class="col-6 text-center"> -->
                <h6 for="keterangan" class="text-center"> Diterima Oleh:
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  _________________
                </h6>
              </div>
              <div class="col-md-3 text-center">
                <h6 for="keterangan" class="text-center"> Hormat Kami :
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <h6 class=text-bold><?= $transaksi->kasir; ?></h6>
                  <!-- </div>
            </div> -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>
