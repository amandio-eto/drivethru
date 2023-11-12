<?php
require_once 'konfig.php'; 
require_once 'fungsi_umum.php';
require_once 'lib/tcpdf/tcpdf.php';
	
$bukti=mysqli_escape_string($conn,$_GET['bukti']);
$nama_toko=AmbilData("select nama_pt from setting");
$alamat_toko=AmbilData("select alamat from setting");
$telp_toko=AmbilData("select telp from setting");
$pageLayout = array(75,75); 
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
$font_size = $pdf->pixelsToUnits('24');
$pdf->SetFont ('timesB', '', $font_size , '', 'default', true );
//$pdf->SetFont ('courier', '', $font_size , '', 'default', true );
$pdf->setMargins(8,5,5,true);
$pdf->SetTitle('Slip Penjulan Kasir');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE,0);
//$pdf->SetAutoPageBreak(true);
$pdf->AddPage();
			
			$q = mysqli_query($conn,"select * from transaksi where bukti='$bukti'");
			if (mysqli_num_rows($q)>0) 
			{
				$i=0; $total=0;
				while($row = mysqli_fetch_array($q)) {
					extract($row);
					$no_urut=substr($bukti,-3);
					if ($jns_bayar=='1') $ket_bayar='Cash'; else $ket_bayar='Debit Card'; 
					$tglf=FormatTgl($tgl,'A1');
					$jamf=FormatTgl($waktu,'J');
					$nkasir=AmbilData("select username from user where id='$kasir'");
					if($disc>0) $disc_persen=FormatAngka($disc).'  %'; else $disc_persen='';
					if($ndisc=='') $ndisc=0;
				}
			}	
			
			$table="";
			$q2 = mysqli_query($conn,"select * from transaksi_detail where bukti='$bukti'");
			if (mysqli_num_rows($q2)>0) 
			{
				$j=0; 
				$table='<table cellpadding="1">';
				while($row2 = mysqli_fetch_array($q2)) {
					extract($row2); 
					$j++;
					$nama=AmbilData("select nama from produk where id='$produk'");
					$table=$table.'
					<tr>
						<td colspan="4">'.$nama.'</td>
				    </tr>
					<tr>
						<td width="22px" height="18" align="right">'.FormatAngka($qty).'</td>
						<td width="25px">PCS</td>
						<td align="right" width="60">'.'$ '.FormatAngka($hsatuan).'</td>
						<td align="right" width="60">'.'$ '.FormatAngka($harga).'</td>
				    </tr>';   
				} 
			} 
			$table=$table.'</table><hr>';
			$table=$table.'<table cellpadding="1">
			     	<tr>
						<td width="40"></td><td width="70px">SUB TOTAL</td><td width="5px">:</td><td align="right" width="55px">'.'$ '.FormatAngka($sub_total).'</td>
					</tr>
					<tr>
						<td width="40"></td><td>DISC '.$disc_persen.'</td><td>:</td><td align="right">'.'$ '.FormatAngka($ndisc).'</td>
					</tr>
					<tr>
						<td width="40"></td><td>TAX </td><td>:</td><td align="right">'.'$ '.FormatAngka($ppn).'</td>
					</tr>
					<tr>
						<td width="40"></td><td>TOTAL</td><td>:</td><td align="right">'.'$ '.FormatAngka($total).'</td>
					</tr>
					</table>
					';
					
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    table.bordered td {
        border: 1px solid black;
    }
	
	table.bordered th {
		background-color: #E6E6E6;
		font-weight:bold;
        border: 1px solid black;
    }
</style>
<table>
	<tr hight="50px">
		<td align="center" colspan="3"><h3>$nama_toko</h3></td>
	</tr>
	<tr hight="50px">
		<td align="center" colspan="3">$alamat_toko</td>
	</tr>
	<tr hight="50px">
		<td align="center" colspan="3">Telp. $telp_toko</td>
	</tr>
	<tr hight="50px">
		<td align="center" colspan="3"></td>
	</tr>
	<tr hight="50px">
		<td width="96px">No Trans : #$no_urut</td><td width="35px">Tanggal </td><td>: $tglf</td>
	</tr>
	<tr>
		<td style="height:12px">Jns Bayar : $ket_bayar</td><td>Jam </td><td>: $jamf</td>
	</tr>
	<tr>
		<td style="height:12px">Cust. : $cust </td><td>Kasir </td><td>: $nkasir</td>
	</tr>
</table>
<hr>
$table
EOF;
 
// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('cetak.pdf', 'I');
?>