<script type="text/javascript">
	function konfirmasi_hapus()
   {
	   tanya = confirm("Apakah data akan dihapus ?");
	   if (tanya == true) return true;
	   else return false;
   }
</script>
	
	<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>

		<ul class="breadcrumb">
			<li>
				<i class="ace-icon fa fa-home home-icon"></i>
				<a href="index.php">Home</a>
			</li>
			<li class="active">Menu</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">			
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div class="table-responsive">
				<table class="table table-bordered table-datatable" id="data_grid">
				<thead>
					<tr>
						<th class="text-right" width="80px">No</th>
						<th>Menu</th>
						<th>Judul</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$q = mysqli_query($conn,"select * from menu order by urut");
					if (mysqli_num_rows($q)>0) 
					{
						$i=0; 
						while($row = mysqli_fetch_array($q)) {
							extract($row);
							$i++;
						?>
							<tr>
								<td class="text-right"><?php echo $i;?></td>
								<td><?php echo $menu;?></td>
								<td><?php echo strip_tags($judul);?></td>
								<td>
									<a class="btn btn-primary btn-xs" href="?menu=edit_menu&id=<?php echo $id;?>">
										&nbsp;<i class="glyphicon glyphicon-pencil icon-white"></i>&nbsp;</a>
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