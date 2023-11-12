<?php
   session_start();
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
  
   if ($_SESSION['key']!='DRIVE_THRU') 
     header('Location:index.php');

  $jns = mysqli_escape_string($conn,$_GET['jns']);
  
  switch ($jns) {

    case 'baru' :
        UserBaru();
        break;
      
    case 'edit' :
        EditUser();
        break;
	
	case 'ubah' :
        UbahPasswordUser();
        break;	
		
    case 'hapus' :
        HapusUser();
        break;
    	   
    default :
        header('Location:index.php');
  }		


function UserBaru()
{
   global $conn;	 
   
   $username = mysqli_escape_string($conn,$_POST['username']);
   $password = mysqli_escape_string($conn,$_POST['password']);
   $password = sha1($password);
   if (AdaData("select username from user where username='$username'")){
	   header('Location:index.php?menu=user&error=1'); 
   } else {
      $sql="insert user(username,password) 
          values('$username','$password')";
      $result = mysqli_query($conn,$sql);       
	  header('Location:index.php?menu=user'); 
   }
}

function EditUser()
{
   global $conn;	 
   $id = mysqli_escape_string($conn,$_POST['id']);
   $username = mysqli_escape_string($conn,$_POST['username']);
   $password = mysqli_escape_string($conn,$_POST['password']);
   $password = sha1($password);
   
   $sql="update user set username='$username',password='$password' where id='$id'";
   $result = mysqli_query($conn,$sql);  
   
   header('Location:index.php?menu=user'); 
}

function UbahPasswordUser()
{
   global $conn;	 
   $id = mysqli_escape_string($conn,$_POST['id']);
   $password = mysqli_escape_string($conn,$_POST['password']);
   $password = sha1($password);
   
   $sql="update user set password='$password' where id='$id'";
   $result = mysqli_query($conn,$sql);       
   
   header('Location:index.php?menu=user'); 
}

function HapusUser()
{
   global $conn;
   $id = mysqli_escape_string($conn,$_GET['id']);
   $sql="delete from user where id='$id'";
   $result = mysqli_query($conn,$sql);       
	
	header('Location:index.php?menu=user'); 
}