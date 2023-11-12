<?php
session_start();
require_once 'konfig.php';
require_once 'fungsi_umum.php';


function berhak($menu)
{
    /*$user=$_SESSION['user'];
             $userid=AmbilData("select id from user where username='$user'");
             
             if (AdaData("select menu from hak_akses where user='$userid' and menu='SUPER' and akses='Y'")){
                 return true;
             }
             if (AdaData("select menu from hak_akses where user='$userid' and menu='$menu' and akses='Y'")){
                 return true;
             } else return false;*/
    return true;
}


if (isset($_GET['menu']))
    $menu = mysqli_real_escape_string($conn, $_GET['menu']);
else
    $menu = "";

if ($_SESSION['key'] != 'DRIVE_THRU')
    header('Location:login.php');
else {
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>CHICK ETO</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="author" content="Sugeng Miarsoadi">

    <!--<link href="img/favicon.png" rel="icon">-->
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/fonts/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="assets/js/datatables/media/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="assets/css/datepicker.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="assets/css/chosen.min.css" />
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link rel="icon" href="img/logo_header.png">


    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css?v=0" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
            <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->

    <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

    <!-- inline styles related to this page -->
    <script src="assets/js/jquery.2.1.1.min.js"></script>
    <script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery.min.js'>" + "<" + "/script>");
    </script>

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>
    <script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write(
        "<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatables/media/js/DT_bootstrap.js"></script>
    <!-- page specific plugin scripts -->
    <script src="assets/js/jquery-ui.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/chosen.jquery.min.js"></script>
    <script src="assets/js/jquery.autosize.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/bootstrap-fileupload.min.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script src="assets/js/bootstrap-timepicker.min.js"></script>
    <script src="assets/qrcodejs/qrcode.js"></script>
    <script src="assets/js/jquery.easypiechart.min.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/jquery.flot.min.js"></script>
    <script src="assets/js/jquery.flot.pie.min.js"></script>
    <script src="assets/js/jquery.flot.resize.min.js"></script>

    <!--[if lte IE 8]>
          <script src="assets/js/excanvas.min.js"></script>
        <![endif]-->

    <!-- ace scripts -->
    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ">
        <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {}
        </script>

        <div class="navbar-container" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="index.php" class="navbar-brand">
                    <div style="padding-top:10px;font-weight:700">
                        <img src="img/chicketo.jpeg" height="32px">
                        CHICKETO &nbsp; &nbsp; <span style="color:#FFD764; font-family: Tahom;font-weight:900">
                        </span>
                    </div>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li>
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="User Photo" />
                            <span class="user-info">
                                <?php $username = $_SESSION['user'] ?>
                                <b>
                                    <?php echo $username ?>
                                </b>
                                <?php
                                    $userid = AmbilData("select id from user where username='$username'");
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='AMBIL_CS'");
                                    if ($hak == 'Y')
                                        $sebagai = 'pengambilan_cs';
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='KASIR_CS'");
                                    if ($hak == 'Y')
                                        $sebagai = 'kasir_cs';
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='KASIR'");
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='ADMIN'");
                                    if ($hak == 'Y')
                                        $sebagai = 'admin';
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='KASIR'");
                                    if ($hak == 'Y')
                                        $sebagai = 'kasir';
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='OUTDOOR'");
                                    if ($hak == 'Y')
                                        $sebagai = 'outdoor';
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='DAPUR'");
                                    if ($hak == 'Y')
                                        $sebagai = 'dapur';
                                    $hak = AmbilData("select akses from hak_akses where user='$userid' and menu='PENGAMBILA'");
                                    if ($hak == 'Y')
                                        $sebagai = 'pengambilan';
                                    ?>
                                <div style="font-size:11px;color:#fdf">
                                    <?php echo $sebagai ?>
                                </div>
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul
                            class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="logout.php">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container" id="main-container">
        <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {}
        </script>

        <?php if (($sebagai == 'kasir') || ($sebagai == 'outdoor') || ($sebagai == 'pengambilan') || ($sebagai == 'dapur')) { ?>

        <?php } else if ($sebagai == 'admin') { ?>
        <div id="sidebar" class="sidebar        responsive">
            <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'fixed')
            } catch (e) {}
            </script>

            <ul class="nav nav-list">
                <?php if ($menu == "")
                            $act = "active";
                        else
                            $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="index.php">
                        <i class="menu-icon fa fa-tachometer"></i>
                        <span class="menu-text"> Dashboard </span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <?php if (berhak('KATEGORI')) {
                            if ($menu == "kategori")
                                $act = "active";
                            else
                                $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="?menu=kategori">
                        <i class="menu-icon fa fa-th-large"></i>
                        <span class="menu-text"> Categoria </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php } ?>

                <?php if (berhak('PRODUK')) {
                            if ($menu == "produk")
                                $act = "active";
                            else
                                $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="?menu=produk">
                        <i class="menu-icon fa fa-cube"></i>
                        <span class="menu-text"> Produtos </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php } ?>

                <?php if (berhak('VOUCHER')) {
                            if ($menu == "voucher")
                                $act = "active";
                            else
                                $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="?menu=voucher">
                        <i class="menu-icon glyphicon glyphicon-tags"></i>
                        <span class="menu-text"> Voucher </span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php } ?>

                <?php if (berhak('USER')) {
                            if ($menu == "user")
                                $act = "active";
                            else
                                $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="?menu=user">
                        <i class="menu-icon glyphicon glyphicon-user "></i>
                        <span class="menu-text"> Usuárias</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php } ?>


                <?php if (berhak('LAP_JUAL')) {
                            if ($menu == "lap_penjualan")
                                $act = "active";
                            else
                                $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="?menu=lap_penjualan">
                        <i class="menu-icon fa fa-shopping-cart "></i>
                        <span class="menu-text">Relatório de Vendas</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php } ?>

                <?php if (berhak('SETTING')) {
                            if ($menu == "setting")
                                $act = "active";
                            else
                                $act = ""; ?>
                <li class="<?php echo $act ?>">
                    <a href="?menu=setting">
                        <i class="menu-icon glyphicon glyphicon-cog"></i>
                        <span class="menu-text">Configuração</span>
                    </a>
                    <b class="arrow"></b>
                </li>
                <?php } ?>

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
                        data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>

                <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {}
                </script>
            </ul>
        </div>
        <?php } ?>
        <div class="main-content">
            <div class="main-content-inner">

                <?php
                    if (($sebagai == 'kasir') || ($sebagai == 'kasir_cs'))
                        include "kasir.php";
                    else if ($sebagai == 'outdoor')
                        include "outdoor.php";
                    else if ($sebagai == 'pengambilan')
                        include "pengambilan.php";
                    else if ($sebagai == 'pengambilan_cs')
                        include "pengambilan_cs.php";
                    else if ($sebagai == 'dapur')
                        include "dapur.php";
                    else {
                        if ($menu == '')
                            include "dashboard.php";
                        else
                            include "$menu.php";
                    }
                    ?>

            </div>
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content" style="padding:5px">
                    Developer Esperança Timor Oan &copy; 2023
                    &nbsp;
                </div>
            </div>
        </div>
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->

    <!-- <![endif]-->

    <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

</body>

</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#data_grid').dataTable({
        "aaSorting": [
            [0, "asc"]
        ],
        "sDom": "<'box-content'<'col-sm-3'l><'col-sm-9'f><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sSearch": "Search &nbsp; ",
            "sLengthMenu": 'Show _MENU_ entries',
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });

    $('#data_grid2').dataTable({
        "aaSorting": [
            [0, "desc"]
        ],
        "sDom": "<'box-content'<'col-sm-3'l><'col-sm-9'f><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sSearch": "Search &nbsp; ",
            "sLengthMenu": 'Show _MENU_ entries',
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });

    $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
    })

});

jQuery(function($) {
    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
        //resize the chosen on window resize

        $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({
                        'width': $this.parent().width()
                    });
                })
            }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
                var $this = $(this);
                $this.next().css({
                    'width': $this.parent().width()
                });
            })
        });


        $('#chosen-multiple-style .btn').on('click', function(e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });
    }

    $('#modal-form').on('shown.bs.modal', function() {
        if (!ace.vars['touch']) {
            $(this).find('.chosen-container').each(function() {
                $(this).find('a:first-child').css('width', '210px');
                $(this).find('.chosen-drop').css('width', '210px');
                $(this).find('.chosen-search input').css('width', '200px');
            });
        }
    })
    /**
    //or you can activate the chosen plugin after modal is shown
    //this way select element becomes visible with dimensions and chosen works as expected
    $('#modal-form').on('shown', function () {
        $(this).find('.modal-chosen').chosen();
    })
    */
});
</script>
<?php } ?>