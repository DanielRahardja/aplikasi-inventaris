<?php
include 'koneksi.php';

$namaAkun= $_GET['namaAkun'];

$hapus = mysqli_query($koneksi,"delete from users where namaAkun='$namaAkun'");
if (!$hapus) {
   die ("Query hapus gagal: " . mysqli_error($koneksi));
}

$update = "UPDATE pegawai SET statusAkun='Tidak Aktif' where namaPegawai='$namaAkun' ";
$executeupdate = mysqli_query($koneksi, $update);
if (!$executeupdate) {
   die ("Query update gagal: " . mysqli_error($koneksi));
}

echo "<script>window.location='halamanadmin.php?url=pegawai'; alert ('Data Berhasil dihapus!');</script>";

?>