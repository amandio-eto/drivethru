<?php
require_once 'konfig.php'; 
require_once 'fungsi_umum.php';
require_once 'lib/tcpdf/tcpdf.php';
 
$tgl1a = mysqli_escape_string($conn,$_GET['tgl1']);
$tgl2a = mysqli_escape_string($conn,$_GET['tgl2']);
$jenis = mysqli_escape_string($conn,$_GET['jenis']);
$jns_bayar = mysqli_escape_string($conn,$_GET['jns_bayar']);
$kasir = mysqli_escape_string($conn,$_GET['kasir']);
if($jns_bayar=='1') {
	$bt1=" and jns_bayar='1'";
	$jb="Cash";	
} else if($jns_bayar=='2'){
    $bt1=" and jns_bayar='2'"; 
	$jb="Debit Card";
} else {
	$bt1="";
	$jb="Semua";
}  

if($kasir==0){
	$jk="Semua";
	$bt2='';
} else{
	$bt2=" and kasir=$kasir";
	$jk=AmbilData("select username from user where id=$kasir");
}

$tgl1=FormatTglDB($tgl1a);
$tgl2=FormatTglDB($tgl2a);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$font_size = $pdf->pixelsToUnits('24');
$pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
$pdf->setMargins(15,15,15,true);
$pdf->SetTitle('Laporan Daftar Penjualan');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetAutoPageBreak(true,5);
$pdf->AddPage();
	
	$table='<table class="bordered" cellpadding="3">
			<thead>
				<tr>
				    <th width="50px">Kasir</th>
					<th width="40px">No Urut</th>
				    <th width="50px">Tanggal</th>
					<th width="30px">Jam</th>
					<th width="90px">Customer</th>
					<th width="60px">No. Telp</th>
					<th width="40px">Status</th>
					<th width="50px" align="right">Sub Total</th>
					<th width="40px" align="right">Disc</th>
					<th width="40px" align="right">Tax</th>
					<th width="40px" align="right">Total</th>
				</tr>
			</thead>
			<tbody>';
			$q = mysqli_query($conn,"select * from transaksi where status='2' and tgl>='$tgl1' and tgl<='$tgl2' $bt1 $bt2");
			if (mysqli_num_rows($q)>0) 
			{
				$i=0; $ttotal=0;$tppn=0;$tsub=0;$tdisc=0;
				while($row = mysqli_fetch_array($q)) {
					extract($row);
					$nuser=AmbilData("select username from user where id=$kasir");
					$nourut=substr($bukti,-3);
					$i++;
					if($status==0) $nstatus='Input';
					if($status==1) $nstatus='Order';
					if($status==2) $nstatus='Lunas';
					if($status==3) $nstatus='Batal';
					$ttotal=$ttotal+$total;
					$tppn=$tppn+$ppn;
					$tdisc=$tdisc+$ndisc;
					$tsub=$tsub+$sub_total;
		        $table=$table."
				<tr>
					<td width=\"50px\">$nuser</td>
					<td width=\"40px\">$nourut</td>
					<td width=\"50px\">".FormatTgl($tgl,'A1')."</td>
					<td width=\"30px\">".FormatTgl($waktu,'J')."</td>
					<td width=\"90px\">$cust</td>
					<td width=\"60px\">$telp</td>
					<td width=\"40px\">$nstatus</td>
					<td width=\"50px\" align=\"right\">".FormatAngka($sub_total)."</td>
					<td width=\"40px\" align=\"right\">".FormatAngka($ndisc)."</td>
					<td width=\"40px\" align=\"right\">".FormatAngka($ppn)."</td>
					<td width=\"40px\" align=\"right\">".FormatAngka($total)."</td>
				</tr>";
					$table=$table."<tr><td colspan=\"9\" style=\"padding:20px\; border-left: 2px solid white;border-right:2px solid white;\"> &nbsp;&nbsp;&nbsp;
						  <table class=\"bordered\" cellpadding=\"3\">
							 <tr>
								<th width=\"25\">No</th>
								<th width=\"190\">Produk</th>
								<th width=\"40\" align=\"right\">Qty</th>
								<th width=\"70\" align=\"right\">Harga Satuan</th>
								<th width=\"60\" align=\"right\">Harga Total</th>
							</tr>
					   ";				
				        $j=0; $tqty=0;$tharga=0;
						$q2 = mysqli_query($conn,"select * from transaksi_detail where bukti='$bukti'");
						if (mysqli_num_rows($q2)>0) 
						{
							while($row2 = mysqli_fetch_array($q2)) {
								extract($row2); 
								$j++;
								$tqty=$tqty+$qty;
								$tharga=$tharga+$harga;
								$nama=AmbilData("select nama from produk where id='$produk'");
								$table=$table."
								<tr>
									<td>$j</td>
									<td>$nama</td>
									<td align=\"right\">".FormatAngka($qty)."</td>
									<td align=\"right\">".FormatAngka($hsatuan)."</td>
									<td align=\"right\">".FormatAngka($harga)."</td>
								</tr>";   
							} 
						} 
						$table=$table."<tr><th colspan=\"2\">TOTAL</th><th align=\"right\">".FormatAngka($tqty)."</th><th></th><th  align=\"right\">".FormatAngka($tharga)."</th></tr>";
						$table=$table."</table><br></td></tr>";
				     
					}
					$table=$table."<tr><th colspan=\"7\">GRAND TOTAL</th><th align=\"right\">".FormatAngka($tsub)."</th><th  align=\"right\">".FormatAngka($tdisc)."</th><th  align=\"right\">".FormatAngka($tppn)."</th><th  align=\"right\">".FormatAngka($ttotal)."</th></tr>";			
				
				} 
			$table=$table."</tbody></table>"; 	
					
			// echo $table;
			
		$table2='<table class="bordered" cellpadding="3">
			<thead>
				<tr>
					<th width="50px">Kasir</th>
					<th width="40px">No Urut</th>
				    <th width="50px">Tanggal</th>
					<th width="30px">Jam</th>
					<th width="90px">Customer</th>
					<th width="60px">No. Telp</th>
					<th width="40px">Status</th>
					<th width="50px" align="right">Sub Total</th>
					<th width="40px" align="right">Disc</th>
					<th width="40px" align="right">Tax</th>
					<th width="40px" align="right">Total</th>
				</tr>
			</thead>
			<tbody>';
			$q = mysqli_query($conn,"select * from transaksi where status='2' and tgl>='$tgl1' and tgl<='$tgl2' $bt1 $bt2 order by bukti");
			if (mysqli_num_rows($q)>0) 
			{
				$i=0; $ttotal=0;$tppn=0;$tsub=0;
				while($row = mysqli_fetch_array($q)) {
					extract($row);
					$nuser=AmbilData("select username from user where id=$kasir");
					$nourut=substr($bukti,-3);
					$i++;
					if($status==0) $nstatus='Input';
					if($status==1) $nstatus='Order';
					if($status==2) $nstatus='Lunas';
					if($status==3) $nstatus='Batal';
					$ttotal=$ttotal+$total;
					$tppn=$tppn+$ppn;
					$tsub=$tsub+$sub_total;
		        $table2=$table2."
				<tr>
					<td width=\"50px\">$nuser</td>
					<td width=\"40px\">$nourut</td>
					<td width=\"50px\">".FormatTgl($tgl,'A1')."</td>
					<td width=\"30px\">".FormatTgl($waktu,'J')."</td>
					<td width=\"90px\">$cust</td>
					<td width=\"60px\">$telp</td>
					<td width=\"40px\">$nstatus</td>
					<td width=\"50px\" align=\"right\">".FormatAngka($sub_total)."</td>
					<td width=\"40px\" align=\"right\">".FormatAngka($ndisc)."</td>
					<td width=\"40px\" align=\"right\">".FormatAngka($ppn)."</td>
					<td width=\"40px\" align=\"right\">".FormatAngka($total)."</td>
				</tr>";
					
				} 
				$table2=$table2."<tr><th colspan=\"7\">GRAND TOTAL</th><th align=\"right\">".FormatAngka($tsub)."</th><th  align=\"right\">".FormatAngka($tppn)."</th><th  align=\"right\">".FormatAngka($ttotal)."</th></tr>";			
			}
			$table2=$table2."</tbody></table>"; 	

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
		<td align="center"><h3>DAFTAR PENJUALAN</h3></td>
	</tr>
</table>
<br><br><br>
Tanggal : <b>$tgl1a</b> sampai <b>$tgl2a</b><br>
Jenis Bayar : <b>$jb</b><br>
Jenis Kasir : <b>$jk</b>
<br><br>
$table

EOF;

$html2 = <<<EOF
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
		<td align="center"><h3>DAFTAR PENJUALAN</h3></td>
	</tr>
</table>
<br><br><br>
Tanggal : <b>$tgl1a</b> sampai <b>$tgl2a</b><br>
Jenis Bayar : <b>$jb</b><br>
Kasir : <b>$jk</b>
<br><br>
$table2

EOF;
 
// output the HTML content
if($jenis==1)
	$pdf->writeHTML($html2, true, false, true, false, '');
else $pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('cetak.pdf', 'I');
?>