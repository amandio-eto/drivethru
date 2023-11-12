<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');

  $jns = mysqli_escape_string($conn,$_GET['jns']);
  
  switch ($jns) {

    case 'baru' :
        VoucherBaru();
        break;
      
    case 'edit' :
        EditVoucher();
        break;
		
    case 'hapus' :
        HapusVoucher();
        break;
		
	case 'cek' :
        CekVoucher();
        break;	
			   
    default :
        header('Location:index.php');
  }		


function VoucherBaru()
{
   global $conn;	 
   
   $kode = mysqli_escape_string($conn,$_POST['kode']);
   $disc = mysqli_escape_string($conn,$_POST['disc']);
   $ndisc = mysqli_escape_string($conn,$_POST['ndisc']);
   $quota = mysqli_escape_string($conn,$_POST['quota']);
   $kode=strtoupper($kode);
   if($disc=='') $disc=0;
   if($ndisc=='') $ndisc=0;
   if($quota=='') $quota=0;
   if($disc=='') $disc=0; else $disc=UnformatAngka($disc); 
   if($ndisc=='') $ndisc=0; else $ndisc=UnformatAngka($ndisc); 
   if($quota=='') $quota=0; else $quota=UnformatAngka($quota); 
   
   $sql="insert into voucher(kode,disc,ndisc,quota,aktif) 
          values('$kode',$disc,$ndisc,$quota,'Y')";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=voucher'); 
}

function EditVoucher()
{
   global $conn;	 
   $id = mysqli_escape_string($conn,$_POST['id']);
   $kode = mysqli_escape_string($conn,$_POST['kode']);
   $disc = mysqli_escape_string($conn,$_POST['disc']);
   $ndisc = mysqli_escape_string($conn,$_POST['ndisc']);
   $quota = mysqli_escape_string($conn,$_POST['quota']);
   $aktif = mysqli_escape_string($conn,$_POST['aktif']);
   $kode=strtoupper($kode);
   if($disc=='') $disc=0; else $disc=UnformatAngka($disc); 
   if($ndisc=='') $ndisc=0; else $ndisc=UnformatAngka($ndisc); 
   if($quota=='') $quota=0; else $quota=UnformatAngka($quota); 
   
   $sql="update voucher set kode='$kode',disc=$disc,ndisc=$ndisc,quota=$quota,aktif='$aktif' where id=$id";
   $result = mysqli_query($conn,$sql);  
   //echo $sql;
   header('Location:index.php?menu=voucher'); 
}

function HapusVoucher()
{
   global $conn;
   $id = mysqli_escape_string($conn,$_GET['id']);
   $sql="delete from voucher where id='$id'";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=voucher'); 
}

function CekVoucher()
{
   global $conn;	 
   $kode = mysqli_escape_string($conn,$_GET['kode']);
   $kode=strtoupper(trim($kode));
     
   $sql="select disc,ndisc,quota from voucher where kode='$kode'";
   $q = mysqli_query($conn,$sql);
   if (mysqli_num_rows($q)>0) 
   {
	  while($row = mysqli_fetch_assoc($q)){
	     $row['disc']=FormatAngka($row['disc']);
	     $arrayjson[] = $row;
	  }
	  echo json_encode($arrayjson);
   } else {
	   $row['disc']='';
	   $row['ndisc']='';
	   echo json_encode($arrayjson);
   }	  
}