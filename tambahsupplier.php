<?php
// Call Database
include 'koneksi.php';

$namaSupplier= $_POST['namaSupplier'];
$alamat= $_POST['alamat'];
$nomorTelepon= $_POST['nomorTelepon'];
$kota= $_POST['kota'];
$perwakilan= $_POST['perwakilan'];

     $query = "INSERT INTO supplier VALUES ('','$namaSupplier','$alamat','$nomorTelepon','$kota','$perwakilan','Belum terdaftar')";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
               echo "<script>window.location='halamanadmin.php?url=supplier'; alert('Data berhasil ditambahkan.'); </script>";
              }

?>