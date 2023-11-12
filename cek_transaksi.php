<?php
   require_once 'konfig.php';
   require_once 'fungsi_umum.php';
   $kasir_out=AmbilData("select kasir from kasir_outdoor");
   $bukti = AmbilData("select bukti from transaksi where status='0' and kasir='$kasir_out'");
   echo $bukti	
?>			