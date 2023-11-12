<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');

  $jns = mysqli_escape_string($conn,$_GET['jns']);
  
  switch ($jns) {

    case 'baru' :
        KategoriBaru();
        break;
      
    case 'edit' :
        EditKategori();
        break;
		
    case 'hapus' :
        HapusKategori();
        break;
    	   
    default :
        header('Location:index.php');
  }		


function KategoriBaru()
{
   global $conn;	 
   
   $nama = mysqli_escape_string($conn,$_POST['nama']);
   if ($_FILES["photo"]["tmp_name"]!=''){
	   $ts=time();
	   $nf=$ts;
	   $fileName = $_FILES['photo']['name'];
	   $pecah = explode(".", $fileName);
	   $ext = $pecah[1];
	   $gambar=$nf.".".$ext;
	   move_uploaded_file($_FILES["photo"]["tmp_name"], 'img/kategori/'.$gambar);
   } else $gambar='';
   
   $sql="insert into kategori(nama,gambar,aktif) 
          values('$nama','$gambar','Y')";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=kategori'); 
}

function EditKategori()
{
   global $conn;	 
   $id = mysqli_escape_string($conn,$_POST['id']);
   $nama = mysqli_escape_string($conn,$_POST['nama']);
   $aktif = mysqli_escape_string($conn,$_POST['aktif']);
    if ($_FILES["photo"]["tmp_name"]!=''){
	   $ts=time();
	   $nf=$ts;
	   $fileName = $_FILES['photo']['name'];
	   $pecah = explode(".", $fileName);
	   $ext = $pecah[1];
	   $gambar=$nf.".".$ext;
	   move_uploaded_file($_FILES["photo"]["tmp_name"], 'img/kategori/'.$gambar);
	   $sql="update kategori set nama='$nama',aktif='$aktif',gambar='$gambar' where id='$id'";
   } else {
	   $sql="update kategori set nama='$nama',aktif='$aktif' where id='$id'";
   }	   
   $result = mysqli_query($conn,$sql);  
   
   header('Location:index.php?menu=kategori'); 
}

function HapusKategori()
{
   global $conn;
   $id = mysqli_escape_string($conn,$_GET['id']);
   $sql="delete from kategori where id='$id'";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=kategori'); 
}