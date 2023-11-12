<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
    $bukti = mysqli_escape_string($conn,$_GET['bukti']);
	$total=AmbilData("select total from transaksi where BUKTI='$bukti'");
	$sub_total=AmbilData("select sub_total from transaksi where BUKTI='$bukti'");
	$ppn=AmbilData("select ppn from transaksi where BUKTI='$bukti'");
	$status=AmbilData("select status from transaksi where BUKTI='$bukti'");
	$jns_kasir=AmbilData("select jns_kasir from transaksi where BUKTI='$bukti'");
	$diambil=AmbilData("select diambil from transaksi where BUKTI='$bukti'");
	$catatan=AmbilData("select catatan from transaksi where BUKTI='$bukti'");
	?>
	<input type="hidden" id="bukti" value="<?php echo $bukti?>">	
	<input type="hidden" id="sub_total" value="<?php echo FormatAngka($sub_total)?>">
	<input type="hidden" id="ppn" value="<?php echo FormatAngka($ppn)?>">	
	<input type="hidden" id="total" value="<?php echo FormatAngka($total)?>">	
	<div style="padding:10px 18px;overflow:auto;font-weight:700;font-size:20px;background:#f1f1f1;border:1px solid #ddd;border-radius:10px">
	   <div style="float:left;width:280px;color:#555">Detail Pemesanan : #<?php echo substr($bukti,-3)?></div>
	   <div style="float:right;width:100px;text-align:center">
	      <?php if($jns_kasir==1){
			      if($status=='2'){?> 
						 <div style="color:#97B49A;padding:1px 4px;border:2px solid #97B49A">LUNAS</div>
					  <?php } else if($status=='3'){?> 	 
						 <div style="color:#B86B69;padding:1px 4px;border:2px solid #B86B69">BATAL</div>
					  <?php } 
		        } else {
					if($diambil=='N'){?> 
						 <div style="color:#97B49A;padding:1px 4px;border:2px solid #97B49A">LUNAS</div>
					  <?php } else {?>
						 <div style="color:#A2CAFF;padding:1px 4px;border:2px solid #A2CAFF">DIAMBIL</div>
					 <?php }
				}?>	
	   </div>
	</div>  
	<div style="height:335px;overflow:auto;">
    <?php					
	$q = mysqli_query($conn,"select * from transaksi_detail where bukti='$bukti' order by id");
	if (mysqli_num_rows($q)>0) 
	{
		$i=0; 
		while($row = mysqli_fetch_array($q)) {
			extract($row); 
			$gambar=AmbilData("select gambar from produk where id=$produk");
			$nama_barang=AmbilData("select nama from produk where id=$produk");
		?>
		   <div style="border-bottom:1px solid #d5d5d5;margin:5px 0;padding-bottom:4px;overflow:auto">
			    
				<table width="100%" cellpadding="1">
					<tr>
					    <td>
				 		 <div style="font-size:20px;padding:2px;font-weight:700"><img src="img/produk/<?php echo $gambar?>" width="40px"> <?php echo $nama_barang ?></div>	
					    </td>
					    <td style="font-size:20px;font-weight:700;" width="60px">
							x <?php echo FormatAngka($qty);?>
						</td>
						<td style="font-size:20px;padding-right:6px" width="130px">									
							<div style="text-align:right;color:red;width:100%;font-weight:700"><?php echo '$ '.FormatAngka($hsatuan);?></div>
						</td>
					</tr>
				</table>
		   </div>
<?php	}
	}
?>			
</div>
<div style="padding:10px;font-size:14px;height:60px">
Catatan : <b><?php echo $catatan ?></b>
</div>
<div style="padding:10px;overflow:auto;font-size:20px;font-weight:700;padding:6px 12px;background:#DFF6E1;border-radius:8px">
	<div style="width:200px;float:left;margin-top:4px">TOTAL : <?php echo '$ '.FormatAngka($total);?></div>
	<?php if($jns_kasir=='1'){?>
	<div style="float:right">
      <a href="slip.php?bukti=<?php echo $bukti?>" class="btn btn-primary btn-sm" target="_blank"><i style="font-size:20px" class="fa fa-print"></i></a> 	 
	  <?php if($status=='1'){?>
		  <button type="button" class="btn btn-success btn-sm" style="font-size:16px" onclick="bayar()">Bayar</button>
		  <button type="button" class="btn btn-danger btn-sm" style="font-size:16px"  onclick="batal()">Batal</button>
	  <?php } ?>	  
    </div>
	<?php } else { ?>		
			<div style="float:right">
			  <a href="slip.php?bukti=<?php echo $bukti?>" class="btn btn-primary btn-sm" target="_blank"><i style="font-size:20px" class="fa fa-print"></i></a> 	 
				<?php if($diambil<>'Y'){?>		
					<button type="button" class="btn btn-success btn-sm" style="font-size:16px" onclick="diambil()">Diambil</button>
				<?php } ?>	
			</div>
		<?php 
	}?>
</div>