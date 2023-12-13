<?php
include 'koneksi.php';

$id= $_GET['idRuang'];

$hapus= mysqli_query($koneksi,"delete from ruangan where idRuang= '$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=ruang'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=ruang';alert ('Data Gagal dihapus!');</script>";
}
?>