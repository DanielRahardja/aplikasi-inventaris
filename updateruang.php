<?php
// Call Database
include 'koneksi.php';
$id= $_POST['idRuang'];
$namaRuang= $_POST['namaRuang'];
$kategoriRuang= $_POST['kategoriRuangan'];
$lokasiGedung= $_POST['lokasiGedung'];
$lantai= $_POST['lantai'];
$keterangan= $_POST['keterangan'];

     $query = "UPDATE ruangan SET namaRuang='$namaRuang', kategoriRuangan='$kategoriRuang', lokasiGedung='$lokasiGedung', lantai='$lantai', keterangan='$keterangan' where idRuang ='$id' ";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
               echo "<script>window.location='halamanadmin.php?url=ruang'; alert('Data berhasil diubah.');</script>";
              }

?>