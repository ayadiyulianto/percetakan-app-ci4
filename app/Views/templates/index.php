<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | KaBer Printing</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/plugins/fontawesome-free/css/all.min.css">

    <!-- ADDITIONAL CSS -->
    <?= $this->renderSection('css') ?>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/admin-lte/dist/css/adminlte.min.css">

    <meta name="csrf_token" content="<?= csrf_hash() ?>" />

</head>

<!-- layout-navbar-fixed layout-fixed -->

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>/img/Kaber.png" height="200" width="350">
        </div>

        <!-- NAVBAR -->
        <?= $this->include('templates/navbar'); ?>

        <!-- SIDEBAR -->
        <?php
        if (in_group('admin')) {
            echo $this->include('templates/admin/sidebar');
        } else {
            echo $this->include('templates/cs/sidebar');
        }
        ?>

        <!-- PAGE CONTENT -->
        <?= $this->renderSection('page-content') ?>

        <!-- FOOTER -->
        <?= $this->include('templates/footer'); ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>/admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/admin-lte/dist/js/adminlte.min.js"></script>

    <script type="text/javascript">
        $(function() {

            // Fix modal auto-focus to make select2 working inside modal
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });
        // Digunakan apabila csrf token regenerate true
        // $(document).ajaxSuccess(function(e, x) {
        //     var result = $.parseJSON(x.responseText);
        //     $('input:hidden[name="<?= csrf_token() ?>"]').val(result.token);
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': result.token
        //         }
        //     });
        // });
    </script>

    <!-- ADDITIONAL JAVASCRIPT -->
    <?= $this->renderSection('javascript') ?>

</body>

</html>