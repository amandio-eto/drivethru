<script>
    function load_makanan(kat) {
        $.ajax({
            url: "load_makanan.php",
            type: "get",
            data: "kategori=" + kat,
            dataType: "html",
            success: function(data) {
                $("#blok_makanan").html(data);
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function cari() {
        var kat = $("#cari").val();
        $.ajax({
            url: "cari_makanan.php",
            type: "get",
            data: "kata=" + kat,
            dataType: "html",
            success: function(data) {
                $("#blok_makanan").html(data);
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function load_detail() {
        var bukti = $("#bukti").val();
        $.ajax({
            url: "load_detail.php",
            type: "get",
            data: "bukti=" + bukti,
            dataType: "html",
            success: function(data) {
                $("#blok_detail").html(data);
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function load_total() {
        var bukti = $("#bukti").val();
        $.ajax({
            url: "load_total.php",
            type: "get",
            data: {
                "bukti": bukti,
                "kasir_cs": "Y" // kasir minimarket
            },
            dataType: "html",
            success: function(data) {
                $("#blok_total").html(data);
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function tambah_makanan(id) {
        var bukti = $("#bukti").val();
        var catatan = $("#note").val();
        var tgl = $("#tgl").val();
        var cust = $("#cust").val();
        var telp = $("#telp").val();
        $.ajax({
            url: "kasir_act.php?jns=tbprod",
            type: "post",
            data: {
                produk: id,
                tgl: tgl,
                bukti: bukti,
                cust: cust,
                telp: telp,
                catatan: catatan
            },
            dataType: "html",
            success: function(data) {
                load_detail();
                load_total();
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function scan_barcode(id) {
        $.ajax({
            url: "cek_barcode.php",
            type: "get",
            data: {
                barcode: id
            },
            dataType: "html",
            success: function(data) {
                if (data != '') {
                    tambah_makanan(data);
                    $("#barcode").val("");
                } else alert("barcode / sku tidak terdaftar");
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function ubah_qty(id, tanda) {
        var bukti = $("#bukti").val();
        $.ajax({
            url: "kasir_act.php?jns=ubahqty",
            type: "post",
            data: {
                bukti: bukti,
                id: id,
                tanda: tanda
            },
            dataType: "html",
            success: function(data) {
                load_detail(bukti);
                load_total(bukti);
            },
            error: function(data) {
                alert(data);
            }
        })
    }

    function tambah_catatan() {
        $("#ModalNote").modal('show');
    }

    function konfirmasi_set_kasir() {
        tanya = confirm("Apakah anda bertindak sebagai kasir Outdoor ?");
        if (tanya == true) return true;
        else return false;
    }
</script>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {}
    </script>
    <div>
        <div style="float:left;width:80px;padding:0 10px">Search</div>
        <div style="float:left;width:300px">
            <input type="text" id="cari" style="padding:3px 5px;height:25px;width:100%" onkeyup="cari()">
        </div>
        <div style="margin-left:50px;float:left;width:100px">
            <?php
            $userid = AmbilData("select id from user where username='$username'");
            $stat_kasir = AmbilData("select kasir from kasir_outdoor where kasir='$userid'");
            if ($stat_kasir != '') $btn = 'success';
            else $btn = "secondary"
            ?>
            <a href="kasir_act.php?jns=setks&kasir=<?php echo $userid ?>" class="btn btn-<?php echo $btn ?> btn-xs" style="font-size:14px" onclick="return konfirmasi_set_kasir()"> Kasir Outdoor </a>
        </div>
    </div>
</div>
<div>
    <table>
        <tr style="vertical-align:top">
            <td width="74px">
                <div style="float:left;width:74px;background:#f4f4f4;height:470px;">
                    <?php
                    $q = mysqli_query($conn, "select * from kategori order by id");
                    if (mysqli_num_rows($q) > 0) {
                        $i = 0;
                        while ($row = mysqli_fetch_array($q)) {
                            extract($row);
                    ?>
                            <button type="button" onclick="load_makanan(<?php echo $id ?>)" style="margin:2px 0;">
                                <div class="text-center" style="margin:10px 0;">
                                    <img src="img/kategori/<?php echo $gambar ?>" width="60px">
                                    <div><?php echo $nama ?></div>
                                </div>
                            </button>
                    <?php    }
                    }
                    ?>
                </div>
            </td>
            <td width="1300px">
                <div style="width:100%;overflow:auto;background:#fafafa" id="blok_makanan">

                </div>
            </td>
            <td width="300px" style="padding:5px 8px;border:1px solid #ddd">
                <div>
                    <?php
                    $tb = date('ymd');
                    $ksr = str_pad($userid, 3, '0', STR_PAD_LEFT);
                    $noakhir = AmbilData("select noakhir from nourut where tgl='$tb$ksr'");
                    if ($noakhir == '') {
                        $nourut = '001';
                        $bukti = $tb . $ksr . $nourut;
                    } else {
                        $noakhir++;
                        $nourut = str_pad($noakhir, 3, '0', STR_PAD_LEFT);
                        $bukti = $tb . $ksr . $nourut;
                    }
                    ?>
                    <div style="font-size:18px;width:140px;float:left">
                        No Order : <b>#<?php echo $nourut ?></b>
                    </div>
                    <input id="tgl" name="tgl" value="<?php echo date('d-m-Y') ?>" class="date-picker" data-date-format="dd-mm-yyyy" style="width:85px;padding:2px 3px;float:right">
                    <input type="hidden" name="bukti" id="bukti" value="<?php echo $bukti ?>">
                </div>
                <input id="cust" name="cust" placeholder="Customer Name" style="width:100%;margin:2px">
                <input id="telp" name="telp" placeholder="Handphone" style="width:100%;margin:2px">
                <div><button class="btn btn-sm btn-primary" style="width:100%" onclick="tambah_catatan()">Note</button></div>
                <input id="barcode" name="barcode" placeholder="SKU / Barcode" style="width:100%;margin:2px">
                <div style="height:270px;overflow:auto;border:1px solid #bbb" id="blok_detail">

                </div>
                <div style="font-size:16px;font-weight:700;border-top:2px solid #ccc;padding:6px" id="blok_total">

                </div>
            </td>
        </tr>
    </table>
</div>
</div><!-- /.row -->

<!-- Modal Bayar CS -->
<div id="modalProceedPayment" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pembayaran</h4>
            </div>
            <div class="modal-body" id="modal_form_bayar">
                
            </div>
        </div>
    </div>
</div>

<div id="ModalNote" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notes</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" id="form_jurnal" action="transaksi_detail.php">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea style="width:100%" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>

    <script>
        
        function ubah_jenis_bayar(){
            var jns=$("#jns_bayar").val();
            if(jns=='1') $("#no_kartu").css('visibility', 'hidden');
            else  $("#no_kartu").css('visibility', 'visible');;
        }

        function get_data_bayar(){
            $.ajax({
            url: "load_detail_cs.php",
            type: "GET",
            data: {
                bukti: bukti,
                kasir: <?php echo $userid ?>,
            },
            dataType: "html",
            success: function(data) {
                $("#modal_form_bayar").html(data);
            },
            error: function(data) {
                alert(data);
            }
        })
        }

        var bukti = $("#bukti").val();
        load_makanan(1);
        load_detail(bukti);
        load_total(bukti);

        $("#barcode").on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                var bar = $("#barcode").val();
                scan_barcode(bar);
            }
        });
    </script>