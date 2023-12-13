<?php
// mengaktifkan session pada php
session_start();
//Connect Database
require('koneksi.php');

//Fetch Data
$uname= $_POST['uname'];
$password= md5($_POST['password']);

$query= mysqli_query($koneksi,"select * from users where namaAkun= '$uname' and password= '$password'");
$cari= mysqli_num_rows($query);

if($cari>0){
	$fetchprivelege= mysqli_fetch_array($query);
	$privelege= $fetchprivelege['privelege'];

	if ($privelege=='Admin') {
		$_SESSION['log']= 'logged';
		$_SESSION['namaAkun']= $uname;
		$_SESSION['privelege']= 'Admin';
		header("location:halamanadmin.php");
	}elseif ($privelege=='Operator'){
		$_SESSION['log']= 'logged';
		$_SESSION['namaAkun']= $uname;
		$_SESSION['privelege']= 'Operator';
		header("location:halamanoperator.php");
	}
}else {
	header("location:index.php?pesan=gagal");
}
?>