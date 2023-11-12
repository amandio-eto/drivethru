<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   $kategori = mysqli_escape_string($conn,$_GET['kategori']);
		
	$q = mysqli_query($conn,"select * from produk where kategori=$kategori order by id");
	if (mysqli_num_rows($q)>0) 
	{
		$i=0; 
		while($row = mysqli_fetch_array($q)) {
			extract($row); 
		?>
		   <a href="javascript:void(0)" onclick="tambah_makanan(<?php echo $id?>)" style="background:#fff;">
			   <div class="text-center" style="width:185px;background:#fff;padding:5px 8px;margin:4px 4px;border:1px solid #ccc;float:left">
					<img src="img/produk/<?php echo $gambar?>" width="100px">
					<div style="font-size:15px;font-weight:600;color:#222"><?php echo $nama?></div>
					<div style="font-size:19px;font-weight:500;color:red"><?php echo '$ '.FormatAngka($harga)?></div>
			   </div>
		   </a>	 
<?php	}
	}
?>			