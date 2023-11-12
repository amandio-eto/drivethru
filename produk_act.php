<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');

  $jns = mysqli_escape_string($conn,$_GET['jns']);
  
  switch ($jns) {

    case 'baru' :
        ProdukBaru();
        break;
      
    case 'edit' :
        EditProduk();
        break;
		
    case 'hapus' :
        HapusProduk();
        break;
    	   
    default :
        header('Location:index.php');
  }		


function ProdukBaru()
{
   global $conn;	 
   
   $nama = mysqli_escape_string($conn,$_POST['nama']);
   $kategori = mysqli_escape_string($conn,$_POST['kategori']);
   $sku = mysqli_escape_string($conn,$_POST['sku']);
   $barcode = mysqli_escape_string($conn,$_POST['barcode']);
   $harga = mysqli_escape_string($conn,$_POST['harga']);
   if($harga=='') $harga=0;
   if ($_FILES["photo"]["tmp_name"]!=''){
	   $ts=time();
	   $nf=$ts;
	   $fileName = $_FILES['photo']['name'];
	   $pecah = explode(".", $fileName);
	   $ext = $pecah[1];
	   $gambar=$nf.".".$ext;
	   move_uploaded_file($_FILES["photo"]["tmp_name"], 'img/produk/'.$gambar);
   } else $gambar='';
   
   $sql="insert into produk(nama,kategori,harga,gambar,sku,barcode,aktif) 
          values('$nama','$kategori',$harga,'$gambar','$sku','$barcode','Y')";
   $result = mysqli_query($conn,$sql);       
   
   header('Location:index.php?menu=produk'); 
}

function EditProduk()
{
   global $conn;	 
   $id = mysqli_escape_string($conn,$_POST['id']);
   $nama = mysqli_escape_string($conn,$_POST['nama']);
   $kategori = mysqli_escape_string($conn,$_POST['kategori']);
   $sku = mysqli_escape_string($conn,$_POST['sku']);
   $barcode = mysqli_escape_string($conn,$_POST['barcode']);
   $harga = mysqli_escape_string($conn,$_POST['harga']);
   if($harga=='') $harga==0; else $harga=UnformatAngka($harga);
   $aktif = mysqli_escape_string($conn,$_POST['aktif']);
   if($harga=='') $harga=0;
   if ($_FILES["photo"]["tmp_name"]!=''){
	   $ts=time();
	   $nf=$ts;
	   $fileName = $_FILES['photo']['name'];
	   $pecah = explode(".", $fileName);
	   $ext = $pecah[1];
	   $gambar=$nf.".".$ext;
	   move_uploaded_file($_FILES["photo"]["tmp_name"], 'img/produk/'.$gambar);
	   $sql="update produk set nama='$nama',kategori='$kategori',harga='$harga',sku='$sku',barcode='$barcode',aktif='$aktif',gambar='$gambar' where id='$id'";
   } else {
	   $sql="update produk set nama='$nama',kategori='$kategori',harga='$harga',sku='$sku',barcode='$barcode',aktif='$aktif' where id='$id'";
   }	   
   $result = mysqli_query($conn,$sql);  
   
   header('Location:index.php?menu=produk'); 
}

function HapusProduk()
{
   global $conn;
   $id = mysqli_escape_string($conn,$_GET['id']);
   $sql="delete from produk where id='$id'";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=produk'); 
}