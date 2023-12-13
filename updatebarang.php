<?php
// Call Database
include 'koneksi.php';
$id= $_POST['no'];
$namaBarang= $_POST['namaBarang'];
$spesifikasi= $_POST['spesifikasi'];
$kategori= $_POST['kategori'];


     $query = "UPDATE barang SET namaBarang='$namaBarang', spesifikasi='$spesifikasi', kategori='$kategori' where no='$id' ";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              echo "<script>window.location='halamanadmin.php?url=barang'; alert('Data berhasil diubah.');</script>";
              }

?>