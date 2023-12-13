<?php
// Call Database
include 'koneksi.php';

$namaRuang= $_POST['namaRuang'];
$kategoriRuangan= $_POST['kategoriRuangan'];
$lokasiGedung= $_POST['lokasiGedung'];
$lantai= $_POST['lantai'];
$keterangan= $_POST['keterangan'];

     $query = "INSERT INTO ruangan VALUES ('','$namaRuang', '$kategoriRuangan', '$lokasiGedung', '$lantai','$keterangan')";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              echo "<script>window.location='halamanadmin.php?url=ruang';alert('Data berhasil ditambahkan.'); </script>";
              }

?>