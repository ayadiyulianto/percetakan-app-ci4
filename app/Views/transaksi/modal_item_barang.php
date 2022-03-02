<!-- Modal Item Barang content -->
<div id="modal-item-barang" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="text-center bg-success p-3">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Item Barang</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8" id="namaItemModalTitle"></div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-block btn-success" onclick="addItemBarang()" title="Tambah"> <i class="fa fa-plus"></i> Tambah Barang</button>
                    </div>
                </div>
                <table id="table_item_barang" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id barang</th>
                            <th>Nama barang</th>
                            <th>Satuan</th>
                            <th>Panjang</th>
                            <th>Lebar</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
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
                                    <input type="number" id="panjang" name="panjang" class="form-control" placeholder="Panjang" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4" id="formInputLebar" style="display: none;">
                                <div class="form-group">
                                    <label for="lebar"> Lebar: </label>
                                    <input type="number" id="lebar" name="lebar" class="form-control" placeholder="Lebar" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jumlah"> Jumlah: <span class="text-danger">*</span> </label>
                                    <input type="hidden" id="luas" name="luas" class="form-control" placeholder="Luas" maxlength="10" number="true" required>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="harga"> Harga: <span class="text-danger">*</span> </label>
                                    <input readonly type="number" id="harga" name="harga" class="form-control" placeholder="Harga" maxlength="10" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="totalHarga"> Total harga: <span class="text-danger">*</span> </label>
                                    <input readonly type="number" id="totalHarga" name="totalHarga" class="form-control" placeholder="Total harga" maxlength="10" number="true" required>
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
                                    <select id="idBarangg" name="idBarang" class="form-control select2" style="width: 100%;" required>
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
                                    <input type="number" id="panjang" name="panjang" class="form-control" placeholder="Panjang" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4" id="formInputLebar" style="display: none;">
                                <div class="form-group">
                                    <label for="lebar"> Lebar: </label>
                                    <input type="number" id="lebar" name="lebar" class="form-control" placeholder="Lebar" maxlength="10" number="true">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jumlah"> Jumlah: <span class="text-danger">*</span> </label>
                                    <input type="hidden" id="luas" name="luas" class="form-control" placeholder="Luas" maxlength="10" number="true" required>
                                    <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah" maxlength="10" number="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="harga"> Harga: <span class="text-danger">*</span> </label>
                                    <input readonly type="number" id="harga" name="harga" class="form-control" placeholder="Harga" maxlength="10" number="true" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="totalHarga"> Total harga: <span class="text-danger">*</span> </label>
                                    <input readonly type="number" id="totalHarga" name="totalHarga" class="form-control" placeholder="Total harga" maxlength="10" number="true" required>
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
