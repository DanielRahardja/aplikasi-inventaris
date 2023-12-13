<?php
include 'koneksi.php';

$id= $_GET['idLantai'];

$hapus= mysqli_query($koneksi,"delete from lantai where idLantai= '$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=lantai'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=lantai';alert ('Data Gagal dihapus!');</script>";
}
?>