<script type="text/javascript">
	function konfirmasi_hapus() {
		tanya = confirm("Ita Boot Hakarak Elemina Dados Refere ?");
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
		<li class="active">Usuárias</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<?php if (isset($_GET['error'])) {
				if ($_GET['error'] == 1) { ?>
					<div class="alert alert-danger" role="alert">
						<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
						<span class="sr-only">Error:</span>
						Username iha Ona
					</div>

				<?php }
			}
			?>
			<div style="margin-bottom:10px">
				<a class="btn btn-primary btn-sm" href="?menu=tambah_user">
					<i class="glyphicon glyphicon-plus icon-white"></i>
					Cria Utilizador
				</a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-datatable" id="data_grid">
					<thead>
						<tr>
							<th class="text-right" width="80px">No</th>
							<th>Username</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$q = mysqli_query($conn, "select * from user where username not in ('webmaster','agustinus') order by username");
						if (mysqli_num_rows($q) > 0) {
							$i = 0;
							while ($row = mysqli_fetch_array($q)) {
								extract($row);
								$i++;
								if ($aktif == 'Y')
									$naktif = "<i class='fa fa-check'></i>";
								else
									$naktif = '';
								?>
								<tr>
									<td class="text-right">
										<?php echo $i; ?>
									</td>
									<td>
										<?php echo $username; ?>
									</td>
									<td>
										<a class="btn btn-primary btn-xs" href="?menu=edit_user&id=<?php echo $id; ?>"
											title="Editar">
											&nbsp;<i class="glyphicon glyphicon-pencil icon-white"></i>&nbsp;</a>

										&nbsp;<a class="btn btn-info btn-xs" href="?menu=akses_menu&id=<?php echo $id; ?>"
											title="Direito de acesso">
											&nbsp;<i class="fa fa-key icon-white"></i>&nbsp;</a>

										&nbsp;<a class="btn btn-danger btn-xs"
											href="user_act.php?jns=hapus&id=<?php echo $id; ?>"
											onclick="return konfirmasi_hapus();" title="Eleminar">
											&nbsp;<i class="glyphicon glyphicon-trash icon-white"></i>&nbsp;</a>
									</td>
								</tr>
							<?php }
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><!-- /.row -->
</div><!-- /.page-content -->