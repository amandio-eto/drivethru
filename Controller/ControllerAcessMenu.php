<?php
$id = mysqli_escape_string($conn, $_GET['id']);
$username = AmbilData("select username from user where id=$id");
$userid = $id;
?>