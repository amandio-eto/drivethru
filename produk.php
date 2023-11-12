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
			<li class="active">Produk</li>
		</ul><!-- /.breadcrumb -->
	</div>

	<div class="page-content">			
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div style="margin-bottom:10px">	
					<a class="btn btn-primary btn-sm" href="?menu=tambah_produk">
						<i class="glyphicon glyphicon-plus icon-white"></i>
						Tambah Produk
					</a>
				</div>	
				<div class="table-responsive">
				<table class="table table-bordered table-datatable" id="data_grid">
				<thead>
					<tr>
						<th class="text-right" width="80px">No</th>
						<th class="text-center" width="100px">Gambar</th>
						<th class="text-center">Nama Produk</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">SKU</th>
						<th class="text-center">Barcode</th>
						<th class="text-center" width="150px">Harga</th>
						<th class="text-center" width="100px">Aktif</th>
						<th width="120px">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$q = mysqli_query($conn,"select * from produk order by id");
					if (mysqli_num_rows($q)>0) 
					{
						$i=0; 
						while($row = mysqli_fetch_array($q)) {
							extract($row);
							$i++;
							$nkategori=AmbilData("select nama from kategori where id=$kategori");
							if ($aktif=='Y')  $naktif="<i class='fa fa-check'></i>"; else $naktif='';
						?>
							<tr>
								<td class="text-right"><?php echo $i;?></td>
								<td>
								    <?php if($gambar!=''){?>     
										<img src="img/produk/<?php echo $gambar;?>" height="40px">
									<?php } else { ?>
										<img src="img/food_no_image.png" height="40px">
									<?php } ?>	
								</td>
								<td><?php echo $nama;?></td>
								<td><?php echo $nkategori;?></td>
								<td><?php echo $sku;?></td>
							    <td><?php echo $barcode;?></td>
								<td class="text-right"><?php echo FormatAngka($harga);?></td>
								<td class="text-center"><?php echo $naktif;?></td>
								<td>
									<a class="btn btn-primary btn-xs" href="?menu=edit_produk&id=<?php echo $id;?>">
										&nbsp;<i class="glyphicon glyphicon-pencil icon-white"></i>&nbsp;</a>
									&nbsp;<a class="btn btn-danger btn-xs" href="produk_act.php?jns=hapus&id=<?php echo $id;?>" onclick="return konfirmasi_hapus();">
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