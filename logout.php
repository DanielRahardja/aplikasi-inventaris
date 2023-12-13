<?php 
 
 unset($_SESSION['namaAkun']);
 unset($_SESSION['password']);
 unset($_SESSION['privelege']);
 session_destroy();
 
 echo "<script>window.location.href = 'index.php';</script>";
 
?>