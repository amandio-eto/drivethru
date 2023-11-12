<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');

  $jns = mysqli_escape_string($conn,$_GET['jns']);
  
  switch ($jns) {

    case 'baru' :
        MenuBaru();
        break;
      
    case 'edit' :
        EditMenu();
        break;
		
    case 'hapus' :
        HapusMenu();
        break;
    	   
    default :
        header('Location:index.php');
  }		


function MenuBaru()
{
   global $conn;	 
   
   $nama = mysqli_escape_string($conn,$_POST['nama']);
   
   $sql="insert menu(nama) values('$nama')";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=menu'); 
}

function EditMenu()
{
   global $conn;	 
   $id = mysqli_escape_string($conn,$_POST['id']);
   $menu = mysqli_escape_string($conn,$_POST['menu']);
   $judul = mysqli_escape_string($conn,$_POST['judul']);
   
   $sql="update menu set menu='$menu',judul='$judul' where id='$id'";
   $result = mysqli_query($conn,$sql);  
   
   header('Location:index.php?menu=menu'); 
}

function HapusMenu()
{
   global $conn;
   $id = mysqli_escape_string($conn,$_GET['id']);
   $sql="delete from menu where id='$id'";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=menu'); 
}