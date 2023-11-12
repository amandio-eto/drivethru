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
				<table width="98%" cellpadding="2" align="center">
					<tr>
					    <td>
				 		  <div style="font-size:24px;padding:2px;font-weight:700"><img src="img/produk/<?php echo $gambar?>" width="70px"> <?php echo $nama_barang ?></div>	
					    </td>
					    <td style="font-size:24px;font-weight:700;text-align:center" width="80px">
							x <?php echo FormatAngka($qty);?>
						</td>
						<td style="font-size:24px" width="130px">									
							<div style="padding:10px;text-align:right;color:red;width:100%;font-weight:700"><?php echo '$ '.FormatAngka($hsatuan);?></div>
						</td>
					</tr>
				</table>
		   </div>
<?php	}
	}
?>			