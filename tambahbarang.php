<?php
// Call Database
include 'koneksi.php';

$namaBarang= $_POST['namaBarang'];
$spesifikasi= $_POST['spesifikasi'];
$kategori= $_POST['kategori'];
$stok= $_POST['stok'];

     $query = "INSERT INTO barang VALUES ('','$namaBarang', '$spesifikasi', '$kategori', '$stok','0')";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              echo "<script>window.location='halamanadmin.php?url=barang';alert('Data berhasil ditambahkan.'); </script>";
              }

?>