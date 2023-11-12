<script type="text/javascript">
    function konfirmasi_hapus() {
        tanya = confirm("Apakah data akan dihapus ?");
        if (tanya == true) return true;
        else return false;
    }
</script>

<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) { }
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="index.php">Home</a>
        </li>
        <li class="active">Relatório de Vendas</li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action='pdf_penjualan.php' method='get' name='form1' id='form1'>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Data de início </label>
                    <div class="col-sm-2">
                        <input type="text" name="tgl1" id="tgl1" value="<?php echo date('d-m-Y') ?>"
                            class="form-control date-picker" data-date-format="dd-mm-yyyy" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Até a data </label>
                    <div class="col-sm-2">
                        <input type="text" name="tgl2" id="tgl2" value="<?php echo date('d-m-Y') ?>"
                            class="form-control date-picker" data-date-format="dd-mm-yyyy" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Tipo Relatorio </label>
                    <div class="col-sm-2">
                        <select name="jenis" class="form-control">
                            <option value="1">Resumo</option>
                            <option value="2">Detailho</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Tipo de Pagamento
                    </label>
                    <div class="col-sm-2">
                        <select name="jns_bayar" class="form-control">
                            <option value="0">Todos</option>
                            <option value="1">Dinheiro</option>
                            <option value="2">Cartão de crédito</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Chasier </label>
                    <div class="col-sm-2">
                        <select name="kasir" class="form-control">
                            <option value="0">Todos</option>
                            <?php
                            $q = mysqli_query($conn, "select id,username from user where id in (select user from hak_akses where menu='KASIR' and akses='Y') order by username");
                            if (mysqli_num_rows($q) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_array($q)) {
                                    extract($row); ?>
                                    <option value="<?php echo $id ?>">
                                        <?php echo $username ?>
                                    </option>
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="submit" value="Visualização" class="btn btn-primary">&nbsp;
                        <a type="button" class="btn btn-danger" href="index.php">Cancela</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->