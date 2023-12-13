<?php
include 'koneksi.php';

$id= $_GET['no'];
$hapus= mysqli_query($koneksi,"delete from pegawai where no='$id'");

if ($hapus) {
    echo "<script>window.location='halamanadmin.php?url=pegawai'; alert ('Data Berhasil dihapus!');</script>";
}else{
    echo "<script>window.location='halamanadmin.php?url=pegawai';alert ('Data Gagal dihapus!');</script>";
}
?>