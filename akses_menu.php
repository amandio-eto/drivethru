<?php
require_once './Controller/ControllerAcessMenu.php';
?>










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
        <li class="active">Direitos de Acesso ao menu</li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" action='akses_menu_act.php' method='post' name='form1' id='form1'
                onsubmit='return validasi();'>
                <input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> utilizador </label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" id="nama" value="<?php echo $username ?>" maxlength="20"
                            class="form-control" readonly />
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center" width="80px">No</th>
                        <th class="">Nome</th>
                        <th width="60px" class="text-center">Access</th>
                    </tr>
                    <?php
					$q = mysqli_query($conn, "select menu,nama,akses,m.id as idmenu from hak_akses h 
						                         left outer join menu m on (h.menu=m.kode) where user='$userid'
						                         union  
												 select kode as menu,nama,'N',id as idmenu from menu 
												 where kode not in (select menu from hak_akses where user='$userid') order by idmenu");
					if (mysqli_num_rows($q) > 0) {
						$i = 0;
						while ($row = mysqli_fetch_array($q)) {
							extract($row);
							$i++;
							if ($akses == 'Y')
								$ck = "checked";
							else
								$ck = "";
							?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            <?php echo $nama ?>
                        </td>
                        <td class="text-center"><input type="hidden" name="menu<?php echo $i ?>"
                                value="<?php echo $menu ?>"><input type="checkbox" name="akses<?php echo $i ?>"
                                value="Y" <?php echo $ck ?>></td>
                    </tr>
                    <?php }
					} ?>
                    <input type="hidden" name="jml_menu" value="<?php echo $i ?>">
                </table>
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
</div><!-- /.page-content