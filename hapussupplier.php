<?php
include 'koneksi.php';

$id= $_GET['no'];

$hapus= mysqli_query($koneksi,"delete from supplier where no='$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=supplier'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=supplier';alert ('Data Gagal dihapus!');</script>";
}
?>