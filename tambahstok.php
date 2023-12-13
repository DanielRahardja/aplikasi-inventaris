<?php
// Call Database
session_start();
include 'koneksi.php';
$id= $_POST['no'];
$namaBarang= $_POST['namaBarang'];
$supplier= $_SESSION['namaAkun'];
$stok= $_POST['stok'];

     $query = "UPDATE barang SET stok= stok+'$stok' where no='$id' ";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              $history= "INSERT INTO masukBarang VALUES ('','$namaBarang','$stok','$supplier',NOW())";
              $result2 = mysqli_query($koneksi, $history);
              echo "<script>window.location='halamansupplier.php?url=barang'; alert('Data berhasil diubah.');</script>";
              }

?>