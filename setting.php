<?php
$q = mysqli_query($conn, "select * from setting");
$row = mysqli_fetch_array($q);
extract($row);
?>

</script>

<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
    try {
        ace.settings.check('breadcrumbs', 'fixed')
    } catch (e) {}
    </script>

    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="index.php">Home</a>
        </li>
        <li class="active">Configuração</li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action='setting_act.php?jns=edit' method='post' name='form1'
                id='form1'>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Nome do
                        Restaurante</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" id="nama" value="<?php echo $nama_pt ?>" maxlength="50"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Endereço </label>
                    <div class="col-sm-4">
                        <input type="text" name="alamat" id="alamat" value="<?php echo $alamat ?>" maxlength="50"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Telefone </label>
                    <div class="col-sm-4">
                        <input type="text" name="telp" id="telp" value="<?php echo $telp ?>" maxlength="20"
                            class="form-control" />
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" value="Gurda" class="btn btn-success">&nbsp;
                        <a type="button" class="btn btn-danger" href="index.php">Cancela</a>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->