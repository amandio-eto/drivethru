<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
   
   $barcode = mysqli_escape_string($conn,$_GET['barcode']);
   $prod = AmbilData("select id from produk where barcode='$barcode' or sku='$barcode'");
   echo $prod;
?>			