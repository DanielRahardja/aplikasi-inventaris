<?php
include 'koneksi.php';

$id= $_GET['idKategoriRuang'];

$hapus= mysqli_query($koneksi,"delete from kategoriruangan where idKategoriRuang= '$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=kategoriruang'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=kategoriruang';alert ('Data Gagal dihapus!');</script>";
}
?>