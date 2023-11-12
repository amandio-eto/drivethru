<div class="row p-2">
<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
    $q = mysqli_query($conn,"select d.*,t.cust,t.catatan from transaksi_detail d 
					left outer join transaksi t on(t.bukti=d.bukti)
					left outer join produk p on(p.id=d.produk)
					left outer join kategori k on(k.id=p.kategori)
					where status='2' and jns_kasir='2' and k.proses_dapur='Y' and diambil<>'Y' order by d.bukti,d.id");
	if (mysqli_num_rows($q)>0) 
	{
		$i=0; $bukti_lama='';
		while($row = mysqli_fetch_array($q)) {
			extract($row); 
			if($bukti<>$bukti_lama){
				$bukti_lama=$bukti;
				?>
				<div class="col-md-12">
				   <div style="font-size:16px;font-weight:700;background:#f5f5f5;padding:4px 8px;border:1px solid #ccc"># <?php echo substr($bukti,-3)?> <span style="color:red;font-weight:500"><?php if($catatan!='') echo ' ==> '.$catatan ?></span></div>
				</div>
			<?php }
			$gambar=AmbilData("select gambar from produk where id=$produk");
			$nama_barang=AmbilData("select nama from produk where id=$produk");
		?>
		   <div class="col-md-2">
		      <div style="padding:8px;border:1px solid #ccc;border-radius:8px;margin:5px;">
					<table width="100%" cellpadding="2">
						<tr>
							<td>
							   <div style="font-size:22px;padding:2px;font-weight:700"><img src="img/produk/<?php echo $gambar?>" width="70px"> </div>	
							</td>
							<td style="font-size:30px;font-weight:700;text-align:center" width="80px">
								x <?php echo FormatAngka($qty);?>
							</td>
						</tr>
						<tr><td colspan="2" style="font-size:16px;"><?php echo $nama_barang ?></td></tr>
					</table>
			  </div>	
		   </div>
<?php	}
	}
?>			
</div>