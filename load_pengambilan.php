<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
?>   
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="text-center" width="90px">Kasir</th>
				<th class="text-right" width="90px">No Order</th>
				<th class="text-center" width="160px">Time</th>
				<th class="text-center">Customer</th>
				<th class="text-center" width="80px">Status</th>
				<th class="text-right" width="100px">Total</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$sekarang=date('Y-m-d');
			//where tgl='$sekarang'
			$q = mysqli_query($conn,"select * from transaksi where status<>'0' and jns_kasir='1' order by waktu");
			if (mysqli_num_rows($q)>0) 
			{
				$i=0; 
				while($row = mysqli_fetch_array($q)) {
					extract($row);
					$i++; 
					if($kasir!='')
					   $nkasir=AmbilData("select username from user where id=$kasir");
					else $nkasir=''; 
					?>
				  <tr>
					  <td><a href="javascript:void(0)" style="color:#111;text-decoration: none; " onclick="load_detail('<?php echo $bukti?>')"><div><?php echo $nkasir?></div></a></td>
					  <td><a href="javascript:void(0)" style="color:#111;text-decoration: none; " onclick="load_detail('<?php echo $bukti?>')"><div><?php echo substr($bukti,-3)?></div></a></td>
					  <td><a href="javascript:void(0)" style="color:#111;text-decoration: none; " onclick="load_detail('<?php echo $bukti?>')"><div><?php echo FormatTgl($waktu,'A1').' | '.FormatTgl($waktu,'J') ?></div></a></td>
					  <td><a href="javascript:void(0)" style="color:#111;text-decoration: none; " onclick="load_detail('<?php echo $bukti?>')"><div><?php echo $cust?>&nbsp;</div></a></td>
					  <td class="text-center"><a href="javascript:void(0)"  style="color:#111;text-decoration: none; " onclick="load_detail('<?php echo $bukti?>')"><div><?php 
							if($status=='1') echo 'Order'; 
							else if($status=='2') echo 'Lunas';
							else if($status=='3') echo 'Batal';?></div></a>
					  </td>
					  <td class="text-right"><a href="javascript:void(0)" style="color:#111;text-decoration: none; " onclick="load_detail('<?php echo $bukti?>')"><div><?php echo '$ '.FormatAngka($total)?></div></a></td>
				  </tr>  	
			<?php } 
			}?>		
   </table>