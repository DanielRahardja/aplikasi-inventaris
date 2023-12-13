<?php
// Call Database
include 'koneksi.php';
$id= $_POST['no'];
$namaPegawai= $_POST['namaPegawai'];
$alamat= $_POST['alamat'];
$jenisKelamin= $_POST['jenisKelamin'];
$userid= $_POST['userid'];
$role= $_POST['role'];

     $query = "UPDATE pegawai SET namaPegawai='$namaPegawai', alamat= '$alamat', jenisKelamin='$jenisKelamin', `role`= '$role' where no='$id' ";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju

              $update = "UPDATE users SET namaAkun='$namaPegawai', privelege='$role' where userid='$userid' ";
              $executeupdate = mysqli_query($koneksi, $update);
              if (!$executeupdate) {
                die ("Query update gagal: " . mysqli_error($koneksi));
              }
              echo "<script>window.location='halamanadmin.php?url=pegawai'; alert('Data berhasil diubah.');</script>";
            }

?>