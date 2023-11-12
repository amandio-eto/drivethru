<script type="text/javascript">
	function konfirmasi_hapus() {
		tanya = confirm("Confirmação Ita Boot hakarak Elemina Dados refere ?");
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
		<li class="active">Voucher</li>
	</ul><!-- /.breadcrumb -->
</div>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div style="margin-bottom:10px">
				<a class="btn btn-primary btn-sm" href="?menu=tambah_voucher">
					<i class="glyphicon glyphicon-plus icon-white"></i>
					Cria Voucher
				</a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-datatable" id="data_grid">
					<thead>
						<tr>
							<th class="text-right" width="80px">No</th>
							<th class="text-center">Code</th>
							<th class="text-center" width="100px">Discounto %</th>
							<th class="text-center" width="150px">Valor Discounto</th>
							<th class="text-center" width="150px">Quota</th>
							<th class="text-center" width="120px">Ativo</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$q = mysqli_query($conn, "select * from voucher order by id");
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
										<?php echo $kode; ?>
									</td>
									<td class="text-right">
										<?php echo FormatAngka($disc); ?>
									</td>
									<td class="text-right">
										<?php echo FormatAngka($ndisc); ?>
									</td>
									<td class="text-right">
										<?php echo $quota; ?>
									</td>
									<td class="text-center">
										<?php echo $naktif; ?>
									</td>
									<td>
										<a class="btn btn-primary btn-xs" href="?menu=edit_voucher&id=<?php echo $id; ?>">
											&nbsp;<i class="glyphicon glyphicon-pencil icon-white"></i>&nbsp;</a>
										&nbsp;<a class="btn btn-danger btn-xs"
											href="voucher_act.php?jns=hapus&id=<?php echo $id; ?>"
											onclick="return konfirmasi_hapus();">
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