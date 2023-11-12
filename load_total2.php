<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   $bukti = mysqli_escape_string($conn,$_GET['bukti']);
		
	$q = mysqli_query($conn,"select * from transaksi where bukti='$bukti'");
	if (mysqli_num_rows($q)>0) 
	{
		$i=0; 
		while($row = mysqli_fetch_array($q)) {
			extract($row); 
		?>
		   <div style="font-size:26px;font-weight:500;padding:10px 20px;border:1px solid #bbb;background:#efefef;border-radius:8px">
				No Order : <b>#<?php echo substr($bukti,-3)?></b>
		   </div>
		   <div style="margin-top:10px;font-size:26px;font-weight:800;padding:10px 20px;border:1px solid #bbb;border-radius:8px;background:#efefef">		   
			    <table width="100%">
					<tr><td>Sub Total</td><td class="text-right"><?php echo '$ '.FormatAngka($sub_total)?></td></tr>
					<tr><td>Tax</td><td class="text-right"><?php echo '$ '.FormatAngka($ppn)?></td></tr>
					<tr><td>Total</td><td class="text-right"><?php echo '$ '.FormatAngka($total)?></td></tr>
				</table>
			</div>	
<?php	}
	}
?>			