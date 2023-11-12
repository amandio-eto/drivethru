<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
   
   $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);	
   $passw = mysqli_real_escape_string($conn,$_POST['password']);	  
   $passw =  sha1($passw); 
   
   $q =mysqli_query($conn,"select username from user where username='$user_name' and password='$passw'");
   if (mysqli_num_rows($q)>0) {
	    $_SESSION['user'] = $user_name;
		$_SESSION['key'] = 'DRIVE_THRU';
	   header("location:index.php");			
   } else header("location:login.php?info=1");	
     
?>   