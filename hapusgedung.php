<?php
include 'koneksi.php';

$id= $_GET['idGedung'];

$hapus= mysqli_query($koneksi,"delete from gedung where idGedung= '$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=gedung'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=gedung';alert ('Data Gagal dihapus!');</script>";
}
?>