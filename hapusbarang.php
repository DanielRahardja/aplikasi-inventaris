<?php
include 'koneksi.php';

$id= $_GET['no'];

$hapus= mysqli_query($koneksi,"delete from barang where no='$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=barang'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=barang';alert ('Data Gagal dihapus!');</script>";
}
?>