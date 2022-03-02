<script>
    function addItemBarang() {
        // reset the form 
        $("#add-form-item-barang")[0].reset();
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
                $("#edit-form-item-barang #idBarang").val(response.id_barang);
                $("#edit-form-item-barang #namaBarang").val(response.nama_barang);
                $("#edit-form-item-barang #satuanKecil").val(response.satuan_kecil);
                $("#edit-form-item-barang #panjang").val(response.panjang);
                $("#edit-form-item-barang #lebar").val(response.lebar);
                $("#edit-form-item-barang #luas").val(response.luas).trigger('change');
                if (response.satuan_kecil == "m2") {
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
                $('#modal-item-barang #panjang').val(undefined);
                $('#modal-item-barang #lebar').val(undefined);
                $('#modal-item-barang #luas').val(1);
                if (response.satuan_kecil == "m2") {
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

    $('#modal-item-barang #panjang').change(function() {
        calculateLuas()
    })

    $('#modal-item-barang #lebar').change(function() {
        calculateLuas()
    })

    function calculateLuas() {
        var p = $('#modal-item-barang #panjang').val();
        var l = $('#modal-item-barang #lebar').val()
        if (p && l) {
            $('#modal-item-barang #luas').val(p * l).trigger('change');
        } else {
            $('#modal-item-barang #luas').val(1).trigger('change');
        }
    }

    $('#modal-item-barang #luas').change(function() {
        calculateTotalHarga()
    })

    $('#modal-item-barang #jumlah').change(function() {
        calculateTotalHarga()
    })

    function calculateTotalHarga() {
        var luas = $('#modal-item-barang #luas').val();
        var jumlah = $('#modal-item-barang #jumlah').val();
        var harga = $('#modal-item-barang #harga').val();
        if (luas && jumlah) {
            var totalHarga = Math.ceil(luas * jumlah * harga);
            $('#modal-item-barang #totalHarga').val(totalHarga);
        } else {
            $('#modal-item-barang #totalHarga').val(0);
        }
    }
</script>
