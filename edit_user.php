<?php
$id = mysqli_escape_string($conn, $_GET['id']);
$q = mysqli_query($conn, "select * from user where id='$id'");
$row = mysqli_fetch_array($q);
extract($row);
?>
<script>
function validasi() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if (username == '') {
        alert("Username tidak boleh kosong");
        document.getElementById('nama').focus();
        return false;
    }
    if (password == '') {
        alert("Password tidak boleh kosong");
        document.getElementById('password').focus();
        return false;
    }
    return true;
}
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
        <li>
            <a href="index.php?menu=user">Usuárias</a>
        </li>
        <li class="active">Atualizar Usuárias</li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" action='user_act.php?jns=edit' method='post' name='form1'
                id='form1' onsubmit='return validasi();'>
                <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Usuário </label>
                    <div class="col-sm-5">
                        <input type="text" name="username" id="username" value="<?php echo $username ?>" maxlength="30"
                            class="form-control" autocomplete="off" readonly />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Password </label>
                    <div class="col-sm-5">
                        <input type="password" name="password" id="password1" maxlength="20" value=""
                            class="form-control" autofocus />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1">Password Confirmação
                    </label>
                    <div class="col-sm-5">
                        <input type="password" id="password2" maxlength="20" value="" class="form-control" />
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" value="Guarda" class="btn btn-primary">&nbsp;
                        <a type="button" class="btn btn-danger" href="?menu=user">Cancela</a>

                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->