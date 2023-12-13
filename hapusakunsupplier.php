<?php
include 'koneksi.php';

$namaAkun= $_GET['namaAkun'];

$hapus = mysqli_query($koneksi,"delete from users where namaAkun='$namaAkun'");
if (!$hapus) {
   die ("Query hapus gagal: " . mysqli_error($koneksi));
}

$update = "UPDATE supplier SET statusAkun='Akun Tidak Aktif' where namaSupplier='$namaAkun' ";
$result2 = mysqli_query($koneksi, $update);
if (!$result2) {
   die ("Query update gagal: " . mysqli_error($koneksi));
}

echo "<script>window.location='halamanadmin.php?url=supplier'; alert ('Data Berhasil dihapus!');</script>";

?>