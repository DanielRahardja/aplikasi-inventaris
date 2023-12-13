<?php
// Call Database
include 'koneksi.php';

$username= $_POST['username'];
$email= $_POST['email'];
$password= $_POST['password'];
$role= $_POST['role'];

     $query = "INSERT INTO users VALUES ('','$username','$email',MD5('$password'), '$role')";
          $result = mysqli_query($koneksi, $query);
          // periska query apakah ada error
          if(!$result){
              die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
          } else {
              //tampil alert dan akan redirect ke halaman index.php
              //silahkan ganti index.php sesuai halaman yang akan dituju
              $update= "UPDATE pegawai SET statusAkun='Aktif' where namaPegawai='$username' ";
              $result2 = mysqli_query($koneksi, $update);
              if(!result2){
                die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                    " - ".mysqli_error($koneksi));
              }else{
                echo "<script>window.location='halamanadmin.php?url=pegawai'; alert('Data berhasil ditambahkan.'); </script>";
              }
              
         }

?>