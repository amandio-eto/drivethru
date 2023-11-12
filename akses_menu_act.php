<?php

#This is The Sessions 
   session_start();


   
   require_once 'konfig.php'; 
   require_once 'fungsi_umum.php';
  
  
   if ($_SESSION['key']!='DAPEN') 
     header('Location:index.php');

   
   $userid = mysqli_escape_string($conn,$_POST['userid']);
   $jml_menu = mysqli_escape_string($conn,$_POST['jml_menu']);
   
   for ($i=1;$i<=$jml_menu;$i++){
	  $menu=$_POST['menu'.$i];
	  if (isset($_POST['akses'.$i])) $akses='Y'; else $akses='N'; 
	  if (AdaData("select user from hak_akses where user='$userid' and menu='$menu'"))
        $sql="update hak_akses set akses='$akses' where user='$userid' and menu='$menu'";
      else    
     	$sql="insert hak_akses(user,menu,akses) values('$userid','$menu','$akses')";
     $result = mysqli_query($conn,$sql);       
   }	
   header('Location:index.php?menu=user'); 
?>