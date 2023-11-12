<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
    $bukti = mysqli_escape_string($conn,$_GET['bukti']);
		
	$q = mysqli_query($conn,"select * from transaksi_detail where bukti='$bukti' order by id");
	if (mysqli_num_rows($q)>0) 
	{
		$i=0; 
		while($row = mysqli_fetch_array($q)) {
			extract($row); 
			$gambar=AmbilData("select gambar from produk where id=$produk");
			$nama_barang=AmbilData("select nama from produk where id=$produk");
		?>
		   <div style="border-bottom:1px solid #d5d5d5;margin:5px 0;padding-bottom:4px">
			    <div style="font-size:16px;padding:2px;font-weight:700"><img src="img/produk/<?php echo $gambar?>" width="40px"> <?php echo $nama_barang ?></div>
				<table width="100%">
					<tr>
					   <td style="padding:0 6px">
							<div class="input-group-btn" >
								<div class="btn-group"> 
									<div class="input-group">
										<div class="input-group-btn">
										  <button class="btn btn-sm" type="button" onclick="ubah_qty(<?php echo $id?>,'-')">
											<i class="glyphicon glyphicon-minus"></i>
										  </button>
										</div>
										<input type="text" class="form-control text-center" size="3" value="<?php echo FormatAngka($qty);?>" readonly>
										<div class="input-group-btn">
										  <button class="btn btn-sm" type="button" onclick="ubah_qty(<?php echo $id?>,'+')">
											<i class="glyphicon glyphicon-plus"></i>
										  </button>
										</div>
									</div>
								</div>
							</div>
						</td>
						<td>									
							<div style="font-size:18px;padding:4px;text-align:right;color:red;width:100%"><?php echo '$ '.FormatAngka($hsatuan);?></div>
						</td>
					</tr>
				</table>
		   </div>
<?php	}
	}
?>			