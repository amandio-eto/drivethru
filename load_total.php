<?php
require_once 'konfig.php';
require_once 'fungsi_umum.php';

$bukti = mysqli_escape_string($conn, $_GET['bukti']);
$jns_trans = mysqli_escape_string($conn, $_GET['jns_trans']); 
$q = mysqli_query($conn, "select * from transaksi where bukti='$bukti'");
	if (mysqli_num_rows($q)>0) 
	{
		$i=0; 
		while($row = mysqli_fetch_array($q)) {
			extract($row); 
		?>
		   <table width="100%">
				<tr><td>Sub Total</td><td class="text-right"><?php echo '$ '.FormatAngka($sub_total)?></td></tr>
				<tr><td>Tax</td><td class="text-right"><?php echo '$ '.FormatAngka($ppn)?></td></tr>
				<tr><td>Total</td><td class="text-right"><?php echo '$ '.FormatAngka($total)?></td></tr>
			</table>
			<input type="hidden" id="sub_total" value="<?php echo '$ '.FormatAngka($sub_total)?>">
			<input type="hidden" id="ppn" value="<?php echo '$ '.FormatAngka($ppn)?>">
			<input type="hidden" id="total" value="<?php echo '$ '.FormatAngka($total)?>">
			<div style="padding:5px;text-align:center">
			    <?php if($jns_trans=='1'){?>
				    <a href="slip.php?bukti=<?php echo $bukti?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fa fa-print"></i></a>
					<button type="button" class="btn btn-success btn-sm" onclick="next_order()">Next Order</a>
				<?php } else { ?>	
					<button type="button" class="btn btn-success btn-sm" onclick="proses_bayar()">Proceed Order</button>
				<?php } ?>	
			</div>
<?php	}
	}
?>