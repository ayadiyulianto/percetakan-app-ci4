<!-- Tambah modal content -->
<div id="add-modal-item" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="text-center bg-info p-3">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Tambah</h4>
            </div>
            <div class="modal-body">
                <form id="add-form-item" class="pl-3 pr-3">
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
                                <label for="ukuran"> Ukuran: <span class="text-danger">*</span> </label>
                                <input type="text" id="ukuran" name="ukuran" class="form-control" placeholder="Ukuran" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kuantiti"> Kuantiti: <span class="text-danger">*</span> </label>
                                <input type="number" id="kuantiti" name="kuantiti" class="form-control" placeholder="Kuantiti" maxlength="10" number="true" required>
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
                                    <input type="file" class="custom-file-input" id="fileGambar">
                                    <label class="custom-file-label" for="fileGambar">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="hargaSatuan"> Harga satuan: </label>
                                <input  type="number" id="hargaSatuan" name="hargaSatuan" class="form-control" placeholder="Harga satuan" maxlength="10" number="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subTotalHarga"> Sub total harga: </label>
                                <input type="number" id="subTotalHarga" name="subTotalHarga" class="form-control" placeholder="Sub total harga" maxlength="10" number="true">
                            </div>
                        </div> -->
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
                <form id="edit-form-item" class="pl-3 pr-3">
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
                                <input type="number" id="kuantiti" name="kuantiti" class="form-control" placeholder="Kuantiti" maxlength="10" number="true">
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
                                    <input type="file" class="custom-file-input" id="fileGambar">
                                    <label class="custom-file-label" for="fileGambar">Choose file</label>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hargaSatuan"> Harga satuan: </label>
                                <input type="number" disabled id="hargaSatuan" name="hargaSatuan" class="form-control" placeholder="Harga satuan" maxlength="10" number="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subTotalHarga"> Sub total harga: </label>
                                <input type="number" disabled id="subTotalHarga" name="subTotalHarga" class="form-control" placeholder="Sub total harga" maxlength="10" number="true">
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
