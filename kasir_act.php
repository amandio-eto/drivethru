<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');

  $jns = mysqli_escape_string($conn,$_GET['jns']);
  
  switch ($jns) {

    case 'tbprod' :
        TambahProduk();
        break;
      
    case 'ubahqty' :
        UbahQty();
        break;
		
    case 'hapus' :
        HapusKategori();
        break;
		
    case 'next' :
        NextOrder();
        break;
		
	case 'simpan' :
        SimpanHeader();
        break;
	
	case 'bayar' :
        SimpanBayar();
        break;

    case 'bayar_cs' :
        SimpanBayarCS();
        break;
    
    case 'batal' :
        Batal();
        break;
		
	case 'setks' :
        SetKasir();
        break;	
	
	case 'diambil' :
        Diambil();
        break;		
    	   	   
    default :
        header('Location:index.php');
  }		


function TambahProduk()
{
   global $conn;	 
   
   $bukti = mysqli_escape_string($conn,$_POST['bukti']);
   $produk = mysqli_escape_string($conn,$_POST['produk']);
   $cust = mysqli_escape_string($conn,$_POST['cust']);
   $telp = mysqli_escape_string($conn,$_POST['telp']);	 
   $tgl = mysqli_escape_string($conn,$_POST['tgl']);
   $tgl=FormatTglDB($tgl);
   $catatan = mysqli_escape_string($conn,$_POST['catatan']);
   $waktu=date('Y-m-d H:i:s');
   $hsatuan=AmbilData("select harga from produk where id=$produk");
   if($hsatuan=='') $hsatuan=0;
   $username=$_SESSION['user'];
   $kasir=AmbilData("select id from user where username='$username'");
   if(AdaData("select kasir from kasir_outdoor where kasir='$kasir'"))
	 $jns_kasir=1;  
   else $jns_kasir=2;  
   if(AdaData("select bukti from transaksi where bukti='$bukti'")){
	    $sql1="update transaksi set cust='$cust',telp='$telp',catatan='$catatan' where bukti='$bukti'";
		$result = mysqli_query($conn,$sql1);    
   } else {
	    $sql1="insert transaksi(bukti,jns_kasir,kasir,tgl,cust,telp,catatan,waktu,sub_total,ppn,total,status,diambil) 
		values('$bukti','$jns_kasir','$kasir','$tgl','$cust','$telp','$catatan','$waktu',0,0,0,'0','N')";
		$result = mysqli_query($conn,$sql1);    
   } 
   
   if(AdaData("select bukti from transaksi_detail where bukti='$bukti' and produk='$produk'")){
	    $qty=AmbilData("select qty from transaksi_detail where bukti='$bukti' and produk='$produk'");
		$qty++;
	    $sql2="update transaksi_detail set qty=$qty,harga=hsatuan*$qty where bukti='$bukti' and produk='$produk'";
		$result = mysqli_query($conn,$sql2);    
   } else {
	    $sql2="insert transaksi_detail(bukti,produk,qty,hsatuan,harga) 
		        values('$bukti','$produk',1,$hsatuan,$hsatuan)";
		$result = mysqli_query($conn,$sql2);    
   }
   $tot=AmbilData("select sum(harga) from transaksi_detail where bukti='$bukti'");
   $sql3="update transaksi set sub_total=$tot,total=$tot where bukti='$bukti'";
   $result = mysqli_query($conn,$sql3);    
   //echo $sql1;
}

function SimpanHeader()
{
   global $conn;	 
   
   $bukti = mysqli_escape_string($conn,$_POST['bukti']);
   $cust = mysqli_escape_string($conn,$_POST['cust']);
   $telp = mysqli_escape_string($conn,$_POST['telp']);	 
   $tgl = mysqli_escape_string($conn,$_POST['tgl']);
   $tgl=FormatTglDB($tgl);
   $catatan = mysqli_escape_string($conn,$_POST['catatan']);
   $waktu=date('Y-m-d H:i:s');
   if(AdaData("select bukti from transaksi where bukti='$bukti'")){
	    $sql1="update transaksi set cust='$cust',telp='$telp',catatan='$catatan',waktu='$waktu' where bukti='$bukti'";
		$result = mysqli_query($conn,$sql1);    
   }
   echo $sql1;
}

function SimpanBayarCS(){
    global $conn;
    $bukti = mysqli_escape_string($conn,$_POST['bukti']);
	$voucher = mysqli_escape_string($conn,$_POST['voucher']);
	$discp = mysqli_escape_string($conn,$_POST['discp']);
	$disc = mysqli_escape_string($conn,$_POST['disc']);
	$total = mysqli_escape_string($conn,$_POST['total']);
	$jns_bayar = mysqli_escape_string($conn,$_POST['jns_bayar']);
	$no_kartu = mysqli_escape_string($conn,$_POST['no_kartu']);
	if($discp=='') $discp=0; else $discp=UnformatAngka($discp);
	if($disc=='') $disc=0; else $disc=UnformatAngka($disc);
	if($total=='') $total=0; else $total=UnformatAngka($total);
	if($disc==0) $voucher='';
		
    $query = "UPDATE transaksi SET STATUS='2',voucher='$voucher',disc=$discp,ndisc=$disc,total=$total,jns_bayar='$jns_bayar',no_kartu='$no_kartu' WHERE bukti='$bukti'"; 
    $result = mysqli_query($conn, $query);
	if ($result==true){
		$username=$_SESSION['user'];
		$kasir=AmbilData("select id from user where username='$username'");
		$ksr=str_pad($kasir,3,'0',STR_PAD_LEFT);   
		$tgl=date('ymd');
		$noakhir=AmbilData("select noakhir from nourut where tgl='$tgl$ksr'");
		if($noakhir=='') $noakhir=1; else $noakhir=$noakhir+1; 
		
		if(AdaData("select noakhir from nourut where tgl='$tgl$ksr'")){
				$sql="update nourut set noakhir=$noakhir where tgl='$tgl$ksr'";
				$result2 = mysqli_query($conn,$sql);
		} else {
			$sql="insert into nourut(tgl,noakhir) values ('$tgl$ksr',$noakhir)";
			$result2 = mysqli_query($conn,$sql);
		}
		
		if($disc>0){
			 $sql = "UPDATE voucher SET quota=quota-1 where kode='$voucher'";
			 $result = mysqli_query($conn,$sql);
		}
	}
    header('Location:index.php?menu=kasir');
}

function UbahQty()
{
   global $conn;	 
   $bukti = mysqli_escape_string($conn,$_POST['bukti']);
   $id = mysqli_escape_string($conn,$_POST['id']);
   $tanda = mysqli_escape_string($conn,$_POST['tanda']);
   $produk=AmbilData("select produk from transaksi_detail where id=$id");
   $hsatuan=AmbilData("select harga from produk where id=$produk");
   
   $qty=AmbilData("select qty from transaksi_detail where bukti='$bukti' and produk='$produk'");
   if($tanda=='-'){
	   if($qty==1){
		    $sql="delete from transaksi_detail where bukti='$bukti' and produk=$produk";
			$result = mysqli_query($conn,$sql);  
	   } else {
		    $sql="update transaksi_detail set qty=$qty-1,harga=($qty-1)*hsatuan where bukti='$bukti' and produk=$produk";
			$result = mysqli_query($conn,$sql);  
	   }
   } else {
	    $sql="update transaksi_detail set qty=$qty+1,harga=($qty+1)*hsatuan where bukti='$bukti' and produk=$produk";
		$result = mysqli_query($conn,$sql);  
   }
  
   $tot=AmbilData("select sum(harga) from transaksi_detail where bukti='$bukti'");
   if($tot=='')$tot=0;
   $sql3="update transaksi set sub_total=$tot,total=$tot where bukti='$bukti'";
   $result = mysqli_query($conn,$sql3);    
   echo $sql3;
}

function HapusKategori()
{
   global $conn;
   $id = mysqli_escape_string($conn,$_GET['id']);
   $sql="delete from kategori where id='$id'";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=kategori'); 
}

function NextOrder()
{
   global $conn;	
   $bukti = mysqli_escape_string($conn,$_GET['bukti']);   
   $kasir = mysqli_escape_string($conn,$_GET['kasir']);  
   $ksr=str_pad($kasir,3,'0',STR_PAD_LEFT);   
   $tgl=date('ymd');
   $noakhir=AmbilData("select noakhir from nourut where tgl='$tgl$ksr'");
   if($noakhir=='') $noakhir=1; else $noakhir=$noakhir+1; 
   $sekarang=Date("Y-m-d H:i:s");
   
   if(AdaData("select noakhir from nourut where tgl='$tgl$ksr'")){
		$sql="update nourut set noakhir=$noakhir where tgl='$tgl$ksr'";
		$result = mysqli_query($conn,$sql);
   } else {
	   $sql="insert into nourut(tgl,noakhir) values ('$tgl$ksr',$noakhir)";
	   $result = mysqli_query($conn,$sql);
   }
  // echo $sql;
   $sql="update transaksi set status='1',waktu='$sekarang' where bukti='$bukti'";
   $result = mysqli_query($conn,$sql);
   header('Location:index.php?menu=kasir');   
}   

function SimpanBayar()
{
    global $conn;	 
    $bukti = mysqli_escape_string($conn,$_POST['bukti']);
	$voucher = mysqli_escape_string($conn,$_POST['voucher']);
	$discp = mysqli_escape_string($conn,$_POST['discp']);
	$disc = mysqli_escape_string($conn,$_POST['disc']);
	$total = mysqli_escape_string($conn,$_POST['total']);
	$jns_bayar = mysqli_escape_string($conn,$_POST['jns_bayar']);
	$no_kartu = mysqli_escape_string($conn,$_POST['no_kartu']);
	if($discp=='') $discp=0; else $discp=UnformatAngka($discp);
	if($disc=='') $disc=0; else $disc=UnformatAngka($disc);
	if($total=='') $total=0; else $total=UnformatAngka($total);
	
	if($disc==0) $voucher='';
		
    $sql = "UPDATE transaksi SET STATUS='2',voucher='$voucher',disc=$discp,ndisc=$disc,total=$total,jns_bayar='$jns_bayar',no_kartu='$no_kartu' WHERE bukti='$bukti'"; 
    $result = mysqli_query($conn,$sql);
	
	if($disc>0){
		 $sql = "UPDATE voucher SET quota=quota-1 where kode='$voucher'";
		 $result = mysqli_query($conn,$sql);
	}
    header('Location:index.php?menu=pengambilan');   
 }   

function Batal()
{
   global $conn;	 
   $bukti = mysqli_escape_string($conn,$_POST['bukti']);
   $sql="update transaksi set status='3' where bukti='$bukti'";
   $result = mysqli_query($conn,$sql);
   
   //echo $sql;
   header('Location:index.php?menu=pengambilan');   
}   

function SetKasir()
{
   global $conn;	 
   $kasir = mysqli_escape_string($conn,$_GET['kasir']);
   $sekarang=date('Y-m-d H:i:s');
   if(AmbilData("select kasir from kasir_outdoor")==$kasir){
	    //$sql="update kasir_outdoor set kasir=0,masuk='$sekarang'";
		//$result = mysqli_query($conn,$sql);
   } else {
	   if(AdaData("select kasir from kasir_outdoor")){
		   $sql="update kasir_outdoor set kasir=$kasir,masuk='$sekarang'";
	   } else {
			$sql="insert kasir_outdoor(kasir,masuk) values('$kasir','$sekarang')";
	   }
	   $result = mysqli_query($conn,$sql);
   }
   
  
   
   //echo $sql;
   header('Location:index.php');   
}   

function Diambil()
{
   global $conn;	 
   $bukti = mysqli_escape_string($conn,$_POST['bukti']);
   $sql="update transaksi set diambil='Y' where bukti='$bukti'";
   $result = mysqli_query($conn,$sql);
   
   //echo $sql;
   header('Location:index.php?menu=pengambilan_cs');   
}
