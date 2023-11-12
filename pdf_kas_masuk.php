<?php
require_once 'konfig.php'; 
require_once 'fungsi_umum.php';
require_once 'lib/tcpdf/tcpdf.php';
 

$bukti = mysqli_escape_string($conn,$_GET['bukti']);
$tipe_slip= mysqli_escape_string($conn,$_GET['tipe']);
$q = mysqli_query($conn,"select * from kasmm where bukti='$bukti'");
$row=mysqli_fetch_array($q);
extract($row);
$tgl=FormatTgl($tgl,'A1');
$nuser=AmbilData("select username from user where id=$user");
$nrelasi=AmbilData("select NAMA from relasi where id=$relasi");
$jml_baris=AmbilData("select count(id) from kasmd where bukti='$bukti' and DK='K'");
if($lampiran==0) $lampiran='';
	
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$font_size = $pdf->pixelsToUnits('24');
$pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
$pdf->setMargins(15,15,5,true);
$pdf->SetTitle('Bukti Kas Masuk');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetAutoPageBreak(true);
$pdf->AddPage();
	if ($tipe_slip==2){
		$table=" <table class=\"noborder\" cellpadding=\"3\">
					 <tr>
						<th width=\"70\"> </th>
						<th width=\"295\"> </th>
						<th width=\"70\" align=\"right\"> </th>
					</tr>";
			
			$q = mysqli_query($conn,"select * from kasmd where bukti='$bukti' and DK='K' order by id");
			if (mysqli_num_rows($q)>0) 
			{
				$i=0; 
				while($row = mysqli_fetch_array($q)) {
					$i++;
					extract($row);
					$kode=AmbilData("select kode from account where id='$account'");
					$nama=AmbilData("select nama from account where id='$account'");
					$nilai1=FormatAngka($nilai);
					$table=$table."
					<tr>
						<td>$kode</td>
						<td>".nl2br($uraian)."</td>
						<td align=\"right\">".$nilai1."</td>
					</tr>";   
					}
				} 
				if($jml_baris<8) {
					for($i=1;$i<8-$jml_baris;$i++){
						$table=$table."
						<tr>
							<td></td><td></td><td></td>
						</tr>";	
					}
				}
				$table=$table."<tr><th colspan=\"2\"><i># ".terbilang($total)." #</i></th><th align=\"right\">".FormatAngka($total)."</th></tr>";
				$table=$table."</tbody></table>"; 	
	} else {
		$table="<table class=\"bordered2\" cellpadding=\"3\" height=\"600px\">
							 <tr>
								<th width=\"70\">Perkiraan</th>
								<th width=\"305\">Uraian</th>
								<th width=\"75\" align=\"right\">Jumlah</th>
							</tr>";
			
			$q = mysqli_query($conn,"select * from kasmd where bukti='$bukti' and DK='K' order by id");
			if (mysqli_num_rows($q)>0) 
			{
				$i=0; 
				while($row = mysqli_fetch_array($q)) {
					$i++;
					extract($row);
					$kode=AmbilData("select kode from account where id='$account'");
					$nama=AmbilData("select nama from account where id='$account'");
					$table=$table."
					<tr>
						<td>$kode</td>
						<td>".nl2br($uraian)."</td>
						<td align=\"right\">".FormatAngka($nilai)."</td>
					</tr>";   			     
					}
				} 
				if($jml_baris<8) {
					for($i=1;$i<8-$jml_baris;$i++){
						$table=$table."
						<tr>
							<td></td><td></td><td></td>
						</tr>";	
					}
				}
				$table=$table."<tr><th colspan=\"2\"><i># ".terbilang($total)." #</i></th><th align=\"right\">".FormatAngka($total)."</th></tr>";
				$table=$table."</tbody></table>"; 	
			}
					
			 //echo $table;

$html1 = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    table.bordered td {
        border: 1px solid black;
    }
	
	table.bordered th {
		font-weight:bold;
        border: 1px solid black;
    }
	
	table.bordered2{
        border-collapse: collapse;
    }
	
	
	table.bordered2 td {
        border-top: 0 solid white;
		border-bottom: 0 solid white;
		border-left: 1 solid black;
		border-right: 1 solid black;
    }
	
	table.bordered2 th {
		font-weight:bold;
        border: 1px solid black;
    }
	
	table.noborder{
        border-collapse: collapse;
    }
	
	table.noborder td {
        border: 1 solid #fff;
    }
	
	table.noborder th {
		font-weight:bold;
        border: 1 solid #fff;
    }
	
	table.bukti td{
		font-size:11px;
	}
	table.bukti th{
		font-size:11px;
		font-weight:bold;
	}
</style>
<table cellpadding="5" class="noborder">
	<tr>
		<td width="40px" rowspan="5"></td>
		<td width="30px" rowspan="5"></td>
		<td width="120px" style="font-size:8px;" align="center"></td>
		<td width="230px" style="font-size:8px;" style="font-size:12px;font-weight:bold" align="center"></td>
		<td width="100px" style="font-size:8px;"> &nbsp;&nbsp; $bukti</td>
	</tr>
	<tr>
	   <td colspan="2" rowspan="2">
	    &nbsp;&nbsp;&nbsp; $nrelasi 
	   </td>
	   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $tgl</td>
	</tr> 
	<tr>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $lampiran</td>
	</tr>
	<tr>
		<td colspan="3">$table</td>
	</tr>
	<tr>
		<td colspan="3" cellspacing="0" cellpadding="0">
			
		</td>
	</tr>
</table>
<br><br>
EOF;

$html2 = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    table.bordered td {
        border: 1px solid black;
    }
	
	table.bordered th {
		font-weight:bold;
        border: 1px solid black;
    }
	
	table.bordered2{
        border-collapse: collapse;
    }
	
	
	table.bordered2 td {
        border-top: 0 solid white;
		border-bottom: 0 solid white;
		border-left: 1 solid black;
		border-right: 1 solid black;
    }
	
	table.bordered2 th {
		font-weight:bold;
        border: 1px solid black;
    }
	
	table.noborder{
        border-collapse: collapse;
    }
	
	table.noborder td {
        border: 1 solid #fff;
    }
	
	table.noborder th {
		font-weight:bold;
        border: 1 solid #fff;
    }
	
	table.bukti td{
		font-size:11px;
	}
	table.bukti th{
		font-size:11px;
		font-weight:bold;
	}
</style>
<table cellpadding="0" class="bordered">
	<tr>
		<td width="40px" rowspan="3"></td>
		<td width="30px" rowspan="3"></td>
		<td width="450px">
		<table class="bordered" cellpadding="3">
		      <tr>
				<td width="120px" style="padding:10px;font-size:8px;" align="center">PERUSAHAAN PELAYARAN<br><span style="font-size:10px">" PT. ISA LINES "</span></td>
				<td width="230px" style="font-size:8px;" style="font-size:12px;font-weight:bold" align="center">BUKTI KAS MASUK</td>
				<td width="100px" style="font-size:8px;">NO : $bukti</td>
			  </tr>	
			  <tr>
				   <td colspan="2" rowspan="2">
				   Diterima dari : $nrelasi 
				   </td>
				   <td>Tanggal : $tgl</td>
				</tr> 
				<tr>
					<td>Lampiran: $lampiran &nbsp; lembar</td>
				</tr>
		   </table>
		</td>
	</tr>	
	<tr>
		<td colspan="3">$table</td>
	</tr>
	<tr>
		<td colspan="3" cellpadding="0">
			<table class="bordered" cellpadding="3">
				<tr>
					<td colspan="2" align="center">Pembukuan</td>
					<td align="center">Mengetahui</td>
					<td align="center">Menyetujui</td>
					<td align="center">Kasir</td>
					<td align="center">Penyetor</td>
				</tr>
				<tr >
					<td style="height:30px"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<br><br>
EOF;
 
// output the HTML content
if($tipe_slip=='2')
  $pdf->writeHTML($html1, true, false, true, false, '');
else
  $pdf->writeHTML($html2, true, false, true, false, '');
$pdf->Output('cetak.pdf', 'I');
?>