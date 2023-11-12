<?php
function AmbilData($s)
{
   global $conn;	 
   $q =mysqli_query($conn,$s) or die (mysqli_error());
   if (mysqli_num_rows($q)>0) {
        $row =mysqli_fetch_row($q);
        $hasil=$row[0];  
   } else $hasil='';	
   return $hasil;
}

function AdaData($s)
{
   global $conn;   
   $q =mysqli_query($conn,$s) or die (mysqli_error());
    if (mysqli_num_rows($q)>0) $hasil=true; else $hasil=false;
    return $hasil;
}

	function FormatAngka($nilai)
	{
	  if (!(is_null($nilai))){
			if ($nilai-floor($nilai)>0) {
				$hasil=number_format($nilai, 2, '.', ',');
				if (substr($hasil, -1)=='0') $hasil=substr($hasil,0,strlen($hasil)-1);
			} else $hasil=number_format($nilai, 0, '.', ',');
		} else $hasil=$nilai;
		return $hasil;
	}
	
	function UnformatAngka($nilai)
	{
	  $pembatas_decimal=".";
	  if ($pembatas_decimal==","){
			$hasil=str_replace('.','',$nilai);
			$hasil=str_replace(',','.',$hasil);
		} else {
			$hasil=str_replace(',','',$nilai);
		}	
		return $hasil;
	}
	
	function FormatTglDB($tgl){
				$pisah = explode('-',$tgl);
				$urutan = array($pisah[2],$pisah[1],$pisah[0]);
				$satukan = implode('-',$urutan);
				return $satukan;
			}
	
	function FormatTgl($tgl,$fmt)
			//HL = Senin, 2 Januari 2007
			//L = 2 Januari 2007
			//HS =Sen, 2 Jan 2007
			//S = 2 Jan 2007
			//A1 = 02-01-2007
			//A2= 02/01/2007
			//HLJ= Senin, 2 Januari 2007 jam 10:20
			//J=10:20
			//H=Senin
			//HR=Sen
			//A1J=02-01-2007 10:20
			//BT=Januari 2014
			{
				if (($fmt=='HL' )or($fmt=='L' )or($fmt=='HLJ')or($fmt=='BT')or($fmt=='H'))
				{
					  $hr=array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
					  $bln=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
				 }  else {
					  $hr=array('Mgu','Sen','Sel','Rab','Kam','Jum','Sab');
					  $bln=array('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
				 }      
				  $d=getdate(strtotime($tgl));
			   //   $j=mktime(strtotime($tgl));
				  $wd=$d['wday'];
				  $hari=$hr[$wd];
				  $m=$d['mon'];
				  $bulan=$bln[$m-1];
				  if ($d['mday']<10) $tgls='0'.$d['mday']; else $tgls=$d['mday'];
				  if ($d['mon']<10) $bls='0'.$d['mon']; else $bls=$d['mon'];
				  if ($d['hours']<10) $hours='0'.$d['hours']; else $hours=$d['hours'];
				  if ($d['minutes']<10) $minutes='0'.$d['minutes']; else $minutes=$d['minutes'];
				  
				if (($fmt=='HL') or ($fmt=='HS'))
					   $hasil=$hari.',  '.$d['mday'] .'  '.$bulan.'  '.$d['year'];       
				elseif (($fmt=='L') or ($fmt=='S')) 
					   $hasil=$d['mday'] .'  '.$bulan.'  '.$d['year'];       
				elseif  ($fmt=='A1')         
				   $hasil=$tgls.'-'.$bls.'-'.$d['year'];  
				elseif  ($fmt=='A2')         
				   $hasil=$tgls.'/'.$bls.'/'.$d['year'];      
				elseif ($fmt=='HLJ')
				   $hasil=$hari.',  '.$d['mday'] .'  '.$bulan.'  '.$d['year'].'&nbsp;&nbsp; Jam '.$hours.':'.$minutes;      	
				elseif ($fmt=='A1J')
				   $hasil=$tgls.'-'.$bls.'-'.$d['year'].' '.$hours.':'.$minutes;      	
				elseif ($fmt=='J')
				   $hasil=$hours.':'.$minutes; 	
				elseif ($fmt=='H')
				   $hasil=$hari;      
				elseif ($fmt=='BT')
				   $hasil=$bulan.'  '.$d['year']; 		
				return $hasil;
			}
			
	function kekata($x) {
		 $x = abs($x);
		 $angka = array("", "satu", "dua", "tiga", "empat", "lima",
		 "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		 $temp = "";
		 if ($x <12) {
		  $temp = " ". $angka[$x];
		 } else if ($x <20) {
		  $temp = kekata($x - 10). " belas";
		 } else if ($x <100) {
		  $temp = kekata($x/10)." puluh". kekata($x % 10);
		 } else if ($x <200) {
		  $temp = " seratus" . kekata($x - 100);
		 } else if ($x <1000) {
		  $temp = kekata($x/100) ." ratus" . kekata($x % 100);
		 } else if ($x <2000) {
		  $temp = " seribu" . kekata($x - 1000);
		 } else if ($x <1000000) {
		  $temp = kekata($x/1000) ." ribu" . kekata($x % 1000);
		 } else if ($x <1000000000) {
		  $temp = kekata($x/1000000) ." juta" . kekata($x % 1000000);
		 } else if ($x <1000000000000) {
		  $temp = kekata($x/1000000000) ." milyar" . kekata(fmod($x,1000000000));
		 } else if ($x <1000000000000000) {
		  $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
		 }
		  return $temp;
	}

	function terbilang($x, $matauang='Rupiah', $style=3) {
		 $x=UnformatAngka($x);
		 $bulat=floor($x);
		 $pecah=round(($x-$bulat)*100);
		 if($x<0) {
		  $hasil = "Min ". trim(kekata($bulat));
		 } 
		 if($x=0) {
		  $hasil = "Nol ";
		 }
		 else {
		  $hasil = trim(kekata($bulat)).' '.$matauang;
			if ($pecah>0) $hasil=trim($hasil.' '.kekata($pecah)).' sen';
		 }
		 switch ($style) {
		  case 1:
		   $hasil = strtoupper($hasil);
		   break;
		  case 2:
		   $hasil = strtolower($hasil);
		   break;
		  case 3:
		   $hasil = ucwords($hasil);
		   break;
		  default:
		   $hasil = ucfirst($hasil);
		   break;
		 }
		 return $hasil;
	}
		

?>