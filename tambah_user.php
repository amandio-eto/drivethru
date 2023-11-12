<script>
	function validasi() {
		var username = document.getElementById('username').value;
		var nama = document.getElementById('nama').value;
		var password = document.getElementById('password1').value;
		var cek_password = document.getElementById('password2').value;
		if (username == '') {
			alert("username labele Mamuk");
			document.getElementById('nama').focus();
			return false;
		}
		if (password == '') {
			alert("Senha Labele Mamuk");
			document.getElementById('password').focus();
			return false;
		}
		if (password != cek_password) {
			alert("Senha Confirmação labele Mamuk");
			document.getElementById('password1').focus();
			return false;
		}
		return true;
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
		<li>
			<a href="index.php?menu=user">Usuários</a>
		</li>
		<li class="active">Cria usuários</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" role="form" action='user_act.php?jns=baru' method='post' name='form1'
				id='form1' onsubmit='return validasi();'>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> usuário </label>
					<div class="col-sm-5">
						<input type="text" name="username" id="username" value="" maxlength="30" class="form-control"
							autocomplete="off" required autofocus />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Senha </label>
					<div class="col-sm-5">
						<input type="password" name="password" id="password1" value="" maxlength="30"
							class="form-control" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Senha Usuários
					</label>
					<div class="col-sm-5">
						<input type="password" name="password" id="password2" value="" maxlength="30"
							class="form-control" required />
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