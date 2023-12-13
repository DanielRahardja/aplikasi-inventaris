<?php
include 'koneksi.php';

$id= $_GET['idKategori'];

$hapus= mysqli_query($koneksi,"delete from kategoribarang where idKategori= '$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=kategoribarang'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=kategoribarang';alert ('Data Gagal dihapus!');</script>";
}
?>