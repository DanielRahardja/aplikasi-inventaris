<?php
// Call Database
include 'koneksi.php';

$namaGedung= $_POST['namaGedung'];

     $query = "INSERT INTO gedung VALUES ('','$namaGedung')";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              echo "<script>window.location='halamanadmin.php?url=gedung'; alert('Data berhasil ditambahkan.'); </script>";
              }

?>