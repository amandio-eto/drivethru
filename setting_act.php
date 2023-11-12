<?php
   session_start();
   require_once 'konfig.php'; 
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');
  
   $nama = mysqli_escape_string($conn,$_POST['nama']);
   $alamat = mysqli_escape_string($conn,$_POST['alamat']);
   $telp = mysqli_escape_string($conn,$_POST['telp']);
   
   $sql="update setting set nama_pt='$nama',alamat='$alamat',telp='$telp'";

   $result = mysqli_query($conn,$sql);       
	
   header('Location:index.php'); 
